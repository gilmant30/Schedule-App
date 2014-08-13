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

	function get_resource_resp($id)
	{
		$query = $this->db->query("SELECT * FROM sch_resource_resp WHERE resource_id = '$id'");

		return $query->result();
	}

	function check_if_priority_exists($resource_id, $skill_id)
	{
		$query = $this->db->query("SELECT * FROM sch_resource_resp WHERE resource_id = '$resource_id' AND skill_id = '$skill_id'");

		return $query->num_rows();
	}

	function delete_priority($resource_id, $skill_id)
	{
		$this->db->query("DELETE FROM sch_resource_resp WHERE resource_id = '$resource_id' AND skill_id = '$skill_id'");

		$query = $this->check_if_priority_exists($resource_id, $skill_id);

		return $query;
	}

	function insert_priority($resource_id, $skill_id, $priority)
	{
		$this->db->set('RESOURCE_ID', $resource_id);
		$this->db->set('SKILL_ID', $skill_id);
		$this->db->set('RESP', $priority);

		if($this->db->insert('SCH_RESOURCE_RESP') != TRUE)
		{
			return 'error';
		}
		else
		{
			return 'added';
		}
	}

	function check_if_priority_matches($resource_id, $skill_id, $priority)
	{
		$query = $this->db->query("SELECT * FROM sch_resource_resp WHERE resource_id = '$resource_id' AND skill_id = '$skill_id' AND resp = '$priority'");

		return $query->num_rows();
	}

	function update_priority($resource_id, $skill_id, $priority)
	{
		if($priority == 0)
		{
			$query = $this->check_if_priority_exists($resource_id, $skill_id);

			if($query != 0)
			{
				$delete = $this->delete_priority($resource_id, $skill_id);

				if($delete != 0)
				{
					return 'error';
				}
			}
		}
		else
		{
			$query = $this->check_if_priority_exists($resource_id, $skill_id);

			if($query == 0)
			{
				$query = $this->insert_priority($resource_id, $skill_id, $priority);

				return $query;
			}
			else
			{
				$this->db->query("UPDATE sch_resource_resp SET RESP = '$priority' WHERE resource_id = '$resource_id' AND skill_id = '$skill_id'");

				$query = $this->check_if_priority_matches($resource_id, $skill_id, $priority);

				if($query == 1)
				{
					return 'updated';
				}
				else
				{
					return 'error';
				}
			}
		}
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
		$query = $this->db->query("SELECT SUM(allocated_duration) AS allocated_duration FROM sch_allocated_resource WHERE needed_resource_type_id = '$needed_resource_type_id' AND resource_id = '$id'");

		if($query->num_rows() > 0)
		{
			$query = $query->row();
			return $query->ALLOCATED_DURATION;
		}
		else
			return 0;
	}

	function get_phases_by_year($year)
	{
		$query = $this->db->query("SELECT * FROM sch_project_phase WHERE phase_year = '$year'");

		return $query->result();
	}

	function get_time_for_resource($id, $year)
	{
		$time = 0;
		$phases = $this->get_phases_by_year($year);

		foreach ($phases as $phase) {
			$needed_resource = $this->get_all_needed_resource_type_id_within_phase($id, $phase->PROJECT_PHASE_ID);
			foreach ($needed_resource as $needed) {
				$time = $time + $this->get_time_of_allocated_resource($id, $needed->NEEDED_RESOURCE_TYPE_ID);
			}
		}

		return $time;
	}

	function get_available_time($id)
	{
		$query = $this->get_resource_info($id);

		$title_id = $query->TITLE_ID;

		$query = $this->db->query("SELECT * FROM sch_title WHERE title_id = '$title_id'");

		$query = $query->row();

		$time = $query->HR_WORK_WEEK;

		$time = $time * 52;

		return $time;
	}

	function delete_allocated_resources()
	{
		$query = $this->db->query("DELETE FROM sch_allocated_resource");
	}

	function get_all_projects_by_year($year)
	{
		$query = $this->db->query("SELECT * FROM sch_project_order INNER JOIN sch_project ON sch_project_order.project_id = sch_project.project_id WHERE project_year = '$year' ORDER BY project_ord");

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

	function insert_allocated_resource($needed_resource_type_id, $resource_id, $time, $year)
	{
		$this->db->set('NEEDED_RESOURCE_TYPE_ID', $needed_resource_type_id);
		$this->db->set('RESOURCE_ID', $resource_id);
		$this->db->set('ALLOCATED_DURATION', $time);
		$this->db->set('STAGE', 'Planning');
		$this->db->set('ALLOCATED_YEAR', $year);

		if($this->db->insert('SCH_ALLOCATED_RESOURCE') != TRUE)
		{
			return 'error';
		}
		else
		{
			return 'added';
		}
	}

	function allocate_resource($resource_type_id, $skill_id, $duration, $year, $needed_resource_type_id, $order, $time_per_resource)
	{
		$resources = $this->get_all_available_resources($resource_type_id, $skill_id, $order, $needed_resource_type_id);

		foreach ($resources as $resource) {
				if($duration > 0)
				{
					$query = $this->insert_allocated_resource($needed_resource_type_id, $resource->RESOURCE_ID, $time_per_resource, $year);
					
					if($query == 'error')
					{
						return $query;
					}

					$duration = $duration - $time_per_resource;
				}	
		}

		return $duration;

	}

	function get_all_resources_by_type($resource_type_id)
	{
		$query = $this->db->query("SELECT * FROM sch_resource WHERE resource_type_id = '$resource_type_id'");

		return $query->result();
	}

	function get_allocated_time_by_system($resource_id, $skill_id, $year)
	{
		$query = $this->db->query("SELECT SUM(sch_allocated_resource.allocated_duration) AS allocated_sum FROM sch_allocated_resource INNER JOIN sch_needed_resource_type ON
		sch_allocated_resource.needed_resource_type_id = sch_needed_resource_type.needed_resource_type_id WHERE sch_allocated_resource.resource_id = '$resource_id' 
		AND sch_needed_resource_type.skill_id = '$skill_id' AND sch_allocated_resource.allocated_year = '$year'");

		$query = $query->row();

		return $query->ALLOCATED_SUM;
	}

	function get_all_resource_resp()
	{
		$query = $this->db->query("SELECT * FROM sch_resource_resp");

		return $query->result();
	}

}

?>