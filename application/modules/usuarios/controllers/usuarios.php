<?php

/**
 * Description of usuarios
 *
 * @author dnl
 */
class Usuarios extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Perfil_model');
    $menu[] = array('link' =>'auth/logout', 'nombre'=>'Salir', 'extra'=>'id="Logout"');
    Template::set('linea', $menu);
    Template::set_block('lateral', '_lateral');
  }
  function perfil(){
    $idUser = $this->tank_auth->get_user_id();
    $user = $this->Perfil_model->getbyId($idUser);
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
}

