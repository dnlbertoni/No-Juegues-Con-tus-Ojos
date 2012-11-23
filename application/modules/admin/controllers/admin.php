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
    Template::render();
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
  function cartaLentes(){
    $nombreFile = TXTFILES . "cartalentesP1_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota1 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      $nota1 = "";
    }
    $nombreFile = TXTFILES . "cartalentesP2_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota2 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      $nota2 = "";
    }
    $nombreFile = TXTFILES . "cartalentesP3_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota3 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      $nota3 = "";
    }
    $this->load->model('programas_model');
    $programa=$this->Programas_model->getOnline();
    $data['fecha']=$programa->ciudadNombre . ", ". " Octubre de 2012";
    $data['destinatarios']="SEÑORES PADRES/TUTORES";
    $data['nota1']=$nota1;
    $data['nota2']=$nota2;
    $data['nota3']=$nota3;
    Template::set($data);
    Template::render();
  }
  function cartaLentesDo(){
    $nombreFile = TXTFILES . "cartalentesP1_".$this->session->userdata('programa_id').".txt";
    $archivo    = fopen($nombreFile, "w+");
    fwrite($archivo, $this->input->post('nota1'));
    fclose($archivo);
    $nombreFile = TXTFILES . "cartalentesP2_".$this->session->userdata('programa_id').".txt";
    $archivo    = fopen($nombreFile, "w+");
    fwrite($archivo, $this->input->post('nota2'));
    fclose($archivo);
    $nombreFile = TXTFILES . "cartalentesP3_".$this->session->userdata('programa_id').".txt";
    $archivo    = fopen($nombreFile, "w+");
    fwrite($archivo, $this->input->post('nota3'));
    fclose($archivo);
    redirect('paper/', 'location', 301);
  }
}
