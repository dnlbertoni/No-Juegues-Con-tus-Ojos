<?php
/**
 * Description of paper/pdf
 *
 * @author dnl
 */
class Pdf extends MY_Controller{
  private $meses = array( '01'=>'Enero',
                          '02'=>'Febrero',
                          '03'=>'Marzo',
                          '04'=>'Abril',
                          '05'=>'Mayo',
                          '06'=>'Junio'
                        );

  function __construct() {
    parent::__construct();
    $this->load->library('fpdf');
    //$this->load->library('pdfauto');
    $this->load->model('Casos_model','',true);
  }
  function ordenEntregaLente($id){
    /**
    * imprime orden de entrega de Lente
    *
    * lee los articulos que le pasan en $items, lo arma y lo imprime
    *@param integer $id  numero de caso 
    */
    $caso = $this->Casos_model->detalleCaso($id);
    $renglon=0;
    $hoja=0;
    $total=0;
    $fechoy= new DateTime();
    $fecha = $fechoy->format("d-m-Y");
    $this->fpdf->Open();
    $cant=0;
    $copias = COPIAS;
    while($cant<$copias){
      $this->fpdf->SetMargins(0,0,0);
      $this->fpdf->SetAutoPageBreak(true);
      $this->fpdf->SetDrawColor(128);
      $this->fpdf->SetFillColor(200,200,200);
      $this->fpdf->SetTopMargin(0);
      //imprimo encabezado
      $this->fpdf->AddPage('P',array('100','148'));
      $this->fpdf->SetFont('Arial','b','14');
      $this->fpdf->Cell(0,5,CLUB_ROTARIO,0,1,'C');
      $this->fpdf->SetFont('Arial','','10');
      $this->fpdf->Cell(0,5,$this->session->userdata('programa_nombre'),1,1,'C');
      //Imprimo Cuerpo
      $this->fpdf->Cell(0,5,"Datos Personales",1,1,'C',true);
      $texto = sprintf("Caso: %s", $caso->id);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
      $texto = sprintf("Nombre: %s, %s", $caso->apellido,$caso->nombre);
      $this->fpdf->Cell(0,5,utf8_decode($texto),0,1,'L');
      $texto = sprintf("D.N.I: %s", $caso->numdoc);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
      $texto = sprintf("Fecha Nacimiento: %s ", $caso->fecnac);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
      $this->fpdf->Cell(0,5,"Datos Escolares",1,1,'C',true);
      $texto = sprintf("Escuela: ( %s ) %s", $caso->escuela_id, $caso->colegio);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
      $texto = sprintf("Grado: %s  %s", $caso->grado, $caso->division);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
      $this->fpdf->Cell(0,5,"Datos del Programa",1,1,'C',true);
      /* valido para el programa 2
      $texto = sprintf("Revisacion Nro: %s", $caso->pesquiza_id);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
      $texto = sprintf("Voluntario: ( %s ) %s, %s", $caso->voluntario, $caso->apevol, $caso->nomvol);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
      $texto = sprintf("Dia Revisacion: %s", $caso->fechapesq);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
       * 
       */
      $texto = sprintf("Dia Diagnostico: %s - %s ", $caso->fechadiag, $caso->horadiag);
      $this->fpdf->Cell(0,5,$texto,0,1,'L');
      $this->fpdf->Cell(60,5,"Se Receto Lentes ? ",0,0,'L');
      $texto=($caso->lentes==1)?"Si":"No";
      $this->fpdf->Cell(10,5,$texto,1,1,'C');   
      $this->fpdf->Ln(15);
      $this->fpdf->Cell(10,5,"",0,0,'C');   
      $this->fpdf->Cell(80,40,$fecha,1,1,'C');
      $cant++;
    }
    $this->fpdf->Output('ordenEntregaLente', 'I');
  }
  function imprimeEtiquetasLentes(){
    $lentes=$this->Casos_model->getLentes();
    $this->fpdf->Open();
    $this->fpdf->SetMargins(0,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetTopMargin(2);
    $this->fpdf->AddPage();
    $ancho=95;
    $alto=35;
    $margenL=10;
    $dato=0;
    $col=0;
    $row=0;
    foreach($lentes as $lente){
      $x=$col * $ancho;
      $y=$row * $alto + 7;
      $caso= $this->Casos_model->detalleCaso($lente->id);
      //$this->fpdf->Rect($x+$margenL,$y,$ancho,$alto,'');
      $this->fpdf->SetFont('Times','' ,14);
      $this->fpdf->SetXY($x+1+$margenL,$y+4);
      $this->fpdf->Image('assets/img/Logo_rysg.jpg',$x+1+$margenL,$y+6,25);
      $this->fpdf->SetXY($x+25+$margenL,$y+6);
      $texto=sprintf("%s, %s", $caso->apellido, $caso->nombre);
      $this->fpdf->MultiCell($ancho-25,5,utf8_decode($texto),0,'L');         
      $this->fpdf->SetXY($x+25+$margenL,$y+19);
      $texto=sprintf("DNI: %s",$caso->numdoc);
      $this->fpdf->Cell($ancho-25,0,$texto,0,0,'L');
      $this->fpdf->SetFont('Times','' ,10);
      $this->fpdf->SetXY($x+26+$margenL,$y+25);
      $texto=sprintf("( %s ) %s", $caso->escuela_id, $caso->colegio);
      $this->fpdf->Cell($ancho-50,0,$texto,0,1,'L');
      $this->fpdf->SetXY($x+26+$margenL,$y+30);
      $texto=sprintf("Grado: %s %s", $caso->grado, $caso->division);
      $this->fpdf->Cell($ancho-50,0,$texto,0,1,'L');
      $this->fpdf->SetFillColor(200);  
      $this->fpdf->Rect($x+$margenL+70,$y+12,18,18,'DF');
      $this->fpdf->SetXY($x+$margenL+70,$y+20);
      $this->fpdf->SetFont('Times','B' ,20);
      $this->fpdf->Cell($ancho-75,0,$caso->id,0,1,'C');
      $dato++;
      $col++;
      if($col>1){
        $col=0;
        $row++;
      };
      if($row>7){
        $row=0;
        $this->fpdf->AddPage();
      };  
    };
    //$actualizo =$this->Articulos_model->GraboImpresionPrecios($codigos);
    //echo $actualizo;
    $actualizo=true;
    if($actualizo){
      $file = "etiquetas.pdf";
      $this->fpdf->Output($file,'I');
      /*
      $cmd = sprintf("lp %s -d %s",$file,$this->Printer);
      shell_exec($cmd);          
      $cmd = sprintf("rm -f  %s",$file);
      shell_exec($cmd);          
       * 
       */
    };
    //redirect('carteles/', 'location',301);
  }
  function pesquizaPlanilla($pesquizas=false){
    $this->fpdf->Open();
    $this->fpdf->SetMargins(15,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetFillColor(200,200,200);
    $this->fpdf->SetTopMargin(0);
    if(!$pesquizas){
      $pesquiza = array ( 'escuela'=>'', 
                          'direccion'=>'', 
                          'curso'=>'', 
                          'division'=>'',
                          'voluntario'=>''
                        );
      $pesq[] = (object) $pesquiza;
    }else{
      $this->load->model('Pesquizas_model');
      if (is_array($pesquizas)){
        foreach($pesquizas as $pes){
          $pesq[] = $this->Pesquizas_model->detPesquiza($pes);
        }
      }else{
          $pesq[] = $this->Pesquizas_model->detPesquiza($pesquizas);        
      }
    }
    //inicio planilla
    foreach($pesq as $p){
      $this->fpdf->AddPage();
      $this->_encabezado();
      $this->fpdf->SetFont('Arial','b','10');
      $this->fpdf->SetXY(15,30);
      $this->fpdf->Cell(16,5,"Escuela",0,0,'L');
      $this->fpdf->Cell(74,5, substr($p->escuela, 0, 74) ,0,0,'L',($p->escuela!='') );
      $this->fpdf->Cell(20,5,"Direccion",0,0,'L');
      $this->fpdf->Cell(70,5, substr($p->direccion, 0, 70) ,0,1,'L', ($p->direccion!=''));
      $this->fpdf->Cell(16,5,"Curso",0,0,'L');  
      $this->fpdf->Cell(15,5, $p->curso,0,0,'L', ($p->curso!=''));
      $this->fpdf->Cell(20,5,"Division",0,0,'L');  
      $this->fpdf->Cell(15,5, $p->division,0,0,'L', ($p->division!=''));
      $this->fpdf->Cell(16,5,"Turno",0,0,'L');
      $this->fpdf->Cell(20,5,utf8_decode("Mañana"),1,0,'C');
      $this->fpdf->Cell(20,5,"Tarde",1,1,'C');    
      $this->fpdf->Cell(100,10,"Docente",0,0,'L');    
      $this->fpdf->Cell(27,10,"Voluntario:",0,0,'L', ($p->voluntario!=''));
      $this->fpdf->Cell(60,10, $p->voluntario,0,1,'L');    
      $this->fpdf->Cell(33,10,"Total Alumnos:",0,0,'L');      
      $this->fpdf->Cell(10,10," ",1,0,'R');        
      $this->fpdf->Cell(2,5," ",0,0,'R');    
      $this->fpdf->Cell(25,10,"Presentes:",0,0,'L');      
      $this->fpdf->Cell(10,10," ",1,0,'R');
      $this->fpdf->Cell(10,10," ",0,0,'R');    
      $this->fpdf->Cell(25,10,"Ausentes:",0,0,'L');      
      $this->fpdf->Cell(10,10," ",1,0,'R');      
      $this->fpdf->Cell(20,10,"Fecha",0,0,'R');    
      $this->fpdf->Cell(10,10," ",1,0,'R');    
      $this->fpdf->Cell(10,10," ",1,0,'R');    
      $this->fpdf->Cell(10,10," ",1,1,'R');    
      //$this->fpdf->Ln();
      $this->fpdf->SetXY(15,65);
      ///ENCABEZADO TABLA
      $this->fpdf->Cell(180,6,"Solo Alumnos para DERIVACION",1,1,'C',true);          
      $this->fpdf->Cell(10,6,"Nro.",1,0,'C', true);      
      $this->fpdf->Cell(50,6,"Apellido",1,0,'C', true);      
      $this->fpdf->Cell(50,6,"Nombre",1,0,'C',true);      
      $this->fpdf->Cell(40,6,"DNI",1,0,'C',true);      
      $this->fpdf->Cell(15,6,"Izq",1,0,'C', true);      
      $this->fpdf->Cell(15,6,"Der",1,1,'C', true);      
      for($i=0;$i<15;$i++){
        $this->fpdf->Cell(10,12,$i+1,1,0,'C', true);      
        $this->fpdf->Cell(50,12,"",1,0,'C');      
        $this->fpdf->Cell(50,12,"",1,0,'C');      
        $this->fpdf->Cell(40,12,"",1,0,'C');
        $this->fpdf->Line(165,89+($i*12),180,89+($i*12)-12);
        $this->fpdf->Cell(15,12,"10",1,0,'R');      
        $this->fpdf->Line(180,89+($i*12),195,89+($i*12)-12);
        $this->fpdf->Cell(15,12,"10",1,1,'R');      
      };
      $this->fpdf->SetFont('Arial','','10');    
      $nota[] = "Complete con datos de los niños del curso correspondiente";
      $nota[] = "Solo ingresar los niños, que en al menos en 1 (un) ojo las mediciones sean INFERIORES a 8/10 ";
      $nota[] = "Completar TODOS los datos del Niño derivado";
      $nota[] = "Adjuntar fotocopia del Registro de Alumnos";
      $this->fpdf->Cell(20,5,"Nota:","B",1,'L');
      foreach($nota as $n){
      $this->fpdf->Cell(20,5," * ". utf8_decode($n),0,1,'L');      
      };
    }
    //termino planilla
    $this->fpdf->Output('planilla.pdf','I');
  }
  function notaTutores($copias=2){
    /**
    * imprime carta de autorizacion de los padres/tutores a la pesquiza
    *
    * lee el archivo txt y arma la carta por la cantidad de copias necesarias
    *@param integer $id  numero de caso 
    */
    $this->load->model('programas_model');
    $programa=$this->Programas_model->getOnline();
    $renglon=0;
    $total=0;
    $fechoy = new DateTime();
    $aux =$fechoy->format("m");
    $fecha  = $programa->ciudadNombre  . ", " . $this->meses[$aux]." de ".$fechoy->format("Y");
    $destinatarios = "SEÑORES PADRES/TUTORES";
    $nombreFile = TXTFILES . "notatutores".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      redirect('admin/notaTutores','location',301);
    };
    $this->fpdf->Open();
    $cant=0;
    $fil=0;
    $col=0;
    $this->fpdf->SetMargins(0,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetFillColor(200,200,200);
    $this->fpdf->SetTopMargin(0);
    $this->fpdf->AddPage();
    while($cant<$copias){
      //imprimo encabezado
      $this->_encabezado(TRUE, TRUE, $col,$fil);
      //Imprimo Cuerpo
      //$this->fpdf->Ln();
      $this->fpdf->SetFont('Arial','',12);
      $this->fpdf->Cell(190,7,$fecha,0,1,'R');
      $this->fpdf->SetX(15);
      $this->fpdf->Cell(0,7,utf8_decode($destinatarios),0,1,'L');
      $this->fpdf->SetXY(15,$fil+45);
      $this->fpdf->MultiCell(180,7,utf8_decode($nota),0,'J');   
      $this->fpdf->Cell(150,7,'Apellido y Nombre:',0,1,'L');      
      $this->fpdf->Cell(150,7,'Grado:',0,1,'L');      
      $this->fpdf->Ln(3);
      $this->fpdf->Cell(150,7,'',0,0,'L');      
      $this->fpdf->Cell(50,7,"Autorizo",'T',1,'C');
      $xAux=$this->fpdf->GetX();
      $yAux=$this->fpdf->GetY();
      $cant++;
      if($cant<$copias){
        if($yAux+5 > 270){
          $this->fpdf->AddPage();
          $fil=0;
          $col=0;
        }else{
          $this->_lineaPunteada($xAux,210,$yAux+5);
          $fil=$yAux+5;
          $col=$this->fpdf->GetX();
        }
      }
    }
    $this->fpdf->Output('notaTutores', 'I');    
  }
  function cartaDiagnostico(){
    /**
    * imprime carta de autorizacion de los padres/tutores a la pesquiza
    *
    * lee el archivo txt y arma la carta por la cantidad de copias necesarias
    *@param integer $id  numero de caso 
    */
    $this->load->model('programas_model');
    $programa=$this->Programas_model->getOnline();
    $renglon=0;
    $total=0;
    $fechoy = new DateTime();
    $aux =$fechoy->format("m");
    $fecha  = $programa->ciudadNombre  . ", " . $this->meses[$aux]." de ".$fechoy->format("Y");
    $destinatarios = "SEÑORES PADRES/TUTORES";
    $nombreFile = TXTFILES . "cartadiagnosticoP1_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota1 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      redirect('admin/notaTutores','location',301);
    };
    $nombreFile = TXTFILES . "cartadiagnosticoP2_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota2 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      redirect('admin/notaTutores','location',301);
    };
    $nombreFile = TXTFILES . "cartadiagnosticoP3_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota3 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      redirect('admin/notaTutores','location',301);
    };
    $this->fpdf->Open();
    $cant=0;
    $this->fpdf->SetMargins(5,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetFillColor(200,200,200);
    $this->fpdf->SetTopMargin(0);
    while($cant<1){
      $fil=0;
      $col=0;
      $this->fpdf->AddPage();
      //imprimo encabezado
      $this->_encabezado(TRUE, TRUE, $col,$fil);
      //Imprimo Cuerpo
      $this->fpdf->SetFont('Arial','',12);
      $this->fpdf->Cell(190,7,$fecha,0,1,'R');
      $this->fpdf->SetX(15);
      $this->fpdf->Cell(0,7,utf8_decode($destinatarios),0,1,'L');
      $this->fpdf->SetX(15);
      $this->fpdf->MultiCell(180,7,utf8_decode($nota1),0,'J');   
      $this->fpdf->SetX(15);
      $this->fpdf->MultiCell(180,7,utf8_decode($nota2),0,'J');   
      $this->fpdf->SetX(15);
      $this->fpdf->MultiCell(180,7,utf8_decode($nota3),0,'J');   
      $this->fpdf->Ln(50);
      $xAux=$this->fpdf->GetX();
      $yAux=$this->fpdf->GetY();
      $this->_lineaPunteada($xAux,210,$yAux+5);
      $this->fpdf->Ln(10);
      $this->fpdf->Cell(90,7,sprintf('Escuela: %s - %s ','XX','nombre'),0,0,'L');      
      $this->fpdf->Cell(90,7,sprintf('Direccion: %s - %s ','direccion','ciudad'),0,1,'L');      
      $this->fpdf->Cell(50,7,sprintf('Grado: %s','9'),0,0,'L');      
      $this->fpdf->Cell(50,7,sprintf('Division: %s','A'),0,0,'L');      
      $this->fpdf->Cell(50,7,sprintf('Turno: %s',utf8_decode('Mañana')),0,1,'L');      
      $this->fpdf->Cell(150,7,sprintf('Apellido y Nombre: %s, %s','apellido','nombre'),0,1,'L');      
      $this->fpdf->Cell(150,7,sprintf('D.N.I: %s','XXXXXXXX'),0,1,'L');      
      $this->fpdf->Ln(3);
      $this->fpdf->Cell(150,7,'',0,0,'L');      
      $this->fpdf->Cell(50,7,"Autorizo",'T',1,'C');
      $cant++;
    }
    $this->fpdf->Output('cartadiagnostico', 'I');    
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
  function _lineaPunteada($empieza,$termina,$linea){
    for($i=$empieza;$i<$termina;$i=$i+5){
      $this->fpdf->Line($i,$linea,$i+3,$linea);      
    }
  }
}