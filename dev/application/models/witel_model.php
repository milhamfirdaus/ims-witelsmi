<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class witel_model extends My_Model{
	protected $_table_name = 'witel';
	protected $_primary_key = 'id_witel';
	protected $_order_by = 'id_witel';
	protected $_order_by_type = 'DESC';	
	public $rules = array(
			'witel_datel' => array(
				'field' => 'witel-datel',
				'label' => 'Nama witel / Datel',
				'rules'	=> 'trim|required',
			),
			'lokasi' => array(
				'field' => 'lokasi',
				'label' => 'Lokasi Witel',
				'rules'	=> 'trim|required',
			),
	);
	function __construct(){
		parent:: __construct();
	}
}