<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kerusakanbarang_model extends My_Model{
	protected $_table_name = 'kerusakan';
	protected $_primary_key = 'id_kerusakan';
	protected $_order_by = 'id_kerusakan';
	protected $_order_by_type = 'DESC';	
	public $rules = array(

			'tanggal_kerusakan' => array(
				'field' => 'tanggal-kerusakan',
				'label' => 'Tanggal Kerusakan',
				'rules'	=> 'trim|required',
			),

			'id_barang' => array(
				'field' => 'hidden-id',
				'rules'	=> 'trim|required',
			),

			'nik' => array(
				'field' => 'nik',
				'label' => 'NIK',
				'rules'	=> 'trim|required',
			),

			'jumlah' => array(
				'field' => 'jumlah-kerusakan',
				'label' => 'Jumlah Kerusakan',
				'rules'	=> 'trim|required|numeric',
			),
	);
	function __construct(){
		parent:: __construct();
	}
}