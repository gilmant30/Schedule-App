<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

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
		$this->load->view('template/header');
		$this->load->view('home_page');
	}

	public function newProject()
	{
		$data['project_type'] = $this->Project_model->get_all_project_types();
		$data['department'] = $this->Project_model->get_all_departments();

		$this->load->view('project/new_project',  $data);
	}

	public function createProject()
	{		

		$this->form_validation->set_rules('project_name', 'Project Name', 'required');
		$this->form_validation->set_rules('project_dept_id', 'Project Department', 'required');
		$this->form_validation->set_rules('project_year', 'Project Year', 'required|numeric|exact_length[4]');
		$this->form_validation->set_rules('project_type_id', 'Project Type', 'required');
		$this->form_validation->set_rules('project_sponsor', 'Project Sponsor', 'required');
		$this->form_validation->set_rules('sequence_number', 'Sequence Number', 'required|numeric');
		$this->form_validation->set_rules('project_descriptor', 'Project Descriptor', 'required');
		$this->form_validation->set_rules('project_code', 'Project Code', 'required');
		$this->form_validation->set_rules('project_info', 'Project Info', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			$project_name = $this->security->xss_clean($this->input->post('project_name'));
			$project_dept_id = $this->security->xss_clean($this->input->post('project_dept_id'));
			$project_year = $this->security->xss_clean($this->input->post('project_year'));
			$project_type_id = $this->security->xss_clean($this->input->post('project_type_id'));
			$project_sponsor = $this->security->xss_clean($this->input->post('project_sponsor'));
			$sequence_number = $this->security->xss_clean($this->input->post('sequence_number'));
			$project_descriptor = $this->security->xss_clean($this->input->post('project_descriptor'));
			$project_code = $this->security->xss_clean($this->input->post('project_code'));
			$project_info = $this->security->xss_clean($this->input->post('project_info'));

			$query = $this->Project_model->insert_project($project_name, $project_dept_id, $project_year, $project_type_id, $project_sponsor, $sequence_number, $project_descriptor, $project_code, $project_info);

			if($query == 'error')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error with adding project type to the database'));
			}
			else if($query == 'added')
			{
				echo json_encode(array('success'=>1, 'msg' => 'Project type has been added'));
			}
		}
	}

	public function showAll()
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
		
		$this->load->view('project/show_all_projects', $data);
	}

	public function newProjectType()
	{
		$this->load->view('project/new_project_type');
	}

	public function createProjectType()
	{
		$this->form_validation->set_rules('project_type_name', 'Project Type Name', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			
			$project_type = $this->input->post('project_type_name');
			$project_type = ucfirst(strtolower($project_type));
			
			$query = $this->Project_model->insert_project_type($project_type);
			
			if($query == 'exists')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Project type already exists'));
			}
			else if($query == 'error')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error with adding project type to the database'));
			}
			else if($query == 'added')
			{
				echo json_encode(array('success'=>1, 'msg' => 'Project type has been added'));
			}
		}
	}

	public function newDept()
	{
		$this->load->view('project/new_dept');
	}

	public function createDept()
	{
		$this->form_validation->set_rules('dept_name', 'Department Name', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			
			$dept_name = $this->input->post('dept_name');
			$dept_name = strtoupper($dept_name);
			
			$query = $this->Project_model->insert_department($dept_name);
			
			if($query == 'exists')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Department already exists'));
			}
			else if($query == 'error')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error with adding department to the database'));
			}
			else if($query == 'added')
			{
				echo json_encode(array('success'=>1, 'msg' => 'Department has been added'));
			}
		}
	}

	public function displayInfo($project_id)
	{
		$data['project'] = $this->Project_model->get_project_by_id($project_id);
		$data['types'] = $this->Project_model->get_all_project_types();
		$data['department'] = $this->Project_model->get_all_departments();

		$this->load->view('project/top_view', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */