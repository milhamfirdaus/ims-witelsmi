<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluar extends Backend_Controller{

	protected $barang_detail;
	protected $user_detail;

	public function __construct(){
		parent::__construct();
		$this->load->model(array('barang_model','jenis_model','barangkeluar_model','user_model','witel_model'));
	}	

	public function index(){
		$data = array();
		$this->site->view('barang_keluar', $data);
	}

	public function action($param){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

			if($param =='ambil'){
				$post= $this->input->post(NULL,TRUE);

				//=== ambil post id barang untuk form pilih===//
				if(!empty($post['id'])){
					$record = $this->barang_model->get($post['id']);
					$record->barang_attribute = json_decode($record->barang_attribute);
					$allnik = $this->user_model->get_by(array('nik'),NULL,NULL,FALSE, 'nik');
					$allwitel = $this->witel_model->get_by(array('witel_datel'),NULL,NULL,FALSE, 'witel_datel');
					echo json_encode(
						array(
							'status' => 'success',
							'data' => $record,
							'all_nik' =>$allnik ,
							'all_witel' =>$allwitel 
							)
					);
				}
				//=== ambil semua data barang ===//
				else{
					$total_rows = $this->barang_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}

						if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->barang_model->count("nama_barang LIKE '%$cari%' or serial LIKE '%$cari%'");
							if ($total_rows <= 0){
								$result='notfound';
							}
							else{
								$record =$this->barang_model->get_by("nama_barang LIKE '%$cari%' or serial LIKE '%$cari%'",$SConfig->_backend_perpage,$offset);
								$result='success';
							}
							$status=$result;
						}
						else{
								$status='failed';
						}
						echo json_encode(
							array(
								'status' =>$status,
								'total_rows' => $total_rows,
								'perpage' => $SConfig ->_backend_perpage,
								'record' => $record
							)
						);
					}
			}
			else if ($param=='simpan'){
				$rules=$this->barangkeluar_model->rules;

				//mengatur rules untuk form validation 						
				$this->form_validation->set_rules($rules); 				

				//jika data yang di inputkan sesuai dengan form validation/rules (BENAR)
				if($this->form_validation->run() == TRUE){  			
					$post = $this->input->post();   

					/* ATRIBUT FEATURED IMAGES */
					if(!array_key_exists('txt_file_name', $post)){
						
						$file_name = '';
						$file_dir = '';
						$file_thumbnail = '';
						$barang_attribute = '';
					}
					else{
						$file_name = $post['txt_file_name'];
						$file_dir = $post['txt_file_dir'];
						$file_thumbnail = $post['txt_file_thumbnail'];
					}

					$barangkeluar_attribute = array(
							'file_name' => $file_name,
							'file_thumbnail' => $file_thumbnail,
							'file_dir' =>$file_dir					
					);
					/* ATRIBUT FILE BARANG BERAKHIR DISINI*/

					if(!empty($post['hidden-id'])){   			
						$this->barang_detail = $this->barang_model->get_by(array('id_barang' => $post['hidden-id']), 1, NULL, TRUE);
						$this->user_detail = $this->user_model->get_by(array('nik' => $post['nik']), 1, NULL, TRUE);

						$jumlahtersedia = $this->barang_detail->jumlah;

						if($post['jumlah-barang'] > $jumlahtersedia){
							$result=array('status' =>'failed','errors'=> 'error_jumlahkurang');
						}
						else if($jumlahtersedia == 0 ){
							$result=array('status' =>'failed','errors'=> 'error_jumlahtidaktersedia');
						}
						else if($post['jumlah-barang'] == 0 ){
							$result=array('status' =>'failed','errors'=> 'error_inputjumlahkosong');
						}
						else{

							$nama = $this->user_detail->nama_lengkap;
							$jumlahsetelahdikurangi = $jumlahtersedia - $post['jumlah-barang'];
							$databarang=array('jumlah'=> $jumlahsetelahdikurangi);

							$datakeluar = array(    									
			 				'nik' =>$post['nik'],
							'nama'=>$nama,
 							'nama_barang'=>$post['hidden-barang'],
							'witel_datel'=>$post['witel-datel'],
							'ip' => $post['IP'],
							'tanggal_keluar'=> $post['tanggal-keluar'],
							'jumlah'=> $post['jumlah-barang'],
							'keterangan'=>$post['keterangan-barang'],
							'barangkeluar_attribute' => json_encode(@$barangkeluar_attribute)
							);

							$checknik = $this->user_model->count(array('nik LIKE' => $datakeluar['nik']));
							$checkwitel = $this->witel_model->count(array('witel_datel LIKE' => $datakeluar['witel_datel']));
							
							if ($checknik == 0){
								$result=array('status' =>'failed','errors'=> 'error_nik');
							}
							else if ($checkwitel == 0){
								$result=array('status' =>'failed','errors'=> 'error_witel');
							}
							else{

								$this->barang_model->update($databarang,array('id_barang'=> $post['hidden-id']));
								$this->barangkeluar_model->insert($datakeluar);
								$result=array('status' =>'success');
							}
						}
					}
					else{											
						$result=array('status' =>'failed');
					}

					//memasukan data yang ada pada post ke dalam database
					 

				}
				else{
					$result=array('status' =>'failed','errors'=> $this->form_validation->error_array());
				}
				echo json_encode($result);
			}

		}
	}


	public function riwayat($action=''){
		global $SConfig; 
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			
			if($action =='ambil'){
				$post= $this->input->post(NULL,TRUE);

				//=== ambil post id barang untuk form pilih===//
				if(!empty($post['id'])){
					$record = $this->barangkeluar_model->get($post['id']);
					$record->barangkeluar_attribute = json_decode($record->barangkeluar_attribute);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				//=== ambil semua data barang ===//
				else{
					$total_rows = $this->barangkeluar_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->barangkeluar_model->count(array("nama_barang LIKE" => "%$cari%"));
							@$record =$this->barangkeluar_model->get_by(array("nama_barang LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						
						else{
							$record = $this->barangkeluar_model->get_by(NULL,$SConfig->_backend_perpage,$offset);
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

			else if ($action =='hapus'){
				$post= $this->input->post(NULL,TRUE);
				if(!empty($post['hidden-id'])){
					$this->barangkeluar_model->delete($post['hidden-id']);
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
			$this->site->view('riwayat_keluar', $data);
		}
	}



	public function laporan(){
		$data['keluar'] = $this->barangkeluar_model->get();
		$this->site->view('laporan-barang-keluar',$data);
	}













}