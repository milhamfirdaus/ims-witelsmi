<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends Backend_Controller {

	protected $barang_detail;

	public function __construct(){
		parent::__construct();
		$this->load->model(array('barang_model','jenis_model'));
	}	

	public function index(){
		$data = array();
		$this->site->view('barang', $data);
	}

	public function action($param){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			//jika button di click dengan form action tambah/update
			if($param=='tambah' || $param=='update'){ 					

				//memakai rules yang ada pada barang model
				$rules=$this->barang_model->rules;

				//mengatur rules untuk form validation 						
				$this->form_validation->set_rules($rules); 				

				//jika data yang di inputkan sesuai dengan form validation/rules (BENAR)
				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   

					/* ATRIBUT FEATURED IMAGES */
					if(!array_key_exists('file_dir_original', $post)){
						$file_original = '';
						$file_thumbnail = '';
						$file_dir_original = '';
						$barang_attribute = '';
					}
					else{
						$file_original = $post['file_original'];
						$file_thumbnail = $post['file_thumbnail'];
						$file_dir_original = $post['file_dir_original'];
					}

					$barang_attribute = array(
							'file_original' =>$file_original,
							'file_thumbnail' => $file_thumbnail,
							'file_dir_original' => $file_dir_original					
					);
					/* ATRIBUT FILE BARANG BERAKHIR DISINI*/

					//memasukan data yang ada pada post ke dalam database
					$data = array(    									
			 				'nama_barang' =>$post['nama-barang'],
							'serial'=>$post['serial-number'],
							'nama_jenis'=>$post['jenis-barang'],
							'tanggal_masuk'=> $post['tanggal-masuk'],
							'nik_pengguna' => $post['nik-pengguna'],
							'sp' => $post['SP'],
							'jumlah'=> $post['jumlah'],
							'keterangan'=>$post['keterangan-barang'],
							'kondisi'=> $post['kondisi'],
							'barang_attribute' => json_encode(@$barang_attribute)
					); 

					if(empty($post['tanggal-masuk'])){
						$data['tanggal_masuk'] = date('Y-m-d');
					}

					$is_exist = $this->barang_model->count(array('nama_barang LIKE' => $data['nama_barang']));

					//jika ada hidden id maka lakukan update
					if(!empty($post['hidden-id'])){
						$checknik = $this->user_model->count(array('nik LIKE' => $data['nik_pengguna']));
						if ($checknik == 0){
							$result=array('status' =>'failed','errors'=> 'error_nik');
						} 
						else{					
						$this->barang_model->update($data, array('id_barang'=> $post['hidden-id']));
						$result=array('status' =>'success');
						}
					}
					else if ($is_exist > 0){
						$this->barang_detail = $this->barang_model->get_by(array('nama_barang' => $data['nama_barang']), 1, NULL, TRUE);
						$data['jumlah'] = $this->barang_detail->jumlah + $post['jumlah'];
						$this->barang_model->update($data, array('nama_barang'=> $data['nama_barang']));
						$result=array('status' =>'success');
					}

					//jika hidden id kosong maka lakukan create/insert
					else{
						$checknik = $this->user_model->count(array('nik LIKE' => $data['nik_pengguna']));
						
						if ($checknik == 0){
							$result=array('status' =>'failed','errors'=> 'error_nik');
						}
						//jika sesuai dengan form validation maka status ajax success dan creat data
						else if($this->barang_model->insert($data)){   		
						$result=array('status' =>'success');
						}
						//jika tidak sesuai dengan form validation maka status ajax failed dan membatalkan insert
						else{ 											
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

				//=== ambil post id dari url barang untuk form edit===//
				if(!empty($post['id'])){
					$record = $this->barang_model->get($post['id']);
					$record->barang_attribute = json_decode($record->barang_attribute);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				//=== ambil semua data barang ===//
				else{
					$total_rows = $this->barang_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						if (!empty($post['jenis']) && ($post['jenis'] != 'null')){
							$jenis =$post['jenis'];
							$total_rows = $this->barang_model->count(array("nama_jenis LIKE" => "%$jenis%"));
							@$record =$this->barang_model->get_by(array("nama_jenis LIKE"=> "%$jenis%"),$SConfig->_backend_perpage,$offset);
						}

						else if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->barang_model->count(array("nama_barang LIKE" => "%$cari%"));
							@$record =$this->barang_model->get_by(array("nama_barang LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						
						else{
							$record = $this->barang_model->get_by(NULL,$SConfig->_backend_perpage,$offset);
							}
						echo json_encode(
							array(
								'total_rows' => $total_rows,
								'perpage' => $SConfig ->_backend_perpage,
								'record' => $record,
								'all_jenis' => $this->jenis_model->get_by(
									array('nama_jenis'),
									NULL,NULL,FALSE, 'nama_jenis'),
								'all_nik' => $this->user_model->get_by(
									array('nik'),
									NULL,NULL,FALSE, 'nik')
							)
						);
					}
			}

			else if ($param =='hapus'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
					if(!empty($post['txt_file_dir'])){

						$file_dir   = $post['txt_file_dir'];
						$this->load->helper('file');
						unlink($file_dir);
						}
					$this->barang_model->delete($post['hidden-id']);
					echo json_encode(array('status' =>'success'));
				}
				else{
					echo json_encode($result);
				}
			}
		}
	}

	public function jenis($action=''){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			
			if($action=='tambah' || $action=='update'){ 					//jika button tambah di click
				$rules=$this->jenis_model->rules; 	//memakai rules yang ada pada barang model
				$this->form_validation->set_rules($rules); //mengatur rules untuk form validation

				if($this->form_validation->run() == TRUE){  //jika data yang di inputkan sesuai dengan rules (benar)
					$post = $this->input->post();   
					$data = array(    //memasukan data yang ada pada post ke dalam database
			 				'nama_jenis' =>$post['nama-jenis'] ,
							'deskripsi'=>$post['deskripsi'],
					); 

					if(!empty($post['hidden-id'])){   //jika ada hidden id maka lakukan update
						$this->jenis_model->update($data, array('id_jenis'=> $post['hidden-id']));
						$result=array('status' =>'success');
					}
					else{							//jika hidden id kosong maka lakukan create/insert
						if($this->jenis_model->insert($data)){   //jika sesuai dengan form validation maka status ajax success dan creat data
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

			else if($action =='ambil'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['id'])){
					echo json_encode(array(
						'status' => 'success',
						'data' => $this->jenis_model->get($post['id'])  
					));
				}
				else{
					$total_rows = $this->jenis_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
					$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->jenis_model->count(array("nama_jenis LIKE" => "%$cari%"));
							@$record =$this->jenis_model->get_by(array("nama_jenis LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->jenis_model->get_by(NULL,$SConfig->_backend_perpage,$offset);
						}
					echo json_encode(
					array(
							'total_rows' => $total_rows,
							'perpage' => $SConfig ->_backend_perpage,
							'record' => $record,
							'all_jenis' => $this->jenis_model->get_by(
									array('nama_jenis'),
									NULL,NULL,FALSE, 'nama_jenis')
							)
					);
				}
			}
			else if ($action =='hapus'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
					$this->jenis_model->delete($post['hidden-id']);
					$result=array('status' =>'success');
				}
				else{
					$result=array('status' =>'failed');
				}
				echo json_encode($result);
			}
		}
		else{
			$data = array();	
			$this->site->view('jenis_barang', $data);
		}
	}

	public function laporan(){
		$data['barang'] = $this->barang_model->get();
		$this->site->view('laporan-barang',$data);
	}











}
/*
	UNTUK UPLOADING FILE HANYA DAPAT DILAKUKAN UNTUK FILE DENGAN FORMAT PNG/JPG/JPEG/GIF
*/