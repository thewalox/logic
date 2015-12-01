<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportadores extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Transportadores_model");

		$this->load->library('form_validation');

	}

	function form_crear(){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

		    $this->load->view("header", $datos);
		    $this->load->view("transportadores/crear_transportadores", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function crear_transportador(){
		$datos["titulo"] = " .: Logic :.";

		$this->form_validation->set_rules('codigo', 'Codigo', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

		$this->form_validation->set_message('required','El campo %s es obligatorio');

	    if($this->form_validation->run()!=false){
			$datos["mensaje"] = $this->Transportadores_model->add_transportador($this->input->post("codigo"), $this->input->post("descripcion"));
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
			$config['base_url'] = base_url().'transportadores/form_buscar/';
			$config['total_rows'] = $this->Transportadores_model->get_total_transportadores();
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

			$datos["transportador"] = $this->Transportadores_model->get_transportadores($config['per_page'], $desde);

			$this->pagination->initialize($config);

		    $this->load->view("header", $datos);
		    $this->load->view("transportadores/buscar_transportador", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function form_editar($id){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

			$datos["transportador"] = $this->Transportadores_model->get_transportador_by_id($id);
			//print_r($datos);

		    $this->load->view("header", $datos);
		    $this->load->view("transportadores/editar_transportador", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function editar_transportador(){

		$this->form_validation->set_rules('codigo', 'Codigo', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

		$this->form_validation->set_message('required','El campo %s es obligatorio');

	    if($this->form_validation->run()!=false){
			$datos["mensaje"] = $this->Transportadores_model->edit_transportador($this->input->post("codigo"), $this->input->post("descripcion"));
		}else{
			$datos["mensaje"] = validation_errors(); //incorrecto
		}

		echo json_encode($datos);

		//$this->form_editar($this->input->post("id"));	
	    
	}

	function eliminar_transportador($id){
		
		$datos["mensaje"] = $this->Transportadores_model->elimina_transportador($id);
		redirect('transportadores/form_buscar');
	}

	function get_transportadores_criterio(){
		$datos = $this->Transportadores_model->get_transportadores_by_criterio($this->input->get("filtro"));
		echo json_encode($datos);
	}

}