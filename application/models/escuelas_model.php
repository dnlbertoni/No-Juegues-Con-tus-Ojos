<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of escuelas_model
 *
 * @author dnl
 */
class escuelas_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('escuelas');
  }
  function searchFull($valor){
    $valor = trim($valor);
    $valores = explode(' ', $valor);
    $this->db->select('nombre as texto', false);
    $this->db->select($this->getPrimaryKey());
    $this->db->from($this->getTable());
    if($this->session->userdata('programa_id')>0){
      $this->db->where('programa_id', $this->session->userdata('programa_id'));
    };
    $this->db->like('nombre',$valor);
    $this->db->order_by('nombre');
    $q = $this->db->get();
    if($q->num_rows() > 1)
       return $q->result();
    else{
      if($q->num_rows() == 1){
        return $q->row();
      }  else {
        return false;
      }
    }
  }  
  function toDropDownEspecial($campoId, $campoNombre){
          $this->db->select($campoId);
          $this->db->select('CONCAT(nombre," - ",numero_estab)as nombre',false);
          $this->db->from($this->getTable());
          $this->db->order_by($campoNombre);
          if($this->session->userdata('programa_id')>0){
            $this->db->where('programa_id', $this->session->userdata('programa_id'));
          };          
          $query = $this->db->get();
          $datos = array();
          foreach($query->result() as $item){
                  $datos[$item->{$campoId}] = $item->{$campoNombre};
          }
          return $datos;
  }    
  function getNombres($valor){
    $this->db->select('id');
    $this->db->select('CONCAT( nombre, " - ", numero_estab) as escuela', false);
    $this->db->from($this->getTable());
    $this->db->like('nombre', $valor);
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->order_by('escuela');
    return $this->db->get()->result();
  }
}

