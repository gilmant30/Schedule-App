<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phase extends CI_Controller {

	//parent function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string', 'cookie'));  //load a form and the base_url
        $this->load->library(array('form_validation', 'security', 'session')); //set form_validation rules and xss_cleaning
        $this->load->model('Phase_model');
        $this->load->model('Project_model');
        $this->load->model('Resource_model');
        
	}

	public function index()
	{
		
	}

	public function newPhase($project_id)
	{
		$data['phase_types'] = $this->Phase_model->get_all_phase_types();
		$data['resource_types'] = $this->Resource_model->get_all_resource_types();
		$data['project'] = $this->Project_model->get_project_by_id($project_id);
		$data['system'] = $this->Phase_model->get_systems_in_project($project_id);
		$data['project_duration'] = $this->Phase_model->get_project_duration($project_id);

		$this->load->view('phase/new_phase', $data);
	}

	public function createPhase()
	{
		$phase_error = 0;
		$resource_error = 0;
		$project_id = $this->input->post('project_id');
		$phase_types = $this->Phase_model->get_all_phase_types();
		$resource_types = $this->Resource_model->get_all_resource_types();
		$system = $this->Phase_model->get_systems_in_project($project_id);
		$project_year = $this->Phase_model->get_project_year($project_id);

		foreach($phase_types as $phase_type)
		{
			foreach ($resource_types as $resource_type) {
					foreach($system as $sys)
					{
						$this->form_validation->set_rules('duration_'.$phase_type->PHASE_TYPE_ID.'_'.$sys->SKILL_ID.'_'.$resource_type->RESOURCE_TYPE_ID, $phase_type->TYPE_NAME.' for '.$resource_type->TYPE_NAME.' '.$sys->SKILL_NAME.' hrs','required|numeric');
					}
			}		
		}

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			foreach($phase_types as $phase_type)
			{
				$phase_id = $this->Phase_model->insert_phase($project_id, $phase_type->PHASE_TYPE_ID, $project_year);

				if($phase_id == 'error')
				{
					$phase_error++;
				}
				else
				{
					foreach ($resource_types as $resource_type) {
						foreach($system as $sys)
						{
							$duration = $this->security->xss_clean($this->input->post('duration_'.$phase_type->PHASE_TYPE_ID.'_'.$sys->SKILL_ID.'_'.$resource_type->RESOURCE_TYPE_ID));
							
							$query = $this->Phase_model->insert_needed_resource_type($duration, $phase_id, $sys->SKILL_ID, $resource_type->RESOURCE_TYPE_ID);

							if($query = 'error')
							{
								$resource_error++;
							}
						}
					}	
				}	
			}

			if($phase_error == 0 && $resource_error == 0)
			{
				echo json_encode(array('success'=>1, 'msg' => 'Phases succesfully added'));
			}
			elseif($resource_error > 0)
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error inserting resources'));
			}
			elseif($phase_error > 0)
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error inserting phases'))
;			}
		}	

	}

	public function newPhaseType()
	{
		$data['phase_types'] = $this->Phase_model->get_all_phase_types();

		$this->load->view('phase/new_phase_type', $data);
	}

	public function createPhaseType()
	{
		$this->form_validation->set_rules('phase_type_name', 'Phase Type Name', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			
			$phase_type = $this->input->post('phase_type_name');
			$phase_type = ucfirst(strtolower($phase_type));
			
			$query = $this->Phase_model->insert_phase_type($phase_type);
			
			if($query == 'exists')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Phase type already exists'));
			}
			else if($query == 'error')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error with adding phase type to the database'));
			}
			else if($query == 'added')
			{
				echo json_encode(array('success'=>1, 'msg' => 'Phase type has been added'));
			}
		}
	}

	public function selectProject()
	{
		$data['title'] = 'Select project to create phase for';
		$data['projects'] = $this->Project_model->get_all_projects();
		$data['types'] = $this->Project_model->get_all_project_types();
		$data['department'] = $this->Project_model->get_all_departments();
		
		$this->load->view('project/show_all_projects', $data);
	}

	public function updateTypeOrder()
	{
		$order = $this->input->post('items');

		echo json_encode(array('success'=>1, 'msg' => $order));
	}

	public function showPhaseInfo($phase_id)
	{
		$data['phase'] = $this->Phase_model->get_phase_by_id($phase_id);
		$data['phase_types'] = $this->Phase_model->get_all_phase_types();


		$this->load->view('phase/phase_info', $data);
	}

}

?>