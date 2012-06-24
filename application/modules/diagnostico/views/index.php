<div class="ui-widget">
  <div class="ui-widget-header">Datos del Programa</div>
  <div class="ui-widget-content">
    <p>Cantidad total de Alumnos</p>
    <p>Cantidad total de Derivados</p>        
    <p>Cantidad de Alumnos Atendidos</p>        
    <p>Cantidad de Lentes a Entregar</p>
    <p>Promedio  Ingreso <span><?php echo sprintf("%3.2f minutos por Chico", $promIngreso)?></span></p>
  </div>
</div>
<div >&nbsp;</div>
<?php $lado=1;?>
<?php foreach($datosDia as $datos):?>
<div class="ui-widget boxCh <?php echo($lado==1)?'Izq':'Der'?>">
  <h1 class="ui-widget-header" style="text-align:center"><?php echo $datos->Dia?></h1>
  <div class="ui-widget-content">
    <p>Cantdidad Esperada: <span><?php echo $datos->Esperados?></span></p>
    <p>Realizado: <span id="dato<?php echo $datos->Dia?>"><?php echo sprintf("%02.2f",$datos->Asistentes/$datos->Esperados*100)?></span>%</p>
    <div id="real<?php echo $datos->Dia?>" class="Pb"></div>
  </div>
</div>
<?php $lado*=-1?>
<?php endforeach;?>
<div >&nbsp;</div>
<div class="ui-widget  boxCh Izq">
  <h1 class="ui-widget-header">Listados</h1>
  <div class="ui-widget-content">
    <ul>
      <li><?php echo anchor('paper/derivadosEscuela','Derivados Por Escuela', 'class="boton"')?></li>
      <li><?php echo anchor('paper/pdf/listadoAlfabetico','Listado Alfabetico', 'class="boton"')?></li>
    </ul>
  </div>
</div>
<div class="ui-widget boxCh Der">
  <h1 class="ui-widget-header">Finalizar Procesos</h1>
  <div class="ui-widget-content">
      <?php echo anchor('diagnostico/confirmaPresencia','Confirmar Presencia', 'class="botonEsp"')?></li>
      <?php echo anchor('diagnostico/finalizaProceso','Finalizar Casos', 'class="botonEsp"')?></li>
  </div>
</div>
<div style="clear: both">&nbsp;</div>
<div id="ventanaAjax"></div>


<script>
$(document).ready(function(){
  $(".Pb").progressbar();
  $(".Pb").each(function(){
    nombreAux = $(this).attr('id');
    nombre = "#dato"+nombreAux.substring(4,14);
    valor = parseFloat($(nombre).html());
    $(this).progressbar('value',valor);
  });
  $(".boton").button({icons:{primary:'ui-icon-print'}})  ;
  $(".botonEsp").button({icons:{primary:'ui-icon-circle-check'}});
  $("#botTurno").button({icons:{primary:'ui-icon-calendar'}});
  $("#botTurno").click(function(e){
    e.preventDefault();
    var nombre = $(this).text();
    LinkAjax($(this).attr('href'), nombre);
  });  
  $("#botDNI").button({icons:{primary:'ui-icon-contact'}})
  $("#botDNI").click(function(e){
    e.preventDefault();
    var nombre = $(this).text();
    LinkAjax($(this).attr('href'), nombre);
  });  
  $("#botApellido").button({icons:{primary:'ui-icon-person'}})
  $("#botApellido").click(function(e){
    e.preventDefault();
    var nombre = $(this).text();
    LinkAjax($(this).attr('href'), nombre);
  });  
  $("#botEscuela").button({icons:{primary:'ui-icon-home'}})
  $("#botEscuela").click(function(e){
    e.preventDefault();
    var nombre = $(this).text();
    LinkAjax($(this).attr('href'), nombre);
  });  
  //chequeo las teclas de funciones
  $(document).bind('keydown',function(e){
    var code = e.keyCode;
    key = getSpecialKey(code)
    if(key){
      e.preventDefault();
      switch(key){
        case 'f1':
          $("#botTurno").click();
          break;
        case 'f2':
          $("#botDNI").click();
          break;
        case 'f3':
          $("#botApellido").click();
          break;
        case 'f4':
          $("#botEscuela").click();
          break;
      }
    }else{
      if(code==13){
        var bandera = true;
        cantidadTXT = Cantidad.val().trim();
        articuloTXT = Articulo.val().trim();
        if(cantidadTXT ==''){
          if(Cantidad.hasClass('focus')==true && bandera){
            alert('Se debe Ingresar una cantidad');
            bandera = false;
          }
        }else{
          if(Cantidad.hasClass('focus')==true && bandera ){
            Cantidad.blur();
            Articulo.focus();
            bandera = false;
          };                  
        }        
        if(articuloTXT ==''){
          if(Articulo.hasClass('focus')==true && bandera ){
            ConsultoArticulo();
            bandera = false;
          };
        }else{
          if(Articulo.hasClass('focus')==true && bandera ){
            bandera = false;
            Agrego.submit();
          };
        }
      }
    };
  });
  // fin de chequeo de teclas de funciones
  
});
function LinkAjax(url, nombre){
   var options = {
     autoOpen : false,
     modal:true,
     height:400,
     width:550,
     title: nombre
   };
   $("#ventanaAjax").dialog(options);
   $("#ventanaAjax").load(url, [],function (){$("#ventanaAjax").dialog("open")});
 }
function getSpecialKey(code){
  if(code > 111 && code < 124){
    aux = code - 111;
    return 'f'+aux;
  }else{
    return false;
  }
} 
</script>