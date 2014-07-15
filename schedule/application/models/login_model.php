<?php
class Login_model extends CI_Model {
	

	//parent function that loads database
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function validate_login($email,$password)
	{
		$query = $this->db->query("SELECT * FROM user_table WHERE email = '$email' AND user_password = '$password'");

		if($query->num_rows() == 1)
		{
			return TRUE;
		}
		else
			return FALSE;
	}

}