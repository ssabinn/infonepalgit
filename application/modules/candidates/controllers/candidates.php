<?php
class Candidates extends MX_Controller 
{

function __construct() {
	parent::__construct();
}

function manage(){
	Modules::run('site_security/make_sure_is_admin');

	$data['query']= $this->get('id');
	$data['view_file'] = "manage";
	$data['module'] = "candidates";
	$this->load->module('template');
	$this->template->admin($data);
}

function get_data_from_post(){
	$data['candidate_name'] = $this->input->post('candidate_name', TRUE);
	$data['party_id'] = $this->input->post('party_id', TRUE);
	$data['district_id'] = $this->input->post('district_id', TRUE);
	$data['area'] = $this->input->post('area', TRUE);
	$data['age'] = $this->input->post('age', TRUE);
	$data['gender'] = $this->input->post('gender', TRUE);

	return $data; 
}

function get_data_from_db($update_id){
	Modules::run('site_security/make_sure_is_admin');
	
	$query = $this->get_where($update_id);
	foreach($query->result() as $row){
		$data['candidate_name'] = $row->candidate_name;
		$data['party_id'] = $row->party_id;
		$data['district_id'] = $row->district_id;
		$data['area'] = $row->area;
		$data['age'] = $row->age;
		$data['gender'] = $row->gender;
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
	$data['module'] = "candidates";

	$this->load->module('template');
	$this->template->admin($data);
}

function submit(){
	Modules::run('site_security/make_sure_is_admin');

	$this->load->library('form_validation');

	$this->form_validation->set_rules('candidate_name', 'Candidate Name', 'required|xss_clean');
	$this->form_validation->set_rules('district_id', 'District', 'required|xss_clean');
	$this->form_validation->set_rules('area', 'Area', 'required|min_length[1]|max_length[2]|numeric|xss_clean');
	$this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean');


	if ($this->form_validation->run($this) == FALSE){
		$this->create();
	}
	else{
		$data = $this->get_data_from_post();		
		$update_id = $this->uri->segment(3);

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

		redirect('candidates/manage');
	}
}


function deleteconf(){
	Modules::run('site_security/make_sure_is_admin');

	$update_id = $this->uri->segment(3);
	$this->_delete($update_id);

	redirect('candidates/manage');
}


function index(){
	redirect('candidates/all');
}

function all(){
	$data['query'] = $this->get('id');
	// echo "here";
	$data['view_file'] = "all";
	$data['module'] = "candidates";
	$data['page_title'] = 'Candidates';
	$this->load->module('template');
	$this->template->pages($data);
}

function single(){
	$get_id = $this->uri->segment(3);
	// echo $get_id;
	$query = $this->get_where($get_id);
	foreach ($query->result() as $row) {
		$data['candidate_name'] = $row->candidate_name;
		$data['party_id'] = $row->party_id;
		$data['district_id'] = $row->district_id;
		$data['age'] = $row->age;
		$data['gender'] = $row->gender;		
		$data['vote_count'] = $row->vote_count;		
		$data['vote_percent'] = $row->vote_percent;		
		$data['area'] = $row->area;		
	}
	$data['page_title'] = '<a href="'.base_url().'/candidates/all" style="color:#3e3e3e; text-decoration:none;">Candidates</a> | <span style="color:#3887be;">'.$data['candidate_name'].'</span>';		
	$data['view_file'] = 'single';
	$data['module'] = 'candidates';
	$this->load->module('template');
	$this->template->pages($data);
}


function get_parties_count_district($district_id){
	$this->load->model('mdl_candidates');
	$query = $this->mdl_candidates->get_parties_count_district($district_id);
	echo $query;
}


function get_candidate_by_district($district_id){
	$this->load->model('mdl_candidates');
	$data['query'] = $this->mdl_candidates->get_candidate_by_district($district_id);
	// return $data;
	$this->load->view('district_list', $data);	
}

function get_candidate_by_area($district_id, $area){
	$this->load->model('mdl_candidates');
	$data['query'] = $this->mdl_candidates->get_candidate_by_area($district_id, $area);
	// return $data;
	$this->load->view('area_list', $data);	
}

function get_candidate_by_area_admin($district_id, $area){
	$this->load->model('mdl_candidates');
	$query = $this->mdl_candidates->get_candidate_by_area($district_id, $area);
	// var_dump($data);
	return $query;
}


function get_all_candidates_by_party($party_id){
	$this->load->model('mdl_candidates');
	$query = $this->mdl_candidates->get_all_candidates_by_party($party_id);
	return $query;
}










function get($order_by){
$this->load->model('mdl_candidates');
$query = $this->mdl_candidates->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_candidates');
$query = $this->mdl_candidates->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_candidates');
$query = $this->mdl_candidates->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_candidates');
$query = $this->mdl_candidates->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_candidates');
$this->mdl_candidates->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_candidates');
$this->mdl_candidates->_update($id, $data);
}

function vote_update($id, $data, $percent){
$this->load->model('mdl_candidates');
$this->mdl_candidates->vote_update($id, $data, $percent);
}

function _delete($id){
$this->load->model('mdl_candidates');
$this->mdl_candidates->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_candidates');
$count = $this->mdl_candidates->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_candidates');
$max_id = $this->mdl_candidates->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_candidates');
$query = $this->mdl_candidates->_custom_query($mysql_query);
return $query;
}

}