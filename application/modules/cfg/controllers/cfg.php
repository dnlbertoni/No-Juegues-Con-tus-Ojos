<?php
/**
 * Description of cfg
 *
 * @author dnl
 */
class Cfg extends MY_Controller{
  function __construct() {
    parent::__construct();
  }
  function index(){
    Template::render();
  }
  function definirRoles(){
    $usuarios=$this->Users_model->getAll();
    $modulos=$this->Modulos_model->getAll();
  }
}
