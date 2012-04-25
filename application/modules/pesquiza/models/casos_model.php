<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of casos_model
 *
 * @author dnl
 */
class Casos_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('casos');
  }
  function getDerivadosPesquiza($idPes) {
    $this->db->select('casos.id                 as id');
    $this->db->select('casos.apellido           as apellido');
    $this->db->select('casos.nombre             as nombre');
    $this->db->select('casos.numdoc             as numdoc');
    $this->db->select('casos.fecnac             as fecnac');
    $this->db->select('casos.pesquiza_id        as pesquiza_id');
    $this->db->select('casos.izq                as izq');
    $this->db->select('casos.der                as der');
    $this->db->select('casos.estado             as estado');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=pesquiza_id', 'inner');
    $this->db->where('casos.pesquiza_id',$idPes);
    $this->db->where('casos.programa_id',$this->session->userdata('programa_id'));
    return $this->db->get()->result();
  }
}
