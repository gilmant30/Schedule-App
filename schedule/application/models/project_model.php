<?php
class Project_model extends CI_Model {
	

	//parent function that loads database
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_all_projects()
	{
		$query = $this->db->query("SELECT * FROM sch_project");

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function get_all_project_types()
	{
		$query = $this->db->query("SELECT * FROM sch_project_type");

		return $query->result();
	}

	function get_all_phase_types()
	{
		$query = $this->db->query("SELECT * FROM sch_phase_type");

		return $query->result();
	}

	function get_all_departments()
	{
		$query = $this->db->query("SELECT * FROM sch_project_dept");

		return $query->result();
	}

	function get_all_project_codes()
	{
		$query = $this->db->query("SELECT PROJECT_CODE FROM sch_project");

		return $query->result();
	}

	function insert_project($project_name, $project_dept_id, $project_year, $project_type_id, $project_sponsor, $sequence_number, $project_descriptor, $project_code, $project_info)
	{
		$this->db->set('PROJECT_TYPE_ID', $project_type_id);
		$this->db->set('PROJECT_DEPT_ID', $project_dept_id);
		$this->db->set('PROJECT_NAME', $project_name);
		$this->db->set('PROJECT_YEAR', $project_year);
		$this->db->set('PROJECT_DESCRIPTOR', $project_descriptor);
		$this->db->set('PROJECT_CODE', $project_code);
		$this->db->set('PROJECT_SPONSOR', $project_sponsor);
		$this->db->set('PROJECT_INFO', $project_info);

		if($this->db->insert('SCH_PROJECT') != TRUE)
		{
			return 'error';
		}
		else
		{
			return 'added';
		}
	}

	function insert_project_duration($project_id, $resource_type_id, $duration)
	{
		$this->db->set('PROJECT_ID', $project_id);
		$this->db->set('RESOURCE_TYPE_ID', $resource_type_id);
		$this->db->set('PROJ_DURATION', $duration);

		if($this->db->insert('SCH_PROJECT_DURATION') != TRUE)
		{
			return 'error';
		}
		else
		{
			return 'added';
		}
	}

	function check_if_project_type_exists($project_type)
	{
		$query = $this->db->query("SELECT * FROM sch_project_type WHERE type_name = '$project_type'");

		return $query->num_rows();
	}

	function insert_project_type($project_type)
	{
		$query = $this->check_if_project_type_exists($project_type);

		if($query > 0)
		{
			return 'exists';
		}
		else
		{
			$this->db->set('TYPE_NAME', $project_type);
			
			if($this->db->insert('SCH_PROJECT_TYPE') != TRUE)
			{
				return 'error';
			}
			else
			{
				return 'added';
			}
			
		}
		

	}

	function check_if_dept_exists($dept_name)
	{
		$query = $this->db->query("SELECT * FROM sch_project_dept WHERE dept_name = '$dept_name'");

		return $query->num_rows();		
	}

	function insert_department($dept_name)
	{
		$query = $this->check_if_dept_exists($dept_name);

		if($query > 0)
		{
			return 'exists';
		}
		else
		{
			$this->db->set('DEPT_NAME', $dept_name);
			
			if($this->db->insert('SCH_PROJECT_DEPT') != TRUE)
			{
				return 'error';
			}
			else
			{
				return 'added';
			}
			
		}
	}

	function get_project_by_id($project_id)
	{
		$query = $this->db->query("SELECT * FROM sch_project WHERE project_id = '$project_id'");

		if($query->num_rows == 0)
		{
			return FALSE;
		}
		else
		{
			return $query->row();
		}
	}

	function get_project_phases($project_id)
	{
		$query = $this->db->query("SELECT * FROM sch_project_phase WHERE project_id = '$project_id'");

		if($query->num_rows == 0)
		{
			return FALSE;
		}
		else
		{
			return $query->result();
		}
	}

	function get_project_id($project_code)
	{
		$query = $this->db->query("SELECT project_id FROM sch_project WHERE project_code = '$project_code'");

		if($query->num_rows() == 1)
		{
			$query = $query->row();
			return $query->PROJECT_ID;
		}
		else
		{
			return 'error';
		}
	}

}