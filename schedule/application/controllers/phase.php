<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phase extends CI_Controller {

	//parent function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string', 'cookie'));  //load a form and the base_url
        $this->load->library(array('form_validation', 'security', 'session')); //set form_validation rules and xss_cleaning
        $this->load->model('Project_model');
        
	}

	public function index()
	{
		
	}

	public function selectProject()
	{
		$query = $this->Project_model->get_all_projects();

		if($query == FALSE)
		{
			$data['projects'] = FALSE;
		}
		else
		{
			$data['projects'] = $query;
		}

		$this->load->view('phase/select_project', $data);
	}

	public function newPhase()
	{
		$this->load->view('phase/new_phase');
	}

}

?>