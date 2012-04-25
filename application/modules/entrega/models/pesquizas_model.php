<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pesquizas_model
 *
 * @author dnl
 */
class Pesquizas_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('pesquizas');
  }
  function escuelaToDropDown(){
    $this->db->distinct();
    $this->db->select('escuela_id as Id');
    $this->db->select('escuelas.nombre as Nombre');
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=escuela_id','inner');
    $query = $this->db->get();
    $datos = array();
    foreach($query->result() as $item){
            $datos[$item->Id] = $item->Nombre;
    }
    return $datos;
  }
}
