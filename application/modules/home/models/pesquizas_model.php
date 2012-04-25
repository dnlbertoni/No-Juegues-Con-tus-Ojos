<?php
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
  function getTotalesAgrupados(){
    $this->db->select('IFNULL(estado,"Total") as estado', false);    
    $this->db->select('COUNT(id) as cantidad', false);
    $this->db->from($this->getTable());
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->group_by('estado WITH ROLLUP', FALSE);
    return $this->db->get()->result();
  }
  function getTotalesAlumnos(){
    $this->db->select('SUM(cant_alum) as totAlu', false);
    $this->db->select('SUM(cant_pres) as totPre', false);
    $this->db->select('SUM(cant_prob) as totDer', false);
    $this->db->from($this->getTable());
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    return $this->db->get()->row();
  }
}
