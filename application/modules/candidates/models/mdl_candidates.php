<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_candidates extends CI_Model {

function __construct() {
parent::__construct();
}

function get_table() {
$table = 'candidates';
return $table;
}

function get_parties_count_district($district_id){
	// $table = $this->get_table();
	// $this->db->where('district_id', $district_id);
	// for(i=2;i<132; i++){
	// 	$this->db->select('party_id');
	// 	$this->db->where('party_id',i);
	// 	$count
	// }

	// $this->db->select('');
	// $this->db->group_by('party_id');
	// $this->db->where('district_id',$district_id);
	// $query=$this->db->get($table);
}

function get_candidate_by_district($district_id){
	$table = $this->get_table();
	$this->db->where('district_id', $district_id);
	$query=$this->db->get($table);
	return $query;
}

function get_candidate_by_area($district_id, $area){
	$table = $this->get_table();
	$this->db->where('district_id', $district_id);
	$this->db->where('area', $area);
	$query=$this->db->get($table);
	return $query;
}

function get_all_candidates_by_party($party_id){
	$table = $this->get_table();
	$this->db->where('party_id', $party_id);
	$query=$this->db->get($table);
	return $query;	
}


function get($order_by){
$table = $this->get_table();
$this->db->order_by($order_by);
$query=$this->db->get($table);
// var_dump($query);
// return;
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$table = $this->get_table();
$this->db->limit($limit, $offset);
$this->db->order_by($order_by);
$query=$this->db->get($table);
return $query;
}

function get_where($id){
$table = $this->get_table();
$this->db->where('id', $id);
$query=$this->db->get($table);
return $query;
}

function get_where_custom($col, $value) {
$table = $this->get_table();
$this->db->where($col, $value);
$query=$this->db->get($table);
return $query;
}

function _insert($data){
$table = $this->get_table();
$this->db->insert($table, $data);
}

function _update($id, $data){
$table = $this->get_table();
$this->db->where('id', $id);
$this->db->update($table, $data);
}

function vote_update($id, $data, $percent){
$table = $this->get_table();
$this->db->set('vote_count', $data);
$this->db->set('vote_percent', $percent);
$this->db->where('id', $id);
$this->db->update($table);
}

function _delete($id){
$table = $this->get_table();
$this->db->where('id', $id);
$this->db->delete($table);
}

function count_where($column, $value) {
$table = $this->get_table();
$this->db->where($column, $value);
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
}

function count_all() {
$table = $this->get_table();
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
}

function get_max() {
$table = $this->get_table();
$this->db->select_max('id');
$query = $this->db->get($table);
$row=$query->row();
$id=$row->id;
return $id;
}

function _custom_query($mysql_query) {
$query = $this->db->query($mysql_query);
return $query;
}

}