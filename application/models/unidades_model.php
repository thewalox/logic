<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidades_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_unidades_medida(){
		$sql = "SELECT * FROM log_unidades WHERE estado = 'A'";
		$res = $this->db->query($sql);
		return $res->result_array();
		
	}

}