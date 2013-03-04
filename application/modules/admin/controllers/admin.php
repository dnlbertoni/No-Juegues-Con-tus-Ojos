<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author dnl
 */
class Admin extends MY_Controller{
  function __construct() {
    parent::__construct();
    Template::set('lateralInfoData',true);    
    Template::set_block('lateral', '_lateralAdmin'); 
  }
  function index(){
    $fecPesq = $this->Fechas_model->getPesquizas();
    $fecEntr = $this->Fechas_model->getEntregas();
    $data['programa']=$this->Programas_model->getById($this->session->userdata('programa_id'));
    Template::set('urlMuestroPesq', "'".base_url()."admin/muestroFechas/1"."'");
    Template::set('urlMuestroDiags', "'".base_url()."admin/muestroFechas/2"."'");
    Template::set('urlMuestroEntr', "'".base_url()."admin/muestroFechas/3"."'");
    Template::set($data);	  
    Template::render();
  }
  function muestroFechas($tipo){
    $this->output->enable_profiler(false);
    switch ($tipo){
      case 1:
        $data['fechas'] = $this->Fechas_model->getPesquizas();
        break;
      case 2:
        $data['fechas'] = $this->Fechas_model->getDiagnosticos();
        break;
      case 3:
        $data['fechas'] = $this->Fechas_model->getEntregas();
        break;
    }
    $this->load->view('fechas/muestro',$data);
  }
  function agregoFecha(){
    $this->load->view('fechas/add');
  }
  function agregoFechaDo(){
    $datos = array(
        'tipo'        => $this->input->post('tipo'),
        'fecha'       => $this->input->post('fecha'),
        'hora_ini'    => $this->input->post('hora_ini'),
        'hora_fin'    => $this->input->post('hora_fin'),
        'programa_id' => $this->input->post('programa_id')
    );
    $id=$this->Fechas_model->add($datos);
  }  
  function borroFecha($id){
    $this->Fechas_model->borrar($id);
  }  
  function notaTutores(){
    $nombreFile = TXTFILES . "notatutores".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      $nota = "";
    }
    $this->load->model('programas_model');
    $programa=$this->Programas_model->getOnline();
    $data['fecha']=$programa->ciudadNombre . ", ". "Marzo de 2012";
    $data['destinatarios']="SEÑORES PADRES/TUTORES";
    $data['texto']=$nota;
    Template::set($data);
    Template::render();
  }
  function notaTutoresDo(){
    $nombreFile = TXTFILES . "notatutores".$this->session->userdata('programa_id').".txt";
    $archivo    = fopen($nombreFile, "w+");
    fwrite($archivo, $this->input->post('texto'));
    fclose($archivo);
    redirect('paper/', 'location', 301);
  }
  function cartaDiagnostico(){
    $nombreFile = TXTFILES . "cartadiagnosticoP1_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota1 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      $nota1 = "";
    }
    $nombreFile = TXTFILES . "cartadiagnosticoP2_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota2 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      $nota2 = "";
    }
    $nombreFile = TXTFILES . "cartadiagnosticoP3_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota3 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      $nota3 = "";
    }
    $this->load->model('programas_model');
    $programa=$this->Programas_model->getOnline();
    $data['fecha']=$programa->ciudadNombre . ", ". "Mayo de 2012";
    $data['destinatarios']="SEÑORES PADRES/TUTORES";
    $data['nota1']=$nota1;
    $data['nota2']=$nota2;
    $data['nota3']=$nota3;
    Template::set($data);
    Template::render();
  }
  function cartaDiagnosticoDo(){
    $nombreFile = TXTFILES . "cartadiagnosticoP1_".$this->session->userdata('programa_id').".txt";
    $archivo    = fopen($nombreFile, "w+");
    fwrite($archivo, $this->input->post('nota1'));
    fclose($archivo);
    $nombreFile = TXTFILES . "cartadiagnosticoP2_".$this->session->userdata('programa_id').".txt";
    $archivo    = fopen($nombreFile, "w+");
    fwrite($archivo, $this->input->post('nota2'));
    fclose($archivo);
    $nombreFile = TXTFILES . "cartadiagnosticoP3_".$this->session->userdata('programa_id').".txt";
    $archivo    = fopen($nombreFile, "w+");
    fwrite($archivo, $this->input->post('nota3'));
    fclose($archivo);
    redirect('paper/', 'location', 301);
  }
  function turnos(){
    $nombreFile = TXTFILES . "turnos_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      $nota = "";
    }
    $this->load->model('programas_model');
    $programa=$this->Programas_model->getOnline();
    $data['texto']=$nota;
    Template::set($data);
    Template::render();
  }
  function turnosDo(){
    $nombreFile = TXTFILES . "turnos_".$this->session->userdata('programa_id').".txt";
    $archivo    = fopen($nombreFile, "w+");
    fwrite($archivo, $this->input->post('texto'));
    fclose($archivo);
    redirect('paper/', 'location', 301);
  }
}
