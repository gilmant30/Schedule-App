<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller {

	//parent function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string', 'cookie'));  //load a form and the base_url
        $this->load->library(array('form_validation', 'security', 'session')); //set form_validation rules and xss_cleaning
        $this->load->model('Resource_model');
        $this->load->model('Project_model');
        
	}

	public function index()
	{

	}

	public function newResource()
	{
		$data['title'] = $this->Resource_model->get_all_titles();
		$data['resource_type'] = $this->Resource_model->get_all_resource_types();

		$this->load->view('resource/new_resource', $data);
	}

	public function createResource()
	{
		$this->form_validation->set_rules('resource_name', 'Resource Name', 'required');
		$this->form_validation->set_rules('resource_type', 'Resource Type', 'required');
		$this->form_validation->set_rules('resource_title', 'Resource Title', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			$resource_name = $this->input->post('resource_name');
			$resource_type = $this->input->post('resource_type');
			$resource_title = $this->input->post('resource_title');

			$resource_name = ucwords(strtolower($resource_name));

			$query = $this->Resource_model->insert_resource($resource_name, $resource_type, $resource_title);

			if($query == 'exists')
			{
				echo json_encode(array('success'=>0, 'msg' => $resource_name.' already exists'));
			}
			elseif($query == 'error')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error inserting resource into database'));
			}
			else
			{
				echo json_encode(array('success'=>1, 'msg' => $resource_name.' succesfully added'));
			}
		}

	}


	public function newResourceType()
	{
		$data['resource_type'] = $this->Resource_model->get_all_resource_types();

		$this->load->view('resource/new_resource_type', $data);
	}

	public function createResourceType()
	{
		$this->form_validation->set_rules('resource_type', 'Resource Type', 'required');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			$resource_type = $this->input->post('resource_type');

			$resource_type = ucfirst(strtolower($resource_type));

			$query = $this->Resource_model->insert_resource_type($resource_type);

			if($query == 'exists')
			{
				echo json_encode(array('success'=>0, 'msg' => $resource_type.' already exists'));
			}
			elseif($query == 'error')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error inserting resource type into database'));
			}
			else
			{
				echo json_encode(array('success'=>1, 'msg' => 'Resource type succesfully added'));
			}
		}
	}

	public function newTitle()
	{
		$data['title'] = $this->Resource_model->get_all_titles();

		$this->load->view('resource/new_title', $data);
	}

	public function createTitle()
	{
		$this->form_validation->set_rules('title', 'Title name', 'required');
		$this->form_validation->set_rules('work_week_hr', 'Hours per week', 'required|numeric');

		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			$title = $this->input->post('title');
			$hours = $this->input->post('work_week_hr');

			$title = ucfirst(strtolower($title));

			$query = $this->Resource_model->insert_title($title, $hours);

			if($query == 'exists')
			{
				echo json_encode(array('success'=>0, 'msg' => $title.' already exists'));
			}
			elseif($query == 'error')
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error inserting title into database'));
			}
			else
			{
				echo json_encode(array('success'=>1, 'msg' => 'title succesfully added'));
			}
		}
	}

	public function showAll()
	{
		$data['resource'] = $this->Resource_model->get_all_resources();
		$data['resource_type'] = $this->Resource_model->get_all_resource_types();
		$data['resource_title'] = $this->Resource_model->get_all_titles();

		$this->load->view('resource/resource_list',$data);
	}

	public function updatePriority()
	{
		$flag = 0;
		$systems = $this->Project_model->get_all_systems();
		foreach($systems as $system)
		{
			$this->form_validation->set_rules('priority_'.$system->SKILL_ID, $system->SKILL_NAME, 'required|integer|is_natural');
		}
		if($this->form_validation->run() == FALSE)
		{
		  echo json_encode(array('success'=>0, 'msg' => validation_errors()));
		}
		else
		{
			$resource_id = $this->security->xss_clean($this->input->post('resource_id'));
			$year = $this->security->xss_clean($this->input->post('year'));
			foreach($systems as $system)
			{
				$priority = $this->security->xss_clean($this->input->post('priority_'.$system->SKILL_ID));

				$query = $this->Resource_model->update_priority($resource_id, $system->SKILL_ID, $priority);

				if($query == 'error')
				{
					$flag++;
				}
			}

			if($flag == 0)
			{
				echo json_encode(array('success'=>1, 'msg' => 'updated', 'resource_id' => $resource_id, 'year' => $year));
			}
			else
			{
				echo json_encode(array('success'=>0, 'msg' => 'Error updating priority', 'resource_id' => $resource_id, 'year' => $year));
			}
		}
	}

	public function showResourceById($id,$year)
	{
		$current_year = date('Y');
		$time = 0;
		$data['resource_info'] = $this->Resource_model->get_resource_info($id);
		$available_time = $this->Resource_model->get_availabel_time($id);
		$phases	= $this->Resource_model->get_phases_by_year($year);
		$data['resource_resp'] = $this->Resource_model->get_resource_resp($id);
		$data['systems'] = $this->Project_model->get_all_systems();
		$data['resource_id'] = $id;


		foreach($phases as $phase)
		{
			$time = $time + $this->Resource_model->get_time_for_resource($id, $phase->PROJECT_PHASE_ID);
		}

		$available_time = (int) $available_time;
		$time = (int) $time;

		$data['total_time'] = $available_time;
		$data['time_spent'] = $time;
		$data['available_time'] = $available_time - $time;
		$data['year'] = $year;
		if($current_year == $year)
		{
			$data['year2'] = $year + 1;
			$data['year3'] = $year + 2;
		}
		else
		{
			if($current_year == $year - 1)
			{
				$data['year2'] = $year - 1;
				$data['year3'] = $year + 1;
			}
			elseif($current_year == $year - 2)
			{
				$data['year2'] = $year - 2;
				$data['year3'] = $year - 1;
			}
		}

		$percentage = ($time/$available_time)*100;
		$data['progress_bar'] = json_encode($percentage);

		$this->load->view('resource/resource_by_id',$data);
	}

	public function allocateResources()
	{
		$year = date('Y');

		//$years = array($year,$year+1,$year+2);

		$this->Resource_model->delete_allocated_resources();

		//foreach($years as $year)
		//{
			$projects = $this->Resource_model->get_all_projects_by_year($year);
			
			foreach ($projects as $proj) {
				$phases = $this->Project_model->get_project_phases($proj->PROJECT_ID);
				
				foreach ($phases as $phase) {
					$needed_resource_types = $this->Resource_model->get_needed_resource_type($phase->PROJECT_PHASE_ID);
					foreach ($needed_resource_types as $needed_resource) {
						$order = 1;
						$flag = 0;
						$query = $this->Resource_model->allocate_resource($needed_resource->RESOURCE_TYPE_ID, $needed_resource->SKILL_ID, $needed_resource->PHASE_DURATION, $year, $needed_resource->NEEDED_RESOURCE_TYPE_ID, $order, $flag);
					}
				}
			}
		//}

	}

	public function systemsByPriority()
	{
		echo 'This shows systems based on priority and resource type';
	}

}

?>