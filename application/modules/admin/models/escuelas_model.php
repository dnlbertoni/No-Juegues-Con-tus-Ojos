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
  function getAllindex(){
    $this->db->select('escuelas.id as id');
    $this->db->select('escuelas.nombre');
    $this->db->select('numero_estab');
    $this->db->select('ciudades.nombre as ciudad');
    $this->db->from($this->getTable());
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'inner');
    $this->db->where('escuelas.programa_id', $this->session->userdata('programa_id'));
    return $this->db->get()->result();
  }
  function getEscuelasTransportes($transporte=1){
    //$this->db->distinct();
    $this->db->select('CONCAT(escuelas.nombre, " - ", ciudades.nombre) as nombre', false);
    $this->db->select('SUM(pesquizas.cant_prob) as cantidad', false);
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.escuela_id=escuelas.id', 'left');
    $this->db->join('ciudades', 'escuelas.ciudad_id=ciudades.id', 'left');
    $this->db->where('pesquizas.transporte',$transporte);
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->group_by('escuela_id');
    $this->db->order_by('cantidad', 'DESC');
    return $this->db->get()->result();
  }
}

