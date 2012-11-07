<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pdf
 *
 * @author dnl
 */
class Pdf extends MY_Controller{
  function __construct() {
    parent::__construct();
    $this->load->library('fpdf');
    //$this->load->library('pdfauto');
    $this->load->model('Casos_model','',true);
  }
  function listadoPorEscuela(){
    $this->fpdf->Open();
    $this->fpdf->SetMargins(10,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetFillColor(128,128,128);
    $this->fpdf->SetTopMargin(2);
	$this->fpdf->SetFont('Arial','',10);        
    $alumnos=$this->Casos_model->getAlumnosLentes();
    $escAux=false;
    foreach($alumnos as $alu){
      if($escAux!=$alu->escuela_id){
        if($escAux){
          $this->fpdf->Cell(150,5,'Total Alumnos',1,0,'C',true); 
          $this->fpdf->Cell(35,5,$totAlu,1,0,'C',true); 
        }
        $escAux=$alu->escuela_id;
        $totAlu=0;
        $this->fpdf->AddPage();
        $this->_encabezado(true, true);
        $renglon=0;
        $this->fpdf->Cell(65,5,$alu->escuela_nom,0,0,'C');      
        $this->fpdf->Cell(85,5,$alu->escuela_dir,0,0,'C');      
        $this->fpdf->Cell(35,5,$alu->escuela_ciu,0,1,'C');                
        $this->fpdf->Ln(10);
        $this->fpdf->Cell(15,5,'Caso',1,0,'C',true);        
        $this->fpdf->Cell(15,5,'Grado',1,0,'C',true);
        $this->fpdf->Cell(15,5,'Division',1,0,'C',true);
        $this->fpdf->Cell(80,5,'Apellido y Nombre',1,0,'L', true);
        $this->fpdf->Cell(25,5,'DNI',1,1,'C', true);
        $renglon++;
      }
      if($renglon==0){
        $this->fpdf->Cell(65,5,$alu->escuela_nom,0,0,'C');      
        $this->fpdf->Cell(85,5,$alu->escuela_dir,0,0,'C');      
        $this->fpdf->Cell(35,5,$alu->escuela_ciu,0,1,'C');                
        $this->fpdf->Ln(10);
        
        $this->fpdf->Cell(15,5,'Caso',1,0,'C',true);        
        $this->fpdf->Cell(15,5,'Grado',1,0,'C',true);
        $this->fpdf->Cell(15,5,'Division',1,0,'C',true);
        $this->fpdf->Cell(80,5,'Apellido y Nombre',1,0,'L', true);
        $this->fpdf->Cell(25,5,'DNI',1,1,'C', true);
      };
      $this->fpdf->Cell(15,5,$alu->id,1,0,'C');
      $this->fpdf->Cell(15,5,$alu->grado,1,0,'C');
      $this->fpdf->Cell(15,5,$alu->division,1,0,'C');      
      $this->fpdf->Cell(80,5, utf8_decode($alu->apellido.', '.$alu->nombre),1,0,'L');
      $this->fpdf->Cell(25,5,$alu->dni,1,1,'C');
      $renglon++;
      $totAlu++;
      $escuelas[$alu->escuela_id]=array('nombre'=>$alu->escuela_nom, 'direccion'=>$alu->escuela_dir, 'ciudad'=>$alu->escuela_ciu, 'total'=>$totAlu);
      if($renglon>30){
        $renglon=0;
        $this->fpdf->AddPage();
      }
    }
    $this->fpdf->AddPage();
    $this->_encabezado(true, true);
    $this->fpdf->Ln();
    $this->fpdf->Cell(70,5,'Escuela',1,0,'C',true);        
    $this->fpdf->Cell(50,5,'Direccion',1,0,'C',true);
    $this->fpdf->Cell(50,5,'Ciudad',1,0,'C',true);
    $this->fpdf->Cell(10,5,'Cant.',1,1,'L', true);
    $totEsc=0;
    $totlentes=0;
    $renglon=1;
    foreach($escuelas as $esc){
      $this->fpdf->Cell(70,5,$esc['nombre'],1,0,'L',false);        
      $this->fpdf->Cell(50,5,$esc['direccion'],1,0,'L',false);
      $this->fpdf->Cell(50,5,$esc['ciudad'],1,0,'C',false);
      $this->fpdf->Cell(10,5,$esc['total'],1,1,'R', false);
      $totEsc++;
      $renglon++;
      $totlentes+=$esc['total'];
      if($renglon>45){
        $this->fpdf->AddPage();
        $this->_encabezado(true, true);
        $this->fpdf->Ln();
        $renglon=1;
      }
    }
    $this->fpdf->Cell(150,5,'Total Escuelas',1,0,'C',true); 
    $this->fpdf->Cell(30,5,$totEsc,1,1,'C',true); 
    $this->fpdf->Cell(150,5,'Total Lentes',1,0,'C',true); 
    $this->fpdf->Cell(30,5,$totlentes,1,1,'C',true); 
    $this->fpdf->Output('listado.pdf', 'I');    
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
    if($prosane){
      $this->fpdf->SetXY($x,$y+13);
      $this->fpdf->Cell(185,5,'Pro.San.E.',0,1,'R');      
      $this->fpdf->Image(IMGFILES.'logoER.gif',$x+190,$y+5,10);
      $this->fpdf->SetXY($x,$y+20);
    }
    $this->fpdf->Cell(0,8," ",'B',1,'C');
    // Salto de línea
    $this->fpdf->SetXY($x,$y+30);    
  }  
}
