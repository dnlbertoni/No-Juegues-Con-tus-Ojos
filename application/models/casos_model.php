<?php
/**
 * Description of casos_model
 *
 * @author sistemas
 */
class Casos_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('casos');
  }
  function detalleCaso($id) {
    $this->db->select('casos.id                 as id');
    $this->db->select('casos.apellido           as apellido');
    $this->db->select('casos.nombre             as nombre');
    $this->db->select('casos.numdoc             as numdoc');
    $this->db->select('casos.fecnac             as fecnac');
    $this->db->select('casos.pesquiza_id        as pesquiza_id');
    $this->db->select('casos.lentes             as lentes');
    $this->db->select('pesquizas.escuela_id     as escuela_id');
    $this->db->select('escuelas.nombre          as colegio');
    $this->db->select('pesquizas.grado          as grado');
    $this->db->select('pesquizas.division       as division');
    $this->db->select('pesquizas.fecha          as fechapesq');
    $this->db->select('pesquizas.fechadiag      as fechadiag');
    $this->db->select('pesquizas.horadiag       as horadiag');
    $this->db->select('pesquizas.voluntario_id  as voluntario');
    $this->db->select('voluntarios.apellido     as apevol');
    $this->db->select('voluntarios.nombre       as nomvol');
    $this->db->select('casos.estado         as estado');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->join('voluntarios', 'voluntarios.id=voluntario_id', 'inner');
    $this->db->where('casos.id',$id);
    return $this->db->get()->row();
  }
}
