<?php
/**
 * Description of casos
 *
 * @author dnl
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
  function getByDni($dni,$programa_id){
    $this->db->where('numdoc', $dni);
    $this->db->from($this->getTable());
    if($programa_id>0)
      $this->db->where('programa_id', $programa_id);
    $query = $this->db->get();
    if($query->num_rows()==1){
      return $query->row();
    }else{
      return false;
    }
  }
  function getByApellido($ape, $programa_id){
    $this->db->select('casos.id             as id');
    $this->db->select('casos.apellido       as apellido');
    $this->db->select('casos.nombre         as nombre');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.nombre      as colegio');
    $this->db->select('pesquizas.grado      as grado');    
    $this->db->select('pesquizas.division   as division');
    $this->db->select('casos.estado         as estado');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->like('apellido', $ape);
    $this->db->where('lentes',1);
    if($programa_id>0)
      $this->db->where('programa_id', $programa_id);
    $this->db->order_by('apellido');
    return $this->db->get()->result();    
  }
  function getByColegio($colegio, $programa_id){
    $this->db->select('casos.id             as id');
    $this->db->select('casos.apellido       as apellido');
    $this->db->select('casos.nombre         as nombre');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.nombre      as colegio');
    $this->db->select('pesquizas.grado      as grado');
    $this->db->select('pesquizas.division   as division');
    $this->db->select('casos.estado         as estado');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->where('escuela_id', $colegio);
    $this->db->where('lentes',1);
    if($programa_id>0)
      $this->db->where('casos.programa_id', $programa_id);
    $this->db->order_by('apellido');
    return $this->db->get()->result();    
  }
  function getAlumnosLentes(){
    $this->db->select('casos.id             as id');
    $this->db->select('casos.apellido       as apellido');
    $this->db->select('casos.nombre         as nombre');
    $this->db->select('casos.numdoc         as dni');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.numero_estab as escuela_num');
    $this->db->select('escuelas.nombre      as escuela_nom');
    $this->db->select('escuelas.direccion   as escuela_dir');
    $this->db->select('escuelas.lugarTransporte  as escuela_trans');
    $this->db->select('ciudades.nombre      as escuela_ciu');
    $this->db->select('pesquizas.grado      as grado');
    $this->db->select('pesquizas.division   as division');
    $this->db->select('pesquizas.turno      as turno');
    $this->db->select('pesquizas.transporte as transporte');
    $this->db->select('DATE_FORMAT(pesquizas.fechadiag,"%d-%m-%Y") as fechadiag', false);
    $this->db->select('pesquizas.horadiag    as horadiag');    
    $this->db->select('pesquizas.horaescuela as horaesc');    
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'left');
    $this->db->where('lentes', 1);
    $this->db->where('casos.programa_id', $this->session->userdata('programa_id'));
    $this->db->order_by('escuela_ciu');    
    $this->db->order_by('escuelas.nombre');
    $this->db->order_by('pesquizas.grado','ASC');
    $this->db->order_by('pesquizas.division');
    $this->db->order_by('apellido');
    //echo $this->db->_compile_select();
    return $this->db->get()->result();
  }  
  function entregoLente($id){
    $this->db->set('lentes_entregado',1);
    $this->db->where($this->getPrimaryKey(),$id);
    $this->db->update($this->getTable());
    return true;
  }
  function estadisticasLentes($programa_id){
    $this->db->select('sum(if(lentes=1,1,0)) as Total', false);
    $this->db->select('sum(if(estado=5,1,0)) as Procesando', false);
    $this->db->select('sum(if(lentes_entregado=1,1,0)) as Entregados', false);
    $this->db->select('( ( sum(if(lentes=1,1,0)) ) - (sum(if(lentes_entregado=1,1,0))) ) as Pendientes', false);
    $this->db->select('(sum(if(lentes_entregado=1,1,0)))/( sum(if(lentes=1,1,0))*100) as Realizado', false);
    $this->db->from($this->getTable());
    if($programa_id>0)
      $this->db->where('programa_id', $programa_id);
    return $this->db->get()->row();
  }
}
