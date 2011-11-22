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
}