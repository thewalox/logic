<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportadores_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function add_transportador($codigo, $descripcion){
		$sql = "INSERT INTO log_transportadores	(cod_transp, desc_transp, estado)
				VALUES (UPPER(". $this->db->escape($codigo) ."), UPPER(". $this->db->escape($descripcion) ."), 'A')";
		//echo $sql;
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function edit_transportador($codigo, $desc){
		$sql = "UPDATE log_transportadores SET desc_transp = UPPER(". $this->db->escape($desc) .")
				WHERE cod_transp = '$codigo'";
		//echo($sql);
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function elimina_transportador($codigo){
		$sql = "UPDATE log_transportadores SET estado = 'I'
				WHERE cod_transp = '$codigo'";
		//echo $sql;			
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function get_transportadores($limit, $segmento){
		$sql = "SELECT * FROM log_transportadores WHERE estado = 'A' ORDER BY desc_transp ";

		if($limit != 0){
			$sql .= "LIMIT ". $segmento ." , ". $limit;
		}

		//echo $sql;

		$res = $this->db->query($sql);
		return $res->result_array();
		
	}

	function get_total_transportadores(){
		$this->db->from('log_transportadores')->where('estado', 'A');
		return $this->db->count_all_results();
  	}

  	public function get_transportador_by_id($id){
		$sql = "SELECT * FROM log_transportadores where cod_transp = '$id' and estado = 'A'";
		//echo($sql);
		$res = $this->db->query($sql);
		return $res->row();
		
	}

	public function get_transportadores_by_criterio($filtro){
		$sql = "SELECT *
				FROM log_transportadores
				WHERE (cod_transp LIKE '%". $filtro ."%' 
				OR desc_transp like '%". $filtro ."%') 
				AND estado = 'A' 
				ORDER BY cod_transp";
				//echo($sql);
		$res = $this->db->query($sql);
		return $res->result_array();
		
	}

}