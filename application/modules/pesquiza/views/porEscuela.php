<table width="100%">
 <tbody>
    <?php foreach($pesqui as $pesq):?>
    <tr>
      <td><?php echo $pesq->fecha?></td>
      <td><?php echo $pesq->curso?></td>
      <td>
          <?php echo $pesq->voluntario?>
          <?php echo anchor('pesquiza/asignarVol/'.$pesq->id,'Asignar Vooluntario',' class="botVol"');?>
      </td>
      <td><?php echo $pesq->cant_alum?></td>
      <td><?php echo $pesq->cant_pres?></td>
      <td><?php echo $pesq->cant_prob?></td>
      <td class="estados" ><?php echo $pesq->estado?></td>
      <td>
        <?php if($pesq->estado == 0  ):?>
          <?php echo anchor('paper/pdf/pesquizaPlanilla/'.$pesq->id,'Imprimir','target="_blank" class="botPrint"');?>
          <?php echo anchor('pesquiza/realizada/'.$pesq->id,'Realizada',' class="botReal"');?>
        <?php endif;?>
        <?php if($pesq->estado == 2  ):?>
          <?php echo anchor('pesquiza/enviarCarta/'.$pesq->id,'Marcar Envio de Carta',' class="botCarta"');?>
        <?php endif;?>
          <?php echo anchor('pesquiza/finalizar/'.$pesq->id,'Derivados',' class="botFin"');?>
          <?php echo anchor('pesquiza/borrar/'.$pesq->id,'Borrar',' class="botDel"');?>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<script>
$('.botMas').button({icons:{primary:'ui-icon-circle-plus'}, text:false});
$('.botPrint').button({icons:{primary:'ui-icon-print'}, text:false});
$('.botEdit').button({icons:{primary:'ui-icon-pencil'}, text:false});
$('.botFin').button({icons:{primary:'ui-icon-contact'}, text:false});
$('.botCarta').button({icons:{primary:'ui-icon-document'}, text:false});
$('.botReal').button({icons:{primary:'ui-icon-circle-check'}, text:false});
$('.botVol').button({icons:{primary:'ui-icon-person'}, text:false});
$('.botDel').button({icons:{primary:'ui-icon-trash'}, text:false});  
$(".botVol").click(function(e){
    e.preventDefault();
    url = $(this).attr('href');
    var options = {
        autoOpen : false,
        modal:true,
        height:500,
        width:800        
    };
    $("#ventanaAjax").dialog(options);
    $("#ventanaAjax").load(url, [],function (){$("#ventanaAjax").dialog("open")});
});
$(".botReal").click(function(e){
  e.preventDefault();
  url=$(this).attr('href');
  $.ajax({
            url:url,
            success:function(){
                    location.reload();
            }           
          });
});
$(".estados").each(function(){
  estado=parseInt($(this).html());
  switch(estado){
    case 0:
      $(this).siblings().addClass('bordePendiente');
      $(this).addClass('estadoPendiente');
      $(this).html('Pendiente');
      break;
    case 1:
      $(this).siblings().addClass('bordeRealizada');
      $(this).addClass('estadoRealizada');
      $(this).html('Realizada');
      break;
    case 2:
      $(this).siblings().addClass('bordeFinalizada');
      $(this).addClass('estadoFinalizada');
      $(this).html('Finalizada');
      break;
    case 3:
      $(this).siblings().addClass('bordeCarta');
      $(this).addClass('estadoCarta');
      $(this).html('Cartas Enviadas');
      break;
    case 4:
      $(this).siblings().addClass('bordeTurno');
      $(this).addClass('estadoTurno');
      $(this).html('Turnos Enviados');
      break;
    case 5:
      $(this).siblings().addClass('bordeFinalizada');
      $(this).addClass('estadoFinalizada');
      $(this).html('Terminada');
      break;
  }
});
</script>