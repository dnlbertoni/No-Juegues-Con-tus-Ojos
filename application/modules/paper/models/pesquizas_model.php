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
  function escuelaToDropDown(){
    $this->db->distinct();
    $this->db->select('escuela_id as Id');
    $this->db->select('escuelas.nombre as Nombre');
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=escuela_id','inner');
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $query = $this->db->get();
    $datos = array();
    foreach($query->result() as $item){
            $datos[$item->Id] = $item->Nombre;
    }
    return $datos;
  }
  function detPesquiza($id){
    $this->db->select('pesquizas.id as id');
    $this->db->select('CONCAT(escuelas.numero_estab, " - ", escuelas.nombre ) as escuela', FALSE);
    $this->db->select('escuelas.direccion as direccion');
    $this->db->select('pesquizas.grado as curso');
    $this->db->select('pesquizas.division as division');
    $this->db->select('pesquizas.voluntario_id as voluntario');
    $this->db->select('pesquizas.fecha as fecha');    
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id = pesquizas.escuela_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('escuelas.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('pesquizas.id', $id);
    //echo $this->db->_compile_select();
    return $this->db->get()->row();
  }
}
