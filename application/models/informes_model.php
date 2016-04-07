<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informes_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();		
	}

	public function informe_aseguradora($fecini, $fecfin){
		$sql = "SELECT lt.desc_transp, lf.planilla, lf.placa, SUM(lf.cantidad_real) AS cantidad_real, 
				SUM(lf.cantidad_real * lf.kilos_emp) AS total_kilos, SUM(lf.subtotal) AS total_bruto
				FROM log_facturas_sap lf
				INNER JOIN log_transportadores lt ON lt.cod_transp = lf.transportador
				WHERE lf.empresa = '". $this->session->userdata('sess_empresa') ."'";

		if(! empty($fecini) and ! empty($fecfin)){
			$sql .= " AND docdate BETWEEN (". $this->db->escape($fecini) .") AND (". $this->db->escape($fecfin) .")";
		}

		$sql .= " GROUP BY lf.planilla, lt.desc_transp, lf.placa
				ORDER BY lt.desc_transp, lf.planilla";

		//echo $sql;
		$res = $this->db->query($sql);
		return $res->result_array();
		
	}

}