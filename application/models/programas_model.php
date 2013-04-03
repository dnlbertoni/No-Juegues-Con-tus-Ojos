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
}