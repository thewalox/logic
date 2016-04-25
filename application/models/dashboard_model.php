<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	var $mssql;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('sess_empresa') == "PJ") {
			$this->mssql = $this->load->database('mssql_pj', TRUE );
		}else{
			$this->mssql = $this->load->database('mssql_ipc', TRUE );
		}
	}

	public function trm(){
		$sql = "SELECT * FROM ORTT o WHERE o.RateDate = CONVERT(DATE, GETDATE(), 20)";
		//echo $sql;		
		$res = $this->mssql->query($sql);
		return $res->result_array();
	}

	public function estado_facturas(){
		$sql = "SELECT 'Por Despachar' AS estado, COUNT(DISTINCT(docnum)) AS cantidad 
				FROM log_facturas_sap 
				WHERE estado_factura = '0' AND empresa = '". $this->session->userdata('sess_empresa') ."'
				UNION ALL
				SELECT 'Pendientes' AS estado, COUNT(DISTINCT(docnum)) AS cantidad 
				FROM log_facturas_sap 
				WHERE estado_factura = 'P' AND empresa = '". $this->session->userdata('sess_empresa') ."'";
		//echo $sql;		
		$res = $this->db->query($sql);
		return $res->result_array();
	}

	public function resumen_mes(){
		$sql = "SELECT DATE_FORMAT(NOW(),'%Y-%m') AS periodo, COUNT(DISTINCT(docnum)) AS total_doc, 
				SUM(cantidad_real) AS total_unid, SUM(total_line) AS total_fact, SUM(valor_flete) AS total_flete
				FROM log_facturas_sap
				WHERE docdate BETWEEN (CONCAT(DATE_FORMAT(NOW(),'%Y-%m-'),'01')) AND (LAST_DAY(NOW()))
				AND transportador != '0' AND empresa = '". $this->session->userdata('sess_empresa') ."'";
		//echo $sql;		
		$res = $this->db->query($sql);
		return $res->row();
	}

	public function total_facturas_mes(){
		$sql = "SELECT COUNT(DISTINCT(docnum)) as total
				FROM log_facturas_sap
				WHERE docdate BETWEEN (CONCAT(DATE_FORMAT(NOW(),'%Y-%m-'),'01')) AND (LAST_DAY(NOW()))
				AND tipo_servicio != 1 AND empresa = '". $this->session->userdata('sess_empresa') ."'";
		//echo $sql;		
		$res = $this->db->query($sql);
		return $res->row();
	}

}