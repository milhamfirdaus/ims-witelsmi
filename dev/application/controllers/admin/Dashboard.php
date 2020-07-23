<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend_Controller {

	public function __construct(){
		parent::__construct();		
		$this->load->model(array('witel_model','user_model','barang_model','barangkeluar_model'));
	}

	public function index(){
		$data = array();
		$this->site->view('index', $data);
	}

	


}