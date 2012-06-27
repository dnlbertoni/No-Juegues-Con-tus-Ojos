<?php
/**
 * Description of paper/pdf
 *
 * @author dnl
 */
class Pdf extends MY_Controller{
  private $meses = array( 
                          '01'=>'Enero',
                          '02'=>'Febrero',
                          '03'=>'Marzo',
                          '04'=>'Abril',
                          '05'=>'Mayo',
                          '06'=>'Junio',
                          '07'=>'Julio',
                          '08'=>'Agosto',
                          '09'=>'Septiembre',
                          '10'=>'Octubre',
                          '11'=>'Noviembre',
                          '12'=>'Diciembre'
                        );
  function __construct() {
    parent::__construct();
    $this->load->library('fpdf');
    //$this->load->library('pdfauto');
    $this->load->model('Casos_model','',true);
    $this->load->model('Pesquizas_model','',true);
  }
  function hojaDeRuta($id=false){
    /**
    * imprime hoja de Ruta
    *
    *@param integer $id  numero de caso  si es falso imprime en blanco
    */
    if($id){
      $caso = $this->Casos_model->detalleCaso($id);
    }else{
      $cas=array( 'id'=>'', 
                  'nombre'=>'',
                  'apellido'=>'',
                  'sexo'=>'',
                  'escuela_num'=>'',
                  'escuela'=>'',
                  'grado'=>'',
                  'edad'=>'',
                  'dni'=>''
                );
      $caso=(object) $cas;
    };
    $renglon=0;
    $hoja=0;
    $total=0;
    $fechoy= new DateTime();
    $fecha = $fechoy->format("d-m-Y H:i");
    $cant=0;
    $copias = COPIAS;
    $copias = 2;
    $this->fpdf->Open();
    $this->fpdf->SetMargins(25,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(0);
    $this->fpdf->SetFillColor(0,0,0);
    $this->fpdf->SetTopMargin(0);
    $this->fpdf->SetFont('Arial','',12);      
    $this->fpdf->AddPage();
    $col=25;
    $fil=0;
    while($cant<$copias){
      //imprimo encabezado
      $this->_encabezadoHojaRuta(true, $id, $col, $fil);
      //Imprimo Cuerpo    
      $this->fpdf->SetFont('Arial','',12);
      $texto = sprintf("Nombre: %s, %s", $caso->apellido,$caso->nombre);
      $this->fpdf->Cell(150,6,utf8_decode($texto),0,1,'L');
      $texto = sprintf("D.N.I: %s", $caso->dni);
      $this->fpdf->Cell(80,6,$texto,0,0,'L');
      $texto = sprintf("Edad: %s ", $caso->edad);
      $this->fpdf->Cell(25,6,$texto,0,0,'L');
      $texto = sprintf("Sexo: %s ", ($caso->sexo=="M")?"VARON":"MUJER");
      $this->fpdf->Cell(0,6,$texto,0,1,'L');
      $texto = sprintf("Escuela: ( %s ) %s", $caso->escuela_num, $caso->escuela);
      $this->fpdf->Cell(105,6,$texto,0,0,'L');
      $texto = sprintf("Grado: %s  ", $caso->grado);
      $this->fpdf->Cell(0,6,$texto,0,1,'L');
      $yAux=$this->fpdf->GetY();

      $this->fpdf->SetFont('Arial','B',12);
      $this->fpdf->Cell(40,10,"Lentes SI",0,1,'C');
      $this->fpdf->EAN13(25,$yAux+10,$caso->id . 1);
      
      $this->fpdf->SetXY(60,$yAux);
      $this->fpdf->Cell(100,5,"Modelo de Armazon",0,1,'C');
      $this->fpdf->SetXY(60,$yAux);
      $this->fpdf->Cell(110,25,"",1,1,'C');
      
      $this->fpdf->SetXY(173,$yAux);
      $this->fpdf->SetFont('Arial','B',12);
      $this->fpdf->Cell(40,10,"Lentes NO",0,1,'C');
      $this->fpdf->EAN13(173,$yAux+10,$caso->id . 0);

      $yAux=$this->fpdf->GetY()+20;
      $this->fpdf->SetXY(0,$yAux);
      $this->fpdf->Cell(0,7,$fecha,0,1,'C');
      $this->fpdf->SetFont('Arial','B',6);     
      $this->fpdf->Cell(0,7,($cant==0)?"(Talon para adjuntar a la Receta)":"(Para Archivo de Rotary)",0,1,'C');
      $xAux=$this->fpdf->GetX();
      $yAux=$this->fpdf->GetY();
      if($cant<$copias-1){
        $this->_lineaPunteada($xAux, 210, $yAux);
      }
      $cant++;
      $fil=$this->fpdf->GetY()+5;
    };
    $this->fpdf->SetFillColor(200,200,200);
    $this->fpdf->SetFont('Arial','I',14);     
    $this->fpdf->Cell(15,10,"AULA", 1,0,'C',true);
    $this->fpdf->Cell(120,10,"PROCEDIMIENTO", 1,0,'C',true);
    $this->fpdf->Cell(35,10,"REALIZADO", 1,1,'C',true);
    //paso 1
    $this->fpdf->Cell(15,10,"1", 1,0,'C');
    $this->fpdf->Cell(120,10,"Autorefractometro", 1,0,'L');
    $this->fpdf->Cell(35,10,"", 1,1,'C');
    //paso 2
    $this->fpdf->Cell(15,10,"2", 1,0,'C');
    $this->fpdf->Cell(120,10,"Agudeza visual", 1,0,'L');
    $this->fpdf->Cell(35,10,"", 1,1,'C');    
    //paso 3
    $this->fpdf->Cell(15,10,"3", 1,0,'C');
    $this->fpdf->Cell(120,10,"Seleccion de Marcos", 1,0,'L');
    $this->fpdf->Cell(35,10,"", 1,1,'C');    
    //paso 4
    $this->fpdf->Cell(15,10,"4", 1,0,'C');
    $this->fpdf->Cell(120,10,"Fondo De Ojos - Hora de Realizacion:", 1,0,'L');
    $this->fpdf->Cell(35,10,"", 1,1,'C');    
    //paso 5
    $this->fpdf->Cell(15,10,"5", 1,0,'C');
    $this->fpdf->Cell(120,10,"Fondo De Ojos - Hora de Realizacion:", 1,0,'L');
    $this->fpdf->Cell(35,10,"", 1,1,'C');    
    //paso 6
    $this->fpdf->Cell(15,10,"6", 1,0,'C');
    $this->fpdf->Cell(120,10,"Autorefractometro - ARM", 1,0,'L');
    $this->fpdf->Cell(35,10,"", 1,1,'C');
    //paso 7
    $this->fpdf->Cell(15,10,"7", 1,0,'C');
    $this->fpdf->Cell(120,10,"Observacion de Nervio Optico", 1,0,'L');
    $this->fpdf->Cell(35,10,"", 1,1,'C');

    $this->fpdf->Output('hojaDeRuta', 'I');
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
  function cartaDiagnostico($pesqui=false){
    /**
    * imprime carta de autorizacion de los padres/tutores a la pesquiza
    *
    * lee el archivo txt y arma la carta por la cantidad de copias necesarias
    *@param integer $id  numero de caso 
    */
    if($pesqui){
      $pesquizas[]=$pesqui;
    }else{
      foreach ($_POST as $key => $value){
        $pesquizas[]=$value;
      }
      if(!isset($pesquizas)){
        $pesquizas[]=false;
      }
    }
    $this->load->model('Pesquizas_model');
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
      redirect('admin/cartaDiagnostico','location',301);
    };
    $nombreFile = TXTFILES . "cartadiagnosticoP2_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota2 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      redirect('admin/cartaDiagnostico','location',301);
    };
    $nombreFile = TXTFILES . "cartadiagnosticoP3_".$this->session->userdata('programa_id').".txt";
    if(file_exists($nombreFile)){
      $archivo = fopen($nombreFile,FOPEN_READ);
      $nota3 = fread($archivo,  filesize($nombreFile));
      fclose($archivo);
    }else{
      redirect('admin/cartaDiagnostico','location',301);
    };
    $this->fpdf->Open();
    $cant=0;
    $this->fpdf->SetMargins(5,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(200);
    $this->fpdf->SetFillColor(0,0,0);
    $this->fpdf->SetTopMargin(0);
    $escAux=false;    
    foreach($pesquizas as $pesq){
      if($pesq){
      	$alumnos=$this->Casos_model->getAlumnosPesquiza($pesq);
       $pes=$this->Pesquizas_model->getEscuelaResumen($pesq);
      }else{
      	$alumno = array(  'id'=>0,
			    'escuela_id'=>'',
      			    'escuela_nom'=>'',
      			    'escuela_num'=>'',
      					  'escuela_dir'=>'',
            			  'escuela_ciu'=>'',
            			  'grado'=>'',
            			  'division'=>'',
            			  'turno'=>'',
            			  'apellido'=>'',
            			  'nombre'=>'',
            			  'dni'=>'',
            			  'transporte'=>1
      	);
      	$alumnos[]=(object) $alumno;
	$pes=false;
      }
      if($pes){
        if($pes->escuela_id!=$escAux){
          $this->fpdf->AddPage();
          $this->fpdf->Ln(3);
	      $this->fpdf->SetFont('Arial','',16);        
          $this->fpdf->Cell(95,7,sprintf('Escuela: %s - %s ',$pes->escuela_num, $pes->escuela_nom),0,1,'L');      
          $this->fpdf->Cell(95,7,sprintf('Direccion: %s - %s ',$pes->escuela_dir, $pes->escuela_ciu),0,1,'L');            
          $this->fpdf->Cell(95,7,sprintf('Cantidad de Alumnos: %s ',$pes->cant_prob),0,1,'L');      
          $this->fpdf->Cell(95,7,sprintf('Alumnos citados en: %s',($pes->transporte==0)?'LA FACULTAD':'LA ESCUELA'),0,1,'L');                 
          $escAux=$pes->escuela_id;
          $fil=0;
          $col=0;
          $cant=1;
        }       
	}
   	  foreach ($alumnos as $alu){
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
	      if($alu->transporte==0){
	      	$msnj='LA FACULTAD DE CS. DE LA ADMINISTRACION.';
	      }else{
	      	$msnj='LA ESCUELA PARA SER TRASLADADO A LA FACULTAD Y UNA VEZ REVISADO LO TRASLADAREMOS NUEVAMENTE A LA ESCUELA.';
	      };
	      $nota3=str_replace("{transporte}", $msnj, $nota3);
	      $this->fpdf->MultiCell(180,7,utf8_decode($nota3),0,'J');   
	      $this->fpdf->Ln(5);
	      $xAux=$this->fpdf->GetX();
	      $yAux=$this->fpdf->GetY();
	      $this->_lineaPunteada($xAux,210,$yAux+5);
	      $this->fpdf->Ln(10);
	      $this->fpdf->Cell(95,7,utf8_decode(sprintf('Escuela: %s - %s ',$alu->escuela_num, $alu->escuela_nom)),0,0,'L');      
	      $this->fpdf->Cell(95,7,utf8_decode(sprintf('Direccion: %s - %s ',$alu->escuela_dir, $alu->escuela_ciu)),0,1,'L');      
	      $this->fpdf->Cell(50,7,sprintf('Grado: %s',$alu->grado),0,0,'L');      
	      $this->fpdf->Cell(50,7,sprintf('Division: %s',$alu->division),0,0,'L');      
	      $this->fpdf->Cell(50,7,sprintf('Turno: %s',$alu->turno),0,1,'L');      
	      $this->fpdf->Cell(150,7,  utf8_decode(sprintf('Apellido y Nombre: %s, %s',$alu->apellido,$alu->nombre)),0,1,'L');      
	      $this->fpdf->Cell(150,7,sprintf('D.N.I: %s',$alu->dni),0,1,'L');      
	      $this->fpdf->Ln(3);
	      $yAux=$this->fpdf->GetY();
          $this->fpdf->EAN13(0+10,$yAux+5,$alu->id);
	      $this->fpdf->Cell(150,7,'',0,0,'L');      
	      $this->fpdf->Cell(50,7,"Autorizo",'T',1,'C');
          $this->Casos_model->mandeCarta($alu->id);
   	  }
      $this->Pesquizas_model->mandeCarta($pesq);
    }
    $this->fpdf->Output('cartadiagnostico.pdf', 'D');
  }
  function turnos(){
    /**
    * imprime turnos
    *
    * lee el archivo txt y arma el turno por la cantidad de copias necesarias
    * 
    */
  	foreach ($_POST as $key => $value){
  	  $pesquizas[]=$value;
  	}
  	if(!isset($pesquizas)){
  	  $pesquizas[]=false;
  	}
    $this->load->model('Pesquizas_model');
    $this->load->model('programas_model');
    $programa=$this->Programas_model->getOnline();
    $this->fpdf->Open();
    $this->fpdf->SetMargins(5,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(0);
    $this->fpdf->SetFillColor(255,255,255);
    $this->fpdf->SetTopMargin(0);
    $escAux=false;
    foreach($pesquizas as $pesq){
      if($pesq){
      	$alumnos=$this->Casos_model->getAlumnosPesquiza($pesq);
        $pes=$this->Pesquizas_model->getEscuelaResumen($pesq);
      }else{
      	$alumno = array(  'escuela_id'=>'',
      					  'escuela_nom'=>'',
      					  'escuela_dir'=>'',
      					  'escuela_trans'=>'',
            			  'escuela_ciu'=>'',
            			  'grado'=>'',
            			  'division'=>'',
            			  'turno'=>'',
            			  'horaesc'=>'',
            			  'apellido'=>'',
            			  'nombre'=>'',
            			  'dni'=>'',
            			  'transporte'=>1
      	);
      	$alumnos[]=(object) $alumno;
      }
      if($pes->escuela_id!=$escAux){
        $this->fpdf->AddPage();
	    $this->fpdf->SetFont('Arial','',16);        
        $this->fpdf->Cell(95,7,sprintf('Escuela: %s - %s ',$pes->escuela_num, $pes->escuela_nom),0,1,'L');      
        $this->fpdf->Cell(95,7,sprintf('Direccion: %s - %s ',$pes->escuela_dir, $pes->escuela_ciu),0,1,'L');            
        $this->fpdf->Cell(95,7,sprintf('Cantidad de Alumnos: %s ',$pes->cant_prob),0,1,'L');      
        if($pes->transporte==0){
          $lugarTransporte='LA FACULTAD';        
          $horaTransporte=$pes->horadiag;
        }else{
          if($pes->escuela_trans=="Facultad Administracion"){
            $lugarTransporte='LA ESCUELA';                  
          }else{
            $lugarTransporte=$pes->escuela_trans;                             
          }
          $horaTransporte=$pes->horaesc;
        };
        $this->fpdf->Cell(95,7,sprintf('Alumnos citados en: %s',$lugarTransporte),0,1,'L');            
        $this->fpdf->Cell(95,7,sprintf('Dia: %s',$pes->fechadiag),0,1,'L');      
        $this->fpdf->Cell(95,7,sprintf('Hora: %s',$horaTransporte),0,1,'L');      
        $escAux=$pes->escuela_id;
        $this->fpdf->AddPage();
        $fil=0;
        $col=0;
        $cant=1;
      }   
      $totAlu=count($alumnos);
      foreach ($alumnos as $alu){ 
          $nombreFile = TXTFILES . "turnos_".$this->session->userdata('programa_id').".txt";
          if(file_exists($nombreFile)){
            $archivo = fopen($nombreFile,FOPEN_READ);
            $nota = fread($archivo,  filesize($nombreFile));
            fclose($archivo);
          }else{
            redirect('admin/turnos','location',301);
          };                
          $lugarTransporte="";  
	      //imprimo encabezado
	      $this->_encabezado(TRUE, false, $col,$fil);
	      //Imprimo Cuerpo
          $this->fpdf->SetDrawColor(0);
          $this->fpdf->SetFillColor(0,0,0);
	      $this->fpdf->SetFont('Arial','B',22);
          $this->fpdf->SetLineWidth(2.5);
          $this->fpdf->Rect($col+10,$fil+28,40,40,"D");
          $this->fpdf->SetLineWidth(0.25);
          $this->fpdf->SetXY(10,$fil+48);
	      $this->fpdf->Cell(40,7,sprintf('%s',$alu->id),0,1,'C');          
          $this->fpdf->SetXY(65,$fil+25);
	      $this->fpdf->SetFont('Arial','B',10);          
          $this->fpdf->Ln(-5);
	      $this->fpdf->Cell(0,7,utf8_decode(sprintf('%s, %s',$alu->apellido,$alu->nombre)),0,1,'C');
	      $this->fpdf->SetFont('Arial','',10);  
          if($alu->transporte==0){
            $lugarTransporte='LA FACULTAD';        
            $horaTransporte=$alu->horadiag;
          }else{
             if($alu->escuela_trans=="Facultad Administracion"){
               $lugarTransporte='LA ESCUELA';                  
             }else{
               $lugarTransporte=$alu->escuela_trans;                             
             }
             $horaTransporte=$alu->horaesc;
           };        
	      $nota=str_replace("{fecha}", $alu->fechadiag, $nota);
	      $nota=str_replace("{hora}", $horaTransporte, $nota);          
	      $nota=str_replace("{lugar}", $lugarTransporte, $nota);
          $this->fpdf->SetX(55);
	      $this->fpdf->MultiCell(150,7,utf8_decode($nota),0,'J');  
          $this->fpdf->SetX(55);
          $this->fpdf->SetFont('Arial','BI',8); 
          $this->fpdf->MultiCell(150,10, utf8_decode('Si el niño tiene antecedente de epilepsia o convulsiones, por favor avise al profesional.'),0,'J');
	      $this->fpdf->SetFont('Arial','',10);            
          $this->fpdf->SetX(55);          
	      $this->fpdf->Cell(95,7,sprintf('Escuela: %s - %s ',$alu->escuela_id, $alu->escuela_nom),0,1,'L');     
          $this->fpdf->SetX(55);              
	      $this->fpdf->Cell(30,7,sprintf('Grado: %s',$alu->grado),0,0,'L');      
	      $this->fpdf->Cell(30,7,sprintf('Division: %s',$alu->division),0,0,'L');      
	      $this->fpdf->Cell(30,7,utf8_decode(sprintf('Turno: %s',  ($alu->turno=="T")?"Tarde":"Mañana")),0,1,'L');      
	      $xAux=$this->fpdf->GetX();
	      $yAux=$this->fpdf->GetY();
	      $this->_lineaPunteada($xAux,210,$yAux+6);
          $cant++;
          $diff=$yAux-$fil;
          if($yAux+$diff+5<290){
           $fil= $yAux+5;
          }else{
            $fil=0;
            $this->fpdf->Addpage();
          }
          //$this->Casos_model->mandeTurno($alu->id);
   	  }
      $this->Pesquizas_model->mandeTurno($pesq);
    }
    $this->fpdf->Output('turnos.pdf', 'D');
  }
  function listadoPorEscuela(){
    $idEsc=$this->input->post('texto');
    $this->fpdf->Open();
    $this->fpdf->SetMargins(10,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetFillColor(128,128,128);
    $this->fpdf->SetTopMargin(2);
	$this->fpdf->SetFont('Arial','',10);        
    $alumnos=$this->Casos_model->getByColegio($idEsc);
    $this->fpdf->AddPage();
    $renglon=0;
    foreach($alumnos as $alu){
      if($renglon==0){
        $this->fpdf->Cell(65,5,$alu->colegio,0,0,'C');      
        $this->fpdf->Cell(85,5,$alu->escuela_dir,0,0,'C');      
        $this->fpdf->Cell(35,5,$alu->escuela_ciu,0,1,'C');      
        $this->fpdf->Cell(25,5,$alu->fecha,1,0,'C');              
        $this->fpdf->Cell(25,5,$alu->hora,1,1,'C');              
        $this->fpdf->Ln(10);
        
        $this->fpdf->Cell(15,5,'Turno',1,0,'C',true);
        $this->fpdf->Cell(80,5,'Apellido y Nombre',1,0,'L', true);
        $this->fpdf->Cell(25,5,'DNI',1,0,'C', true);
        $this->fpdf->Cell(50,5,'Estado',1,0,'C',true);
        $this->fpdf->Cell(20,5,'Presente',1,1,'C',true);
        };
      $this->fpdf->Cell(15,5,$alu->id,1,0,'C');
      $this->fpdf->Cell(80,5, utf8_decode($alu->apellido.', '.$alu->nombre),1,0,'L');
      $this->fpdf->Cell(25,5,$alu->dni,1,0,'C');
      $this->fpdf->Cell(50,5,($alu->confirmo==1)?'Esperar':'No Confirmo Asistencia',1,0,'C');
      $this->fpdf->Cell(20,5,'',1,1,'C');
      $renglon++;
      if($renglon>30){
        $renglon=0;
        $this->fpdf->AddPage();
      }
    }
    $this->fpdf->Output('listado.pdf', 'I');    
  }
  function listadoTurnos(){
    $this->fpdf->Open();
    $this->fpdf->SetMargins(10,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetFillColor(128,128,128);
    $this->fpdf->SetTopMargin(2);
	$this->fpdf->SetFont('Arial','',10);        
    $escuelas=$this->Pesquizas_model->getTurnos();
    $this->fpdf->AddPage();
    $renglon=0;
    foreach($escuelas as $esc){
      $this->fpdf->Cell(100,5,  utf8_decode($esc->colegio),'LTR',0,'L');      
      $this->fpdf->Cell(25,5,$esc->fechadiag,'LTRB',0,'C');              
      $this->fpdf->Cell(25,5,$esc->horaesc,'LTRB',0,'C',($esc->transporte=="COLECTIVO"));              
      $this->fpdf->Cell(25,5,$esc->horadiag,'LTRB',1,'C');              
      $this->fpdf->Cell(80,5,  utf8_decode($esc->escuela_dir),'LB',0,'L');      
      $this->fpdf->Cell(60,5,$esc->escuela_ciu,'BR',0,'L');      
      if($esc->transporte=="COLECTIVO"){
        $this->fpdf->SetDrawColor(255);
        $this->fpdf->Cell(35,5,$esc->transporte,1,0,'C',true);     
        $this->fpdf->SetDrawColor(128);        
      }else{
        $this->fpdf->Cell(35,5,$esc->transporte,'LBR',0,'C', false);                   
      };
      $this->fpdf->Cell(15,5,$esc->cantidad,'LBR',1,'C');   
      $renglon+=2;
      if($renglon>52){
        $renglon=0;
        $this->fpdf->AddPage();
      }
    };
    $this->fpdf->Output('listado.pdf', 'I');    
  }
  function listadoAlfabetico(){
    $idEsc=$this->input->post('texto');
    $this->fpdf->Open();
    $this->fpdf->SetMargins(10,0,0);
    $this->fpdf->SetAutoPageBreak(true);
    $this->fpdf->SetDrawColor(128);
    $this->fpdf->SetFillColor(128,128,128);
    $this->fpdf->SetTopMargin(2);
	$this->fpdf->SetFont('Arial','',10);        
    $alumnos=$this->Casos_model->getAlfabeticoFull();
    $this->fpdf->AddPage();
    $renglon=0;
    $pLaux="A";
    $loop=0;
    foreach($alumnos as $alu){
      $primerLetra=substr($alu->apellido,0,1);
      if($primerLetra!=$pLaux){
        $renglon=0;
        $pLaux=$primerLetra;
        $this->fpdf->AddPage();
      }
      if($renglon==0){
    	$this->fpdf->SetFont('Arial','',18);        
        $this->fpdf->Cell(150,20,"Listado Alfabetico de Chicos",0,0,'C');
    	$this->fpdf->SetFont('Arial','',36);        
        $this->fpdf->Cell(30,20,$primerLetra,1,1,'C');
    	$this->fpdf->SetFont('Arial','',10);        
        
        $this->fpdf->Cell(15,5,'Turno',1,0,'C',true);
        $this->fpdf->Cell(75,5,'Apellido y Nombre',1,0,'L', true);
        $this->fpdf->Cell(20,5,'DNI',1,0,'C', true);
        $this->fpdf->Cell(65,5,'Escuela',1,0,'C',true);
        $this->fpdf->Cell(15,5,'Curso',1,0,'C',true);
        $this->fpdf->Cell(8,5,'Pres.',1,1,'C',true);
      };
      $this->fpdf->Cell(15,5,$alu->id,1,0,'C');
      $this->fpdf->Cell(75,5, utf8_decode($alu->apellido.', '.$alu->nombre),1,0,'L');
      $this->fpdf->Cell(20,5,$alu->dni,1,0,'C');
      $this->fpdf->Cell(65,5,  utf8_decode($alu->colegio),1,0,'L');
      $this->fpdf->Cell(15,5,$alu->curso,1,0,'C');
      $this->fpdf->Cell(8,5,'',1,1,'C');
      $renglon++;
      if($renglon>50){
        $renglon=0;
        $this->fpdf->AddPage();
      }
    }
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
  function _encabezadoHojaRuta($rotary=true, $id=false,$x=0,$y=0){
    $this->fpdf->SetXY($x,$y);
    // Logo
    $this->fpdf->Image(IMGFILES.'wh-286.gif',$x+10,$y+3,10);
    // Arial bold 15
    $this->fpdf->SetFont('Arial','B',12);
    $this->fpdf->SetXY($x,$y+3);
    $this->fpdf->Cell(0,5,'No Juegues con tus Ojos',0,1,'C');          
    $this->fpdf->SetXY($x,$y+8);
    $this->fpdf->Cell(0,5,'Edicion 2012',0,1,'C');          
    // Títulos
    $this->fpdf->SetFont('Arial','',10);
    $this->fpdf->SetXY($x+25,$y+3);
    $this->fpdf->Cell(110,5,'Rotary Club',0,1,'L');      
    $this->fpdf->SetXY($x+25,$y+8);
    $this->fpdf->Cell(110,5,'Salto Grande Concordia',0,1,'L');      
    //diagnostico
    $this->fpdf->SetFont('Arial','B',12);
    $this->fpdf->SetXY($x+145,$y+2);
    $this->fpdf->Cell(35,5,'Nro. Diagnostico',1,1,'C');      
    $this->fpdf->SetLineWidth("2");
    $this->fpdf->SetXY($x+145,$y+10);
    $this->fpdf->Cell(35,20,($id)?$id:'',1,1,'C');      
    $this->fpdf->SetXY($x,$y+20);      
    $this->fpdf->SetLineWidth("0.25");
    // Salto de línea
    $this->fpdf->SetXY($x,$y+15);    
  }
  function _lineaPunteada($empieza,$termina,$linea){
    for($i=$empieza;$i<$termina;$i=$i+5){
      $this->fpdf->Line($i,$linea,$i+3,$linea);      
    }
  }
}