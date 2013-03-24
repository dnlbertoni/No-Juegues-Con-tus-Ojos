<?php

/**
 * Description of usuarios
 *
 * @author dnl
 */
class Usuarios extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Usuarios_model');
    $menu[] = array('link' =>'auth/logout', 'nombre'=>'Salir', 'extra'=>'id="Logout"');
    Template::set('linea', $menu);
    Template::set_block('lateral', '_lateral');
  }
  function index(){
    $usuarios=$this->Usuarios_model->getTodos();
    //print_r($usuarios);
    Template::set('todos', $usuarios);
    Template::render();
  }
  function perfil(){
    $idUser = $this->tank_auth->get_user_id();
    $user = $this->Usuarios_model->getPerfil($idUser);
    if($user){
      Template::set('user',$user);
      $data['accion']='usuarios/editDo';
    }else{
      $userAux=array(  'id'=>$idUser,
                    'apellido'=>'',
                    'nombre'=>'',
                    'telefono'=>''
                  );
      $aux = (object) $userAux;
      $data['accion']='usuarios/addDo';
      Template::set('user',$aux);
    };
    //Template::set_message('prueba', 'ok');
    Template::set($data);
    Template::render();
  }
  function addDo(){
    foreach($_POST as $key=>$valor){
      $datos[$key]=$valor;
    }
    $id=$this->Perfil_model->add($datos);
    Template::redirect('home');
  }
  function editDo(){
    foreach($_POST as $key=>$valor){
      if($key!='id'){
        $datos[$key]=$valor;
      }
    }
    $id=$this->Perfil_model->update($datos, $this->input->post('id'));
    Template::redirect('home');
  }
  function setPermiso(){
    $modulo_id = $this->input->post('modulo');
    $estado    = $this->input->post('accion');
    $programa_id   = $this->input->post('programa');
    $this->Usuarios_model->setPermiso($modulo_id,$estado, $programa_id);
  }
  function creoPermiso($user,$programa_id){
    $usuario=$this->Usuarios_model->getUsuario($user);
    $programa=$this->Programas_model->getById($programa_id);
    $data['user_id']        = $usuario->id;
    $data['usuario_nombre'] = $usuario->username;   
    $data['programa_id'] = $programa->id;
    $data['programa_nombre']=$programa->nombre;
    $data['modulos']     = $this->Modulos_model->toDropDown('id','nombre');
    $this->load->view('usuarios/creoPermiso',$data);
  }
  function creoPermisoDo(){
    $modulo_id     = $this->input->post('modulo');
    $usuario_id    = $this->input->post('usuario');
    $programa_id   = $this->input->post('programa');
    $this->Usuarios_model->createPermiso($usuario_id,$modulo_id, $programa_id);    
  }
}

