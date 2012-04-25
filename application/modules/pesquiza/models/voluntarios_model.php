<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of voluntarios_model
 *
 * @author dnl
 */
class Voluntarios_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('voluntarios');
  }
}