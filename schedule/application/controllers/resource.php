<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller {

	//parent function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string', 'cookie'));  //load a form and the base_url
        $this->load->library(array('form_validation', 'security', 'session')); //set form_validation rules and xss_cleaning
        $this->load->model('Resource_model');
        
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

}

?>