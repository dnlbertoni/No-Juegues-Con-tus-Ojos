<?php
/**
 * Description of modulos_model
 *
 * @author dnl
 */
class Modulos_model extends MY_Model{
  function __construct() {
    parent::__construct();
    $this->setTable('modulos');
  }
}
