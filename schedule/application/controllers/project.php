<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	//parent function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string', 'cookie'));  //load a form and the base_url
        $this->load->library(array('form_validation', 'security', 'session')); //set form_validation rules and xss_cleaning
        $this->load->model('Project_model');
        $this->load->model('Resource_model');
        
	}

	public function index()
	{
		$data['project_codes'] = json_encode($this->Project_model->get_all_project_codes());


		$this->load->view('template/header',$data);
		$this->load->view('home_page');
	}

	public function newProject()
	{
		$data['project_type'] = $this->Project_model->get_all_project_types();
		$data['department'] = $this->Project_model->get_all_departments();
		$data['resource_type'] = $this->Resource_model->get_all_resource_types();
		$data['system'] = $this->Project_model->get_all_systems();

		$this->load->view('project/new_project',  $data);
	}

	public function createProject()
	{		
		//validate to make sure all fields are filled in correctly
		$this->form_validation->set_rules('project_name', 'Project Name', 'required');
		$this->form_validation->set_rules('project_dept_id', 'Project Department', 'required');
		$this->form_validation->set_rules('project_year', 'Project Year', 'required|numeric|exact_length[4]');
		$this->form_validation->set_rules('project_type_id', 'Project Type', 'required');
		$this->form_validation->set_rules('project_sponsor', 'Project Sponsor', 'required');
		$this->form_validation->set_rules('sequence_number', 'Sequence Number', 'required|numeric');
		$this->form_validation->set_rules('project_descriptor', 'Project Descriptor', 'required');
		$this->form_validation->set_rules('project_code', 'Project Code', 'required');
		$this->form_validation->set_rules('project_info', 'Project Info', 'required');
		$this->form_validation->set_rules('system', 'System', 'required');

		$resource_type = $this->Resource_model->get_all_resource_types();

		foreach($resource_type as $type)
		{
			$this->form_validation->set_rules('duration_'.$type->RESOURCE_TYPE_ID, $type->TYPE_NAME.' Project Duration', 'required|numeric');
		}


		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			$flag =0;

			$project_name = $this->security->xss_clean($this->input->post('project_name'));
			$project_dept_id = $this->security->xss_clean($this->input->post('project_dept_id'));
			$project_year = $this->security->xss_clean($this->input->post('project_year'));
			$project_type_id = $this->security->xss_clean($this->input->post('project_type_id'));
			$project_sponsor = $this->security->xss_clean($this->input->post('project_sponsor'));
			$sequence_number = $this->security->xss_clean($this->input->post('sequence_number'));
			$project_descriptor = $this->security->xss_clean($this->input->post('project_descriptor'));
			$project_code = $this->security->xss_clean($this->input->post('project_code'));
			$project_info = $this->security->xss_clean($this->input->post('project_info'));
			$system = $this->security->xss_clean($this->input->post('system'));

			$query = $this->Project_model->insert_project($project_name, $project_dept_id, $project_year, $project_type_id, $project_sponsor, $sequence_number, $project_descriptor, $project_code, $project_info);

			if($query == 'error')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error with adding project type to the database'));
			}
			else if($query == 'added')
			{
				$project_id = $this->Project_model->get_project_id($project_code);
				if($project_id == 'error')
				{
					echo json_encode(array('success'=>0, 'msg' => 'Error with retrieving project id from the database'));
				}
				else
				{
					foreach ($system as $sys_id) {
						$query = $this->Project_model->insert_project_skill($project_id, $sys_id);

						if($query == 'error')
						{
							$flag = 1;
							echo json_encode(array('success'=>0, 'msg' => 'Error with adding project skill to the database'));
						}
					}

					foreach($resource_type as $type)
					{
						$duration = $this->security->xss_clean($this->input->post('duration_'.$type->RESOURCE_TYPE_ID));

						if($duration > 0)
						{
							$query = $this->Project_model->insert_project_duration($project_id, $type->RESOURCE_TYPE_ID, $duration);

							if($query == 'error')
							{
								$flag = 1;
								echo json_encode(array('success'=>0, 'msg' => 'Error with adding project duration to the database'));
							}
						}
					}
					if($flag == 0)
					{
						echo json_encode(array('success'=>1, 'msg' => 'Project has been added', 'project_id' => $project_id));
					}
				}
			}
		}
	}

	public function showAll()
	{
		$data['title'] = 'Show All Projects';
		$data['projects'] = $this->Project_model->get_all_projects();
		$data['types'] = $this->Project_model->get_all_project_types();
		$data['department'] = $this->Project_model->get_all_departments();
		
		$this->load->view('project/show_all_projects', $data);
	}

	public function newProjectType()
	{
		$data['project_type'] = $this->Project_model->get_all_project_types();
		
		$this->load->view('project/new_project_type', $data);
	}

	public function createProjectType()
	{
		$this->form_validation->set_rules('project_type_name', 'Project Type Name', 'required');
		$this->form_validation->set_rules('project_abbr', 'Project Abbreviation', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			
			$project_type = $this->input->post('project_type_name');
			$project_abbr = $this->input->post('project_abbr');
			
			$project_type = ucfirst(strtolower($project_type));
			$project_abbr = strtoupper($project_abbr);
			
			$query = $this->Project_model->insert_project_type($project_type, $project_abbr);
			
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
		$data['department'] = $this->Project_model->get_all_departments();

		$this->load->view('project/new_dept',$data);
	}

	public function createDept()
	{
		$this->form_validation->set_rules('dept_name', 'Department Name', 'required');
		$this->form_validation->set_rules('dept_abbr', 'Department Abbreviation', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			
			$dept_name = $this->input->post('dept_name');
			$dept_abbr = $this->input->post('dept_abbr');

			$dept_name = ucwords(strtolower($dept_name));
			$dept_abbr = strtoupper($dept_abbr);

			$query = $this->Project_model->insert_department($dept_name, $dept_abbr);
			
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


	public function showProjectInfo($project_id)
	{
		$data['json_array'] = new ArrayObject();
		$data['project'] = $this->Project_model->get_project_by_id($project_id);
		$phase_types = $this->Project_model->get_all_phase_types();
		$dept = $this->Project_model->get_all_departments();
		$phases = $this->Project_model->get_project_phases($project_id);

		foreach($phases as $phase)
		{
			foreach ($phase_types as $type) {
				if($phase->PHASE_TYPE_ID == $type->PHASE_TYPE_ID)
				{
					$phase_name = $type->TYPE_NAME;
				}
			}

			$phase_array = array(
				'phase_id' => $phase->PROJECT_PHASE_ID,
				'phase_type' => $phase_name,
				'phase_start' => $phase->PHASE_START,
				'phase_end' => $phase->PHASE_END
				);

			$data['json_array']->append($phase_array);
		}

		$data['json_array'] = json_encode($data['json_array']);

		$this->load->view('project/project_info', $data);
	}

	public function progressBar()
	{
		$data['systems'] = $this->Project_model->get_all_systems();
		$data['resource_types'] = $this->Resource_model->get_all_resource_types();
		$data['years'] = array(date('Y'), date('Y', strtotime("+1 year")), date('Y', strtotime("+2 years")));
		$this->load->view('template/progress_bars', $data);
	}


}
