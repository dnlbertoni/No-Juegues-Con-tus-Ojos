<?php

/**
 * class escuelas
 *
 * Description for class escuelas
 *
 * @author:
*/
class Escuelas extends MY_Controller{
    /**
        * escuelas constructor
        *
        * @param 
        */
  function __construct(){
    parent::__construct();
    $this->load->model('Escuelas_model');
    $this->load->model('Ciudades_model');
    if($this->session->userdata('status')==0){
      redirect('auth/login');
    }
    $this->load->model('Perfil_model');
    $this->load->model('UserModulos_model');
    $idUser=$this->session->userdata('user_id');
    $modulos=$this->UserModulos_model->getModulosFromUsers($idUser);
    $menu[] = array('link' =>'admin/escuelas/add', 'nombre'=>'Nueva Escuela', 'extra'=>'id="botEscuela"');
    $menu[] = array('link' =>'admin/voluntarios/add', 'nombre'=>'Nuevo Volun.', 'extra'=>'id="botVol"');
    $menu[] = array('link' =>'pesquiza/add', 'nombre'=>'Nueva Pesquiza', 'extra'=>'id="Pesq"');
    //Template::set('linea', $menu);
    Template::set('dataMenu', $modulos);
    Template::set_block('menu', '_menu'); 
    Template::set_block('lateral', '_lateral');         
  }
    function index(){
        $data['escuelas']=$this->Escuelas_model->getAllIndex();
        Template::set($data);
        Template::render();
    }
    function add(){
        $data['accion']='admin/escuelas/addDo';
        $data['botGuardar']='Guardar';
        $data['selCiudades']=$this->Ciudades_model->toDropDown('id', 'nombre');
        $escuela= array(
                            'id'=>'',
                            'nombre'=>'',
                            'direccion'=>'',
                            'telefono'=>'',
                            'ciudad_id'=>1,
                            'director'=>'',
                            'numero_estab'=>'',
                            'lugartransporte'=>'Facultad',
                            'programa_id'=>$this->session->userdata('programa_id')
                          );
        $data['esc'] = (object) $escuela;
        $this->load->view('admin/escuelas/add', $data);        
    }
    function addDo(){
        $datos=array(	
                'nombre'=>$this->input->post('nombre'),
                'direccion'=>$this->input->post('direccion'),
                'telefono'=>$this->input->post('telefono'),
                'ciudad_id'=>$this->input->post('ciudad_id'),
                'director'=>$this->input->post('director'),
                'numero_estab'=>$this->input->post('numero_estab'),
                'lugarTransporte'=>$this->input->post('lugarTransporte'),
                'programa_id'=>$this->session->userdata('programa_id')
                );
        $id=$this->Escuelas_model->add($datos);
    }
    function edit($id){
        $data['accion']='admin/escuelas/editDo';
        $data['botGuardar']='Editar';
        $data['esc']=$this->Escuelas_model->getByid($id);
        $data['selCiudades']=$this->Ciudades_model->toDropDown('id', 'nombre');
        $this->load->view('admin/escuelas/add', $data);
    }
    function editDo(){
      $datos=array(	
                'nombre'=>$this->input->post('nombre'),
                'direccion'=>$this->input->post('direccion'),
                'telefono'=>$this->input->post('telefono'),
                'ciudad_id'=>$this->input->post('ciudad_id'),
                'director'=>$this->input->post('director'),
                'numero_estab'=>$this->input->post('numero_estab'),
                'lugarTransporte'=>$this->input->post('lugarTransporte'),
                'programa_id'=>$this->session->userdata('programa_id')
                );
        $this->Escuelas_model->update($datos,$this->input->post('id'));
    }
    function del($id){
        $data['accion']='admin/escuelas/delDo';
        $data['botGuardar']='Borrar';
        $data['esc']=$this->Escuelas_model->getByid($id);
        $data['selCiudades']=$this->Ciudades_model->toDropDown('id', 'nombre');
        $this->load->view('admin/escuelas/add', $data);
    }
    function delDo(){
        $this->Escuelas_model->borrar($this->input->post('id'));
    }
}
