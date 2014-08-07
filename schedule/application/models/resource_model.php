<?php
class Resource_model extends CI_Model {

	//parent function that loads database
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function check_if_resource_exists($resource_name)
	{
		$query = $this->db->query("SELECT * FROM sch_resource WHERE resource_name = '$resource_name'");

		return $query->num_rows();
	}

	function insert_resource($resource_name, $resource_type, $resource_title)
	{
		$query = $this->check_if_resource_exists($resource_name);

		if($query > 0)
		{
			return 'exists';
		}
		else
		{
			$this->db->set('RESOURCE_TYPE_ID', $resource_type);
			$this->db->set('TITLE_ID', $resource_title);
			$this->db->set('RESOURCE_NAME', $resource_name);

			if($this->db->insert('SCH_RESOURCE') != TRUE)
			{
				return 'error';
			}
			else
			{
				return 'added';
			}
		}
	}

	function check_resource_type_exists($resource_type)
	{
		$query = $this->db->query("SELECT * FROM sch_resource_type WHERE type_name = '$resource_type'");

		return $query->num_rows();
	}


	function insert_resource_type($resource_type)
	{
		$query = $this->check_resource_type_exists($resource_type);

		if($query > 0)
		{
			return 'exists';
		}
		else
		{
			$this->db->set('TYPE_NAME', $resource_type);

			if($this->db->insert('SCH_RESOURCE_TYPE') != TRUE)
			{
				return 'error';
			}
			else
			{
				return 'added';
			}
		}
	}

	function get_all_resource_types()
	{
		$query = $this->db->query("SELECT * FROM sch_resource_type");

		return $query->result();
	}

	function check_title_exists($title)
	{
		$query = $this->db->query("SELECT * FROM sch_title WHERE title_name = '$title'");

		return $query->num_rows();
	}

	function insert_title($title, $hours)
	{
		$query = $this->check_title_exists($title);

		if($query > 0)
		{
			return 'exists';
		}
		else
		{
			$this->db->set('TITLE_NAME', $title);
			$this->db->set('HR_WORK_WEEK', $hours);

			if($this->db->insert('SCH_TITLE') != TRUE)
			{
				return 'error';
			}
			else
			{
				return 'added';
			}
		}
	}

	function get_all_titles()
	{
		$query = $this->db->query("SELECT * FROM sch_title");

		return $query->result();
	}

	function get_all_resources()
	{
		$query = $this->db->query("SELECT * FROM sch_resource");

		return $query->result();
	}


	function get_phases_by_year($year)
	{
		$query = $this->db->query("SELECT * FROM sch_project_phase WHERE phase_year = '$year'");

		return $query->result();
	}

	function get_resource_info($id)
	{
		$query = $this->db->query("SELECT * FROM sch_resource INNER JOIN sch_resource_type ON sch_resource.resource_type_id = sch_resource_type.resource_type_id WHERE sch_resource.resource_id = '$id'");

		return $query->row();
	}

	function get_all_needed_resource_type_id_within_phase($id, $phase_id)
	{
		$query = $this->db->query("SELECT * FROM sch_needed_resource_type WHERE project_phase_id = '$phase_id'");

		return $query->result();
	}

	function get_time_of_allocated_resource($id, $needed_resource_type_id)
	{
		$query = $this->db->query("SELECT * FROM sch_allocated_resource WHERE needed_resource_type_id = '$needed_resource_type_id' AND resource_id = '$id'");

		if($query->num_rows() > 0)
		{
			$query = $query->row();
			return $query->ALLOCATED_DURATION;
		}
		else
			return 0;
	}

	function get_time_for_resource($id, $phase_id)
	{
		$needed = $this->get_all_needed_resource_type_id_within_phase($id, $phase_id);

		$total_time = 0;

		foreach($needed as $need)
		{
			$total_time = $total_time + $this->get_time_of_allocated_resource($id, $need->NEEDED_RESOURCE_TYPE_ID);
		}

		return $total_time;
	}

	function get_availabel_time($id)
	{
		$query = $this->get_resource_info($id);

		$title_id = $query->TITLE_ID;

		$query = $this->db->query("SELECT * FROM sch_title WHERE title_id = '$title_id'");

		$query = $query->row();

		$time = $query->HR_WORK_WEEK;

		$time = $time * 52;

		return $time;
	}

	function get_all_projects_by_year($year)
	{
		$query = $this->db->query("SELECT * FROM sch_project WHERE project_year = '$year'");

		return $query->result();
	}

	function get_needed_resource_type($phase_id)
	{
		$query = $this->db->query("SELECT * FROM sch_needed_resource_type WHERE project_phase_id = '$phase_id'");

		return $query->result();
	}

	function get_all_available_resources($resource_type_id, $skill_id, $order)
	{
		$query = $this->db->query("SELECT sch_resource.resource_id FROM sch_resource INNER JOIN sch_resource_type ON 
		sch_resource.resource_type_id = sch_resource_type.resource_type_id INNER JOIN sch_resource_resp ON sch_resource_resp.RESOURCE_ID = sch_resource.resource_id WHERE 
		sch_resource.resource_type_id = '$resource_type_id' AND sch_resource_resp.skill_id = '$skill_id' AND sch_resource_resp.resp = '$order'");

		return $query->result();
	}

	function allocate_resource($resource_type_id, $skill_id, $duration, $year)
	{
		$order = 1;
		$resources = $this->get_all_available_resources($resource_type_id, $skill_id, $order);

		foreach ($variable as $key => $value) {
			# code...
		}

	}

}

?>