<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Backend_Controller {
	
	protected $user_detail;

	public function __construct(){
		parent::__construct();		
		$this->load->model(array('user_model','user_detail_model'));
		$this->load->helper('cookie');
	}

	public function index(){
		$data = array();
		$this->site->view('user',$data);		
	}

	public function login(){
		
		/* tahap 3 finishing */
		$post = $this->input->post(NULL, TRUE);
		
		if(isset($post['nik']) ){ 
			$this->user_detail = $this->user_model->get_by(array('nik' => $post['nik'], 'group' => 'Admin'), 1, NULL, TRUE);
		}

		$this->form_validation->set_message('required', '%s kosong, tolong diisi!');

		$rules = $this->user_model->rules;
		$this->form_validation->set_rules($rules);	

		if($this->form_validation->run() == FALSE){	
			$this->site->view('login');
        }
        else{
			$login_data = array(
					'id_user' => $this->user_detail->id_user,
			        'nik'  => $post['nik'],		
			        'nama_user' => $this->user_detail->nama_lengkap,
			        'group' => $this->user_detail->group,
			        'email' => $this->user_detail->email,	        
			        'logged_in' => TRUE,
			        'last_login' => date('Y m d')
			);						

			$this->session->set_userdata($login_data);

			if(isset($post['remember']) ){
				$expire = time() + (86400 * 7);
				set_cookie('nik', $post['nik'], $expire , "/");
				set_cookie('password', $post['password'], $expire , "/" );
			}
			
			redirect(set_url('dashboard'));
        }
    }

	public function logout(){
		$this->session->sess_destroy();
		delete_cookie('nik'); delete_cookie('password');
		redirect(set_url('login'));
	}

	public function password_check($str){
    	$user_detail =  $this->user_detail;  	
    	if (@$user_detail->password == crypt($str,@$user_detail->password)){
			return TRUE;
		}
		else if(@$user_detail->password){
			$this->form_validation->set_message('password_check', 'Password yang Anda masukan salah !');
			return FALSE;
		}
		else{
			$this->form_validation->set_message('password_check', 'Anda tidak punya akses Admin !');
			return FALSE;	
		}		
	}	

	public function action($param){
		global $SConfig;
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			if($param == 'ambil'){
				$post = $this->input->post();

				if(!empty($post['id'])){
					$record = $this->user_model->get_user_detail($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				else{
					$offset = NULL;
					
					if(!empty($post['hal_aktif']) && $post['hal_aktif'] > 1){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage ;
					}

					if(!empty($post['cari']) && ($post['cari'] != 'null')){
						$cari = $post['cari'];
						$total_rows = $this->user_model->count(array("nik LIKE" => "%$cari%"));
						@$record = $this->user_model->get_user(array("nik LIKE" => "%$cari%"),$SConfig->_backend_perpage, $offset, FALSE, "id_user, nik, group, email, nama_lengkap, {PRE}user_detail.*");
					}
					else{
						$record = $this->user_model->get_user(NULL,$SConfig->_backend_perpage,$offset,FALSE, "id_user, nik, group, email, nama_lengkap, {PRE}user_detail.*");	
						$total_rows = $this->user_model->count();						
					}

					echo json_encode(array(
						'record' => $record,
						'total_rows' => $total_rows, 
						'perpage' => $SConfig->_backend_perpage,
					) );					
				}			
			}

			else if($param == 'tambah' || $param == 'update'){

				if($param == 'update'){
					$rules = $this->user_model->rules_update;					
				}
				else{
					$rules = $this->user_model->rules_register;
				}
				
				$this->form_validation->set_rules($rules);

				$post = $this->input->post();
				if ($this->form_validation->run() == TRUE){
					$data = array(
							'nik' => $post['nik'],
							'password' => bCrypt($post['password'],12),							
							'group' => (!empty($post['group-user'])) ? $group = $post['group-user'] : $group = '',
							'nama_lengkap' => $post['nama-user'],
							'email' => $post['email']
					);

					unset($data['active']);

					if($param == 'update'){
						unset($data['email']);
						unset($data['nik']);
						if(!empty($post['password'])) { 
							$data['password'] = bCrypt($post['password'],12);
						}
						else{
							unset($data['password']);
						}

						$this->user_model->update($data, array('id_user' => $post['hidden-id']));
						$getID = $post['hidden-id'];
					}
					else{
						$getID = $this->user_model->insert($data);
					}
					//----------detail user-------//
					if(!empty($getID)){
						$data_detail = array(	
							'jabatan' => $post['jabatan'],
							'jenis_kelamin' => $post['jenis-kelamin'],	
							'handphone' => $post['handphone'],
							'alamat' => $post['alamat']									
							);

						if($param == 'update'){
							$this->user_detail_model->update($data_detail, array('user_detail_ID' => $getID));
						}
						else{
							$data_detail['id_tbuser'] = $getID;
							$this->user_detail_model->insert($data_detail);
						}
					}
					$result = array('status' => 'success');
				}
				else{
					$result = array('status' => 'failed');
				}

				echo json_encode($result);			
			}

			else if($param == 'hapus'){
				$post = $this->input->post();
				if(!empty($post['hidden-id'])){
					$data_detail = $this->user_detail_model->get_by(array('user_detail_ID' => $post['hidden-id']), 1, NULL, TRUE);
					$id_detail= $data_detail->user_detail_ID;
					$this->user_model->delete($post['hidden-id']);
					$result = array('status' => 'success');
					$this->user_detail_model->delete($id_detail);
				}

				echo json_encode($result);
			}			
		}
	}

	public function email_check($str){
		/* bisa digunakan untuk mengecek ke dalam database */
		if ($this->user_model->count(array('email' => $str)) > 0){
            $this->form_validation->set_message('email_check', 'Email sudah digunakan, mohon ganti dengan yang lain');
            return FALSE;
        }
        else{
            return TRUE;
        }
	}	

	public function nik_check($str){
		/* bisa digunakan untuk mengecek ke dalam database */
		if ($this->user_model->count(array('nik' => $str)) > 0){
            $this->form_validation->set_message('nik_check', 'NIK sudah digunakan, mohon ganti dengan yang lain');
            return FALSE;
        }
        else{
            return TRUE;
        }
	}	






// stackoverflow.com/questions/19706046/how-to-read-an-external-local-json-file-in-javascript //






















}