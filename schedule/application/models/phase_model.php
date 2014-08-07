<?php
class Phase_model extends CI_Model {

	//parent function that loads database
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function check_if_phase_type_exists($phase_type)
	{
		$query = $this->db->query("SELECT * FROM sch_phase_type WHERE type_name = '$phase_type'");

		return $query->num_rows();
	}

	function insert_phase_type($phase_type)
	{
		$query = $this->check_if_phase_type_exists($phase_type);

		if($query > 0)
		{
			return 'exists';
		}
		else
		{
			$this->db->set('TYPE_NAME', $phase_type);
			
			if($this->db->insert('SCH_PHASE_TYPE') != TRUE)
			{
				return 'error';
			}
			else
			{
				return 'added';
			}
			
		}
	}

	function get_all_phase_types()
	{
		$query = $this->db->query("SELECT * FROM sch_phase_type");

		return $query->result();
	}

	function get_phase_id($project_id,$phase_type_id,$status)
	{
		$query = $this->db->query("SELECT * FROM sch_project_phase WHERE phase_type_id = '$phase_type_id' AND project_id = '$project_id' AND status = '$status'");

		$query = $query->row();

		return $query->PROJECT_PHASE_ID;
	}

	function insert_needed_resource_type($duration, $phase_id, $sys_id, $resource_type_id)
	{
		$this->db->set('RESOURCE_TYPE_ID', $resource_type_id);
		$this->db->set('PROJECT_PHASE_ID', $phase_id);
		$this->db->set('SKILL_ID', $sys_id);
		$this->db->set('PHASE_DURATION', $duration);

		if($this->db->insert('SCH_NEEDED_RESOURCE_TYPE') != TRUE)
		{
			return 'error';
		}
		else
		{
			return 'added';
		}

	}

	function insert_phase($project_id, $phase_type_id, $project_year)
	{
		$this->db->set('PROJECT_ID', $project_id);
		$this->db->set('PHASE_TYPE_ID', $phase_type_id);
		$this->db->set('PHASE_YEAR', $project_year);
		$this->db->set('STATUS', 'initial');

		if($this->db->insert('SCH_PROJECT_PHASE') != TRUE)
		{
			return 'error';
		}
		else
		{
			$phase_id = $this->get_phase_id($project_id,$phase_type_id,'initial');
			
			return $phase_id;
		}
	}

	function get_phase_by_id($phase_id)
	{
		$query = $this->db->query("SELECT * FROM sch_project_phase WHERE project_phase_id = '$phase_id'");

		return $query->row();
	}

	function get_systems_in_project($project_id)
	{
		$query = $this->db->query("SELECT skill_name, sch_skill.skill_id FROM sch_project_skill JOIN sch_skill ON sch_skill.skill_id = sch_project_skill.skill_id WHERE sch_project_skill.project_id = '$project_id'");

		return $query->result();
	}

	function get_project_duration($project_id)
	{
		$query = $this->db->query("SELECT * FROM sch_project_duration WHERE project_id = '$project_id'");

		return $query->result();
	}

	function get_project_year($project_id)
	{
		$query = $this->db->query("SELECT * FROM sch_project WHERE project_id = '$project_id'");

		$query = $query->row();

		return $query->PROJECT_YEAR;
	}
}