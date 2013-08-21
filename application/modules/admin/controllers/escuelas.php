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
    Template::set('lateralInfoData',true);
    Template::set_block('lateral', '_lateralAdmin');
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
  function ToExcel(){
    $this->load->library('PHPExcel');
    $this->phpexcel->getProperties()
            ->setTitle("Esto es una prueba")
            ->setDescription("Descripcion del excel bla bla blaaa");
    // Setiar la solapa que queda actia al abrir el excel
    $this->phpexcel->setActiveSheetIndex(0);
    // Solapa excel para trabajar con PHP
    $sheet = $this->phpexcel->getActiveSheet();
    $nombreTabla=$this->Escuelas_model->getTable();
    $sheet->setTitle($nombreTabla);
    $sheet->getColumnDimension()->setWidth(20);
    $col=0;
    $campos=$this->Escuelas_model->getCampos($nombreTabla);
    foreach ($campos as $campo) {
      $sheet->getStyleByColumnAndRow($col,1)->getFill()
        ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => 'F28A8C')
        ));
      $sheet->setCellValueByColumnAndRow($col, 1, $campo->name);
      $col++;
    }
    // Salida
    header("Content-Type: application/vnd.ms-excel");
    $nombreArchivo = 'export_lisatdo_'.date('YmdHis');
    header("Content-Disposition: attachment; filename=\"$nombreArchivo.xls\"");
    header("Cache-Control: max-age=0");
    // Genera Excel
    $writer = PHPExcel_IOFactory::createWriter($this->phpexcel, "Excel5");
    // Escribir
    $writer->save('php://output');
    exit;    
  }
}
