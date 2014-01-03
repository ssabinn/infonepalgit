<?php

class Template extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->module('pages');
		// $this->pages->list_pages;
	}

	function home_page($data){
		$this->load->module('news');
		$news_data = $this->news->get_recent_news();
		$sports_data = $this->news->get_category_news('sports');
		$economics_data = $this->news->get_category_news('economics');
		$technology_data = $this->news->get_category_news('technology');
		
		$this->load->module('blogs');
		$blog_data = $this->blogs->get_recent_blog();

		// $this->load->library('rssparser');
		$this->load->module('rss_reader');
		$rss_data = $this->rss_reader->get_rss();

		// var_dump($rss_news);

		$this->load->module('districts');
		$district_names = $this->districts->get_where_district('Kathmandu');

		// print_r($district_names);
		// print_r($news_data);
		// print_r($blog_data);
		$data = array_merge($data, $news_data);
		$data = array_merge($data, $sports_data);
		$data = array_merge($data, $economics_data);
		$data = array_merge($data, $technology_data);
		$data = array_merge($data, $blog_data);
		$data = array_merge($data, $rss_data);
		// $data = array_merge($data, $district_names);
		// print_r($data);
		// var_dump($data);

		$this->load->view('header');
		$this->load->view('home_page', $data);
	}

	function pages($data){
		$this->load->view('header');
		$this->load->view('pages', $data);
	}

	function dist_pages($data){
		$this->load->view('header');
		$this->load->view('dist_pages', $data);
	}

	function public_one_col($data){
		$this->load->view('public_one_col', $data);
	}

	function admin($data){
		if($data['module'] == 'parties' || $data['module'] == 'candidates' || $data['module'] == 'proportionates'){
			$this->load->view('admin_election', $data);
		}else{
			$this->load->view('admin', $data);
		}
	}

	function admin_home($data){
		$this->load->view('admin_home', $data);
	}
	
}

?>