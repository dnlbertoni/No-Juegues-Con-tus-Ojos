<?php
/**
 * Description of home
 *
 * @author dnl
 */
class Home extends MY_Controller{
  function __construct() {
    parent::__construct();
    if($this->session->userdata('status')==0){
      redirect('auth/login');
    }
    $this->load->model('Perfil_model');
    $this->load->model('UserModulos_model');
    $idUser=$this->session->userdata('user_id');
    $modulos=$this->UserModulos_model->getModulosFromUsers($idUser);
    $menu[] = array('link' =>'usuarios/perfil', 'nombre'=>'Perfil del Usuario', 'extra'=>'id="Perfil"');
    $menu[] = array('link' =>'auth/unregister', 'nombre'=>'Desvincularse', 'extra'=>'id="Eliminarse"');
    $menu[] = array('link' =>'auth/logout', 'nombre'=>'Salir', 'extra'=>'id="Logout"');
    Template::set('linea', $menu);
    
    Template::set('dataMenu', $modulos);
    Template::set_block('lateral', '_lateral');
    Template::set_block('menu', '_menu');    

  }
  function index(){
    $this->load->model('auth/users');
    $idUser = $this->tank_auth->get_user_id();
    $webuser= $this->users->get_user_by_id($idUser, true);
    if($this->config->item('perfiles')){
      $usuario = $this->Perfil_model->getById($idUser);
      if(!isset($usuario->id)){
        Template::set_message('Faltan datos del Usuario', 'alert');
      }
    };
    $data['nombreUsuario']=$this->tank_auth->get_username();
    $data['lastLog']=$webuser->last_login;
    Template::set($data);
    Template::render();
  }
}
