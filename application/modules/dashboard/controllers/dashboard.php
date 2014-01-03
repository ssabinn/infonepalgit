<?php
class Dashboard extends MX_Controller{

	function __construct() {
		parent::__construct();
		Modules::run('site_security/make_sure_is_admin');
		Modules::run('site_security/make_sure_is_reporter');
	}

	function home(){
		$data['view_file'] = "admin_home";
		$data['module'] = "dashboard";
		$this->load->module('template');
		$this->template->admin_home($data);
	}
}
?>	