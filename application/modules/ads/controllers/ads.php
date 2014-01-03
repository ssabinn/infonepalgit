<?php
class Ads extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function manage(){
	Modules::run('site_security/make_sure_is_admin');

	$data['query']= $this->get('id');
	$data['view_file'] = "manage";
	$data['module'] = "ads";
	$this->load->module('template');
	$this->template->admin($data);
}

function get_data_from_post(){
	$data['ads_name'] = $this->input->post('ads_name', TRUE);
	$data['ads_href'] = $this->input->post('ads_href', TRUE);
	$data['ads_category'] = $this->input->post('ads_category', TRUE);


	if (empty($_FILES['userfile']['name'])) {	
		$data['ads_url'] = $this->input->post('ads_url_old', TRUE);		
	}else{
		$data['ads_url'] = $this->input->post('ads_url', TRUE);
	}
	return $data; 
}

function get_data_from_db($update_id){
	Modules::run('site_security/make_sure_is_admin');
	
	$query = $this->get_where($update_id);
	foreach($query->result() as $row){
		$data['ads_name'] = $row->ads_name;
		$data['ads_url'] = $row->ads_url;
		$data['ads_href'] = $row->ads_href;
		$data['ads_category'] = $row->ads_category;
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
	$data['module'] = "ads";

	$this->load->module('template');
	$this->template->admin($data);
}

function submit(){
	Modules::run('site_security/make_sure_is_admin');

	$this->load->library('form_validation');

	$this->form_validation->set_rules('ads_name', 'Ads Name', 'required|xss_clean');
	$this->form_validation->set_rules('ads_category', 'Ads Category', 'required|xss_clean');

	if ($this->form_validation->run($this) == FALSE){
		$this->create();
	}
	else{
		$data = $this->get_data_from_post();		
		$update_id = $this->uri->segment(3);

		$config['overwrite'] = TRUE;
	    $config['allowed_types'] = 'jpg|jpeg|gif|png';
	    $config['max_size'] = 2000;
	    $config['upload_path'] = './images/ads/';

	    $this->load->library('upload', $config);

	    if ( !$this->upload->do_upload()){
	    	$error ="";
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('create', $error);
		}else{
			$file_data = $this->upload->data();
			$data['ads_url'] = 'images/ads/'.$file_data['file_name'];
		}


		if(is_numeric($update_id)){
			$this->_update($update_id, $data);
		}else{
			$this->_insert($data);
		}

		redirect('ads/manage');
	}
}


function deleteconf(){
	Modules::run('site_security/make_sure_is_admin');

	$update_id = $this->uri->segment(3);
	$this->_delete($update_id);

	redirect('ads/manage');
}














function get($order_by){
$this->load->model('mdl_ads');
$query = $this->mdl_ads->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_ads');
$query = $this->mdl_ads->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_ads');
$query = $this->mdl_ads->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_ads');
$query = $this->mdl_ads->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_ads');
$this->mdl_ads->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_ads');
$this->mdl_ads->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_ads');
$this->mdl_ads->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_ads');
$count = $this->mdl_ads->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_ads');
$max_id = $this->mdl_ads->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_ads');
$query = $this->mdl_ads->_custom_query($mysql_query);
return $query;
}

}