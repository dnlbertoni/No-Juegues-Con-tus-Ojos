<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fechas_model
 *
 * @author dnl
 */
class Fechas_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('fechas');
  }
  /*
   *  metodo getFechas
   *  @param $tipo integer 1 - Pesquiza 2 - Diagnostico 3 - Entrega
   */
  function getFechas($tipo=false){
    $this->db->select('fechas.id as id');
    $this->db->select('programas.id as programa');
    $this->db->select('programas.nombre as nombre');
    $this->db->select('programas.clubrotario as clubrotario');
    $this->db->select('DATE_FORMAT(fechas.fecha,"%d/%m/%Y") as fecha', FALSE);
    $this->db->select('fechas.sede as sede');
    $this->db->select('fechas.hora_ini as inicio');
    $this->db->select('fechas.hora_fin as final');
    $this->db->from('fechas');
    $this->db->join('programas', 'fechas.programa_id=programas.id', 'inner');
    $this->db->where('tipoevent', $tipo);
    $this->db->where('programas.id',$this->session->userdata('programa_id'));
    return $this->db->get()->result();
  }
  function getPesquizas(){
    return $this->getFechas(1);
  }
  function getDiagnosticos(){
    return $this->getFechas(2);
  }
  function getEntregas(){
    return $this->getFechas(3);
  }
}
