<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();		
	}

	public function filtra_facturas($estado, $tipodoc, $fecini, $fecfin, $fecenvio, $transp, $planilla){
		$sql = "SELECT lf.docdate, lf.docnum, lf.cardname, lf.itemcode, lf.itemdesc, lf.cantidad_real, lf.um, 
				lf.subtotal, lf.city, lf.slpname, IFNULL(lf.fecha_envio, '') AS fecha_envio, 
				IFNULL(lt.desc_transp, '') AS desc_transp, IFNULL(lf.fecha_recibido, '') AS fecha_recibido, 
				IFNULL(lf.placa, '') as placa, lf.valor_flete, 
				IFNULL(DATEDIFF(lf.fecha_envio, lf.docdate), '') AS ind_despacho, 
				IFNULL(DATEDIFF(lf.fecha_recibido, lf.fecha_envio), '') AS ind_entrega,
				CASE 
				lf.estado_factura 
				WHEN '0' THEN 'Por Despachar'
				WHEN 'P' THEN 'Pendiente'
				WHEN 'OK' THEN 'Ok'
				END AS estado_factura 
				FROM log_facturas_sap lf
				LEFT JOIN log_transportadores lt ON lt.cod_transp = lf.transportador
				WHERE lf.empresa = '". $this->session->userdata('sess_empresa') ."'";
				

		if($estado != "ALL"){
			$sql .= " AND lf.estado_factura = ". $this->db->escape($estado);
		}

		if($tipodoc != "0"){
			$sql .= " AND lf.tipodoc = ". $this->db->escape($tipodoc);
		}

		if(! empty($fecini) and ! empty($fecfin)){
			$sql .= " AND lf.docdate BETWEEN (". $this->db->escape($fecini) .") AND (". $this->db->escape($fecfin) .")";
		}

		if(! empty($fecenvio)){
			$sql .= " AND lf.fecha_envio = ". $this->db->escape($fecenvio);
		}

		if($transp != "0"){
			$sql .= " AND lf.transportador = ". $this->db->escape($transp);
		}

		if(! empty($planilla)){
			$sql .= " AND lf.planilla = ". $this->db->escape($planilla);
		}

		$sql .= " ORDER BY lf.docnum DESC, lf.itemcode";

		//echo $sql;
		$res = $this->db->query($sql);
		return $res->result_array();
		
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