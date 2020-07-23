<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barangkeluar_model extends My_Model{
	protected $_table_name = 'barangkeluar';
	protected $_primary_key = 'id_keluar';
	protected $_order_by = 'id_keluar';
	protected $_order_by_type = 'DESC';	
	public $rules = array(
			'nama_barang' => array(
				'field' => 'hidden-barang',
				'rules'	=> 'trim|required',
			),

			'nik' => array(
				'field' => 'nik',
				'label' => 'NIK',
				'rules'	=> 'trim|required',
			),

			'witel_datel' => array(
				'field' => 'witel-datel',
				'label' => 'witel-datel',
				'rules'	=> 'trim|required',
			),

			'ip' => array(
				'field' => 'IP',
				'label' => 'IP',
				'rules'	=> 'trim|required',
			),

			'jumlah' => array(
				'field' => 'jumlah-barang',
				'label' => 'Keterangan',
				'rules'	=> 'trim|required|numeric',
			),

			'tanggal_keluar' => array(
				'field' => 'tanggal-keluar',
				'label' => 'Tanggal Keluar',
				'rules'	=> 'trim|required',
			),
	);

	function __construct(){
		parent:: __construct();
	}
}