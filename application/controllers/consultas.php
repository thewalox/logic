<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();

	}

	function form_consulta_factura(){
		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

		    $this->load->view("header", $datos);
		    $this->load->view("consultas/filtrar_facturas", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
	}

}