<?php
/**
 * Description of inicio
 *
 * @author dnl
 */
class Inicio extends MY_Controller{
  function __construct() {
    parent::__construct();
    if($this->session->userdata('status')==1){
      Template::redirect('home');
    }
  }
  function index(){
    $programas = $this->Programas_model->getActivos();
    Template::set('programas', $programas);
    $programas = $this->Programas_model->getFinalizados();
    Template::set('programasVie', $programas);
    Template::set_block('menu', 'auth/_menu');
    Template::render();
  }
}
