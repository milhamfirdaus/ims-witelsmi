<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * CLASS NAME : Laporan
 * ------------------------------------------------------------------------
 *
 * @author     Muhammad Akbar <muslim.politekniktelkom@gmail.com>
 * @copyright  2016
 * @license    http://aplikasiphp.net
 *
 */

class Laporan extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('barang_model','jenis_model','kerusakanbarang_model','user_model'));

		if( ! in_array($level, $allowed))
		{
			redirect();
		}
	}

	public function index()
	{
		$this->load->view('laporan/form_laporan');
	}

	public function laporan($from, $to)
	{
		$this->load->model('m_penjualan_master');
		$dt['barang'] 	= $this->barang_model->laporan_penjualan($from, $to);
		$dt['from']			= date('d F Y', strtotime($from));
		$dt['to']			= date('d F Y', strtotime($to));
		$this->load->view('laporan/laporan_penjualan', $dt);
	}














}