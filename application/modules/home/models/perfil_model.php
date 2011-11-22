<?php
/**
 * Description of perfil_model
 *
 * @author dnl
 */
class Perfil_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('perfil');
  }
}
