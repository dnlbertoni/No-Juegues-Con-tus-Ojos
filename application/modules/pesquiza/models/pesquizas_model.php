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
  function getAllIndex(){
    $this->db->select('pesquizas.id            as id');
    $this->db->select('pesquizas.fecha         as fecha');
    $this->db->select('pesquizas.voluntario_id as voluntario_id');
    $this->db->select('responsables.nombre     as responsable');
    $this->db->select('IF(pesquizas.voluntario_id IS NULL,"Sin Asignar",CONCAT(voluntarios.apellido,", ",voluntarios.nombre)) as voluntario');
    $this->db->select('pesquizas.escuela_id    as escuela_id');
    $this->db->select('escuelas.nombre         as escuela');
    $this->db->select('CONCAT(pesquizas.grado," ",pesquizas.division) as curso', FALSE);
    $this->db->select('pesquizas.cant_alum     as cant_alum');
    $this->db->select('pesquizas.cant_pres     as cant_pres');
    $this->db->select('pesquizas.cant_prob     as cant_prob');
    $this->db->select('pesquizas.estado        as estado');
    $this->db->from($this->getTable());
    $this->db->join('voluntarios', 'voluntarios.id=voluntario_id', 'left');
    $this->db->join('responsables', 'responsables.id=responsable_id', 'left');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->order_by('escuela_id');
    return $this->db->get()->result();
  }
  function getIndexAgrupados(){
    $this->db->select('COUNT(pesquizas.id)      as cantidad');
    $this->db->select('pesquizas.escuela_id     as escuela_id');
    $this->db->select('CONCAT(escuelas.numero_estab," - ",escuelas.nombre)  as escuela', false);
    $this->db->select('SUM(pesquizas.cant_alum) as cant_alum');
    $this->db->select('SUM(pesquizas.cant_pres) as cant_pres');
    $this->db->select('SUM(pesquizas.cant_prob) as cant_prob');
    $this->db->select('if(AVG(pesquizas.estado)=0,0,IF(AVG(pesquizas.estado)=2,2,1))    as estado',false);
    $this->db->select('escuelas.observaciones   as observaciones');
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->group_by('escuela_id');
    $this->db->order_by('estado', 'ASC');   
    $this->db->order_by('escuela', 'ASC');
    return $this->db->get()->result();
  }
  function getPorEscuela($idEscuela){
    $this->db->select('pesquizas.id            as id');
    $this->db->select('pesquizas.fecha         as fecha');
    $this->db->select('pesquizas.voluntario_id as voluntario_id');
    $this->db->select('IF(pesquizas.voluntario_id IS NULL,"Sin Asignar",CONCAT(voluntarios.apellido,", ",voluntarios.nombre)) as voluntario');
    $this->db->select('pesquizas.escuela_id    as escuela_id');
    $this->db->select('escuelas.nombre         as escuela');
    $this->db->select('CONCAT(pesquizas.grado," ",pesquizas.division) as curso', FALSE);
    $this->db->select('pesquizas.cant_alum     as cant_alum');
    $this->db->select('pesquizas.cant_pres     as cant_pres');
    $this->db->select('pesquizas.cant_prob     as cant_prob');
    $this->db->select('pesquizas.estado        as estado');
    $this->db->from($this->getTable());
    $this->db->join('voluntarios', 'voluntarios.id=voluntario_id', 'left');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('pesquizas.escuela_id', $idEscuela);
    $this->db->order_by('estado','ASC');
    $this->db->order_by('escuela_id');
    return $this->db->get()->result();
  }
  function toDropDownResponsables($campoId, $campoNombre){
    $this->db->select($campoId);
    $this->db->select($campoNombre);
    $this->db->from('responsables');
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
  function escuelasPendientespesquiza(){
    $this->db->select('escuela_id');
  }
  
}
