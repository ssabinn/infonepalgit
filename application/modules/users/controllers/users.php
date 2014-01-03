<?php
class Users extends MX_Controller 
{

function __construct() {
parent::__construct();
}


function login(){
	$data['view_file'] = 'loginform';
	$this->load->module('template');
	$this->template->public_one_col($data);
}

function logout(){
	$this->session->unset_userdata('user_id');
	$this->session->unset_userdata('username');
	$this->session->unset_userdata('is_a');
	$this->session->sess_destroy();
	redirect('/');
}

function create(){
	$data['view_file'] = 'signupform';
	$this->load->module('template');
	$this->template->public_one_col($data);
}

function _in_you_go($username){
	//give them session id and send them to admin panel
	$query = $this->get_where_custom('username', $username);
	foreach($query->result() as $row){
		$user_id = $row->id;
		$is_a = $row->is_a;
	}

	$sess_array = array(
			'user_id' => $user_id,
			'username' => $username,
			'is_a'=> $is_a,
			 );

	$this->session->set_userdata('user_id', $user_id);
	$this->session->set_userdata('username', $username);
	$this->session->set_userdata('is_a', $is_a);

	redirect('dashboard/home');

}

function submit(){

	$this->load->library('form_validation');

	$this->form_validation->set_rules('username', 'Username', 'required|max_length[30]|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'required|max_length[240]|xss_clean|callback_password_check');

	if ($this->form_validation->run($this) == FALSE){
		$this->login();
	}
	else{
		$username = $this->input->post('username', TRUE);
		$this->_in_you_go($username);
	}
}

function password_check($password){
	$username = $this->input->post('username', TRUE);
	$this->load->model('mdl_users');
	$result = $this->mdl_users->password_check($username, $password);  

	if ($result == FALSE)
	{
		$this->form_validation->set_message('password_check', 'Incorrect Username/Password combination');
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}


function get_where_custom($col, $value) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where_custom($col, $value);
return $query;
}


function signupsubmit(){

	$this->load->library('form_validation');

	$this->form_validation->set_rules('username', 'Username', 'required|max_length[30]|xss_clean');
	$this->form_validation->set_rules('name', 'name', 'required|max_length[30]|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'required|max_length[240]|xss_clean|matches[passwordconf]');
	$this->form_validation->set_rules('passwordconf', 'Confirm Password', 'required|max_length[240]|xss_clean');
	$this->form_validation->set_rules('email', 'Email', 'required|max_length[240]|xss_clean|valid_email');

	if ($this->form_validation->run($this) == FALSE){
		$this->create();
	}
	else{
		$data['username'] = $this->input->post('username', TRUE);
		$data['name'] = $this->input->post('name', TRUE);
		$data['password'] = $this->input->post('password', TRUE);
		$data['email'] = $this->input->post('email', TRUE);
		$this->_insert($data);
		$this->login();

	}
}

function _insert($data){
	$this->load->model('mdl_users');
	$this->mdl_users->_insert($data);
}



}

?>