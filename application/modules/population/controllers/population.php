<?php
class Population extends MX_Controller {

function __construct() {
	parent::__construct();
}

function get_population_district($district){
	$this->load->model('mdl_population');
	$query = $this->mdl_population->get_population_district($district);
	foreach ($query->result() as $row) {
		return $row->population;
	}
}















function get($order_by){
$this->load->model('mdl_population');
$query = $this->mdl_population->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_population');
$query = $this->mdl_population->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($district){
$this->load->model('mdl_population');
$query = $this->mdl_population->get_where($district);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_population');
$query = $this->mdl_population->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_population');
$this->mdl_population->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_population');
$this->mdl_population->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_population');
$this->mdl_population->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_population');
$count = $this->mdl_population->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_population');
$max_id = $this->mdl_population->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_population');
$query = $this->mdl_population->_custom_query($mysql_query);
return $query;
}

}