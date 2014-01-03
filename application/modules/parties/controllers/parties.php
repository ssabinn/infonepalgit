<?php
class Parties extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function manage(){
	Modules::run('site_security/make_sure_is_admin');

	$data['query']= $this->get('id');
	$data['view_file'] = "manage";
	$data['module'] = "parties";
	$this->load->module('template');
	$this->template->admin($data);

}

function get_data_from_post(){
	$data['party_name'] = $this->input->post('party_name', TRUE);
	$data['chief'] = $this->input->post('chief', TRUE);
	$data['address'] = $this->input->post('address', TRUE);
	$data['symbol'] = $this->input->post('symbol', TRUE);

	if (empty($_FILES['userfile']['name'])) {	
		$data['flag'] = $this->input->post('flagname', TRUE);		
	}else{
		$data['flag'] = $this->input->post('flag', TRUE);
	}

	$data['reg_date'] = $this->input->post('reg_date', TRUE);
	$data['manifesto'] = $this->input->post('manifesto', TRUE);
	return $data; 
}

function get_data_from_db($update_id){
	Modules::run('site_security/make_sure_is_admin');
	
	$query = $this->get_where($update_id);
	foreach($query->result() as $row){
		$data['party_name'] = $row->party_name;
		$data['chief'] = $row->chief;
		$data['address'] = $row->address;
		$data['symbol'] = $row->symbol;
		$data['flag'] = $row->flag;
		$data['reg_date'] = $row->reg_date;
		$data['manifesto'] = $row->manifesto;
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
	$data['module'] = "parties";
	$this->load->module('template');
	$this->template->admin($data);
}

function submit(){
	Modules::run('site_security/make_sure_is_admin');

	$this->load->library('form_validation');

	$this->form_validation->set_rules('party_name', 'Party Name', 'required|xss_clean');
	$this->form_validation->set_rules('chief', 'Chief', 'required|xss_clean');
	$this->form_validation->set_rules('symbol', 'Symbol', 'required|xss_clean');
	$this->form_validation->set_rules('reg_date', 'Registration Date', 'required|xss_clean');


	if ($this->form_validation->run($this) == FALSE){
		$this->create();
	}
	else{
		$data = $this->get_data_from_post();		
		$update_id = $this->uri->segment(3);


	    $config['overwrite'] = TRUE;
	    $config['allowed_types'] = 'jpg|jpeg|gif|png';
	    $config['max_size'] = 2000;
	    $config['upload_path'] = './images/flags/';

	    $this->load->library('upload', $config);

	    if ( !$this->upload->do_upload()){
	    	$error ="";
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('create', $error);
		}else{
			$file_data = $this->upload->data();
			$data['flag'] = 'images/flags/'.$file_data['file_name'];
		}


		if (empty($_FILES['userfile']['name'])) {	
			
		}

		if(is_numeric($update_id)){
			// if(($update_id == 1) || ($update_id == 2) || ($update_id == 3) || ($update_id == 4)){
			// 	unset($data['page_url']); //so that page url of home, blog, news doesn change and destroy the space time continium
			// }
			$this->_update($update_id, $data);
		}else{
			$this->_insert($data);
			// $query = $this->get_with_limit(1,0,'timestamp');
			// foreach ($query->result() as $row) {
			// 	$update_id = $row->id;
			// }
			// $data['news_url'] = url_title($update_id); 
			// $this->_update($update_id, $data);		
		}

		redirect('parties/manage');
	}
}


function deleteconf(){
	Modules::run('site_security/make_sure_is_admin');

	$update_id = $this->uri->segment(3);
	$this->_delete($update_id);

	redirect('parties/manage');
}

function index(){
	redirect('parties/all');
}

function all(){
	$data['query'] = $this->get('id');
	// echo "here";
	$data['view_file'] = "all";
	$data['module'] = "parties";
	$data['page_title'] = 'Parties of Nepal';
	$this->load->module('template');
	$this->template->pages($data);
}

function single(){
	$get_id = $this->uri->segment(3);
	// echo $get_id;
	$query = $this->get_where($get_id);
	foreach ($query->result() as $row) {
		$data['party_name'] = $row->party_name;
		$data['flag'] = $row->flag;
		$data['reg_date'] = $row->reg_date;
		$data['address'] = $row->address;
		$data['symbol'] = $row->symbol;		
		$data['chief'] = $row->chief;		
		$data['manifesto'] = $row->manifesto;		
	}
	$data['page_title'] = '<a href="'.base_url().'/parties/all" style="color:#3e3e3e; text-decoration:none;">पार्टी</a> | <span style="color:#3887be;">'.$data['party_name'].'</span>';		
	$data['view_file'] = 'single';
	$data['module'] = 'parties';
	$this->load->module('template');
	$this->template->pages($data);
}


// function get_all_candidates_by_party(){

// 	$party_id = $this->uri->segment(3);

// 	$this->load->module('candidates');
// 	$data['query'] = $this->candidates->get_all_candidates_by_party($party_id);

// 	return $data;
// }


function get_party_name($id){
	$this->load->model('mdl_parties');
	$query = $this->mdl_parties->get_party_name($id);
	return $query;
}




function get($order_by){
$this->load->model('mdl_parties');
$query = $this->mdl_parties->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_parties');
$query = $this->mdl_parties->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_parties');
$query = $this->mdl_parties->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_parties');
$query = $this->mdl_parties->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_parties');
$this->mdl_parties->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_parties');
$this->mdl_parties->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_parties');
$this->mdl_parties->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_parties');
$count = $this->mdl_parties->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_parties');
$max_id = $this->mdl_parties->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_parties');
$query = $this->mdl_parties->_custom_query($mysql_query);
return $query;
}

}