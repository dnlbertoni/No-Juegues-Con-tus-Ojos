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
    $this->db->select('escuelas.numero_estab as escuela_num');
    $this->db->select('escuelas.nombre as escuela');
    $this->db->select('ciudades.nombre as ciudad');    
    $this->db->select('CONCAT(pesquizas.grado, pesquizas.division, pesquizas.turno) as grado', false);
    $this->db->select('DATE_FORMAT(pesquizas.fechadiag,"%d-%m-%Y") as fechadiag', false);    
    $this->db->select('pesquizas.horadiag  as hora');
    $this->db->select('IF(cartadiag=1,"Enviada", "NO se envio") as carta', false);
    $this->db->select('IF(confirmo=1,"Confirmo", "NO Confirmo") as confirmo', false);
    $this->db->select('casos.lentes as lentes');
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
  function getByDni($dni){
    $this->db->where('numdoc', $dni);
    $this->db->from($this->getTable());
    $query = $this->db->get();
    if($query->num_rows()==1){
      return $query->row();
    }else{
      return false;
    }
  }
  function getByApellido($ape){
    $this->db->select('casos.id             as id');
    $this->db->select('casos.apellido       as apellido');
    $this->db->select('casos.nombre         as nombre');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.nombre      as colegio');
    $this->db->select('pesquizas.grado      as grado');    
    $this->db->select('pesquizas.division   as division');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->like('apellido', $ape);
    $this->db->where('lentes',1);
    $this->db->order_by('apellido');
    return $this->db->get()->result();    
  }
  function getByColegio($colegio){
    $this->db->select('casos.id             as id');
    $this->db->select('casos.apellido       as apellido');
    $this->db->select('casos.nombre         as nombre');
    $this->db->select('casos.numdoc         as dni');
    $this->db->select('casos.confirmo       as confirmo');
    $this->db->select('pesquizas.escuela_id as escuela_id');
    $this->db->select('escuelas.nombre      as colegio');
    $this->db->select('escuelas.direccion   as escuela_dir');
    $this->db->select('ciudades.nombre      as escuela_ciu');
    $this->db->select('pesquizas.grado      as grado');
    $this->db->select('pesquizas.division   as division');
    $this->db->select('pesquizas.turno      as turno');
    $this->db->select('pesquizas.fechadiag  as fecha');
    $this->db->select('pesquizas.horadiag   as hora');
    $this->db->from($this->getTable());
    $this->db->join('pesquizas', 'pesquizas.id=pesquiza_id', 'inner');
    $this->db->join('escuelas', 'escuelas.id=escuela_id', 'inner');
    $this->db->join('ciudades', 'ciudades.id=escuelas.ciudad_id', 'inner');
    $this->db->where('escuela_id', $colegio);
    $this->db->where('casos.programa_id',$this->session->userdata('programa_id'));
    $this->db->order_by('confirmo', 'DESC');
    $this->db->order_by('apellido', 'ASC');
    return $this->db->get()->result();    
  }
  function getAlumnosPesquiza($idPesq){
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
    $this->db->where('pesquiza_id', $idPesq);
    $this->db->where('casos.programa_id', $this->session->userdata('programa_id'));
    $this->db->order_by('apellido');
    //echo $this->db->_compile_select();
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
    $this->db->order_by('apellido');
    //echo $this->db->_compile_select();
    return $this->db->get()->result();
  }
  function mandeCarta($id){
    $this->db->set('cartadiag',1);
    $this->db->where('id',$id);
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->update($this->getTable());
    return true;
  }
  function mandeCartaLente($id){
    $this->db->set('cartalente',1);
    $this->db->where('id',$id);
    $this->db->where('programa_id', $this->session->userdata('programa_id'));
    $this->db->update($this->getTable());
    return true;
  }
  function getLentes(){
    $this->db->select('id');
    $this->db->from($this->getTable());
    $this->db->where('cartalentes',1);
    //$this->db->where('programa_id',PROGRAMA);
    return $this->db->get()->result();
  }
}
