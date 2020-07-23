<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {
	
	protected $_table_name = 'user';
	protected $_primary_key = 'id_user';
	protected $_order_by = 'id_user';
	protected $_order_by_type = 'DESC';

	public $rules = array(
		'nik' => array(
            'field' => 'nik',
            'label' => 'nik',
            'rules' => 'trim|required'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|callback_password_check'
		)
	);	

	public $rules_register = array(
		'nik' => array(
            'field' => 'nik',
            'label' => 'nik',
            'rules' => 'trim|required|numeric|min_length[6]|callback_nik_check'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|min_length[5]'
		),
		'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|callback_email_check'
		), 
		'nama_user' => array(
            'field' => 'nama-user',
            'label' => 'Nama User',
            'rules' => 'trim|required'
		), 

		'jabatan' => array(
            'field' => 'jabatan',
            'label' => 'Jabatan',
            'rules' => 'trim|required'
		), 

		'handphone' => array(
            'field' => 'handphone',
            'label' => 'No Handphone',
            'rules' => 'trim|required|numeric'
		), 

		'alamat' => array(
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'trim|required'
		), 

	);

	public $rules_update = array(
		'nik' => array(
            'field' => 'nik',
            'label' => 'nik',
            'rules' => 'trim|required'
		),
		'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
		), 
	);

	function __construct() {
		parent::__construct();
	}	

	function get_user($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}user_detail', '{PRE}user.id_user  = {PRE}user_detail.id_tbuser', 'LEFT' );
		$this->db->group_by('{PRE}user.id_user');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

	function get_user_detail($id=NULL){
		$this->db->select('{PRE}user.nik, {PRE}user.email, {PRE}user.group, {PRE}user.nama_lengkap, {PRE}user_detail.*');
		$this->db->join('{PRE}user_detail', '{PRE}user.id_user  = {PRE}user_detail.id_tbuser', 'LEFT');
		return parent::get($id);
	}
}