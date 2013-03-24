<?php
/**
 * Description of modulos_model
 *
 * @author dnl
 */
class Modulos_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('modulos');
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
