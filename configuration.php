<?php
	define('url', "http://" . $_SERVER['SERVER_NAME'] . '/dev-ci/ims-witelsmi');
	define('doc_root', str_replace('\\', "/", dirname(__FILE__)) );

	class SConfig{
		var $_site_url = url;
		var $_document_root = doc_root;
		var $_host_name = "localhost";
		var $_site_name = "inventaris.witelsukabumi.com";
		var $_database_name = "db_imsWitel";
		var $_database_user = "root";
		var $_database_password = "";
		var $_table_prefix = "tb_";
		var $_cms_name = "Witel Sukabumi";
		var $_backend_perpage = 5;
		var $_frontend_perpage = 5;
	}
?>