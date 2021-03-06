<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of diagnostico
 *
 * @author dnl
 */
class Diagnostico extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model('Escuelas_model');
    $this->load->model('Casos_model');
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
  function index(){
    $this->output->enable_profiler(false);
    $menu[] = array('link' =>'diagnostico/buscoTurno/ajax',    'nombre'=>'F1 - Por Turno',    'extra'=>'id="botTurno"');
    $menu[] = array('link' =>'diagnostico/buscoDNI/ajax',      'nombre'=>'F2 - Por DNI',      'extra'=>'id="botDNI"');
    $menu[] = array('link' =>'diagnostico/buscoApellido/ajax', 'nombre'=>'F3 - Por Apellido', 'extra'=>'id="botApellido"');
    $menu[] = array('link' =>'diagnostico/buscoEscuela/ajax',  'nombre'=>'F4 - Por Escuela',  'extra'=>'id="botEscuela"');
    $menu[] = array('link' =>'diagnostico/addManual',          'nombre'=>'F6 - Sin Turno',    'extra'=>'id="botAdd"');
    $dataLateral['linea']=$menu;
    $dataLateral['titulo']='Busquedas';
    Template::set($dataLateral);
    Template::set_block('lateral', '_lateral');
    /*
     * defino datos a visualizar
     */
    $datosDia = $this->Casos_model->datosPorDia();
    $data['datosDia']=$datosDia;
    $data['datosTotal']=$this->Casos_model->datosTotal();    
    $data['promIngreso']=$this->Casos_model->promedioIngresos();
    $data['promTiempo']=$this->Casos_model->promedioTiempo();
    Template::set($data);
    Template::render();
  }
  function buscoTurno($method="ajax"){
    $data['texto']='Turno:';
    $data['accion']="diagnostico/turnoDo";
    if($method=="ajax"){
      $this->load->view('diagnostico/search',$data);
    }
  }
  function turnoDo(){
    $idTurno=$this->input->post('texto');
    $nene     = $this->Casos_model->getByTurno($idTurno);
    if(!$nene){
      $data['mensaje']="El turno ".$idTurno." ingresado no se encuentra registrado en nuestra base de datos";
      $this->load->view('diagnostico/error',$data);      
    }else{
      $x=0;
      foreach($nene as $n){
        $id[$x]=$n->escuela_id;
        $nombre[$x]=$n->escuela;
        $x++;
      } 
      $aux = array_unique($id);
      $x=0;
      foreach ($aux as $key=>$value){
        $escuela[$x]['id']=$value;
        $escuela[$x]['nombre']=$nombre[$key];
        $x++;
      };
      $data['escuelas'] =$escuela;
      $data['nene']=$nene;
      $this->load->view('diagnostico/resultadoAjax',$data);            
    }
  }  
  function buscoDNI($method="ajax"){
    $data['texto']='DNI:';
    $data['accion']="diagnostico/dniDo";
    if($method=="ajax"){
      $this->load->view('diagnostico/search',$data);
    }
  }
  function dniDo(){
    $dni=$this->input->post('texto');
    $nene     = $this->Casos_model->getByDni($dni);
    if(!$nene){
      $data['mensaje']="El numero DNI ".$dni." ingresado no se encuentra registrado en nuestra base de datos";
      $this->load->view('diagnostico/error',$data);      
    }else{
      $x=0;
      foreach($nene as $n){
        $id[$x]=$n->escuela_id;
        $nombre[$x]=$n->escuela;
        $x++;
      } 
      $aux = array_unique($id);
      $x=0;
      foreach ($aux as $key=>$value){
        $escuela[$x]['id']=$value;
        $escuela[$x]['nombre']=$nombre[$key];
        $x++;
      };
      $data['escuelas'] =$escuela;
      $data['nene']=$nene;
      $this->load->view('diagnostico/resultadoAjax',$data);            
    }
  }
  function buscoApellido($method="ajax"){
    $data['texto']='Apelldio:';
    $data['accion']="diagnostico/apellidoDo";
    if($method=="ajax"){
      $this->load->view('diagnostico/search',$data);
    }
  }  
  function apellidoDo(){
    $apellido=$this->input->post('texto');
    $nene = $this->Casos_model->getByApellido($apellido);
    if(!$nene){
      $data['mensaje']="No existen registros con el apellido:  ".$apellido."  en nuestra base de datos";
      $this->load->view('diagnostico/error',$data);      
    }else{
      $x=0;
      foreach($nene as $n){
        $id[$x]=$n->escuela_id;
        $nombre[$x]=$n->escuela;
        $x++;
      } 
      $aux = array_unique($id);
      $x=0;
      foreach ($aux as $key=>$value){
        $escuela[$x]['id']=$value;
        $escuela[$x]['nombre']=$nombre[$key];
        $x++;
      };
      $data['escuelas'] =$escuela;
      $data['nene']=$nene;
      $this->load->view('diagnostico/resultadoAjax',$data);            
    }
  }  
  function buscoEscuela($method="ajax"){
    $data['texto']='Escuela:';
    $data['pageEscuelas']= '"'. base_url().'index.php/diagnostico/searchEscuelas"';
    $data['escuelas']=$this->Escuelas_model->toDropDownEspecial('id', 'nombre');
    $data['accion']="diagnostico/escuelasDo";
    if($method=="ajax"){
      $this->load->view('diagnostico/search',$data);
    }
  }
  function searchEscuelas(){
    $valor=$this->input->get('term');
    $escuelas = $this->Escuelas_model->getNombres($valor);
    $cant=0;
    $resultado = '[ ';
    foreach($escuelas as $e){
      $resultado .=  ($cant>0)?', ':'';
      $resultado .= '{"id":"'.$e->id.'", "label":"'.$e->escuela.'", "value":"'.$e->id.'"}';
      $cant++;
    }
    $resultado .= '] ';
    echo $resultado;
  }
  function escuelasDo(){
    $esc=$this->input->post('texto');
    $nene = $this->Casos_model->getByEscuela($esc);
    $escu=$this->Escuelas_model->getById($esc);
    if(!$nene){
      $data['mensaje']="No existen chicos con posibles problemas cargados para la escuela:  ".$escu->nombre."  en nuestra base de datos para este Programa";
      $this->load->view('diagnostico/error',$data);      
    }else{
      $x=0;
      foreach($nene as $n){
        $id[$x]=$n->escuela_id;
        $nombre[$x]=$n->escuela;
        $x++;
      } 
      $aux = array_unique($id);
      $x=0;
      foreach ($aux as $key=>$value){
        $escuela[$x]['id']=$value;
        $escuela[$x]['nombre']=$nombre[$key];
        $x++;
      };
      $data['escuelas'] =$escuela;
      $data['nene']=$nene;
      $this->load->view('diagnostico/resultadoAjax',$data);            
    }
  }   
  function recibir($id=false){
    $caso=$this->Casos_model->detalleCaso($id);
    $caso->fecnac=($caso->fecnac=="0000-00-00")?'':$caso->fecnac;
    $data['ocultos']=array('id'=>$caso->id, 'edad'=>$caso->edad,'programa_id'=>$this->session->userdata('programa_id'));
    $data['caso']=$caso;
    Template::set($data);
    Template::render();
  }
  function hojaruta(){
    $this->output->enable_profiler(true);
    //actualizo los datos
    foreach ($_POST as $key => $value) {
      if(!preg_match('/(id)/', $key)){
        $datos[$key]=$value;
      }
    };
    $this->Casos_model->update($datos, $this->input->post('id'));
    // marco como en proceso
    // pongo hora de inicio
    $this->Casos_model->recibirNene($this->input->post('id'));
    // imprimo hoja de ruta
    //redirect('paper/pdf/hojaDeRuta/'.$this->input->post('id'), 'location', 301);
  }
  function confirmaPresencia(){
    $data['titulo']='Confirmar Asistencia al Diagnostico';
    $data['accion']='diagnostico/confirmaPresenciaDo';
    $data['pagina']='"'.base_url().'index.php/diagnostico/listaConfirmaciones"';
    $data['texto']="Confirmar";
    Template::set($data);
    Template::set_view('diagnostico/fastCierre');
    Template::render();
  }
  function listaConfirmaciones(){
    $alumnos=$this->Casos_model->getConfirmados();
    $data['chicos']=$alumnos;
    $this->load->view('listaConfirmaciones', $data);
  }
  function confirmaPresenciaDo(){
    $id=$this->input->post('texto');
    $id=$this->_decodeEAN13($id);
    $alumnos=$this->Casos_model->getConfirmados();
    $data['chicos']=$alumnos;
    $this->load->view('listaConfirmaciones', $data);
  }
  function finalizaProceso(){
    $data['titulo']='Finalizar Proceso de  Diagnostico';
    $data['accion']='diagnostico/finalizaProcesoDo';
    $data['pagina']='"'.base_url().'index.php/diagnostico/listaFinalizados"';
    $data['texto']="Finalizar";
    Template::set($data);
    Template::set_view('diagnostico/fastCierre');
    Template::render();
  }
  function listaFinalizados(){
    $alumnos=$this->Casos_model->getFinalizados();
    $data['chicos']=$alumnos;
    $this->load->view('listaFinalizados', $data);
  }
  function finalizaProcesoDo(){
    $this->output->enable_profiler(false);
    $id     = $this->input->post('texto');
    $id     = $this->_decodeEAN13($id);
    if($id){
      $idCaso = intval($id/10);
      $estado = $id - ($idCaso*10);
      if($estado==1){
        $leyenda="Se le han asignado Lentes";
        $clase="notification info";
      }else{
        $leyenda="NO le han asignado Lentes";
        $clase="notification ok";
      };
      $this->Casos_model->finalizarCaso($idCaso, $estado);
    }else{
        $idCaso=$this->input->post('texto');
        $leyenda="POSEE ERROR EN LA CARGA DEL CODIGO";
        $clase="notification error";
    }
    $mensaje=sprintf("<div class='%s'>Al Caso %s %s</div>", $clase, $idCaso, $leyenda);
    $alumnos=$this->Casos_model->getFinalizados();
    $data['chicos']=$alumnos;
    $data['mensaje']=$mensaje;
    $this->load->view('listaFinalizados', $data);
  }
  function _decodeEAN13($barcode){
      $sum=0;
      $numero=intval($barcode/10);
      $barcode=  str_pad($barcode, 13, '0', STR_PAD_LEFT);
      for($i=1;$i<=11;$i+=2)
          $sum+=3*$barcode{$i};
      for($i=0;$i<=10;$i+=2)
          $sum+=$barcode{$i};
      if(($sum+$barcode{12})%10==0){
        return $numero;
      } else {
        return false; 
      }    
  }
  function _encodeEAN13($barcode){
    $barcode=  str_pad($barcode, 12, '0', STR_PAD_LEFT);
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    $r=$sum%10;
    if($r>0)
        $r=10-$r;
    return $barcode.$r;    
  }
  /*
   * Agregar un chicos que no se haya visto en una pesquiza y vaya al diagnostico
   * 
   */
  function addManual(){
    $fechoy= new DateTime();
    $c = array( 'id'=>'',
                'apellido'=>'',
                'nombre'=>'',
                'sexo'=>'',
                'dni'=>0,
                'fecnac'=>'',
                'escuela'=>'',
                'ciudad'=>'',
                'grado'=>'',
                'division'=>'A',
                'fechapesq'=>$fechoy->format('Y-m-d'),
                'voluntario'=>1,
                'dia'=>$fechoy->format('d-m'),
                'hora'=>$fechoy->format('h:s'),        
                'carta'=>1,
                'confirmo'=>0,
                'tipopesq'=>2,
                'edad'=>0,
                'programa_id'=>'');
    $caso= (object)$c;
    $this->load->model('Escuelas_model');
    $this->load->model('Ciudades_model');
    $data['escuelas'] = $this->Escuelas_model->toDropdownEspecial('id','nombre');
    $data['ciudades'] = $this->Ciudades_model->toDropdown('id','nombre');
    $data['turnos'] = array('M','T');
    $data['ocultos']=array('id'=>$caso->id, 'edad'=>$caso->edad,'programa_id'=>$this->session->userdata('programa_id'));
    $data['caso']= $caso;
    $this->load->view('diagnostico/addManual',$data);
  }
}
