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

		$this->load->view('phase/new_phase', $data);
	}

	public function createPhase($project_id)
	{
		$phase_types = $this->Phase_model->get_all_phase_types();

		$insert_type = $this->input->post('insert_phase');
		$project_id = $this->input->post('project_id');
		$flag = 0;
		$added = 0;
	
		foreach($insert_type as $type)
		{
			foreach ($phase_types as $phase_type) {
				if($type == $phase_type->PHASE_TYPE_ID)
				{
					if($flag == 0)
					{
						$this->form_validation->set_rules('phase_start_'.$type, 'Phase Start '.$phase_type->TYPE_NAME, 'required');
						$this->form_validation->set_rules('phase_end_'.$type, 'Phase End '.$phase_type->TYPE_NAME, 'required');

						if($this->form_validation->run() == FALSE)
						{
						  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
						  $flag++;
						}
					}
				}
			}
		}

		
		if($flag == 0)
		{
			foreach ($insert_type as $type) 
			{
				$start = $this->input->post('phase_start_'.$type);
				$end = $this->input->post('phase_end_'.$type);

				$query = $this->Phase_model->insert_phase($project_id, $type, $start, $end);

				if($query == 'added')
					$added++;
			}
			echo json_encode(array('success'=>1, 'msg' => $added.' Phase added'));
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