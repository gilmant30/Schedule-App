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

	function insert_phase($project_id, $phase_type, $start, $end)
	{
		$this->db->set('PROJECT_ID', $project_id);
		$this->db->set('PHASE_TYPE_ID', $phase_type);
		$this->db->set('PHASE_START', $start);
		$this->db->set('PHASE_END', $end);
		$this->db->set('STATUS', 'start');

		if($this->db->insert('SCH_PROJECT_PHASE') != TRUE)
		{
			return 'error';
		}
		else
		{
			return 'added';
		}
	}

	function get_phase_by_id($phase_id)
	{
		$query = $this->db->query("SELECT * FROM sch_project_phase WHERE project_phase_id = '$phase_id'");

		return $query->row();
	}
}