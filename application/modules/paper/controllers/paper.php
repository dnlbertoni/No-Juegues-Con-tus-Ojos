<?php
/**
 * Description of paper
 *
 * @author dnl
 */
class Paper extends MY_Controller{
  function __construct() {
    parent::__construct();
    if($this->session->userdata('status')==0){
      redirect('auth/login');
    }
    $this->load->model('Perfil_model');
    $this->load->model('UserModulos_model');
    $this->load->model('Casos_model', '', true);
    $this->load->model('Pesquizas_model', '', true);  
    $idUser=$this->session->userdata('user_id');
    $modulos=$this->UserModulos_model->getModulosFromUsers($idUser);
    Template::set('dataMenu', $modulos);
    Template::set_block('menu', '_menu'); 
    Template::set_block('lateral', '_lateral');     
  }
  function index(){
    Template::render();
  }
  function listadoLentes(){
    $estado = array ( 0 => 'Sin Diagnosticar',
                              1 => 'Carta Enviada',
                              2 => 'Diagnosticado',
                              3 => 'Pendiente Lente',
                              4 => 'Carta Enviada',
                              5 => 'Lentes',
                              6 => 'Terminado'
                            );
    $lentes= $this->Casos_model->getLentes($this->session->userdata('programa_id'));
    $this->load->library('pdfauto');
    $this->pdfauto->Open();
    $this->pdfauto->SetMargins(5,5,5);
    $this->pdfauto->SetAutoPageBreak(true);
    $this->pdfauto->SetDrawColor(128);
    $this->pdfauto->SetFillColor(200);
    $this->pdfauto->SetTopMargin(5);
    $this->pdfauto->AddPage();
    $renglon=0;
    foreach($lentes as $lente){
      $this->pdfauto->SetFont('Arial','',10);
      $caso = $this->Casos_model->detalleCaso($lente->id);
      /*encabezado*/
      if($renglon==0){
        $this->pdfauto->Cell(10,5,"Caso",1,0,'C',true);
        $this->pdfauto->Cell(80,5,"Apellido y Nombre",1,0,'C',true);
        $this->pdfauto->Cell(20,5,"DNI",1,0,'C',true);
        $this->pdfauto->Cell(50,5,"Colegio",1,0,'C',true);
        $this->pdfauto->Cell(20,5,"Grado",1,0,'C',true);
        $this->pdfauto->Cell(20,5,"Estado",1,1,'C',true);
        $renglon++;
      };
      $this->pdfauto->Cell(10,5,$caso->id,1,0,'R',false);
      $texto=sprintf("%s, %s", $caso->apellido, $caso->nombre);
      $this->pdfauto->Cell(80,5,  substr(utf8_decode($texto),0,40),1,0,'L',false);
      $this->pdfauto->Cell(20,5,$caso->numdoc,1,0,'R',false);
      $this->pdfauto->Cell(50,5,  substr($caso->colegio,0,18),1,0,'L',false);
      $texto=sprintf("%s %s", $caso->grado, $caso->division);
      $this->pdfauto->Cell(20,5,$texto,1,0,'R',false);
      $this->pdfauto->SetFont('Arial','',8);
      $this->pdfauto->Cell(20,5,$estado[$caso->estado],1,1,'R',false);
      //$this->pdfauto->Cell(5,5,$renglon,1,1,'R',false);
      $renglon=($renglon==57)?0:$renglon+1;
    };
    $this->pdfauto->AutoPrint(true);
    $this->pdfauto->Output();
  }
  function derivadosEscuela(){
    $data['accion']='paper/pdf/listadoPorEscuela';
    $data['pageEscuelas']= '"'. base_url().'index.php/diagnostico/searchEscuelas"';
    Template::set($data);
    Template::set_view('paper/seleccionarEscuela');
    Template::render();
  }
}
