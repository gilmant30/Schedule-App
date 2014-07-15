<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	//parent function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string', 'cookie'));  //load a form and the base_url
        $this->load->library(array('form_validation', 'security', 'session')); //set form_validation rules and xss_cleaning
        $this->load->view('template/header');
	}


	public function index()
	{
		$this->load->view('login');
	}

	public function validate_login()
	{
		$email = $this->input->post('email');
		//echo $email;
		echo "this works";
	}

	public function logout()
	{
		echo 'logout';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */