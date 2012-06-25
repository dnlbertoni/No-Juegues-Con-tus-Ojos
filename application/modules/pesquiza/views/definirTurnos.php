<?php echo Assets::css('pesquizas', 'screen');?>
<h2>Turnos Otorgados</h2>
<table>
  <tr><td>Asignados</td></tr>
  <?php $total=0;?>
  <?php $parcial=0;?>
  <?php $turnox=false?>
  <?php foreach($xTurnos as $turno):?>
  <?php if(!$turnox):?>
    <?php if($turno->turno!=$turnox):?>
      <tr><th colspan="2"><?php echo $turno->turno?></th></tr>
    <?php $turnox=$turno->turno?>
    <?php endif;?>
  <?php else:?>
    <?php if($turno->turno!=$turnox):?>
      <tr><td>Total Parcial del Dia</td><th><?php echo $parcial?></th></tr>
      <?php $parcial=0;?>
      <tr><th colspan="2"><?php echo $turno->turno?></th></tr>
    <?php $turnox=$turno->turno?>
    <?php endif;?>
  <?php endif;?>
  <tr>
    <td><?php echo $turno->hora?></td>
    <td><?php echo $turno->cant_prob?></td>
    <?php $total   +=$turno->cant_prob?>
    <?php $parcial +=$turno->cant_prob?>
  </tr>
  <?php endforeach;?>
  <tr><td>Total Parcial del Dia </td><th><?php echo $parcial?></th></tr>
  <tr>
    <td>Total Asignados</td>
    <td><?php echo $total?></td>
  </tr>
  <tr>
    <td>Total a Asignar</td>
    <td><?php echo $pendientes?></td>
  </tr>
</table>
<h2>Definir Turnos</h2>
<table>
 <tbody>
    <?php foreach($pesquizas as $pesq):?>
    <tr id="esc_<?php echo $pesq->escuela_id?>">
      <td><?php echo $pesq->escuela_id, ' - ',$pesq->escuela?></td>
      <td >Fecha:<?php echo $pesq->turno?></td>
      <td>Hora :<?php echo $pesq->hora?></td>
      <td><?php echo $pesq->direccion?></td>
      <td><?php echo $pesq->ciudad?></td>
      <td class="transporte">
        <?php echo $pesq->transporte?>
      </td>
      <th><?php echo $pesq->cant_prob?></th>
      <td >
        <?php echo anchor('pesquiza/asignarTurnoTransporte/'.$pesq->escuela_id,'Asignar Turno y Transporte','class="botTurno"');?>
      </td>
      <td class="estados" ><?php echo $pesq->estado?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<div id="dialogos"></div>
<script>
$(document).ready(function(){
	$(".botTurno").button({icons:{primary:'ui-icon-calendar'}, text:false});
    $(".botTurno").click(function(e){
      e.preventDefault();
      $("#dialogos").dialog({
        autoOpen:false,
        width:400,
        modal: true,
        title:'Asignar Turno y Transporte'
      });
      pagina=$(this).attr('href');
      $("#dialogos").load(pagina, [], function(){
        $('#dialogos').dialog('open');
      })
    });
	$(".estados").each(function(){
		  estado=parseInt($(this).html());
		  switch(estado){
		    case 0:
		      $(this).parent().addClass('estadoPendiente');
		      $(this).html('Pendiente');
		      break;
		    case 1:
		      $(this).parent().addClass('estadoRealizada');
		      $(this).html('Realizada');
		      break;
		    case 2:
		      $(this).parent().addClass('estadoFinalizada');
		      $(this).html('Finalizada');
		      break;
		    case 3:
		      $(this).parent().addClass('estadoCarta');
		      $(this).html('Cartas Enviadas');
		      break;
		    case 4:
		      $(this).parent().addClass('estadoTurno');
		      $(this).html('Turnos Enviados');
		      break;
		    case 5:
		      $(this).parent().addClass('estadoFinalizada');
		      $(this).html('Terminada');
		      break;
		  };
		});
	$(".transporte").each(function(){
		  estado=parseInt($(this).html());
		  switch(estado){
		    case 1:
		      $(this).addClass('estadoPendiente');
		      $(this).html('Escuela');
		      break;
		    case 0:
		      $(this).addClass('estadoFinalizada');
		      $(this).html('Van a La Facultad');
		      break;
		  };
		});
});
</script>