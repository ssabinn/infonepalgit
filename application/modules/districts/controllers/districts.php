<?php
class Districts extends MX_Controller 
{

function __construct() {
parent::__construct();
}


function districtArea(){
	$district = $this->input->post('district');
	$area = $this->input->post('area');

	redirect('districts/single/'.$district.'/'.$area);
}

function single(){
	if($this->uri->segment(3)){
		$district = $this->uri->segment(3);
		if($this->uri->segment(4)){
			$area = $this->uri->segment(4);
		}else{
			$area = "";
		}
	}elseif ($this->input->post('district', 'area')) {
		$district = $this->input->post('district');
		$area = $this->input->post('area');
	}else{
		$district = "";
		$area = "";
	}

	$data['district'] = $district;
	$data['area'] = $area; 

	// var_dump($district);
	// var_dump($area);

	$data['zone_count'] = $this->get_election_zone($district);

	$this->load->module('population');
	$data['population'] = $this->population->get_population_district($district);
	// $data['population'] = Modules::run('population/get_population_district/', $district);
	// var_dump($data['population']);

	$district_id = $this->get_id_from_district($district);
	$data['district_id'] = $district_id;

	// echo $district_id;
	$this->load->module('candidates');
	$data['parties_count'] = $this->candidates->get_parties_count_district($district_id);

	// $this->load->module('candidates');
	// $data['query'] = $this->candidates->get_candidate_by_district($district_id);

	$data['page_title'] = 'Districts';		
	$data['view_file'] = 'single';
	$data['module'] = 'districts';
	$this->load->module('template');
	$this->template->dist_pages($data);
}

function get_election_zone($district){
	$this->load->model('mdl_districts');
	$query = $this->mdl_districts->get_where_district($district);
	return $query;
	// return $count;
}

function get_sidebar_option(){
	$district = $this->input->post('district');

	$zone_count = $this->get_election_zone($district);

	$this->load->module('population');
	$population = $this->population->get_population_district($district);

	echo $population."-".$zone_count;
}


function get_district_names(){
	$query = $this->get('district_name');
	foreach ($query->result() as $row) {
		$data['district_name']= $row->district_name;
	}
	return $data; 
}

function get_where_district($district){
	if($this->input->post('district')) { $district = $this->input->post('district');}	
	// var_dump($district);
	$this->load->model('mdl_districts');
	$query = $this->mdl_districts->get_where_district($district);
	echo $query;
}

function get_id_from_district($district){
	$this->load->model('mdl_districts');
	$query = $this->mdl_districts->get_id_from_district($district);
	foreach ($query->result() as $row) {
		return $row->id;
	}
}


function get($order_by){
$this->load->model('mdl_districts');
$query = $this->mdl_districts->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_districts');
$query = $this->mdl_districts->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_with_limit_asc($limit, $offset, $order_by) {
$this->load->model('mdl_districts');
$query = $this->mdl_districts->get_with_limit_asc($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_districts');
$query = $this->mdl_districts->get_where($id);
return $query;
}

function get_where_my($col, $value1, $value2) {
$this->load->model('mdl_districts');
$query = $this->mdl_districts->get_where_custom($col, $value1, $value2);
return $query;
}


function get_where_custom($col, $value) {
$this->load->model('mdl_districts');
$query = $this->mdl_districts->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_districts');
$this->mdl_districts->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_districts');
$this->mdl_districts->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_districts');
$this->mdl_districts->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_districts');
$count = $this->mdl_districts->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_districts');
$max_id = $this->mdl_districts->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_districts');
$query = $this->mdl_districts->_custom_query($mysql_query);
return $query;
}

}