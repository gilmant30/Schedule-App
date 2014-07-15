<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	//parent function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string', 'cookie'));  //load a form and the base_url
        $this->load->library(array('form_validation', 'security', 'session')); //set form_validation rules and xss_cleaning
        //$this->load->model('Project_model');
        
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('project/home_page');
	}

	public function newProject()
	{

		$this->load->view('project/new_project');
	}

	public function createProject()
	{
		
		$this->form_validation->set_rules('project_name', 'Project Name', 'required');
		$this->form_validation->set_rules('project_department', 'Project Department', 'required');
		$this->form_validation->set_rules('project_year', 'Project Year', 'required');
		$this->form_validation->set_rules('project_type', 'Project Type', 'required');
		$this->form_validation->set_rules('project_sponsor', 'Project Sponsor', 'required');
		$this->form_validation->set_rules('sequence_number', 'Sequence Number', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			//put the data into the database
			/****** HERE *********/


			/*********************/
			echo json_encode(array('st'=>0));
		}
	}

	public function showAll()
	{
		$this->load->view('project/show_all_projects');
	}

	public function info()
	{
		echo "the project has been added";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */