<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifas_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function add_tarifa($tarifa, $trans, $destino, $um, $valor){
		$sql = "INSERT INTO log_tarifas	(cod_tarifa, cod_transp, destino, und_transp, valor, estado)
				VALUES (UPPER('$tarifa'), '$trans', UPPER('$destino'), $um, $valor, 'A');";
		//echo $sql;
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function edit_tarifa($tarifa, $transp, $destino, $um, $valor){
		$sql = "UPDATE log_tarifas SET cod_transp = ". $this->db->escape($transp) .
				", destino = UPPER(". $this->db->escape($destino) ."), und_transp = ". $this->db->escape($um) .
				", valor = ". $this->db->escape($valor) . 
				" WHERE cod_tarifa = '$tarifa'";
		//echo($sql);
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function elimina_tarifa($tarifa){
		$sql = "UPDATE log_tarifas SET estado = 'I'
				WHERE cod_tarifa = '$tarifa'";
		//echo $sql;			
		if ($this->db->simple_query($sql)){
        	$mensaje =  2; //Exito
		}else{
        	$mensaje = 3; //Error
		}

		return $mensaje;
		
	}

	public function get_tarifas($limit, $segmento){
		$sql = "SELECT lt.cod_tarifa, t.desc_transp, lt.destino, lu.desc_unidad, lt.valor
				FROM log_tarifas AS lt
				LEFT JOIN log_transportadores AS t ON t.cod_transp = lt.cod_transp
				INNER JOIN log_unidades AS lu ON lu.cod_unidad = lt.und_transp
				WHERE lt.estado = 'A'
				ORDER BY cod_tarifa LIMIT $segmento , $limit";
				//echo($sql);
		$res = $this->db->query($sql);
		return $res->result_array();
		
	}

	function get_total_tarifas(){
		$this->db->from('log_tarifas')->where('estado', 'A');
		return $this->db->count_all_results();
  	}

  	public function get_tarifa_by_id($id){
  		//reemplazo %20 de la url por espacios en blanco y luego codifico la cadena
  		$codigo = str_replace("%20"," ", $id);
  		$codigo = urldecode($codigo);

		$sql = "select * from log_tarifas where cod_tarifa = '$codigo' and estado = 'A'";
		//echo($sql);
		$res = $this->db->query($sql);
		return $res->row();
		
	}

	public function get_tarifas_by_criterio($filtro){
		$sql = "SELECT lt.cod_tarifa, t.desc_transp, lt.destino, lu.desc_unidad
				FROM log_tarifas AS lt
				LEFT JOIN log_transportadores AS t ON t.cod_transp = lt.cod_transp
				INNER JOIN log_unidades AS lu ON lu.cod_unidad = lt.und_transp
				WHERE (cod_tarifa LIKE '%".$filtro."%' OR t.desc_transp like '%".$filtro."%' OR lt.destino like '%".$filtro."%') 
				AND lt.estado = 'A' 
				ORDER BY lt.cod_tarifa";
				//echo($sql);
		$res = $this->db->query($sql);
		return $res->result_array();
		
	}

}