<?php
/**
 * Description of perfil_model
 *
 * @author dnl
 */
class Perfil_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('perfil');
  }
  function add($data, $field_control=FALSE) {
    if(is_array($data)) {
      if($field_control){
        $duplicado = $this->is_duplicate($field_control,$data[$field_control]);
        if($duplicado){
          $this->update($data,$data[$field_control]);
          return true;
        }else{
          $this->db->insert($this->getTable(), $data);
          return $this->db->insert_id();
        }
      }else{
        $this->db->insert($this->getTable(), $data);
        return $this->db->insert_id();
      }
    } else {
      log_message('error', 'No es una matriz');
      return FALSE;
    }
  }  
}
