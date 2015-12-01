<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function add_servicio($codigo, $descripcion){
		$sql = "INSERT INTO log_tipo_servicios (cod_servicio, desc_servicio, estado)
				VALUES (UPPER(". $this->db->escape($codigo) ."), UPPER(". $this->db->escape($descripcion) ."), 'A')";
		//echo $sql;
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function edit_servicio($codigo, $desc){
		$sql = "UPDATE log_tipo_servicios SET desc_servicio = UPPER(". $this->db->escape($desc) .")
				WHERE cod_servicio = '$codigo'";
		//echo($sql);
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function elimina_servicio($codigo){
		$sql = "UPDATE log_tipo_servicios SET estado = 'I'
				WHERE cod_servicio = '$codigo'";
		//echo $sql;			
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function get_servicios($limit, $segmento){
		$sql = "SELECT * FROM log_tipo_servicios WHERE estado = 'A' ORDER BY cod_servicio ";

		if($limit != 0){
			$sql .= "LIMIT ". $segmento ." , ". $limit;
		}

		//echo $sql;

		$res = $this->db->query($sql);
		return $res->result_array();
		
	}

	function get_total_servicios(){
		$this->db->from('log_tipo_servicios')->where('estado', 'A');
		return $this->db->count_all_results();
  	}

  	public function get_servicio_by_id($id){
		$sql = "SELECT * FROM log_tipo_servicios where cod_servicio = '$id' and estado = 'A'";
		//echo($sql);
		$res = $this->db->query($sql);
		return $res->row();
		
	}

	public function get_servicios_by_criterio($filtro){
		$sql = "SELECT *
				FROM log_tipo_servicios
				WHERE (cod_servicio LIKE '%". $filtro ."%' 
				OR desc_servicio like '%". $filtro ."%') 
				AND estado = 'A' 
				ORDER BY cod_servicio";
				//echo($sql);
		$res = $this->db->query($sql);
		return $res->result_array();
		
	}

}