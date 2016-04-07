<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->model("Dashboard_model");
	}

	function index(){
		//print_r($this->session->all_userdata());
		
		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";
			$datos["trm"] = $this->Dashboard_model->trm();
			$datos["estado"] = $this->Dashboard_model->estado_facturas();

			$this->load->view("header", $datos);
			$this->load->view("dashboard", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
	}

}