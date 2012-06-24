<?php echo Assets::css('pesquizas', 'screen');?>
<h2>Pesquizas</h2>
<div style="clear: both">&nbsp;</div>
<?php echo anchor('pesquiza/generarAuto', 'Generar Pesquiza', 'id=botGeneraAuto');?>
<?php echo anchor('pesquiza/imprimirCartas', 'Imprimir Cartas Diagnostico', 'id=botCartas');?>
<?php echo anchor('pesquiza/definirTurnos', 'Definir Turnos Diagnostico', 'id=botDefTurnos');?>
<?php echo anchor('pesquiza/imprimirTurnos', 'Imprimir Turnos', 'id=botTurnos');?>
<div style="clear: both">&nbsp;</div>
<table cellpadding="3">
  <tbody>
    <?php foreach($pesquizas as $pesq):?>
    <tr id="E<?php echo $pesq->escuela_id?>">
      <td>
        <?php echo anchor('pesquiza/porEscuela/'.$pesq->escuela_id,'Expandir',' id="'.$pesq->escuela_id.'" class="botMas"');?>
        <?php echo $pesq->escuela?>
      </td>
      <td style="background-color:lightblue;"><b><?php echo $pesq->cantidad?></b></td>
      <td><b>Alumnos: </b><?php echo ($pesq->cant_alum>0)?$pesq->cant_alum:0;?></td>
      <td><b>Derivados: </b><?php echo ($pesq->cant_prob>0)?$pesq->cant_prob:0;?></td>
      <td class="estados" ><?php echo $pesq->estado?></td>
      <td><?php echo anchor('pesquiza/observ/'.$pesq->escuela_id,'Observaciones','id="bo'.$pesq->escuela_id.'" class="botObservaciones"');?><span id="O<?php echo $pesq->escuela_id?>"><?php echo $pesq->observaciones?></span></td>
    </tr>
    <tr id="D<?php echo $pesq->escuela_id?>">
      <td>
        <?php echo $pesq->direccion,' - ',$pesq->ciudad;?>
      </td>
      <td colspan="4">
        <?php if($pesq->transporte==0):?>
          <?php echo anchor('pesquiza/asignoTransporte/'.$pesq->escuela_id.'/1','Poner Transporte','id="boT'.$pesq->escuela_id.'" class="botTransporte"');?>
        <?php else:?>
          <?php echo anchor('pesquiza/asignoTransporte/'.$pesq->escuela_id.'/0','Quitar Transporte','id="boT'.$pesq->escuela_id.'" class="botTransporte"');?>
        <?php endif;?>
      </td>
        <td id="T<?php echo $pesq->escuela_id?>"><?php echo ($pesq->transporte==0)?"Van a Facultad":"Van en Colectivo"?></td>      
    </tr>
    <tr >
      <td colspan="6">
        <div id="F<?php echo $pesq->escuela_id?>"></div>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<div id="ventanaAjax"></div>
