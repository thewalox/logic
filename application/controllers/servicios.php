<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Servicios_model");

		$this->load->library('form_validation');

	}

	function form_crear(){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

		    $this->load->view("header", $datos);
		    $this->load->view("servicios/crear_servicios", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function crear_servicio(){
		$datos["titulo"] = " .: Logic :.";

		$this->form_validation->set_rules('codigo', 'Codigo', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

		$this->form_validation->set_message('required','El campo %s es obligatorio');

	    if($this->form_validation->run()!=false){
			$datos["mensaje"] = $this->Servicios_model->add_servicio($this->input->post("codigo"), $this->input->post("descripcion"));
		}else{
			$datos["mensaje"] = validation_errors(); //incorrecto
		}

		echo json_encode($datos);
		
	}

	function form_buscar(){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$this->load->library('pagination');

			/*Se personaliza la paginación para que se adapte a bootstrap*/
			$config['base_url'] = base_url().'servicios/form_buscar/';
			$config['total_rows'] = $this->Servicios_model->get_total_servicios();
			$config['per_page'] = 10;
			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		    $config['cur_tag_open'] = '<li class="active"><a href="#">';
		    $config['cur_tag_close'] = '</a></li>';
		    $config['num_tag_open'] = '<li>';
		    $config['num_tag_close'] = '</li>';
		    $config['last_link'] = FALSE;
		    $config['first_link'] = FALSE;
		    $config['next_link'] = '&raquo;';
		    $config['next_tag_open'] = '<li>';
		    $config['next_tag_close'] = '</li>';
		    $config['prev_link'] = '&laquo;';
		    $config['prev_tag_open'] = '<li>';
		    $config['prev_tag_close'] = '</li>';

			$datos["titulo"] = " .: Logic :.";

			$datos["servicio"] = $this->Servicios_model->get_servicios($config['per_page'], $desde);

			$this->pagination->initialize($config);

		    $this->load->view("header", $datos);
		    $this->load->view("servicios/buscar_servicio", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function form_editar($id){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

			$datos["servicio"] = $this->Servicios_model->get_servicio_by_id($id);
			//print_r($datos);

		    $this->load->view("header", $datos);
		    $this->load->view("servicios/editar_servicio", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function editar_servicio(){

		$this->form_validation->set_rules('codigo', 'Codigo', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

		$this->form_validation->set_message('required','El campo %s es obligatorio');

	    if($this->form_validation->run()!=false){
			$datos["mensaje"] = $this->Servicios_model->edit_servicio($this->input->post("codigo"), $this->input->post("descripcion"));
		}else{
			$datos["mensaje"] = validation_errors(); //incorrecto
		}

		echo json_encode($datos);

		//$this->form_editar($this->input->post("id"));	
	    
	}

	function eliminar_servicio($id){
		
		$datos["mensaje"] = $this->Servicios_model->elimina_servicio($id);
		redirect('servicios/form_buscar');
	}

	function get_servicios_criterio(){
		$datos = $this->Servicios_model->get_servicios_by_criterio($this->input->get("filtro"));
		echo json_encode($datos);
	}

}