<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	//parent function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string', 'cookie'));  //load a form and the base_url
        $this->load->library(array('form_validation', 'security', 'session')); //set form_validation rules and xss_cleaning
        $this->load->model('Login_model');
	}


	public function index()
	{
		//validate form
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$data['error'] = '';
			$this->load->view('login/login', $data);
		}
		else
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$valid = $this->Login_model->validate_login($email,$password);

			if($valid == FALSE)
			{
				$data['error'] = 'Email or password is incorrect';
				$this->load->view('login/login',$data);
			}
			else
			{
				redirect('project/index');
			}
		}
	}


	public function logout()
	{
		redirect('login/index');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */