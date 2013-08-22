<?php

/**
 * class escuelas
 *
 * Description for class escuelas
 *
 * @author:
*/
class Ciudades extends MY_Controller{
    /**
        * escuelas constructor
        *
        * @param
        */
  function __construct(){
    parent::__construct();
    $this->load->model('Ciudades_model');
    Template::set('lateralInfoData',true);
    Template::set_block('lateral', '_lateralAdmin');
  }
    function index(){
        $data['ciudades']=$this->Ciudades_model->getAll();
        Template::set($data);
        Template::render();
    }
    function add(){
        $data['accion']='admin/ciudades/addDo';
        $data['botGuardar']='Guardar';
        $ciudad= array(
                        'id'=>'',
                        'nombre'=>'',
                        'cpostal'=>'',
                        'provincia'=>'Entre Rios',
                         'pais'=>'Argentina'
        );
        $data['esc'] = (object) $escuela;
        $this->load->view('admin/ciudades/add', $data);
    }
    function addDo(){
        $datos=array(
                'nombre'=>$this->input->post('nombre'),
                'cpostal'=>$this->input->post('cpostal'),
                'provincia'=>$this->input->post('provincia'),
                'pais'=>$this->input->post('pais')
                );
        $id=$this->Ciudades_model->add($datos,false,false);
    }
    function edit($id){
        $data['accion']='admin/ciudades/editDo';
        $data['botGuardar']='Editar';
        $data['ciu']=$this->Ciudades_model->getByid($id);
        $this->load->view('admin/ciudades/add', $data);
    }
    function editDo(){
        $datos=array(
                'nombre'=>$this->input->post('nombre'),
                'cpostal'=>$this->input->post('cpostal'),
                'provincia'=>$this->input->post('provincia'),
                'pais'=>$this->input->post('pais')
                );
        $this->Ciudades_model->update($datos,$this->input->post('id'));
    }
    function del($id){
        $data['accion']='admin/ciudades/delDo';
        $data['botGuardar']='Borrar';
        $data['ciu']=$this->Ciudades_model->getById($id);
        $this->load->view('admin/ciudades/add', $data);
    }
    function delDo(){
        $this->Ciudades_model->borrar($this->input->post('id'));
    }
}
