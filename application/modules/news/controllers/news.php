<?php
class News extends MX_Controller 
{

function __construct() {
	parent::__construct();

}

function manage(){
	Modules::run('site_security/make_sure_is_admin');
	Modules::run('site_security/make_sure_is_reporter');


	$data['query']= $this->get('id');
	$data['view_file'] = "manage";
	$data['module'] = "news";
	$this->load->module('template');
	$this->template->admin($data);
}

function get_data_from_post(){
	$data['news_headline'] = $this->input->post('news_headline', TRUE);
	$data['news_content'] = $this->input->post('news_content', TRUE);
	$data['category'] = $this->input->post('category', TRUE);
	return $data; 
}

function get_data_from_db($update_id){
	Modules::run('site_security/make_sure_is_admin');
	Modules::run('site_security/make_sure_is_reporter');
	

	$query = $this->get_where($update_id);
	foreach($query->result() as $row){
		$data['news_headline'] = $row->news_headline;
		$data['news_content'] = $row->news_content;
		$data['category'] = $row->category;
	}
	if(!isset($data)){
		$data = "";
	}
	return $data;
}

function create(){
	Modules::run('site_security/make_sure_is_admin');
	Modules::run('site_security/make_sure_is_reporter');


	$update_id = $this->uri->segment(3);
	$submit = $this->input->post('submit', TRUE);
	if($submit == "submit"){
		//if person has submitted the form
		$data = $this->get_data_from_post();
	}else{
		if(is_numeric($update_id)){
			$data = $this->get_data_from_db($update_id);
		}
	}

	if(!isset($data)){
		$data = $this->get_data_from_post();
	}

	$data['update_id'] = $update_id;	
	$data['query']= $this->get('id');
	$data['view_file'] = "create";
	$data['module'] = "news";
	$this->load->module('template');
	$this->template->admin($data);
}


function submit(){
	Modules::run('site_security/make_sure_is_admin');
	Modules::run('site_security/make_sure_is_reporter');

	$this->load->library('form_validation');

	$this->form_validation->set_rules('news_headline', 'News Headline', 'required|xss_clean');
	$this->form_validation->set_rules('news_content', 'News Content', 'required|xss_clean');
	$this->form_validation->set_rules('category', 'Category', 'required|xss_clean');

	if ($this->form_validation->run($this) == FALSE){
		$this->create();
	}
	else{
		$data = $this->get_data_from_post();
		$data['posted_by'] = $this->session->userdata('username');
		//figure out page url should be
		// $data['news_url']= url_title($data['news_headline']) ;
		
		$update_id = $this->uri->segment(3);

		// $data['news_url']= url_title($update_id);

		if(is_numeric($update_id)){
			// if(($update_id == 1) || ($update_id == 2) || ($update_id == 3) || ($update_id == 4)){
			// 	unset($data['page_url']); //so that page url of home, blog, news doesn change and destroy the space time continium
			// }
			$this->_update($update_id, $data);
		}else{
			$this->_insert($data);
			$query = $this->get_with_limit(1,0,'timestamp');
			foreach ($query->result() as $row) {
				$update_id = $row->id;
			}
			$data['news_url'] = url_title($update_id);
			$this->_update($update_id, $data);		
		}

		redirect('news/manage');
	}
}


function deleteconf(){
	Modules::run('site_security/make_sure_is_admin');
	Modules::run('site_security/make_sure_is_reporter');

	$update_id = $this->uri->segment(3);
	$this->_delete($update_id);

	redirect('news/manage');
}

function index(){
	// echo base_url();
	$config = array();
	$config['base_url'] = base_url()."news/page/";
	$config['total_rows'] = $this->get('id')->num_rows();
	$config['per_page'] = 10;
	$config['num_links'] = 10;
	$config['uri_segment'] = 3;
	
	$config['full_tag_open'] = '<div class="pagination"><ul>';
	$config['full_tag_close'] = '</ul></div>';
	$config['prev_link'] = '&lt; Prev';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = 'Next &gt;';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';



	$this->pagination->initialize($config);

	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

	$data['query'] = $this->get_with_limit($config['per_page'], $page, 'timestamp');
	// echo "here";
	$data['view_file'] = "all";
	$data['module'] = "news";
	$data['page_title'] = 'News';
	$this->load->module('template');
	$this->template->pages($data);
}

function page(){
	// echo base_url();
	$config = array();
	$config['base_url'] = base_url()."news/page/";
	$config['total_rows'] = $this->get('id')->num_rows();
	$config['per_page'] = 10;
	$config['num_links'] = 10;
	$config['uri_segment'] = 3;

	// $config['full_tag_open'] = '<div class="pagination"><ul>';
	// $config['full_tag_close'] = '</ul></div>';
	// $config['prev_link'] = '&lt; Prev';
	// $config['prev_tag_open'] = '<li>';
	// $config['prev_tag_close'] = '</li>';
	// $config['next_link'] = 'Next &gt;';
	// $config['next_tag_open'] = '<li>';
	// $config['next_tag_close'] = '</li>';
	// $config['cur_tag_open'] = '<li class="active"><a href="#">';
	// $config['cur_tag_close'] = '</a></li>';
	// $config['num_tag_open'] = '<li>';
	// $config['num_tag_close'] = '</li>';

	$this->pagination->initialize($config);

	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	$data['query'] = $this->get_with_limit($config['per_page'], $page, 'timestamp');
	// echo "here";
	$data['view_file'] = "all";
	$data['module'] = "news";
	$data['page_title'] = 'News';
	$this->load->module('template');
	$this->template->pages($data);
}

function get_recent_news(){
	$data['news_query'] = $this->get_with_limit(10, 0, 'timestamp');
	// foreach ($query->result() as $row) {
	// 	$data['news_headline'] = $row->news_headline;
	// 	$data['news_posted_by'] = $row->posted_by;
	// 	$data['news_timestamp'] = $row->timestamp;
	// 	$data['news_content'] = $row->news_content;
	// 	$data['news_url'] = $row->news_url;				
	// }
	$data['page_title'] = 'News';				
	return $data;
}

function get_category_news($category){
	$data[$category.'_query'] = $this->get_with_limit_category(10, 0, 'timestamp', $category);
	$data['page_title'] = 'News';				
	return $data;
}


function posts(){
	$post_id = $this->uri->segment(3);
	// echo $post_id;
	$query = $this->get_where($post_id);
	foreach ($query->result() as $row) {
		$data['news_headline'] = $row->news_headline;
		$data['news_posted_by'] = $row->posted_by;
		$data['news_timestamp'] = $row->timestamp;
		$data['news_content'] = $row->news_content;
		$data['news_url'] = $row->news_url;	
	}

	$data['view_file'] = 'single_post';
	$data['page_title'] = 'News';				
	$data['module'] = 'news';
	$this->load->module('template');
	$this->template->pages($data);
}












function get($order_by){
$this->load->model('mdl_news');
$query = $this->mdl_news->get($order_by);
return $query;
}

function get_with_limit_category($limit, $offset, $order_by, $category) {
$this->load->model('mdl_news');
$query = $this->mdl_news->get_with_limit_category($limit, $offset, $order_by, $category);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_news');
$query = $this->mdl_news->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_news');
$query = $this->mdl_news->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_news');
$query = $this->mdl_news->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_news');
$this->mdl_news->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_news');
$this->mdl_news->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_news');
$this->mdl_news->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_news');
$count = $this->mdl_news->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_news');
$max_id = $this->mdl_news->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_news');
$query = $this->mdl_news->_custom_query($mysql_query);
return $query;
}

}