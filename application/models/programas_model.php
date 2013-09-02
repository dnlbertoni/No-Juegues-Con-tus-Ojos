<?php
/**
 * Description of programas_model
 *
 * @author dnl
 */
class Programas_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('programas');
  }
  function getActivos(){
    $this->db->select('programas.id as id');
    $this->db->select('programas.nombre as nombre');
    $this->db->select('programas.ciudad_id as city');
    $this->db->select('ciudades.nombre as ciudadNombre');
    $this->db->from($this->getTable());
    $this->db->join('ciudades', 'ciudades.id=ciudad_id', 'inner');
    $this->db->where('estado',1);
    return $this->db->get()->result();
  }
  function getFinalizados(){
    $this->db->select('programas.id as id');
    $this->db->select('programas.nombre as nombre');
    $this->db->select('programas.ciudad_id as city');
    $this->db->select('ciudades.nombre as ciudadNombre');
    $this->db->from($this->getTable());
    $this->db->join('ciudades', 'ciudades.id=ciudad_id', 'inner');
    $this->db->where('estado',0);
    return $this->db->get()->result();
  }
  function getOnline(){
    $this->db->select('programas.id as id');
    $this->db->select('programas.nombre as nombre');
    $this->db->select('programas.ciudad_id as city');
    $this->db->select('programas.clubrotario as club');
    $this->db->select('ciudades.nombre as ciudadNombre');
    $this->db->from($this->getTable());
    $this->db->join('ciudades', 'ciudades.id=ciudad_id', 'inner');
    $this->db->where('programas.id',$this->session->userdata('programa_id'));
    return $this->db->get()->row();
  }
  function getFechasDiag(){
    $this->db->select('programas.id as id');
    $this->db->select('programas.nombre as nombre');
    $this->db->select('programas.fecini_diag as inicio');
    $this->db->select('programas.fecfin_diag as final');
    $this->db->from($this->getTable());
    $this->db->join('ciudades', 'ciudades.id=ciudad_id', 'inner');
    $this->db->where('programas.id',$this->session->userdata('programa_id'));
    return $this->db->get()->row();
  }
  function toDropDown($campoId, $campoNombre){
    $this->db->select($campoId);
    $this->db->select($campoNombre);
    $this->db->from($this->getTable());
    $this->db->order_by($campoNombre);        
    $query = $this->db->get();
    $datos = array();
    foreach($query->result() as $item){
      $datos[$item->{$campoId}] = $item->{$campoNombre};
    }
    return $datos;
  }
  function getDisponibles($user=false){
    if($user){
      $consulta = sprintf(" SELECT  programas.id      as id,
                                    programas.nombre  as nombre,
                                    ciudades.nombre   as ciudad
                            FROM programas 
                            INNER JOIN ciudades ON ciudades.id=programas.ciudad_id 
                            WHERE NOT EXISTS (  SELECT DISTINCT programa_id
                                                FROM user_modulos 
                                                WHERE programa_id=programas.id and user_id = %s 
                                              )",$user);
     return  $this->db->query($consulta)->result();
    }else{
      $this->db->select('programas.id as id');
      $this->db->select('programas.nombre as nombre');
      $this->db->select('programas.ciudad_id as city');
      $this->db->select('ciudades.nombre as ciudadNombre');
      $this->db->from($this->getTable());
      $this->db->join('ciudades', 'ciudades.id=ciudad_id', 'inner');
      $this->db->where('estado',1);
      return $this->db->get()->result();
    }
  }  
}