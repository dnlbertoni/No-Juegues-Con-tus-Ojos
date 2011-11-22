<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {
  function __construct() {
    parent::__construct();
    $ipDebags=array('192.168.1.2','192.168.0.8');
    $this->output->enable_profiler(in_array($_SERVER['REMOTE_ADDR'],$ipDebags));
    /*
    $modulos[] = array('link' => 'pesquiza', 'nombre'=>'Pesquiza','clase'=>'Bpesq');
    $modulos[] = array('link' => 'paper', 'nombre'=>'Papeleria','clase'=>'Bpaper');
    $modulos[] = array('link' => 'diagnostico', 'nombre'=>'Diagnostico','clase'=>'Bdiag');
    $modulos[] = array('link' => 'entrega', 'nombre'=>'Entrega Lentes','clase'=>'Bentr');
    $modulos[] = array('link' => 'admin', 'nombre'=>'Administracion','clase'=>'Badmi');
    $data['menu']=$modulos;
    Template::set('dataMenu',$data);
     * 
     */
  }
}