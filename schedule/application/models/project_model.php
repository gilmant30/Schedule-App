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
		$query = $this->db->query("SELECT * FROM sch_project_type ORDER BY TYPE_NAME");

		return $query->result();
	}

	function get_all_phase_types()
	{
		$query = $this->db->query("SELECT * FROM sch_phase_type");

		return $query->result();
	}

	function get_all_departments()
	{
		$query = $this->db->query("SELECT * FROM sch_project_dept ORDER BY DEPT_NAME");

		return $query->result();
	}

	function get_all_project_codes()
	{
		$query = $this->db->query("SELECT project_code FROM sch_project ORDER BY project_code");

		return $query->result();
	}

	function get_all_systems()
	{
		$query = $this->db->query("SELECT * FROM sch_skill WHERE skill_category_id = (SELECT skill_category_id FROM sch_skill_category WHERE category_name = 'Systems') ORDER BY skill_name");

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

	function add_project_order($project_id, $project_year)
	{
		$query = $this->db->query("SELECT MAX(sch_project_order.project_ord) AS NUM_ORDER FROM sch_project INNER JOIN sch_project_order ON sch_project.project_id = sch_project_order.project_id WHERE sch_project.project_year = '$project_year'");

		$query = $query->row();

		$query = $query->NUM_ORDER;

		$order = intval($query);

		$order++;

		$this->db->set('PROJECT_ID', $project_id);
		$this->db->set('PROJECT_ORD', $order);

		if($this->db->insert('SCH_PROJECT_ORDER') != TRUE)
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

	function insert_project_skill($project_id, $sys_id)
	{
		$this->db->set('PROJECT_ID', $project_id);
		$this->db->set('SKILL_ID', $sys_id);

		if($this->db->insert('SCH_PROJECT_SKILL') != TRUE)
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

	function insert_project_type($project_type, $project_abbr)
	{
		$query = $this->check_if_project_type_exists($project_type);

		if($query > 0)
		{
			return 'exists';
		}
		else
		{
			$this->db->set('TYPE_NAME', $project_type);
			$this->db->set('ABBR', $project_abbr);
			
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

	function insert_department($dept_name, $dept_abbr)
	{
		$query = $this->check_if_dept_exists($dept_name);

		if($query > 0)
		{
			return 'exists';
		}
		else
		{
			$this->db->set('DEPT_NAME', $dept_name);
			$this->db->set('ABBR', $dept_abbr);
			
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

	function get_total_system_time_used_by_resource_type_and_year($skill_id, $resource_type_id, $year)
	{
		$query = $this->db->query("SELECT SUM(sch_allocated_resource.allocated_duration) AS ALLOCATED_SUM FROM sch_allocated_resource INNER JOIN sch_resource ON 
			sch_allocated_resource.resource_id = sch_resource.resource_id INNER JOIN sch_needed_resource_type ON 
			sch_needed_resource_type.NEEDED_RESOURCE_TYPE_ID = sch_allocated_resource.NEEDED_RESOURCE_TYPE_ID INNER JOIN sch_project_phase ON
			 sch_needed_resource_type.project_phase_id = sch_project_phase.project_phase_id WHERE
			  sch_resource.resource_type_id = '$resource_type_id' AND sch_project_phase.phase_year = '$year' AND sch_needed_resource_type.skill_id = '$skill_id'");

		$query = $query->row();

		return $query->ALLOCATED_SUM;
	}

	function get_system_by_name($skill_id)
	{
		$query = $this->db->query("SELECT * FROM sch_skill WHERE skill_id = '$skill_id'");

		$query = $query->row();

		return $query->SKILL_NAME;
	}

	function get_resource_type_by_name($resource_type_id)
	{
		$query = $this->db->query("SELECT * FROM sch_resource_type WHERE resource_type_id = '$resource_type_id'");

		$query = $query->row();

		return $query->TYPE_NAME;
	}

	function get_all_resource_by_resource_type($resource_type_id)
	{
		$query = $this->db->query("SELECT * FROM sch_resource WHERE resource_type_id = '$resource_type_id'");

		return $query->result();
	}

	function check_resource_resp($resource_id, $skill_id)
	{
		$query = $this->db->query("SELECT * FROM sch_resource_resp WHERE resource_id = '$resource_id' AND skill_id = '$skill_id'");

		return $query->num_rows();
	}

	function get_total_hrs_by_resource($resource_id)
	{
		$query = $this->db->query("SELECT * FROM sch_resource INNER JOIN sch_title ON sch_resource.title_id = sch_title.title_id WHERE sch_resource.resource_id = '$resource_id'");

		$query = $query->row();

		$time = $query->HR_WORK_WEEK;

		$time = (int) $time;

		return $time*52;
	}

	function get_total_time_by_system_and_resource_type($skill_id, $resource_type_id)
	{
		$resources = $this->get_all_resource_by_resource_type($resource_type_id);
		$total_time = 0;

		foreach($resources as $resource)
		{
			$query = $this->check_resource_resp($resource->RESOURCE_ID, $skill_id);

			if($query > 0)
			{
				$total_time = $total_time + $this->get_total_hrs_by_resource($resource->RESOURCE_ID);
			}
		}

		return $total_time;
	}

	function get_hrs_spent_by_resource($resource_id, $year)
	{
		$query = $this->db->query("SELECT SUM(allocated_duration) AS allocated_sum FROM sch_allocated_resource WHERE resource_id = '$resource_id' AND allocated_year = '$year'");

		$query = $query->row();

		return $query->ALLOCATED_SUM;
	}

	function time_spent_by_resource($resource_type_id, $skill_id, $year)
	{
		$resources = $this->get_all_resource_by_resource_type($resource_type_id);
		$time_spent = 0;

		foreach($resources as $resource)
		{
			$query = $this->check_resource_resp($resource->RESOURCE_ID, $skill_id);

			if($query > 0)
			{
				$time_spent = $time_spent + $this->get_hrs_spent_by_resource($resource->RESOURCE_ID, $year);
			}
		}

		return $time_spent;
	}


}