<script>
$('td').css('padding', '2px');
$('.botMas').button({icons:{primary:'ui-icon-circle-plus'}, text:false});
$('.botPrint').button({icons:{primary:'ui-icon-print'}, text:false});
$('.botEdit').button({icons:{primary:'ui-icon-pencil'}, text:false});
$('.botFin').button({icons:{primary:'ui-icon-contact'}, text:false});
$('.botCarta').button({icons:{primary:'ui-icon-document'}, text:false});
$('.botReal').button({icons:{primary:'ui-icon-circle-check'}, text:false});
$('.botDel').button({icons:{primary:'ui-icon-trash'}, text:false});
$("#botCartas").button({icons:{primary:'ui-icon-document'}});
$("#botTurnos").button({icons:{primary:'ui-icon-calendar'}});
$("#botDefTurnos").button({icons:{primary:'ui-icon-calendar'}});
$(".botObservaciones").button({icons:{primary:'ui-icon-document'}, text:false});
$(".botTransporte").button({icons:{primary:'ui-icon-transferthick-e-w'}, text:true});
$("#botGeneraAuto").button({icons:{primary:'ui-icon-video'}});
$("#botGeneraAuto").click(function(e){
    e.preventDefault();
    url = $(this).attr('href');
    var options = {
        autoOpen : false,
        modal:true,
        height:400,
        width:400
    };
    $("#ventanaAjax").dialog(options);
    $("#ventanaAjax").load(url, [],function (){$("#ventanaAjax").dialog("open")});
});
$(".botCarta").click(function(e){
  e.preventDefault();
  url=$(this).attr('href');
  $.ajax({
            url:url,
            success:function(){
                    location.reload();
            }           
          });
});
$(".botReal").click(function(e){
  e.preventDefault();
  url=$(this).attr('href');
  $.ajax({
            url:url,
            success:function(){
                    $(document).reload();
            }           
          });
});
$(".botObservaciones").click(function(e){
  e.preventDefault();
  url=$(this).attr('href');
  id=$(this).attr('id').substring(2,400);
  var options = {
      autoOpen : false,
      modal:true,
      height:350,
      width:400,
      title:"Observaciones"
  };
  $("#ventanaAjax").dialog(options);
  $("#ventanaAjax").load(url, [], function(data){
    $("#ventanaAjax").dialog('open');
  });
});
$(".botTransporte").click(function(e){
  e.preventDefault();
  url=$(this).attr('href');
  $.ajax({
            url:url,
            success:function(){
                    location.reload();
            }           
          });
});$(".botMas").click(function(e){
  e.preventDefault();
  url=$(this).attr('href');
  id=$(this).attr('id');
  nombreAux="#E"+id;
  if($(nombreAux).hasClass('seleccionada')){
    ocultoPesquizas(id);
  }else{
    muestroPesquizas(id,url);    
  }
});
$(".estados").each(function(){
  estado=parseInt($(this).html());
  switch(estado){
    case 0:
      $(this).parent().addClass('bordePendiente');
      $(this).parent().next().addClass('bordePendiente');
      $(this).addClass('estadoPendiente');
      $(this).html('Pend.');
      break;
    case 1:
      $(this).parent().addClass('bordeRealizada');
      $(this).parent().next().addClass('bordeRealizada');
      $(this).addClass('estadoRealizada');
      $(this).html('Real.');
      break;
    case 2:
      $(this).parent().addClass('bordeFinalizada');
      $(this).parent().next().addClass('bordeFinalizada');
      $(this).addClass('estadoFinalizada');
      $(this).html('Final');
      break;
    case 3:
      $(this).parent().addClass('bordeCarta');
      $(this).parent().next().addClass('bordeCarta');
      $(this).addClass('estadoCarta');
      $(this).html('Carta');
      break;
    case 4:
      $(this).parent().addClass('bordeTurno');
      $(this).parent().next().addClass('bordeTurno');
      $(this).addClass('estadoTurno');
      $(this).html('Turno');
      break;
    case 5:
      $(this).parent().addClass('bordeFinalizada');
      $(this).parent().next().addClass('bordeFinalizada');
      $(this).addClass('estadoFinalizada');
      $(this).html('Term.');
      break;
  };
});
function ocultoPesquizas(id){
  nombre= "#F"+id;
  nombre2= "#E"+id;
  nombre3= "#D"+id;
  $(nombre2).removeClass('seleccionada');
  $(nombre3).removeClass('seleccionada');
  $(nombre).html('');
}
function muestroPesquizas(id, pagina){
  nombre= "#F"+id;
  nombre2= "#E"+id;
  nombre3= "#D"+id;
  $(nombre2).addClass('seleccionada');
  $(nombre3).addClass('seleccionada');
  $.ajax({
      url: pagina,
      success: function(data) {
              $(nombre).html(data);
      }
  }); 
}

</script>