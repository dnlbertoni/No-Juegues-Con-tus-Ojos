<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userprofiles_model
 *
 * @author dnl
 */
class Userprofiles_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('user_profiles');
  }
  function getNivel(){
    $this->db->select('nivel');
    $this->db->from($this->getTable());
    $this->db->join('users', 'users.id=user_profiles.user_id', 'inner');
    $this->db->where('username', $this->session->userdata('username'));
    return $this->db->get()->row()->nivel;
  }
}
