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
    $this->db->where('programa_id', $this->session->userdata('programa_id'));    
    return $this->db->get()->result();
  }
  function createPermiso($user_id, $modulo_id, $programa_id){
    $this->db->set('user_id', $user_id);
    $this->db->set('modulo_id', $modulo_id);
    $this->db->set('permiso', 1);
    $this->db->set('programa_id',$programa_id);
    $this->db->insert('user_modulos');
    return $this->db->insert_id();
  }
  function toDropDownUsuario($campoId, $campoNombre, $user, $propio=true){
    $this->db->select('modulos.id as id');
    $this->db->select($campoNombre);
    $this->db->from($this->getTable());
    $this->db->join('modulos','modulos.id=user_modulos.modulo_id','inner');
    if($propio){
      $this->db->where('user_id', $user);      
    }else{
      $this->db->where('user_id <>', $user, false);            
    }
    $this->db->order_by($campoNombre);        
    $query = $this->db->get();
    $datos = array();
    foreach($query->result() as $item){
      $datos[$item->{$campoId}] = $item->{$campoNombre};
    }
    return $datos;
  }
}
