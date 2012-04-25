<?php
/**
 * funciones propias del chico, estado pasos y entregas
 *
 * @author sistemas
 */
class Casos extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Casos_model', '', true);
  }
  function edit($id){
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
    $data['activo']=  '$(".txt").removeAttr("disabled")';
    $data['accion']='admin/casos/editDo';
    /**
     *  @todo cambiar de estado con selectora
     */
    $botones[]=array( 'texto'=> 'Guardar',
                                  'id'=>'Bsave',
                                  'clase'=>'save',
                                  'target'=>"_self");
    $botones[]=array( 'texto'=> 'Volver',
                                'id'=>'Bback',
                                'clase'=>'back',
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
    $this->template->write_view('content', 'admin/casos/view', $data);
    $this->template->render();
  }
  function editDo(){
    $datos= array(  'apellido' => $this->input->post('apellido'),
                    'nombre' => $this->input->post('nombre'),
                    'numdoc' => $this->input->post('numdoc')
    );
    $this->Casos_model->update($datos,$this->input->post('id'));
    $this->template->render();
    //redirect('pesquiza','location',301);
  }
}

