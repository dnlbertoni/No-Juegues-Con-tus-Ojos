<?php
/**
 * Description of home
 *
 * @author dnl
 */
class Home extends MY_Controller{
  function __construct() {
    parent::__construct();
    $menu[] = array('link' =>'usuarios/perfil', 'nombre'=>'Perfil del Usuario', 'extra'=>'id="Perfil"');
    $menu[] = array('link' =>'usuarios/chngPass', 'nombre'=>'Contraseña', 'extra'=>'id="Password"');
    $menu[] = array('link' =>'auth/unregister', 'nombre'=>'Desvincularse', 'extra'=>'id="Eliminarse"');
    $menu[] = array('link' =>'auth/logout', 'nombre'=>'Salir', 'extra'=>'id="Logout"');
    Template::set_block('lateral', '_lateral');

  }
  function index(){
    $this->load->model('auth/users');
    $this->load->model('Escuelas_model');
    $this->load->model('Pesquizas_model');
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
    /*
     * Datos de las Escuelas
     */
    $escuelasInfo=$this->Escuelas_model->getAll();
    $data['escuelasInfo']= count($escuelasInfo);
    $data['pesquizadas'] = count($this->Pesquizas_model->getDetalleEscuelas());
    /*
     * Datos de las pesquizas
     */
    $pesquizas=$this->Pesquizas_model->getTotalesAgrupados();
    $data['pesqTotales']=$pesquizas;
    $fin=count($pesquizas);
    $data['total']=$pesquizas[$fin-1]->cantidad;
    $pesquizas=$this->Pesquizas_model->getTotalesAgrupados(2);
    $data['pesqExcep']=$pesquizas;
    $alu=$this->Pesquizas_model->getTotalesAlumnos();
    $data['totPre']=$alu->totPre;
    $data['totAlu']=$alu->totAlu;
    $data['totDer']=$alu->totDer;
    Template::set($data);
    Template::set('lateralInfoData',true);
    Template::set_block('lateral', '_lateralHome');
    Template::render();
  }
}
