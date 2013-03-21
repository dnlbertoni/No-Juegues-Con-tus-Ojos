<?php
/**
 * Description of voluntairos
 *
 * @author dnl
 */
class Voluntarios extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Voluntarios_model', '', true);
    Template::set('lateralInfoData',true);
    Template::set_block('lateral', '_lateralAdmin');
  }
  function index(){
    $voluntarios = $this->Voluntarios_model->getAll('apellido, nombre', 20);
    $data['voluntarios'] = $voluntarios;
    $dataLateral['titulo'] = "Busqueda de Voluntarios";
    $dataLateral['accion'] = "admin/voluntarios/searchDo";
    Template::set($data);
    Template::render();
  }
  function add($method="ajax"){
    $voluntarios =   array( 'id'       => '',
                            'apellido' => '',
                            'nombre'   => '',
                            'telefono' => '',
                            'email'    => ''
                          );
    $data['vol'] = (object) $voluntarios;
    $data['botGuardar'] = "Agragar";
    if($method=="ajax"){
      $this->output->enable_profiler(false);
      $data['accion'] = 'admin/voluntarios/addDo';
      $this->load->view('admin/voluntarios/add', $data);
    }
  }
  function addDo(){
    foreach($_POST as $key=>$valor){
      if($key=='apellido' || $key=='nombre'){
        $datos[$key] = strtoupper ($valor);
      }
      else{
        $datos[$key] = $valor;
      }
    }
    $id=$this->Voluntarios_model->add($datos);
  }
  function edit($id,$method="ajax"){
    $data['vol'] = $this->Voluntarios_model->getById($id);
    $data['botGuardar'] = "Editar";
    if($method=="ajax"){
      $this->output->enable_profiler(false);
      $data['accion'] = 'admin/voluntarios/editDo';
      $this->load->view('admin/voluntarios/add', $data);
    }
  }
  function editDo(){
    foreach($_POST as $key=>$valor){
      if($key=='apellido' || $key=='nombre'){
        $datos[$key] = strtoupper ($valor);
      }
      else{
        $datos[$key] = $valor;
      }
    }
    $this->Voluntarios_model->update($datos, $this->input->post('id'));
  }
  function del($id,$method="ajax"){
    $data['vol'] = $this->Voluntarios_model->getById($id);
    $data['botGuardar'] = "Borrar";
    if($method=="ajax"){
      $this->output->enable_profiler(false);
      $data['accion'] = 'admin/voluntarios/delDo';
      $this->load->view('admin/voluntarios/add', $data);
    }
  }
  function delDo(){
    $this->Voluntarios_model->borrar($this->input->post('id'));
  }
  function search($target=""){
    $this->output->enable_profiler(false);
    $data['accion']='admin/voluntarios/searchDo';
    $data['titulo']='Voluntarios';
    $data['ocultos'] = array('target' => $target);
    $this->load->view('admin/voluntarios/search', $data);
  }
  function searchDo(){
    $this->output->enable_profiler(false);
    if($this->input->post('filtro')=='N'){
      $voluntarios = $this->Voluntarios_model->searchNombre($this->input->post('searchTXT'));
    };
    if($this->input->post('filtro')=='A'){
      $voluntarios = $this->Voluntarios_model->searchApellido($this->input->post('searchTXT'));
    }
    $data['datos']  = $voluntarios;
    $target = "'#";
    $target .= ($this->input->post('target'))?$this->input->post('target'):' ';
    $target .= "'";
    $data['target'] = $target;
    $this->load->view('admin/resultados', $data);
  }
}
