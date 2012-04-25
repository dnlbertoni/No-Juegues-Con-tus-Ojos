<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of diagnostico
 *
 * @author dnl
 */
class Diagnostico extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Escuelas_model');
    $this->load->model('Casos_model');
    if($this->session->userdata('status')==0){
      redirect('auth/login');
    }
    $this->load->model('Perfil_model');
    $this->load->model('UserModulos_model');
    $idUser=$this->session->userdata('user_id');
    $modulos=$this->UserModulos_model->getModulosFromUsers($idUser);    
    Template::set('dataMenu', $modulos);
    Template::set_block('menu', '_menu');    
    $menu[] = array('link' =>'diagnostico/add', 'nombre'=>'Recibir Nene', 'extra'=>'id="botVol"');
    $dataLateral['linea']=$menu;
    Template::set($dataLateral);
    Template::set_block('lateral', '_lateral');
  }
  function index(){
    Template::render();
  }
  
}
