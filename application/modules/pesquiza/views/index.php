<?php echo Assets::css('pesquizas', 'screen');?>
<h2>Pesquizas</h2>
<div style="clear: both">&nbsp;</div>
<?php echo anchor('pesquiza/generarAuto', 'Generar Pesquiza Automatica', 'id=botGeneraAuto');?>
<?php echo anchor('pesquiza/imprimirCartas', 'Imprimir Cartas para Diagnostico', 'id=botCartas');?>
<?php echo anchor('pesquiza/imprimirTurnos', 'Imprimir Turnos para Diagnostico', 'id=botTurnos');?>
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
    <tr >
      <td colspan="5">
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
$(".botObservaciones").button({icons:{primary:'ui-icon-document'}, text:false});
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
$(".botMas").click(function(e){
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
      $(this).addClass('estadoPendiente');
      $(this).html('Pendiente');
      break;
    case 1:
      $(this).parent().addClass('bordeRealizada');
      $(this).addClass('estadoRealizada');
      $(this).html('Realizada');
      break;
    case 2:
      $(this).parent().addClass('bordeFinalizada');
      $(this).addClass('estadoFinalizada');
      $(this).html('Finalizada');
      break;
    case 3:
      $(this).parent().addClass('bordeCarta');
      $(this).addClass('estadoCarta');
      $(this).html('Cartas Enviadas');
      break;
    case 4:
      $(this).parent().addClass('bordeTurno');
      $(this).addClass('estadoTurno');
      $(this).html('Turnos Enviados');
      break;
    case 5:
      $(this).parent().addClass('bordeFinalizada');
      $(this).addClass('estadoFinalizada');
      $(this).html('Terminada');
      break;
  };
});
function ocultoPesquizas(id){
  nombre= "#F"+id;
  nombre2= "#E"+id;
  $(nombre2).removeClass('seleccionada');
  $(nombre).html('');
}
function muestroPesquizas(id, pagina){
  nombre= "#F"+id;
  nombre2= "#E"+id;
  $(nombre2).addClass('seleccionada');
  $.ajax({
      url: pagina,
      success: function(data) {
              $(nombre).html(data);
      }
  }); 
}

</script>