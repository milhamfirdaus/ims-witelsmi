<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Witel extends Backend_Controller {

	public function __construct(){
			parent::__construct();
			$this->load->model(array('witel_model'));  //fungsi untuk memanggil model "witel_model"
	}	

	public function index(){
		$data = array();
		$this->site->view('witel', $data);
	}

	public function action($param){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			

			if($param=='tambah' || $param=='update'){ 					//jika button tambah di click
				$rules=$this->witel_model->rules; 			//memakai rules yang ada pada witel model
				$this->form_validation->set_rules($rules); 	//mengatur rules untuk form validation

				if($this->form_validation->run() == TRUE){  //jika data yang di inputkan sesuai dengan rules (benar)
					$post = $this->input->post();   
					$data = array(    						//memasukan data yang ada pada post ke dalam database
			 				'witel_datel' =>$post['witel-datel'] ,
							'lokasi'=>$post['lokasi']
					); 

					if(!empty($post['hidden-id'])){   //jika ada hidden id maka lakukan update
						$this->witel_model->update($data, array('id_witel'=> $post['hidden-id']));
						$result=array('status' =>'success');
					}
					else{										 //jika hidden id kosong maka lakukan create/insert
						if($this->witel_model->insert($data)){   //jika sesuai dengan form validation maka status ajax success dan creat data
						$result=array('status' =>'success');
						}
						else{ 				//jika tidak sesuai dengan form validation maka status ajax failed dan membatalkan insert
							$result=array('status' =>'failed');
						}
					}
				}
				else{
					$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
				}
				echo json_encode($result);
			}

			else if($param =='ambil'){
				$post= $this->input->post(NULL,TRUE);

				if(!empty($post['id'])){
					echo json_encode(array(
						'status' => 'success',
						'data' => $this->witel_model->get($post['id'])  
					));
				}
				else{
					$total_rows = $this->witel_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post['hal_aktif'] > 1 ){
					$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}

						if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->witel_model->count(array("witel_datel LIKE" => "%$cari%"));
							@$record =$this->witel_model->get_by(array("witel_datel LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->witel_model->get_by(NULL,$SConfig->_backend_perpage,$offset);
						}
					echo json_encode(
						array(
								'total_rows' => $total_rows,
								'perpage' => $SConfig ->_backend_perpage,
								'record' => $record 
								)
							);
				}
			}

			else if ($param =='hapus'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
					$this->witel_model->delete($post['hidden-id']);
					echo json_encode(array('status' =>'success'));
				}
				else{
					echo json_encode($result);
				}
			}
		}
	}









}