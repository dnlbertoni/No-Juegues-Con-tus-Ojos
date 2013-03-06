<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->output->enable_profiler(ENVIRONMENT==='desarrollo');
    $programa=$this->Programas_model->getOnline();
    Template::set('database', $this->Programas_model->db->database);
    Template::set('nombrePrograma', (isset($programa->nombre))?$programa->nombre:'');
    Template::set_theme($this->session->userdata('tema'));
// menu
    if($this->session->userdata('status')==0){
      redirect('auth/login');
    }
    $this->load->model('Perfil_model');
    $this->load->model('UserModulos_model');
    $idUser=$this->session->userdata('user_id');
    $modulos=$this->UserModulos_model->getModulosFromUsers($idUser);
    Template::set('dataMenu', $modulos);
    Template::set_block('menu', '_menu');
  }
  function _formatFechaSave($fecha){
    $fX=explode('/', $fecha);
    return $fX[2]."-".$fX[1]."-".$fX[0];
  }
  function _formatFechaDisplay($fecha){
    $fX=explode('-', $fecha);
    return $fX[2]."/".$fX[1]."/".$fX[0];
  }
}
class Pub_Controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->output->enable_profiler(ENVIRONMENT==='desarrollo');
    $programa=$this->Programas_model->getOnline();
    Template::set('database', $this->Programas_model->db->database);
    Template::set('nombrePrograma', (isset($programa->nombre))?$programa->nombre:'');
    Template::set_theme($this->session->userdata('tema'));
  }
}