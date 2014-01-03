<?php
class Aboutus extends MX_Controller {

	function __construct() {
		parent::__construct();
	}

	function index(){
		$data['view_file'] = 'aboutus';
		$data['module'] = 'aboutus';
		$data['page_title'] = 'About Us';
		$this->load->module('template');
		$this->template->pages($data);
	}

}

?>