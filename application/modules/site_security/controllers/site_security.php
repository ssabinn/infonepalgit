<?php
class Site_security extends MX_Controller 
{

	function __construct() {
		parent::__construct();
		
	}


	function make_hash($password){
		return md5($password);
	}

	function make_sure_is_admin(){
		$user_id = $this->session->userdata('user_id');
		

		if(!is_numeric($user_id)){
			redirect(base_url());
		}
	}

	function make_sure_is_reporter(){
		$is_a = $this->session->userdata('is_a');
		// echo "here";

		if($is_a == ""){
			redirect(base_url());					
		}

		if($is_a !== 'reporter'){
			if($is_a !== 'admin'){
				redirect(base_url());					
			}
		}
	}


}

?>