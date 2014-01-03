<?php
class Custompage extends MX_Controller {

	function __construct() {
	parent::__construct();
	}

	function index(){
		//echo "homepage";
		$first_bit = $this->uri->segment(1);
		$second_bit = $this->uri->segment(2);
		$data = array();

		if($second_bit == ""){

			if($first_bit == ""){
				$first_bit = 'home';
			}

			$this->load->module('pages');
			$query = $this->pages->get_where_custom('page_url', $first_bit);

			foreach ($query->result() as $row) {
				$data['page_title'] = $row->page_title;
				$data['page_url'] = $row->page_url;
				$data['keyword'] = $row->keyword;
			}
		}

		$this->load->module('template');
		$this->template->home_page($data);

	}

}

?>