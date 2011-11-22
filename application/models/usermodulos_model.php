<?php
/**
 * Description of usermodulos_model
 *
 * @author dnl
 */
class UserModulos_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('user_modulos');
  }
  function getModulosFromUsers($id){
    $this->db->from($this->getTable());
    $this->db->join('modulos', 'modulos.id=modulo_id', 'inner');
    $this->db->where('user_id', $id);
    $this->db->where('permiso', 1);
    return $this->db->get()->result();
  }
}
