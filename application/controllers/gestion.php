<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Gestion_model");
		$this->load->model("Transportadores_model");
		$this->load->model("Servicios_model");

		$this->load->library('form_validation');

	}

	function form_importar(){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

		    $this->load->view("header", $datos);
		    $this->load->view("gestion/importar_facturas", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function importar_documentos(){
		//$datos["titulo"] = "Logistica Industrias Plasticas";

		$this->form_validation->set_rules('fecini', 'Fecha Inicial', 'required');
		$this->form_validation->set_rules('fecfin', 'Fecha Final', 'required');

		$this->form_validation->set_message('required','El campo %s es obligatorio');

	    if($this->form_validation->run()!=false){
	    	$this->Gestion_model->borrar_log_estado_importacion();

	    	$facturas = $this->Gestion_model->facturas_sap_by_fecha($this->input->post("fecini"), $this->input->post("fecfin"));

	    	foreach($facturas as $fac) {
	    		
				$this->Gestion_model->importar_documentos_sap($fac["DocDate"],$fac["DocNum"],$fac["LineNum"],'F',
                                $fac["CardCode"],$fac["CardName"],$fac["ItemCode"],$fac["Dscription"],
                                $fac["UM"],$fac["WhsCode"],$fac["Quantity"],$fac["Iva"],$fac["SubTotal"],
                                $fac["Total_neto"],$fac["City"],$fac["Nit"],$fac["Address2"],$fac["Total_linea"],
                                $fac["Total_Kilos"],$fac["U_NormaReparto"],$fac["SlpName"],$fac["Centro_Costo"],
                                $fac["U_cu_kls_emp"],$fac["U_cu_um_log"],$fac["U_cu_volumen_m3"]);
			}

			$entregas = $this->Gestion_model->entregas_sap_by_fecha($this->input->post("fecini"), $this->input->post("fecfin"));

			foreach($entregas as $ent) {
	    		
				$this->Gestion_model->importar_documentos_sap($ent["DocDate"],$ent["DocNum"],$ent["LineNum"],'E',
                                $ent["CardCode"],$ent["CardName"],$ent["ItemCode"],$ent["Dscription"],
                                $ent["UM"],$ent["WhsCode"],$ent["Quantity"],$ent["Iva"],$ent["SubTotal"],
                                $ent["Total_neto"],$ent["City"],$ent["Nit"],$ent["Address2"],$ent["Total_linea"],
                                $ent["Total_Kilos"],$ent["U_NormaReparto"],$ent["SlpName"],$ent["Centro_Costo"],
                                $ent["U_cu_kls_emp"],$ent["U_cu_um_log"],$ent["U_cu_volumen_m3"]);
			}

			$datos = $this->Gestion_model->get_resultado_importacion();
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
			$datos["transportadores"] = $this->Transportadores_model->get_transportadores(0, 0);
			$datos["servicios"] = $this->Servicios_model->get_servicios(0, 0);
			//print_r($_POST);
			/*Se personaliza la paginación para que se adapte a bootstrap*/
			$config['base_url'] = base_url().'gestion/form_buscar/';
			$config['total_rows'] = $this->Gestion_model->get_total_facturas();
			$config['per_page'] = 50;
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

			$datos["facturas"] = $this->Gestion_model->get_facturas_top200($config['per_page'], $desde);

			$this->pagination->initialize($config);

		    $this->load->view("header", $datos);

		    $datos["lote"] = $this->input->post("FacMasivas");
		    
		    if (isset($_POST["FacMasivas"])) {
		    	$this->load->view("gestion/editar_facturas_lote", $datos);
		    }else{
		    	$this->load->view("gestion/buscar_facturas", $datos);	
		    }

		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function form_editar($id){

		if (!$this->session->userdata('sess_id_user')) {
		   	redirect("login");
		}else{
			$datos["titulo"] = " .: Logic :.";

			$datos["transportadores"] = $this->Transportadores_model->get_transportadores(0, 0);
			$datos["servicios"] = $this->Servicios_model->get_servicios(0, 0);
			$datos["factura"] = $this->Gestion_model->get_factura_by_id($id);
			$datos["valida_flete"] = $this->Gestion_model->tiene_flete($id);
			//print_r($datos);

		    $this->load->view("header", $datos);
		    $this->load->view("gestion/editar_factura", $datos);
		    $this->load->view("footer", $datos);
		    $this->load->view("fin", $datos);
		}
		
	}

	function editar_factura(){
		$datos["mensaje"] = $this->Gestion_model->edit_factura($this->input->post("factura"), $this->input->post("transp"), $this->input->post("fecenvio"), $this->input->post("horaenvio"), $this->input->post("planilla"),$this->input->post("guia"), $this->input->post("placa"), $this->input->post("seguro"), $this->input->post("gastos"), $this->input->post("servicio"), $this->input->post("estadofac"),$this->input->post("obs"), $this->input->post("dev"), $this->input->post("recibido"), $this->input->post("fecrecibo"), $this->input->post("items"), $this->input->post("fletes"));
		echo json_encode($datos);
	}

	function eliminar_factura(){		
		//print_r($this->input->post("id"));
		$datos["mensaje"] = $this->Gestion_model->elimina_factura($this->input->post("id"));
		echo json_encode($datos);
	}

	function get_facturas_criterio(){
		$datos = $this->Gestion_model->get_facturas_by_criterio($this->input->get("filtro"));
		echo json_encode($datos);
	}

	
	function editar_facturas_lote(){
		
		$where = " WHERE empresa = '". $this->session->userdata('sess_empresa') ."' AND docnum IN (";
		$facturas = $this->input->post("lote");

		foreach ($facturas as $fac) {
			$where .= "'". $fac["value"] ."',";
		}

		$where = trim($where, ",");
		$where .= ")";

		//echo $where;

		$datos["mensaje"] = $this->Gestion_model->edit_facturas_lote($where, $this->input->post("transp"), $this->input->post("fecenvio"), $this->input->post("horaenvio"), $this->input->post("planilla"),$this->input->post("guia"), $this->input->post("placa"), $this->input->post("seguro"), $this->input->post("gastos"), $this->input->post("servicio"), $this->input->post("estadofac"),$this->input->post("obs"));
		echo json_encode($datos);
	}

	function calcular_fletes(){
		$datos = $this->Gestion_model->calcula_flete($this->input->get("id"));
		echo json_encode($datos);
	}

}