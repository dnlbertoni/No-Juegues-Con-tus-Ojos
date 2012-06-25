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
  function getByTurno($id){
    $this->db->select('casos.id as id');
    $this->db->select('casos.apellido');
    $this->db->select('casos.nombre');
    $this->db->select('casos.numdoc as dni');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.nombre as escuela');
    $this->db->select('CONCAT(pesquizas.grado, pesquizas.division, pesquizas.turno) as grado', false);
    $this->db->select('CONCAT(pesquizas.fechadiag, pesquizas.horadiag) as turno', false);
    $this->db->select('IF(cartadiag=1,"Enviada", "NO se envio") as carta', false);
    $this->db->select('IF(confirmo=1,"Confirmo", "NO Confirmo") as confirmo', false);
    $this->db->select('casos.programa_id as programa');
    $this->db->select('casos.estado as estado');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=casos.pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->where('casos.id', $id);
    return $this->db->get()->result();
  }
  function getByDNI($dni){
    $this->db->select('casos.id as id');
    $this->db->select('casos.apellido');
    $this->db->select('casos.nombre');
    $this->db->select('casos.numdoc as dni');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.nombre as escuela');
    $this->db->select('CONCAT(pesquizas.grado, pesquizas.division, pesquizas.turno) as grado', false);
    $this->db->select('CONCAT(pesquizas.fechadiag, pesquizas.horadiag) as turno', false);
    $this->db->select('IF(cartadiag=1,"Enviada", "NO se envio") as carta', false);
    $this->db->select('IF(confirmo=1,"Confirmo", "NO Confirmo") as confirmo', false);
    $this->db->select('casos.programa_id as programa');
    $this->db->select('casos.estado as estado');    
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=casos.pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->where('casos.numdoc', $dni);
    $this->db->order_by('escuela_id');
    $this->db->order_by('grado');
    $this->db->order_by('apellido');    
    return $this->db->get()->result();
  }
  function getByApellido($apellido){
    $this->db->select('casos.id as id');
    $this->db->select('casos.apellido');
    $this->db->select('casos.nombre');
    $this->db->select('casos.numdoc as dni');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.nombre as escuela');
    $this->db->select('CONCAT(pesquizas.grado, pesquizas.division, pesquizas.turno) as grado', false);
    $this->db->select('CONCAT(pesquizas.fechadiag, pesquizas.horadiag) as turno', false);
    $this->db->select('IF(cartadiag=1,"Enviada", "NO se envio") as carta', false);
    $this->db->select('IF(confirmo=1,"Confirmo", "NO Confirmo") as confirmo', false);
    $this->db->select('casos.programa_id as programa');
    $this->db->select('casos.estado as estado');    
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=casos.pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->like('casos.apellido', $apellido);
    $this->db->order_by('escuela_id');
    $this->db->order_by('grado');
    $this->db->order_by('apellido');    
    return $this->db->get()->result();
  }
  function getByEscuela($escuela){
    $this->db->select('casos.id as id');
    $this->db->select('casos.apellido');
    $this->db->select('casos.nombre');
    $this->db->select('casos.numdoc as dni');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.nombre as escuela');
    $this->db->select('CONCAT(pesquizas.grado, pesquizas.division, pesquizas.turno) as grado', false);
    $this->db->select('CONCAT(pesquizas.fechadiag, pesquizas.horadiag) as turno', false);
    $this->db->select('IF(cartadiag=1,"Enviada", "NO se envio") as carta', false);
    $this->db->select('IF(confirmo=1,"Confirmo", "NO Confirmo") as confirmo', false);
    $this->db->select('casos.programa_id as programa');
    $this->db->select('casos.estado as estado');    
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=casos.pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->where('pesquizas.escuela_id', $escuela);
    $this->db->order_by('escuela_id');
    $this->db->order_by('grado');
    $this->db->order_by('apellido');    
    return $this->db->get()->result();
  }  
  function detalleCaso($id){
    $this->db->select('casos.id as id');
    $this->db->select('casos.apellido');
    $this->db->select('casos.nombre');
    $this->db->select('casos.numdoc as dni');
    $this->db->select('casos.fecnac as fecnac');
    $this->db->select('casos.edad   as edad');
    $this->db->select('casos.sexo   as sexo');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('pesquizas.fecha as fechapesq');
    $this->db->select('voluntarios.nombre as voluntario');
    $this->db->select('pesquizas.tipo as tipopesq');
    $this->db->select('escuelas.nombre as escuela');
    $this->db->select('ciudades.nombre as ciudad');    
    $this->db->select('CONCAT(pesquizas.grado, pesquizas.division, pesquizas.turno) as grado', false);
    $this->db->select('pesquizas.fechadiag as turno');
    $this->db->select('pesquizas.horadiag  as hora');
    $this->db->select('IF(cartadiag=1,"Enviada", "NO se envio") as carta', false);
    $this->db->select('IF(confirmo=1,"Confirmo", "NO Confirmo") as confirmo', false);
    $this->db->select('casos.programa_id as programa');
    $this->db->select('casos.estado as estado');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=casos.pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'inner');
    $this->db->join('voluntarios', 'voluntarios.id=pesquizas.voluntario_id', 'inner');
    $this->db->where('casos.id', $id);
    return $this->db->get()->row();    
  }
  function recibirNene($id){
    $this->db->set('horaini','NOW()',  false );
    $this->db->set('asistio', 1);
    $this->db->set('estado', 1);
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->where('id', $id);
    $this->db->update($this->getTable());
    return true;
  }  
  function confirmar($id){
    $this->db->set('confirmo', 1);
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->where('id', $id);
    $this->db->update($this->getTable());
    return true;
  }
  function datosPorDia(){
    $this->db->select('DATE_FORMAT(pesquizas.fechadiag, "%d-%m-%Y") as Dia', false );
    $this->db->select('count(casos.id) as Esperados', false);
    $this->db->select('SUM(if(casos.asistio=1,1,0)) as Asistentes', false);
    $this->db->select('SUM(if(casos.asistio=0,1,0)) as Ausentes', false);
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=casos.pesquiza_id', 'inner');
    $this->db->where('casos.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('fechadiag IS NOT NULL','', false);
    $this->db->group_by('Dia');
    $this->db->order_by('fechadiag','ASC');
    return $this->db->get()->result();
  }
  function getIngresos(){
    $this->db->select('DATE_FORMAT(casos.horaini, "%d-%m-%Y") as Dia', false );
    $this->db->select('TIME_TO_SEC(casos.horaini) as tiempo', false );
    $this->db->from($this->getTable());
    $this->db->where('casos.programa_id', $this->session->userdata('programa_id'));
    $this->db->where('TIME_TO_SEC(casos.horaini) IS NOT NULL', false, false);
    $this->db->where('TIME_TO_SEC(casos.horaini) > 0',false, false);
    $this->db->order_by('Dia');
    $this->db->order_by('tiempo');
    return $this->db->get()->result();    
  }
  function getConfirmados(){
    $this->db->select('casos.id as id');
    $this->db->select('casos.apellido');
    $this->db->select('casos.nombre');
    $this->db->select('casos.numdoc as dni');
    $this->db->select('escuelas.nombre as colegio');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=casos.pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->where('confirmo', 1);
    $this->db->where('casos.programa_id', $this->session->userdata('programa_id'));
    return $this->db->get()->result();
  }
  function getFinalizados(){
    $this->db->select('casos.id as id');
    $this->db->select('casos.apellido');
    $this->db->select('casos.nombre');
    $this->db->select('casos.numdoc as dni');
    $this->db->select('escuelas.nombre as colegio');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=casos.pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=pesquizas.escuela_id', 'inner');
    $this->db->where('casos.estado', 2);
    $this->db->where('casos.programa_id', $this->session->userdata('programa_id'));
    return $this->db->get()->result();
  }
}
