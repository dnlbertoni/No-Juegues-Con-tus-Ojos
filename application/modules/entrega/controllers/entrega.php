<?php
/**
 * Description of entrega
 *
 * @author dnl
 */
class Entrega extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Perfil_model');
    $this->load->model('UserModulos_model');
    $this->load->model('Casos_model', '', true);
    $this->load->model('Pesquizas_model', '', true);

    $menu[] = array('link' =>'entrega/lenteOk', 'nombre'=>'Lente Entregado', 'extra'=>'id="botLente" class="boton"');
    $dataLateral['linea']=$menu;
    $dataLateral['statics']=$this->Casos_model->estadisticasLentes($this->session->userdata('programa_id'));
    Template::set($dataLateral);
    Template::set_block('lateral', '_lateral');
  }
  function index($error=""){
    $data['casos'] = count($this->Casos_model->getAlumnosLentes());
    $data['colSel']= $this->Pesquizas_model->escuelaToDropDown();
    $data['error'] = $error;
    $data['estado'] = array ( 0 => 'Sin Diagnosticar',
                              1 => 'Carta Enviada',
                              2 => 'Diagnosticado',
                              3 => 'Pendiente Lente',
                              4 => 'Carta Enviada',
                              5 => 'Lentes',
                              6 => 'Terminado'
                            );
    Template::set($data);
    Template::render();
  }
  function dniSearch(){
    $caso = $this->Casos_model->getByDni($this->input->post('dniTXT'), $this->session->userdata('programa_id'));
    if(!$caso){
      $this->index($error="dni");
    }else{
     $this->casoLente($caso->id);
    }
  }
  function apellidoSearch(){
    $casos = $this->Casos_model->getByApellido( strtoupper($this->input->post('apellidoTXT')),
                                                $this->session->userdata('programa_id'));
    $data['casos']=$casos;
    $data['estado'] = array ( 0 => 'Sin Diagnosticar',
                              1 => 'Carta Enviada',
                              2 => 'Diagnosticado',
                              3 => 'Pendiente Lente',
                              4 => 'Carta Enviada',
                              5 => 'Lentes',
                              6 => 'Terminado'
                            );
    $this->template->write_view('content','entrega/lista',$data);
    $this->template->render();
  }
  function colegioSearch(){
    $casos = $this->Casos_model->getByColegio( $this->input->post('colegioTXT'),
                                               $this->session->userdata('programa_id'));
    $data['casos']=$casos;
    $data['estado'] = array ( 0 => 'Sin Diagnosticar',
                              1 => 'Carta Enviada',
                              2 => 'Diagnosticado',
                              3 => 'Pendiente Lente',
                              4 => 'Carta Enviada',
                              5 => 'Lentes',
                              6 => 'Terminado'
                            );
    Template::set($data);
    Template::set_view('entrega/lista');
    Template::render();
  }
  function casoLente($id){
    $caso = $this->Casos_model->detalleCaso($id);
    $data['caso']=$caso;
    $data['estado'] = array ( 0 => 'Sin Diagnosticar',
                              1 => 'Carta Enviada',
                              2 => 'Diagnosticado',
                              3 => 'Pendiente Lente',
                              4 => 'Carta Enviada',
                              5 => 'Lentes',
                              6 => 'Terminado'
                            );
    $data['activo']=  ' $(".txt").attr("disabled", true);';
    $data['accion']= '';
    if($caso->estado!=6){
      $botones[]=array('accion'=> 'paper/pdf/ordenEntregaLente/'.$caso->id,
                                    'texto'=> 'Orden Entrega',
                                    'id'=>'Bentrega',
                                    'clase'=>'print',
                                    'target'=>"_blank");
    }
    $botones[]=array('accion'=> 'admin/casos/edit/'.$caso->id,
                                  'texto'=> 'Editar Datos',
                                  'id'=>'Bedit',
                                  'clase'=>'edit',
                                  'target'=>"_self");
    $botones[]=array('accion'=> 'entrega/',
                                  'texto'=> 'Volver',
                                  'id'=>'Bback',
                                  'clase'=>'boton',
                                  'target'=>"_self");

    /*
    $botones[]=array('accion'=> 'paper/pdf/cartaEntregaLente/'.$caso->id,
                                  'texto'=> 'Carta Lente',
                                  'id'=>'Baccion',
                                  'clase'=>'print',
                                  'target'=>"_blank");
    $botones[]=array('accion'=> 'paper/pdf/etiquetaCasoLente/'.$caso->id,
                                  'texto'=> 'Etiqueta Lente',
                                  'id'=>'Baccion',
                                  'clase'=>'print',
                                  'target'=>"_blank");
     *
     */
    $dataLateral['back']="'".base_url()."index.php/entrega/lenteProceso/".$caso->id."'";
    $dataLateral['botones']=$botones;
    $this->template->write_view('header2', 'admin/casos/lateral', $dataLateral);
    $this->template->write_view('content','admin/casos/view',$data);
    $this->template->render();
  }
  function lenteProceso($id){
    $this->Casos_model->setEstado($id,5);
    $this->index();
  }
  function lenteOk(){
    $this->output->enable_profiler(false);
    $this->load->view('entrega/lenteOK');
  }
  function lenteOkDo(){
    $this->Casos_model->entregoLente($this->input->post('caso'));
    $this->Casos_model->setEstado($this->input->post('caso'),6);
  }
}
