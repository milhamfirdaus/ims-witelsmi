<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang_model extends My_Model{
	protected $_table_name = 'barang';
	protected $_primary_key = 'id_barang';
	protected $_order_by = 'id_barang';
	protected $_order_by_type = 'DESC';	
	public $rules = array(
			'nik_pengguna' => array(
				'field' => 'nik-pengguna',
				'label' => 'Nama Barang',
				'rules'	=> 'trim|required',
			),
			'nama_barang' => array(
				'field' => 'nama-barang',
				'label' => 'Nama Barang',
				'rules'	=> 'trim|required',
			),
			'serial' => array(
				'field' => 'serial-number',
				'label' => 'Serial',
				'rules'	=> 'trim|required',
			),
			'nama_jenis' => array(
				'field' => 'jenis-barang',
				'label' => 'Jenis Barang',
				'rules'	=> 'trim|required',
			),
			'jumlah' => array(
				'field' => 'jumlah',
				'label' => 'Jumlah',
				'rules'	=> 'trim|numeric|required',
			),
			'keterangan' => array(
				'field' => 'keterangan-barang',
				'label' => 'Keterangan',
				'rules'	=> 'trim',
			),
			'kondisi' => array(
				'field' => 'kondisi',
				'label' => 'Kondisi',
				'rules'	=> 'trim|required',
			),
			'tanggal_masuk' => array(
				'field' => 'tanggal-masuk',
				'label' => 'Tanggal Masuk',
				'rules'	=> 'trim|required',
			),

	);
	function __construct(){
		parent:: __construct();
	}
}