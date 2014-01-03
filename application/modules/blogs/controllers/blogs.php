<?php
class Blogs extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function manage(){
	Modules::run('site_security/make_sure_is_admin');
	Modules::run('site_security/make_sure_is_reporter');

	$data['query']= $this->get('id');
	$data['view_file'] = "manage";
	$data['module'] = "blogs";
	$this->load->module('template');
	$this->template->admin($data);
}

function get_data_from_post(){
	Modules::run('site_security/make_sure_is_reporter');
	Modules::run('site_security/make_sure_is_admin');

	$data['blog_title'] = $this->input->post('blog_title', TRUE);
	$data['blog_content'] = $this->input->post('blog_content', TRUE);
	$data['tags'] = $this->input->post('tags', TRUE);
	return $data; 
}

function get_data_from_db($update_id){
	Modules::run('site_security/make_sure_is_reporter');
	Modules::run('site_security/make_sure_is_admin');

	$query = $this->get_where($update_id);
	foreach($query->result() as $row){
		$data['blog_title'] = $row->blog_title;
		$data['blog_content'] = $row->blog_content;
		$data['tags'] = $row->tags;
	}
	if(!isset($data)){
		$data = "";
	}
	return $data;
}

function create(){
	Modules::run('site_security/make_sure_is_reporter');
	Modules::run('site_security/make_sure_is_admin');

	$this->load->library('ckeditor');
	$this->load->library('ckfinder');

	$this->ckeditor->basePath = base_url().'ckeditor/';
	$this->ckeditor->config['toolbar'] = array(
	                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
	                                                    );
	$this->ckeditor->config['language'] = 'it';
	$this->ckeditor->config['width'] = '730px';
	$this->ckeditor->config['height'] = '300px';            

	//Add Ckfinder to Ckeditor
	$this->ckfinder->SetupCKEditor($this->ckeditor,'../../ckfinder/'); 

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
	$data['module'] = "blogs";
	$this->load->module('template');
	$this->template->admin($data);
}

function deleteconf(){
	Modules::run('site_security/make_sure_is_reporter');
	Modules::run('site_security/make_sure_is_admin');

	$update_id = $this->uri->segment(3);
	$this->_delete($update_id);

	redirect('blogs/manage');
}


function submit(){
	Modules::run('site_security/make_sure_is_reporter');
	Modules::run('site_security/make_sure_is_admin');
	
	$this->load->library('form_validation');

	$this->form_validation->set_rules('blog_title', 'Blog Title', 'required|xss_clean');
	$this->form_validation->set_rules('blog_content', 'Blog Content', 'required|xss_clean');
	$this->form_validation->set_rules('tags', 'tags', 'required|xss_clean');

	if ($this->form_validation->run($this) == FALSE){
		$this->create();
	}
	else{
		$data = $this->get_data_from_post();
		$data['posted_by'] = $this->session->userdata('username');
		//figure out page url should be
		// $data['blog_url']= url_title($data['blog_title']) ;

		$update_id = $this->uri->segment(3);
		// echo $update_id;

		// $data['blog_url']= url_title($update_id);

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
			$data['blog_url'] = url_title($update_id);
			$this->_update($update_id, $data);
		}

		redirect('blogs/manage', $data);
	}
}


function get_news(){
	$query = $this->get('datetime');
	foreach ($query->result() as $row) {
		echo $row->news_headline;
	}
}


function index(){
	$data['query'] = $this->get_with_limit(10,0,'timestamp');
	// echo "here";
	$data['view_file'] = "all";
	$data['module'] = "blogs";
	$data['page_title'] = 'Blog';
	$this->load->module('template');
	$this->template->pages($data);
}


function get_recent_blog(){
	$query = $this->get_with_limit(1, 0, 'timestamp');
	foreach ($query->result() as $row) {
		$data['blog_title'] = $row->blog_title;
		$data['blog_posted_by'] = $row->posted_by;
		$data['blog_timestamp'] = $row->timestamp;
		$data['blog_content'] = $row->blog_content;
		$data['blog_url'] = $row->blog_url;		
	}
	$data['page_title'] = 'Blog';				
	return $data;
}

function posts(){
	$post_id = $this->uri->segment(3);
	// echo $post_id;
	$query = $this->get_where($post_id);
	foreach ($query->result() as $row) {
		$data['blog_id'] = $row->id;
		$data['blog_title'] = $row->blog_title;
		$data['blog_posted_by'] = $row->posted_by;
		$data['blog_timestamp'] = $row->timestamp;
		$data['blog_content'] = $row->blog_content;
		$data['blog_url'] = $row->blog_url;		
	}
	$data['page_title'] = 'Blog';		
	$data['view_file'] = 'single_post';
	$data['module'] = 'blogs';
	$this->load->module('template');
	$this->template->pages($data);
}







function get($order_by){
$this->load->model('mdl_blogs');
$query = $this->mdl_blogs->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_blogs');
$query = $this->mdl_blogs->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_blogs');
$query = $this->mdl_blogs->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_blogs');
$query = $this->mdl_blogs->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_blogs');
$this->mdl_blogs->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_blogs');
$this->mdl_blogs->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_blogs');
$this->mdl_blogs->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_blogs');
$count = $this->mdl_blogs->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_blogs');
$max_id = $this->mdl_blogs->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_blogs');
$query = $this->mdl_blogs->_custom_query($mysql_query);
return $query;
}

}