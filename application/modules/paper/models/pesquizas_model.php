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
  function mandeCarta($id){
    $this->db->set('fecprncarta','NOW()', false);
    $this->db->set('estado', PESQUIZA_CARTAS);
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->where('id', $id);
    $this->db->update($this->getTable());
    return true;
  }
  function mandeTurno($id){
    $this->db->set('fecprnturno', 'NOW()', false);
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->where('id', $id);
    $this->db->update($this->getTable());
    return true;
  }
  function getPesquizas($idPesq){
    $this->db->select('pesquizas.escuela_id  as escuela_id');
    $this->db->select('escuelas.numero_estab as escuela_num');
    $this->db->select('escuelas.nombre       as escuela_nom');
    $this->db->select('escuelas.direccion    as escuela_dir');
    $this->db->select('ciudades.nombre       as escuela_ciu');
    $this->db->select('pesquizas.transporte  as transporte');
    $this->db->select('pesquizas.cant_prob   as cant_prob');
    $this->db->select('pesquizas.fechadiag   as fechadiag');
    $this->db->select('pesquizas.horadiag    as horadiag');
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'left');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'left');
    $this->db->where('pesquizas.id', $idPesq);
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    //echo $this->db->_compile_select();
    return $this->db->get()->row();
  }    
  function getEscuelaResumen($idPesq){
    $pesquiza=$this->getById($idPesq);
    $this->db->select('pesquizas.escuela_id  as escuela_id');
    $this->db->select('escuelas.numero_estab as escuela_num');
    $this->db->select('escuelas.nombre       as escuela_nom');
    $this->db->select('escuelas.direccion    as escuela_dir');
    $this->db->select('escuelas.lugarTransporte  as escuela_trans');
    $this->db->select('ciudades.nombre       as escuela_ciu');
    $this->db->select('pesquizas.transporte  as transporte');
    $this->db->select('SUM(pesquizas.cant_prob)  as cant_prob');
    $this->db->select('pesquizas.fechadiag   as fechadiag');
    $this->db->select('pesquizas.horadiag    as horadiag');
    $this->db->select('pesquizas.horaescuela as horaesc');    
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'left');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'left');
    $this->db->where('pesquizas.escuela_id', $pesquiza->escuela_id);
    $this->db->group_by('pesquizas.escuela_id');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    //echo $this->db->_compile_select();
    return $this->db->get()->row();
  }
  function getTurnos(){
    $this->db->select('pesquizas.escuela_id  as escuela_id');
    $this->db->select('escuelas.numero_estab as escuela_num');
    $this->db->select('escuelas.nombre       as colegio');
    $this->db->select('escuelas.direccion    as escuela_dir');
    $this->db->select('escuelas.lugarTransporte  as escuela_trans');
    $this->db->select('ciudades.nombre       as escuela_ciu');
    $this->db->select('IF(pesquizas.transporte=1,"COLECTIVO","facultad") as transporte', false);
    $this->db->select('SUM(pesquizas.cant_prob)  as cantidad');
    $this->db->select('DATE_FORMAT(pesquizas.fechadiag,"%d-%m") as fechadiag', false);
    $this->db->select('pesquizas.horadiag    as horadiag');
    $this->db->select('pesquizas.horaescuela as horaesc');    
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'left');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'left');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->having('cantidad > ',0);
    $this->db->group_by('pesquizas.escuela_id');
    $this->db->order_by('pesquizas.fechadiag', 'asc');
    $this->db->order_by('horadiag', 'asc');
    //echo $this->db->_compile_select();
    return $this->db->get()->result();    
  }
}
