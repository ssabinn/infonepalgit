<?php
class Contact extends MX_Controller {

	function __construct() {
		parent::__construct();
	}

	function index(){
		$data['view_file'] = 'contact';
		$data['module'] = 'contact';
		$data['page_title'] = 'Contact';
		$this->load->module('template');
		$this->template->pages($data);
	}

}

?>