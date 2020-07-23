<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jenis_model extends My_Model{
	protected $_table_name = 'jenis';
	protected $_primary_key = 'id_jenis';
	protected $_order_by = 'id_jenis';
	protected $_order_by_type = 'DESC';	
	public $rules = array(
			'nama_jenis' => array(
				'field' => 'nama-jenis',
				'label' => 'Nama Jenis',
				'rules'	=> 'trim|required',
			),
			'deskripsi' => array(
				'field' => 'deskripsi',
				'label' => 'Deskripsi',
				'rules'	=> 'trim',
			),
	);
	function __construct(){
		parent:: __construct();
	}
}