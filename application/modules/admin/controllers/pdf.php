<?php
/**
 * Description of pdf
 *
 * @author dnl
 */
class Pdf extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->library('fpdf');
  }
  function listadoTransporte($transporte=1){
    $this->load->model('Escuelas_model');
    $titulo=($transporte==1)?'Listado de Escuelas con Transporte':'Listado de Escuelas que van a la sede';
    $escuelas=$this->Escuelas_model->getEscuelasTransportes($transporte);
    $this->fpdf->Open();
    $this->fpdf->SetMargins(10,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetTopMargin(2);
    $hoja=0;
    $linea=0;
    $this->fpdf->AddPage();
    $this->_encabezado();
    //titulo listado
    $this->fpdf->SetFont('Arial','BU' ,14);
    $this->fpdf->Cell(0,10,$titulo, 0,1,'C',false);    
    $this->fpdf->Ln(5);
    foreach($escuelas as $escuela){
      $this->fpdf->SetFont('Arial','' ,14);
      $this->fpdf->Cell(150,10,  utf8_decode($escuela->nombre), 1,0,'L');
      $this->fpdf->Cell(20,10,$escuela->cantidad, 1,0,'C');
      $this->fpdf->Cell(20,10,' ', 1,1,'C');
      $linea++;
      if($linea>20){
        $linea=0;
        $hoja++;
        $this->fpdf->AddPage();
        $this->_encabezado();
        //titulo listado
        $this->fpdf->SetFont('Arial','BU' ,14);
        $this->fpdf->Cell(0,10,$titulo, 0,1,'C',false);    
        $this->fpdf->Ln(5);
      }
    };
    $file = "listado.pdf";
    $this->fpdf->Output($file,'I');
  }
  function _encabezado($rotary=true, $prosane=false,$x=0,$y=0){
    $this->fpdf->SetXY($x,$y+5);
    // Logo
    $this->fpdf->Image(IMGFILES.'wh-286.gif',$x+10,$y+5,17);
    // Arial bold 15
    $this->fpdf->SetFont('Arial','B',12);
    $this->fpdf->SetXY($x,$y+5);
    $this->fpdf->Cell(0,5,'No Juegues con tus Ojos',0,1,'C');          
    $this->fpdf->SetXY($x,$y+10);
    $this->fpdf->Cell(0,5,'Edicion 2012',0,1,'C');          
    // Títulos
    $this->fpdf->SetFont('Arial','',10);
    $this->fpdf->SetXY($x+32,$y+8);
    $this->fpdf->Cell(110,5,'Rotary Club',0,1,'L');      
    $this->fpdf->SetXY($x+32,$y+13);
    $this->fpdf->Cell(110,5,'Salto Grande Concordia',0,1,'L');      
    //prosane
    $this->fpdf->SetXY($x,$y+13);
    $this->fpdf->Cell(185,5,'Pro.San.E.',0,1,'R');      
    $this->fpdf->Image(IMGFILES.'logoER.gif',$x+190,$y+5,10);
    $this->fpdf->SetXY($x,$y+20);
    $this->fpdf->Cell(0,8," ",'B',1,'C');
    // Salto de línea
    $this->fpdf->SetXY($x,$y+30);    
  }
}