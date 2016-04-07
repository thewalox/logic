<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informes extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model("Informes_model");
		
	}

	function form_informe_aseguradora(){
		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

		    $this->load->view("header", $datos);
		    $this->load->view("informes/informe_aseguradora", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
	}

	function generar_informe_aseguradora(){
		$datos = $this->Informes_model->informe_aseguradora($this->input->post("fecini"), $this->input->post("fecfin"));
		echo json_encode($datos);
	}

}