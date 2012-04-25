<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of escuelas_model
 *
 * @author dnl
 */
class escuelas_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('escuelas');
  }
}

