<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarios_model
 *
 * @author dnl
 */
class Usuarios_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('user_profiles');
  }
  function getTodos(){
    $this->db->select('user_modulos.id as modulo_id');
    $this->db->select('username');
    $this->db->select('CONCAT(user_profiles.apellido, ", ", user_profiles.nombre ) as usuario', false);
    $this->db->select('modulos.nombre as modulo_nombre');
    $this->db->select('programas.nombre as programa');
    $this->db->select('user_modulos.permiso as modulo_permiso', false);
    $this->db->from('user_modulos');
    $this->db->join('user_profiles', 'user_profiles.user_id=user_modulos.user_id', 'inner');
    $this->db->join('users', 'users.id=user_profiles.user_id', 'inner');
    $this->db->join('modulos', 'modulos.id=user_modulos.modulo_id', 'left');
    $this->db->join('programas', 'user_modulos.programa_id=programas.id', 'inner');
    $this->db->order_by('username');
    $this->db->order_by('user_modulos.programa_id');
    $this->db->order_by('modulos.id');
    return $this->db->get()->result();
  }
  function getPerfil($id){
    $this->db->from('user_modulos');
    $this->db->join('user_profiles', 'user_profiles.user_id=user_modulos.user_id', 'inner');
    $this->db->join('users', 'users.id=user_profiles.user_id', 'inner');
    $this->db->where('users.id',$id);
    return $this->db->get()->row();
  }
}
