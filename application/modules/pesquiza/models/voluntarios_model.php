<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of voluntarios_model
 *
 * @author dnl
 */
class Voluntarios_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('voluntarios');
  }
  function toDropDown() {
    $this->db->select('id');
    $this->db->select("CONCAT(apellido, ',', nombre) as nombre", FALSE);
    $this->db->from($this->getTable());
    $this->db->order_by('nombre');
    if($this->session->userdata('programa_id')>0){
      $this->db->where('programa_id', $this->session->userdata('programa_id'));
    };          
    $query = $this->db->get();
    $datos = array('NULL'=>'Sin Asignar');
    foreach($query->result() as $item){
            $datos[$item->id] = $item->nombre;
    }
    return $datos;
  }
}