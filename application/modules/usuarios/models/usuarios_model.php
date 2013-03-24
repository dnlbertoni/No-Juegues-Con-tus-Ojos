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
    $this->db->select('user_modulos.programa_id as programa_id');
    $this->db->select('user_modulos.user_id as user_id');
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
  function getUsuario($id){
    $this->db->from('users');
    $this->db->where('id', $id);
    return $this->db->get()->row();
  }
  function setPermiso($modulo_id, $permiso, $programa_id){
    $this->db->set('permiso',$permiso);
    $this->db->where('id',$modulo_id);
    $this->db->where('programa_id',$programa_id);
    $this->db->update('user_modulos');
    return true;
  }
  function createPermiso($user_id, $modulo_id, $programa_id){
    $this->db->set('user_id', $user_id);
    $this->db->set('modulo_id', $modulo_id);
    $this->db->set('permiso', 1);
    $this->db->set('programa_id',$programa_id);
    $this->db->insert('user_modulos');
    return $this->db->insert_id();
}
}
