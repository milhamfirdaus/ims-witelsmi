<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerusakan extends Backend_Controller{

	protected $barang_detail;
	protected $user_detail;

	public function __construct(){
		parent::__construct();
		$this->load->model(array('barang_model','jenis_model','kerusakanbarang_model','user_model'));
	}	

	public function index(){
		$data = array();
		$this->site->view('kerusakan', $data);
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
					echo json_encode(
						array(
							'status' => 'success',
							'data' => $record,
							'all_nik' =>$allnik
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
								'record' => $record,
								'all_nik' => $this->user_model->get_by(
									array('nik'),
									NULL,NULL,FALSE, 'nik')
							)
						);
					}
			}
			else if ($param=='simpan'){
				$rules=$this->kerusakanbarang_model->rules;

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

						if($post['jumlah-kerusakan'] > $jumlahtersedia){
							$result=array('status' =>'failed','errors'=> 'error_jumlahkurang');
						}
						else if($jumlahtersedia == 0 ){
							$result=array('status' =>'failed','errors'=> 'error_jumlahtidaktersedia');
						}
						else if($post['jumlah-kerusakan'] == 0 ){
							$result=array('status' =>'failed','errors'=> 'error_inputjumlahkosong');
						}
						else{
							$nama = $this->user_detail->nama_lengkap;
							$namabarang = $this->barang_detail->nama_barang;

							$jumlahrusak = $this->barang_detail->jumlah - $post['jumlah-kerusakan'];
							$databarang=array(
								'jumlah'=> $jumlahrusak,
								'kondisi' => 'Tidak Baik'
							);

							$datakerusakan = array(    	
							'tanggal_kerusakan'=> $post['tanggal-kerusakan'],
 							'nama_barang'=>$namabarang,								
			 				'nik' =>$post['nik'],					
			 				'nama' =>$nama,
							'jumlah'=> $post['jumlah-kerusakan'],
							'keterangan'=>$post['keterangan-kerusakan'],
							'kerusakan_attribute' => json_encode(@$barangkeluar_attribute)
							);

							$checknik = $this->user_model->count(array('nik LIKE' => $datakerusakan['nik']));
							
							if ($checknik == 0){
								$result=array('status' =>'failed','errors'=> 'error_nik');
							}
							else{
					
								$this->barang_model->update($databarang,array('id_barang'=> $post['hidden-id']));
								$this->kerusakanbarang_model->insert($datakerusakan);
								$result=array('status' =>'success');
							}
						}
					}
					else{											
						$result=array('status' =>'failed');
					}
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

				//=== ambil data berdasarkan id ===//
				if(!empty($post['id'])){
					$record = $this->kerusakanbarang_model->get($post['id']);
					echo json_encode(array('status' => 'success','data' => $record));
				}
				//=== ambil semua data ===//
				else{
					$total_rows = $this->kerusakanbarang_model->count();
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post > 1 ){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}
						if (!empty($post['cari']) && ($post['cari'] != 'null')){
							$cari =$post['cari'];
							$total_rows = $this->kerusakanbarang_model->count(array("nama_barang LIKE" => "%$cari%"));
							@$record =$this->kerusakanbarang_model->get_by(array("nama_barang LIKE"=> "%$cari%"),$SConfig->_backend_perpage,$offset);
						}
						else{
							$record = $this->kerusakanbarang_model->get_by(NULL,$SConfig->_backend_perpage,$offset);
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
					$this->kerusakanbarang_model->delete($post['hidden-id']);
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
			$this->site->view('riwayat_kerusakan',$data);
		}
	}

	public function laporan(){
		$data['kerusakan'] = $this->kerusakanbarang_model->get();
		$this->site->view('laporan-kerusakan',$data);	
	}
















}