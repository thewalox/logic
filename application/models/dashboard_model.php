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
				WHERE estado_factura = '0'
				UNION ALL
				SELECT 'Pendientes' AS estado, COUNT(DISTINCT(docnum)) AS cantidad 
				FROM log_facturas_sap 
				WHERE estado_factura = 'P'";
		//echo $sql;		
		$res = $this->db->query($sql);
		return $res->result_array();
	}

}