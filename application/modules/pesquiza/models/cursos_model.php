<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cursos_model
 *
 * @author dnl
 */
class Cursos_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('cursos');
  }
  function getAll($orden=FALSE, $limite=FALSE){
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id = cursos.escuela_id', 'inner');
    if($orden)
      $this->db->order_by($orden);
    if($limite)
      $this->db->limit ($limite);
    return $this->db->get()->result();
  }
}
