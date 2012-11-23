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

    if($this->session->userdata('status')==0){
      redirect('auth/login');
    }
    $idUser=$this->session->userdata('user_id');
    $modulos=$this->UserModulos_model->getModulosFromUsers($idUser);        
    Template::set('header','Entrega de Lentes');
    Template::set('dataMenu', $modulos);
    Template::set_block('menu', '_menu');    

  }
  function index($error=""){
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
    $this->template->write_view('content','entrega/lista',$data);
    $this->template->render();
  }
  function casoLente(){
    if($this->input->post('dni')){
      $caso = $this->Casos_model->getByDni($this->input->post('dniTXT'), $this->session->userdata('programa_id'));
      $id=$caso->id;
    }
    if($id){
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
        $menu[] = array('link' =>'paper/pdf/ordenEntregaLente/'.$caso->id,    'nombre'=>'Orden Entrega',    'extra'=>'id="botPrint"');
      }
      $menu[] = array('link' =>'entrega/',      'nombre'=>'Volver',      'extra'=>'id="botBack"');
      $dataLateral['linea']=$menu;
      $dataLateral['titulo']='Busquedas';
      Template::set($dataLateral);
      Template::set_block('lateral', '_lateral');
      Template::set($data);
      Template::set_view('entrega/view');
    }else{
      echo "error";
    }
    Template::render();
  }
  function lenteOk(){
    Template::render();
  }
  function lenteOkDo(){
    $this->Casos_model->entregoLente($this->input->post('caso'));
    $this->Casos_model->setEstado($this->input->post('caso'),6);
  }
}
