<?php
class Election extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function dashboard(){
	$data['view_file'] = "election_home";
	$data['module'] = "election";
	$this->load->module('template');
	$this->template->admin_home($data);
}


function addResult(){
	$data['view_file'] = "election_select";
	$data['module'] = "election";
	$this->load->module('template');
	$this->template->admin($data);
}

function manage(){
	if($_GET['district']){
		$district = $_GET['district'];
	}else{
		$district = $this->input->post('district');		
	}
	if($_GET['area']){
		$area = $_GET['area'];
	}else{
		$area = $this->input->post('area');
	}


	$this->load->module('districts');
	$district_id = $this->districts->get_id_from_district($district);
	// var_dump($district_id);
	$this->load->module('candidates');
	$data['query']= $this->candidates->get_candidate_by_area_admin($district_id, $area);

	$data['view_file'] = "manage";
	$data['module'] = "election";
	$data['district'] = $district;
	$data['area'] = $area;

	$this->load->module('template');
	$this->template->admin($data);
}

function candidate_submit(){
	$candidate = $this->input->post('candidate');
	$count = $this->input->post('count');
	// var_dump($candidate);
	$district = $_GET['district'];
	$area = $_GET['area'];
	// return;
	$i = 0; 
	$this->load->module('candidates');
	for($i=0; $i<$count; $i++){
		// var_dump($row);
		$this->candidates->vote_update($candidate[$i]['id'], $candidate[$i]['vote_count'], $candidate[$i]['vote_percent']);
	}
	redirect('election/manage?district='.$district.'&area='.$area);
}





















function get($order_by){
$this->load->model('mdl_election');
$query = $this->mdl_election->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_election');
$query = $this->mdl_election->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_election');
$query = $this->mdl_election->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_election');
$query = $this->mdl_election->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_election');
$this->mdl_election->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_election');
$this->mdl_election->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_election');
$this->mdl_election->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_election');
$count = $this->mdl_election->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_election');
$max_id = $this->mdl_election->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_election');
$query = $this->mdl_election->_custom_query($mysql_query);
return $query;
}

}