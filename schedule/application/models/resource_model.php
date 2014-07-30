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

}

?>