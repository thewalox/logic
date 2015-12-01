<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifas extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Tarifas_model");
		$this->load->model("Transportadores_model");
		$this->load->model("Unidades_model");

		$this->load->library('form_validation');

	}

	public function form_crear(){
		
		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

		    $datos["transportadores"] = $this->Transportadores_model->get_transportadores(0, 0);
		    $datos["unidades"] = $this->Unidades_model->get_unidades_medida();

			$this->load->view("header", $datos);
		    $this->load->view("tarifas/crear_tarifas", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
	    
	}

	public function crear_tarifa(){
		$datos["titulo"] = " .: Logic :.";

		$this->form_validation->set_rules('codigo', 'Codigo', 'required');
		$this->form_validation->set_rules('destino', 'Destino', 'required');
		$this->form_validation->set_rules('valor', 'Valor', 'required');

		$this->form_validation->set_rules('transportador', 'Transportador', 'required|callback_check_default');
		$this->form_validation->set_rules('um', 'Unidad de Medida', 'required|callback_check_default');

		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('check_default','Seleccione un valor para el campo %s');

	    if($this->form_validation->run()!=false){
			$datos["mensaje"] = $this->Tarifas_model->add_tarifa($this->input->post("codigo"), $this->input->post("transportador"), $this->input->post("destino"), $this->input->post("um"), $this->input->post("valor"));
		}else{
			$datos["mensaje"] = validation_errors(); //incorrecto
		}

		echo json_encode($datos);
		
	}

	public function form_buscar(){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$this->load->library('pagination');

			/*Se personaliza la paginación para que se adapte a bootstrap*/
			$config['base_url'] = base_url().'tarifas/form_buscar/';
			$config['total_rows'] = $this->Tarifas_model->get_total_tarifas();
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

			$datos["tarifas"] = $this->Tarifas_model->get_tarifas($config['per_page'], $desde);

			$this->pagination->initialize($config);

		    $this->load->view("header", $datos);
		    $this->load->view("tarifas/buscar_tarifa", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	public function form_editar($id){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

			$datos["transportadores"] = $this->Transportadores_model->get_transportadores(0, 0);
		    $datos["unidades"] = $this->Unidades_model->get_unidades_medida();
			$datos["tarifa"] = $this->Tarifas_model->get_tarifa_by_id($id);
			//print_r($datos);

		    $this->load->view("header", $datos);
		    $this->load->view("tarifas/editar_tarifa", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	public function editar_tarifa(){

			$this->form_validation->set_rules('destino', 'Destino', 'required');
			$this->form_validation->set_rules('valor', 'Valor', 'required');

			$this->form_validation->set_rules('transportador', 'Transportador', 'required|callback_check_default');
			$this->form_validation->set_rules('um', 'Unidad de Medida', 'required|callback_check_default');

			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('check_default','Seleccione un valor para el campo %s');

	        if($this->form_validation->run()!=false){
				$datos["mensaje"] = $this->Tarifas_model->edit_tarifa($this->input->post("id"), $this->input->post("transportador"), $this->input->post("destino"), $this->input->post("um"), $this->input->post("valor"));
			}else{
				$datos["mensaje"] = validation_errors(); //incorrecto
			}

			echo json_encode($datos);

			//$this->form_editar($this->input->post("id"));	
	    
	}

	public function eliminar_tarifa($id){
				
		$datos["mensaje"] = $this->Tarifas_model->elimina_tarifa($id);
		redirect('tarifas/form_buscar');
	}

	public function get_tarifas_criterio(){
		$datos = $this->Tarifas_model->get_tarifas_by_criterio($this->input->get("filtro"));
		echo json_encode($datos);
	}

	public function form_importar_lote(){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{

			$datos["titulo"] = " .: Logic :.";
			
		    $this->load->view("header", $datos);
		    $this->load->view("tarifas/importar_tarifas_lote", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	public function importar(){
		$config["upload_path"] = realpath(APPPATH."../assets/files");
		$config["allowed_types"] = "xlsx";
		$config["max_size"] = "0";

		$this->load->library("upload", $config);

		if (!$this->upload->do_upload('file')) {
			
			$datos["tipo"] = 0; //0 = error, 1= success
			$datos["errores"] = $this->upload->display_errors();

			echo json_encode($datos);
		}else{
			$data = array("upload_data" => $this->upload->data());

			$this->load->library("PHPExcel");

			$objPHPExcel = PHPExcel_IOFactory::load(APPPATH."../assets/files/".$data['upload_data']['file_name']);

			unlink($config["upload_path"].'/'.$data['upload_data']['file_name']);

			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

			//print_r($cell_collection);
			$header = array();
			$array_data = array();

			foreach ($cell_collection as $cell) {
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn(); //obtenemos las columnas
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow(); //obtenemos el numero de filas

				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

				if($row == 1){
					$header[$row][$column] = $data_value;
				}else{
					$array_data[$row][$column] = $data_value;
				}
			}
			//print_r($array_data);
			//$datos["header"] = $header;
			//$datos["values"] = $array_data;
			$cont_add = 0;
			$cont_edit = 0;

			foreach ($array_data as $data) {

				$tarifa = $this->Tarifas_model->get_tarifa_by_id($data["A"]);

				if ($tarifa) {
					$this->Tarifas_model->edit_tarifa($data["A"], $data["B"], $data["C"], $data["D"], $data["E"]);	
					$cont_edit = $cont_edit + 1;
				}else{
					$this->Tarifas_model->add_tarifa($data["A"], $data["B"], $data["C"], $data["D"], $data["E"]);
					$cont_add = $cont_add + 1;	
				}

				
			}

			$datos["add"] = $cont_add;
			$datos["edit"] = $cont_edit;
			
			$datos["tipo"] = 1; //0 = error, 1= success

			echo json_encode($datos);

		}

	}

	function check_default($valor_post){
		if($valor_post == '0'){ 
      		return FALSE;
    	}else{
  			return TRUE;
  		}
	}

}