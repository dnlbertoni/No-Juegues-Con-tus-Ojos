<?php
/**
 * Description of cfg
 *
 * @author dnl
 */
class Cfg extends MY_Controller{
  function __construct() {
    parent::__construct();
    if($this->session->userdata('status')==0){
      redirect('auth/login');
    }
    $this->load->model('Perfil_model');
    $this->load->model('UserModulos_model');
    $idUser=$this->session->userdata('user_id');
    $modulos=$this->UserModulos_model->getModulosFromUsers($idUser);
    $menu[] = array('link' =>'usuarios/perfil', 'nombre'=>'Perfil del Usuario', 'extra'=>'id="Perfil"');
    $menu[] = array('link' =>'usuarios/chngPass', 'nombre'=>'Contraseña', 'extra'=>'id="Password"');
    $menu[] = array('link' =>'auth/unregister', 'nombre'=>'Desvincularse', 'extra'=>'id="Eliminarse"');
    $menu[] = array('link' =>'auth/logout', 'nombre'=>'Salir', 'extra'=>'id="Logout"');
    //Template::set('linea', $menu);
    Template::set('dataMenu', $modulos);
    Template::set_block('menu', '_menu');
    Template::set_block('lateral', '_lateral');
  }
  function index(){
    $fecPesq = $this->Fechas_model->getPesquizas();
    $fecEntr = $this->Fechas_model->getEntregas();
    $data['programa']=$this->Programas_model->getById($this->session->userdata('programa_id'));
    Template::set('urlMuestroPesq', "'".base_url()."cfg/muestroFechas/1"."'");
    Template::set('urlMuestroDiags', "'".base_url()."cfg/muestroFechas/2"."'");
    Template::set('urlMuestroEntr', "'".base_url()."cfg/muestroFechas/3"."'");
    Template::set($data);
    Template::render();
  }
  function definirRoles(){
    $usuarios=$this->Users_model->getAll();
    $modulos=$this->Modulos_model->getAll();
    Template::set('usuarios',$usuarios);
    Template::set('modulos',$modulos);
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
}
