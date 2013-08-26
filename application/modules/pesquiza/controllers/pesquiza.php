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
    $this->load->model('Fechas_model');

    $menu[] = array('link' =>'admin/escuelas/add', 'nombre'=>'Nueva Escuela', 'extra'=>'id="botEscuela"');
    $menu[] = array('link' =>'admin/voluntarios/add', 'nombre'=>'Nuevo Volun.', 'extra'=>'id="botVol"');
    $menu[] = array('link' =>'pesquiza/add', 'nombre'=>'Nueva Pesquiza', 'extra'=>'id="Pesq"');;
    Template::set_block('lateral', '_lateral');
  }
  function index(){
    $data['pesquizas']=$this->Pesquizas_model->getIndexAgrupados();
    Template::set($data);
    Template::render();
  }
  function porEscuela($idEscuela){
    //$this->output->enable_profiler(true);      
    $pesquizas=$this->Pesquizas_model->getPorEscuela($idEscuela);
    $data['pesqui']=$pesquizas;
    $this->load->view('pesquiza/porEscuela',$data);
  }
  function asignarVol($idPesquiza){
      $data['ocultos']=array('idPesquiza'=>$idPesquiza);
      $data['optVoluntarios']=$this->Voluntarios_model->toDropDown();
      $this->load->view('pesquiza/asignarVol', $data);
  }
  function asignaVolDo(){
      $valor = ($this->input->post('voluntario_id')=='NULL')?NULL:$this->input->post('voluntario_id');
      $datos = array('voluntario_id'=>$valor);
      $this->Pesquizas_model->update($datos, $this->input->post('idPesquiza'));
  }
  function listadoPorVoluntarios(){
    $this->output->enable_profiler(true);      
    $data['pesquizas']=$this->Pesquizas_model->getAgrupadosVoluntarios();
    Template::set($data);
    Template::render();
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
                      'tipo'     =>1,
                      'turno'     =>'M',
                      'cant_pres'=>'',
                      'cant_prob'=>''
                     );
    $data['pesq'] = (object) $pesquiz;

    $fecini = new DateTime();
    $fecfin = new DateTime();
    $f=explode('-', $this->Fechas_model->getPesquizas(false, true, false) );
    $fecini->setDate($f[0],$f[1],$f[2]);
    $data['fecini']=$fecini;
    $f=explode('-', $this->Fechas_model->getPesquizas(false, false, true));
    $fecfin->setDate($f[0],$f[1],$f[2]);
    $data['fecfin']=$fecfin;
    
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
    $data['tipos'][]=array('label'=>'Normal', 'value'=>1, 'valor'=>($pesquiza->tipo==1)?true:false);
    $data['tipos'][]=array('label'=>'Excepciones', 'value'=>2, 'valor'=>($pesquiza->tipo==2)?true:false);
    $data['tipos'][]=array('label'=>'Otro Programa', 'value'=>3, 'valor'=>($pesquiza->tipo==3)?true:false);
    $data['voluntarioNombre']=(isset($voluntario->nombre))?$voluntario->apellido.", ".$voluntario->nombre:"sin asignar";
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
    $f=explode('-', $this->Fechas_model->getPesquizas(false, true, false) );
    $fecini->setDate($f[0],$f[1],$f[2]);
    $data['fechini']=$fecini;
    $f=explode('-', $this->Fechas_model->getPesquizas(false, false, true));
    $fecfin->setDate($f[0],$f[1],$f[2]);
    $data['fechfin']=$fecfin;
    $data['escuelasSel'] = $this->Escuelas_model->toDropdownEspecial('id', 'nombre');
    $data['responsablesSel'] = $this->Pesquizas_model->toDropDownResponsables('id', 'nombre');
    $data['accion']='pesquiza/generarAutoDo';
    $this->load->view('pesquiza/generarAuto', $data);
  }
  function generarAutoDo(){
      $cursos=array();
      $division=array();
      foreach($_POST as $key=>$value){
          if(preg_match('/^g_/', $key)){
              $cursos[]=$value;
          }else{
            if(preg_match('/^d_/', $key)){
                $division[]=$value;
            }else{
                continue;
            }
          }
      }
      foreach($cursos as $curso){
        foreach($division as $divi){
          $datos = array( 'fecha'=>$this->_formatFechaSave($this->input->post('fecha')),
                          'programa_id' => $this->session->userdata('programa_id'),
                          'escuela_id'  => $this->input->post('escuela'),
                          'grado'       => $curso,
                          'turno'       => 'M',
                          'tipo'        => 1,
                          'division'    => $divi,
                          'estado'      => PESQUIZA_PENDIENTE
                        );
          $this->Pesquizas_model->add($datos);
        }
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
    $data['tipos'][]=array('label'=>'Normal', 'value'=>1, 'valor'=>($pesquiza->tipo==1)?true:false);
    $data['tipos'][]=array('label'=>'Excepciones', 'value'=>2, 'valor'=>($pesquiza->tipo==2)?true:false);
    $data['tipos'][]=array('label'=>'Otro Programa', 'value'=>3, 'valor'=>($pesquiza->tipo==3)?true:false);
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
        'tipo'          => $this->input->post('tipo'),
        'estado'        => PESQUIZA_FINALIZADA
    );
    $this->Pesquizas_model->update($datos,$this->input->post('id'));
    Template::redirect('pesquiza');
  }
  function realizada($idPesq){
    /*
    * modulo que genera una marca en la pesquiza para que quede pendiente de impresion de carta
    * cuando se imprime ahi recien se marca como impresa en el alumno
    */
    $this->Pesquizas_model->setEstado($idPesq,PESQUIZA_REALIZADA);
  }
  function enviarCarta($idPesq){
    /*
    * modulo que genera una marca en la pesquiza para que quede pendiente de impresion de carta
    * cuando se imprime ahi recien se marca como impresa en el alumno
    */
    $this->Pesquizas_model->setEstado($idPesq,PESQUIZA_CARTAS);
  }
  function imprimirCartas(){
        $data['finalizadas']=$this->Pesquizas_model->getByEstado(PESQUIZA_FINALIZADA);
        $data['cartas']=$this->Pesquizas_model->getByEstado(PESQUIZA_CARTAS);
        $data['titulo']='Impresion de Cartas';
        $data['texto']='Imrpimir Cartas';
        $data['accion']='paper/pdf/cartaDiagnostico';
  	Template::set($data);
  	Template::render();
  }
  function definirTurnos(){
    $this->output->enable_profiler(false);
    $cartas=$this->Pesquizas_model->getByEscuelasEstado(PESQUIZA_CARTAS);
    $data['pendientes']=0;
    foreach ($cartas as $carta){
      $data['pendientes'] += $carta->cant_prob;
    }
    $data['xTurnos']=$this->Pesquizas_model->getAgrupadosPorTurnos();
    $cartas=$this->Pesquizas_model->getByEscuelasEstado(PESQUIZA_CARTAS);
    $turnos=$this->Pesquizas_model->getByEscuelasEstado(PESQUIZA_TURNOS);
    $data['pesquizas']=array_merge($cartas, $turnos);
    Template::set($data);
    Template::render();
  }
  function asignarTurnoTransporte($idEsc){
    $this->output->enable_profiler(false);
    $data['ocultos']=array('escuela'=>$idEsc);
    $data['tiempoViajes']=array('0'=>0,'15'=>15,'30'=>30,'45'=>45,'60'=>60,'90'=>90,'120'=>120);
    $data['escuela']=$this->Escuelas_model->getById($idEsc);
    $this->load->model('Programas_model');
    $programa=$this->Programas_model->getFechasDiag();
    $fIni=new DateTime($programa->inicio);
    $fFin=new DateTime($programa->final);
    $fFin->modify('+1 day');
    do{
      $data['diasTurnos'][]=array('label'=>$fIni->format('d-m-Y'),'value'=>$fIni->format('Y-m-d'));
      $fIni->modify('+1 day');
    }while ($fFin->format('d-m-Y')!=$fIni->format('d-m-Y'));
    $this->load->view('pesquiza/addTT', $data);
  }
  function asignarTurnoTransporteDo(){
    $this->output->enable_profiler(false);
    $this->Pesquizas_model->asignoTurno(  $this->input->post('escuela'),
                                          $this->input->post('dia'),
                                          $this->input->post('hora'),
                                          $this->input->post('transporte'),
                                          $this->input->post('viaje'));
    /*
    $pesq=$this->Pesquizas_model->getTurnoEscuela($this->input->post('escuela'));
    $resultado = <<<TEXTO
      <td>$pesq->escuela_id - $pesq->escuela</td>
      <td>Fecha: $pesq->turno</td>
      <td>Hora :$pesq->hora</td>
      <td>$pesq->direccion</td>
      <td>$pesq->ciudad</td>
      <td class="transporte">$pesq->transporte</td>
      <th>$pesq->cant_prob</th>
      <td class="estados" ><?php echo $pesq->estado?></td>
TEXTO;
    $resultado .= "<td >Turno recien Asignado</td>";
    echo $resultado;
     *
     */
  }
  function definirTransporte(){
    $this->output->enable_profiler(false);
    $finalizadas=$this->Pesquizas_model->getByEscuelasEstado(PESQUIZA_FINALIZADA);
    $data['pesqFin']=$finalizadas;
    Template::set($data);
    Template::render();
  }
  function asignoTransporte($idEsc, $transporte){
    $this->Pesquizas_model->asignoTransporte($idEsc,$transporte);
  }
  function imprimirTurnos(){
  	$data['finalizadas']=$this->Pesquizas_model->getByEstado(PESQUIZA_TURNOS);
    $data['titulo']='Impresion de turnos';
    $data['texto']='Imrpimir Turnos';
    $data['accion']='paper/pdf/turnos';
    Template::set_view('pesquiza/imprimirCartas');
  	Template::set($data);
  	Template::render();
  }
}
