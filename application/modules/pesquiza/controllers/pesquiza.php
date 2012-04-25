<?php
/**
 * Description of pesquiza
 *
 * @author dnl
 */
class Pesquiza extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Escuelas_model');
    $this->load->model('Voluntarios_model', '', true);
    $this->load->model('Pesquizas_model', '', true);
    $this->load->model('Casos_model');
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
    $data['pesquizas']=$this->Pesquizas_model->getIndexAgrupados();
    Template::set($data);
    Template::render();
  }
  function porEscuela($idEscuela){
    $pesquizas=$this->Pesquizas_model->getPorEscuela($idEscuela);
    $data['pesqui']=$pesquizas;
    $this->load->view('pesquiza/porEscuela',$data);
  }
  function observ($idEsc){
    $data['ocultos']=array('id'=>$idEsc);
    $escuela=$this->Escuelas_model->getById($idEsc);
    $data['observ']=$escuela->observaciones;
    $data['idTarget']='"#O'.$idEsc.'"';
    $this->load->view('pesquiza/observ',$data);
  }
  function observDo(){
    $datos=array('observaciones'=>$this->input->post('texto'));
    $this->Escuelas_model->update($datos,$this->input->post('id'));
  }
  function add($method="html"){
    $pesquiz = array( 'fecha' => '',
                      'voluntario_id'=>'',
                      'escuela_id'=>'',
                      'grado'=>'',
                      'division'=>'',
                      'cant_alum'=>'',
                      'cant_pres'=>'',
                      'cant_prob'=>''
                     );
    $data['pesq'] = (object) $pesquiz;
    if($method=="ajax"){
      $this->output->enable_profiler(false);
      $data['accion'] = 'pesquiza/addDo';
      $this->load->view('pesquiza/add', $data);
    }else{
      $data['accion'] = 'pesquiza/addDo';
      Template::set($data);
      Template::render();
    }
  }
  function addDo(){
    foreach($_POST as $key=>$valor){
      $datos[$key] = $valor;
    }
    //$id=$this->Pesquizas_model->add($datos);
    print_r($datos);
  }
  function borrar($id){
    $pesquiza=$this->Pesquizas_model->getById($id);
    $data['pesq']=$pesquiza;
    $this->load->model('Escuelas_model');
    $escuela=$this->Escuelas_model->getById($pesquiza->escuela_id);
    $data['escuelaNombre']=$escuela->nombre;
    $data['paginaDerivados'] ="'".base_url()."index.php/pesquiza/muestroDerivados/".$pesquiza->id."'";
    $data['accion']          ='pesquiza/borrarDo';
    $data['ocultos']         = array('id'=>$pesquiza->id);
    $data['textoBoton']      ="Borrar";
    Template::set($data);
    Template::set_view('pesquiza/add');
    Template::render();
  }
  function borrarDo(){
    $idPesq=$this->input->post('id');
    //borro los derivados
    $derivados = $this->Casos_model->getDerivadosPesquiza($idPesq);
    foreach($derivados as $der){
      $this->Casos_model->borrar($der->id);
    }
    //borro la pesquiza
    $this->Pesquizas_model->borrar($idPesq);
    Template::redirect('pesquiza/');
  }
  function searchDo(){
    $this->output->enable_profiler(false);
    echo $this->input->post('searchTXT');
  }
  function agregoAlumno($idPes){
    $this->output->enable_profiler(false);
    $this->load->model('Casos_model');
    $data['accion']  = 'pesquiza/agregoAlumnoDo';
    $data['ocultos'] = array('pesquiza_id'=>$idPes);
    $this->load->view('pesquiza/addAlumno', $data);
  }
  function agregoAlumnoDo(){
    $datos = array( 'apellido' => $this->input->post('apellido'),
                    'nombre'   => $this->input->post('nombre'),
                    'numdoc'   => $this->input->post('dni'),
                    'izq'      => $this->input->post('izq'), 
                    'der'      => $this->input->post('der'),
                    'pesquiza_id' => $this->input->post('pesquiza_id')
    );
    $id=$this->Casos_model->add($datos);    
  }
  function borroAlumno($id){
    $this->Casos_model->borrar($id);
  }
  function muestroDerivados($idPes){
    $this->output->enable_profiler(false);
    $data['derivados'] = $this->Casos_model->getDerivadosPesquiza($idPes);
    $this->load->view('pesquiza/viewDerivados', $data);
  }
  function generarAuto(){
    $programa = $this->Programas_model->getById($this->session->userdata('programa_id'));
    $data['titulo']="Genracion de Pesquiza Automatica";
    $fecha = new DateTime();
    $fecini = new DateTime();
    $fecfin = new DateTime();
    $data['fecha']=$fecha;
    $f=explode('-', $programa->fecini_pesq);
    $fecini->setDate($f[0],$f[1],$f[2]);
    $data['fechini']=$fecini;
    $f=explode('-', $programa->fecfin_pesq);
    $fecfin->setDate($f[0],$f[1],$f[2]);
    $data['fechfin']=$fecfin;
    $data['escuelasSel'] = $this->Escuelas_model->toDropdownEspecial('id', 'nombre');    
    $data['responsablesSel'] = $this->Pesquizas_model->toDropDownResponsables('id', 'nombre');
    $data['accion']='pesquiza/generarAutoDo';
    $this->load->view('pesquiza/generarAuto', $data);
  }
  function generarAutoDo(){
    $cursos = array('A', 'B', 'C', 'D', 'E', 'F', 'G');
    for($i=0;$i<$this->input->post('cantidad')&&$i<6;$i++){
      $datos = array( 'fecha'=>$this->_formatFechaSave($this->input->post('fecha')), 
                      'programa_id' => $this->session->userdata('programa_id'),
                      'escuela_id'  => $this->input->post('escuela'), 
                      'grado'       => $this->input->post('grado'), 
                      'division'    => $cursos[$i], 
                      'estado'      => 0
                    );
      $this->Pesquizas_model->add($datos);
    }
    Template::redirect('pesquiza');
  }
  function finalizar($id){
    $pesquiza=$this->Pesquizas_model->getById($id);
    $data['pesq']=$pesquiza;
    $this->load->model('Escuelas_model');
    $escuela=$this->Escuelas_model->getById($pesquiza->escuela_id);
    $data['escuelaNombre']=$escuela->nombre;
    $voluntario=$this->Voluntarios_model->getById($pesquiza->voluntario_id);
    $data['voluntarioNombre']=(isset($voluntario->nombre))?$voluntario->apellido.", ".$voluntario->nombre:"sin asignar";
    $data['accion']='pesquiza/finalizarDo';
    $data['textoBoton']="Finalizar";
    $data['paginaDerivados']="'".base_url()."index.php/pesquiza/muestroDerivados/".$pesquiza->id."'";
    $data['ocultos']=array('id'=>$id);
    Template::set($data);
    Template::set_view('pesquiza/add');
    Template::render();
  }
  function finalizarDo(){
    $this->output->enable_profiler(true);
    $datos = array(
        'fecha'         => $this->input->post('fecha'), 
        'division'      => $this->input->post('division'), 
        'turno'         => $this->input->post('turno'), 
        'cant_alum'     => $this->input->post('cant_alum'), 
        'cant_pres'     => $this->input->post('cant_pres'), 
        'cant_prob'     => $this->input->post('cant_prob'), 
        'voluntario_id' => $this->input->post('voluntario_id'),
        'estado'        => 2
    );
    $this->Pesquizas_model->update($datos,$this->input->post('id'));
    Template::redirect('pesquiza');
  }
  function realizada($idPesq){
    /*
    * modulo que genera una marca en la pesquiza para que quede pendiente de impresion de carta
    * cuando se imprime ahi recien se marca como impresa en el alumno
    */
    $this->Pesquizas_model->setEstado($idPesq,1);    
  }
  function enviarCarta($idPesq){
    /*
    * modulo que genera una marca en la pesquiza para que quede pendiente de impresion de carta
    * cuando se imprime ahi recien se marca como impresa en el alumno
    */
    $this->Pesquizas_model->setEstado($idPesq,3);
  }
}
