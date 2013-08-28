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
    $this->db->select('FORMAT(pesquizas.escuela_id, 2) as escuela_id', FALSE);
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
    $this->db->select('CONCAT(LPAD(escuelas.numero_estab,2,"0")," - ",escuelas.nombre)  as escuela', false);
    $this->db->select('SUM(pesquizas.cant_alum) as cant_alum');
    $this->db->select('SUM(pesquizas.cant_pres) as cant_pres');
    $this->db->select('SUM(pesquizas.cant_prob) as cant_prob');
    $this->db->select('if(AVG(pesquizas.estado)=0,0,IF(AVG(pesquizas.estado)=2,2,IF(AVG(pesquizas.estado)=3,3,IF(AVG(pesquizas.estado)=4,4,1))))    as estado',false);
    //$this->db->select('AVG(pesquizas.estado) DIV 1    as estado',false);
    $this->db->select('escuelas.observaciones   as observaciones');
    $this->db->select('escuelas.direccion       as direccion');
    $this->db->select('ciudades.nombre          as ciudad');
    $this->db->select('IF(AVG(pesquizas.transporte)<1,0,1)    as transporte',false);    
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->group_by('escuela_id');
    $this->db->order_by('estado', 'ASC');   
    $this->db->order_by('cant_prob', 'Desc');
    $this->db->order_by('escuela', 'ASC');
    $this->db->order_by('pesquizas.tipo', 'ASC');
    return $this->db->get()->result();
  }
  function getAgrupadosVoluntarios(){
    $this->db->select('pesquizas.escuela_id     as escuela_id');
    $this->db->select('CONCAT(escuelas.numero_estab," - ",escuelas.nombre)  as escuela', false);
    $this->db->select('CONCAT(pesquizas.grado," ",pesquizas.division) as curso', FALSE);
    $this->db->select('escuelas.director        as responsable');
    $this->db->select('escuelas.telefono        as telefono');
    $this->db->select('pesquizas.voluntario_id as voluntario_id');
    $this->db->select('IF(pesquizas.voluntario_id IS NULL,"Sin Asignar",CONCAT(voluntarios.apellido,", ",voluntarios.nombre)) as voluntario');
    $this->db->select('pesquizas.cant_alum      as cant_alum');
    $this->db->select('pesquizas.cant_pres      as cant_pres');
    $this->db->select('pesquizas.cant_prob      as cant_prob');
    $this->db->select('escuelas.observaciones   as observaciones');
    $this->db->select('escuelas.direccion       as direccion');
    $this->db->select('ciudades.nombre          as ciudad');
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->join('voluntarios', 'voluntarios.id=voluntario_id', 'left');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->order_by('voluntario_id', 'ASC');   
    $this->db->order_by('estado', 'ASC');   
    $this->db->order_by('cant_prob', 'Desc');
    $this->db->order_by('escuela', 'ASC');
    $this->db->order_by('pesquizas.tipo', 'ASC');
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
    $this->db->order_by('pesquizas.tipo');
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
  function getByEstado($estado){
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
    $this->db->select('DATE_FORMAT(pesquizas.fecprncarta, "%d-%m %H:%i") as fechacarta', false);
    $this->db->select('DATE_FORMAT(pesquizas.fecprnturno, "%d-%m %H:%i") as fechaturno', false);
    $this->db->from($this->getTable());
    $this->db->join('voluntarios', 'voluntarios.id=voluntario_id', 'left');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('pesquizas.estado', $estado);
    $this->db->order_by('estado', 'ASC');   
    $this->db->order_by('escuela', 'ASC');
    return $this->db->get()->result();
  }
  function getByEscuelasEstado($estado){
    $this->db->select('pesquizas.id            as id');
    $this->db->select('pesquizas.escuela_id    as escuela_id');
    $this->db->select('escuelas.nombre         as escuela');
    $this->db->select('escuelas.direccion      as direccion');
    $this->db->select('ciudades.nombre         as ciudad');
    $this->db->select('escuelas.direccion      as direccion');
    $this->db->select_sum('pesquizas.cant_alum', 'cant_alum');
    $this->db->select_sum('pesquizas.cant_pres', 'cant_pres');
    $this->db->select_sum('pesquizas.cant_prob', 'cant_prob');
    $this->db->select('pesquizas.fechadiag     as turno');
    $this->db->select('pesquizas.horadiag      as hora');
    $this->db->select('pesquizas.transporte    as transporte');
    $this->db->select('pesquizas.estado        as estado');
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('pesquizas.estado', $estado);
    $this->db->group_by('pesquizas.escuela_id');
    $this->db->order_by('turno', 'Asc');
    $this->db->order_by('hora', 'ASC');
    $this->db->order_by('cant_prob', 'DESC');
    return $this->db->get()->result();
  }
  function getAgrupadosPorTurnos(){
    $this->db->select_sum('pesquizas.cant_prob', 'cant_prob');
    $this->db->select('DATE_FORMAT(pesquizas.fechadiag,"%d-%m-%Y") as turno', false);
    $this->db->select('DATE_FORMAT(pesquizas.horadiag,"%H:%i") as hora', false);
    $this->db->select('pesquizas.estado        as estado');
    $this->db->from($this->getTable());
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('pesquizas.estado', PESQUIZA_TURNOS);
    $this->db->group_by('pesquizas.fechadiag');
    $this->db->group_by('pesquizas.horadiag');
    $this->db->order_by('turno', 'ASC');
    $this->db->order_by('hora', 'ASC');
    return $this->db->get()->result();    
  }
  function asignoTurno($escuela,$dia, $hora, $transporte, $viaje){
    $hAux= explode(' ',  trim($hora));
    $h = explode(':', trim($hAux[0]));
    $ho = (trim($hAux[1])=="PM")?intval($h[0])+12:intval($h[0]);
    $diaX=explode("-", $dia);
    $fecha=new DateTime();
    $fecha->setDate($diaX[0],$diaX[1],$diaX[2]);
    $fecha->setTime($ho, intval($h[1]));
    echo $fecha->format('H:i');
    $this->db->set('fechadiag', $fecha->format('Y-m-d'));
    $this->db->set('horadiag', $fecha->format('H:i'));
    $this->db->set('transporte', $transporte);
    $fecha->modify('-'.($transporte * $viaje).' minutes') ;
    $this->db->set('horaescuela', $fecha->format('H:i'));
    $this->db->set('estado', PESQUIZA_TURNOS);
    $this->db->where('escuela_id', $escuela);
    $this->db->update($this->getTable());
    return $this->db->_compile_select();
    //return true;
  }
  function getTurnoEscuela($idEsc){
    $this->db->select('pesquizas.id            as id');
    $this->db->select('pesquizas.escuela_id    as escuela_id');
    $this->db->select('escuelas.nombre         as escuela');
    $this->db->select('escuelas.direccion      as direccion');
    $this->db->select('ciudades.nombre         as ciudad');
    $this->db->select('escuelas.direccion      as direccion');
    $this->db->select_sum('pesquizas.cant_alum', 'cant_alum');
    $this->db->select_sum('pesquizas.cant_pres', 'cant_pres');
    $this->db->select_sum('pesquizas.cant_prob', 'cant_prob');
    $this->db->select('pesquizas.fechadiag     as turno');
    $this->db->select('pesquizas.horadiag      as hora');
    $this->db->select('pesquizas.transporte    as transporte');
    $this->db->select('pesquizas.estado        as estado');
    $this->db->from($this->getTable());
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'inner');
    $this->db->where('pesquizas.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('pesquizas.escuela_id', $idEsc);
    $this->db->group_by('pesquizas.escuela_id');
    $this->db->limit(1);
    return $this->db->get()->row();
  }
  function asignoTransporte($idEsc, $transporte){
    $this->db->set('transporte', $transporte);
    $this->db->where('escuela_id', $idEsc);
    $this->db->update($this->getTable());    
  }
}
