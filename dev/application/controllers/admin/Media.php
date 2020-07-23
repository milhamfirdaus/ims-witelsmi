<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends Backend_Controller {

	public function __construct(){
		parent::__construct();	
	}


	public function action($param,$type=NULL){
		global $SConfig;
		/* jika aksinya adalah tambah ... */
		if($param == 'tambah'){

			$date = date('d-m-Y');

			$this->site->create_dir($type,$date);
			$this->load->library('upload', $this->site->media_upload_config($type,$date));

			if ($this->upload->do_upload('userfile')){
				$upload_data = $this->upload->data();
				$filefullpath = base_url().'uploads/'.$type.'/'.$date.'/'.$upload_data['file_name'];
				$file_dir = $SConfig->_document_root.'/uploads/'.$type.'/'.$date.'/'.$upload_data['file_name'];
					$status = array(
						'success' => 'TRUE',
						'file_original'	=> $filefullpath,
						'file_dir_original' =>$file_dir,
						'file_thumbnail' => $this->site->resize_img($filefullpath,150,150,1)
					);
			}
			else{
				$status['success'] = 'FALSE';
			}
				echo json_encode($status);					
			}

		else if($param == 'hapus'){
			$post= $this->input->post(NULL,TRUE);

			if(!empty($post['file_dir_original'])){

				$file_dir_original   = $post['file_dir_original'];
				$this->load->helper('file');
					unlink($file_dir_original);
					echo json_encode(array('status' =>'success'));
			}
			else{
					echo json_encode(array('status' =>'failed'));
			}									
		}	

	}
		
}
