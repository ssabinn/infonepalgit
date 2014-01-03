<?php
class Pages extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function manage(){
	Modules::run('site_security/make_sure_is_admin');

	$data['query']= $this->get('id');
	$data['view_file'] = "manage";
	$data['module'] = "pages";
	$this->load->module('template');
	$this->template->admin($data);
}

function get_data_from_post(){
	$data['page_title'] = $this->input->post('page_title', TRUE);
	$data['keyword'] = $this->input->post('keyword', TRUE);
	return $data; 
}

function get_data_from_db($update_id){
	$query = $this->get_where($update_id);
	foreach($query->result() as $row){
		$data['page_title'] = $row->page_title;
		$data['keyword'] = $row->keyword;
	}
	if(!isset($data)){
		$data = "";
	}
	return $data;
}

function create(){
	Modules::run('site_security/make_sure_is_admin');

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
	$data['module'] = "pages";
	$this->load->module('template');
	$this->template->admin($data);
}

function submit(){
	Modules::run('site_security/make_sure_is_admin');
	
	$this->load->library('form_validation');

	$this->form_validation->set_rules('page_title', 'Page Title', 'required|xss_clean');
	$this->form_validation->set_rules('keyword', 'Keyword', 'required|xss_clean');

	if ($this->form_validation->run($this) == FALSE){
		$this->create();
	}
	else{
		$data = $this->get_data_from_post();
		//figure out page url should be
		$data['page_url']= url_title($data['page_title']) ;

		$update_id = $this->uri->segment(3);
		if(is_numeric($update_id)){
			if(($update_id == 1) || ($update_id == 2) || ($update_id == 3) || ($update_id == 4)){
				unset($data['page_url']); //so that page url of home, blog, news doesn change and destroy the space time continium
			}
			$this->_update($update_id, $data);
		}else{
			$this->_insert($data);		
		}

		redirect('pages/manage');
	}
}

function deleteconf(){
	Modules::run('site_security/make_sure_is_admin');

	$update_id = $this->uri->segment(3);
	$this->_delete($update_id);

	redirect('pages/manage');
}







function get($order_by){
$this->load->model('mdl_pages');
$query = $this->mdl_pages->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_pages');
$query = $this->mdl_pages->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_pages');
$query = $this->mdl_pages->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_pages');
$query = $this->mdl_pages->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_pages');
$this->mdl_pages->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_pages');
$this->mdl_pages->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_pages');
$this->mdl_pages->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_pages');
$count = $this->mdl_pages->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_pages');
$max_id = $this->mdl_pages->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_pages');
$query = $this->mdl_pages->_custom_query($mysql_query);
return $query;
}

}