<?php
/**
 * Modelo para la administracion de la talba Voluntarios
 *
 * @author dnl
 */
class Voluntarios_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('voluntarios');
  }
  function searchApellido($valor){
    $valor = trim($valor);
    $this->db->select('CONCAT(apellido,", ",nombre) as texto', false);
    $this->db->select($this->getPrimaryKey());
    $this->db->from($this->getTable());
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->like('apellido', $valor);
    $this->db->order_by('apellido');
    return $this->db->get()->result();        
  }
  function searchnombre($valor){
    $valor = trim($valor);
    $this->db->select('CONCAT(apellido,", ",nombre) as texto', false);
    $this->db->select($this->getPrimaryKey());
    $this->db->from($this->getTable());
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->like('nombre', $valor);
    $this->db->order_by('texto');
    return $this->db->get()->result();        
  }
}