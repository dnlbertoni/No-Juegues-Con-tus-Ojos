<?php echo Assets::css('pesquizas', 'screen');?>
<?php echo form_open($accion,'id="form-cartas"');?>
<h2><?php echo $titulo?></h2>
<div id="botOcultar">Ocultar/Mostar Pesquizas</div>
<p>&nbsp;</p>
<table >
 <tbody>
 	<?php $escAux=false;?>
    <?php foreach($finalizadas as $pesq):?>
    <?php if($pesq->escuela_id!=$escAux):?>
    	<?php $escAux=$pesq->escuela_id;?>
    	<tr>
    		<th colspan="2">
    		<?php echo $pesq->escuela?>
    		</th>
            <td colspan="2"><?php echo "Fecha Impresion Carta ",$pesq->fechacarta?></td>
            <td  colspan="2"><?php echo "Fecha Impresion turno ",$pesq->fechaturno?></td>
    		<th colspan="2"><div class="boton" id="escF_<?php echo $pesq->escuela_id?>">Toda la Escuela</div></th>
    	</tr>
    <?php endif;?>
    <tr class="pesquizas">
      <td><?php echo $pesq->fecha?></td>
      <td><?php echo $pesq->curso?></td>
      <td><?php echo $pesq->voluntario?></td>
      <td><?php echo $pesq->cant_alum?></td>
      <td><?php echo $pesq->cant_pres?></td>
      <td><?php echo $pesq->cant_prob?></td>
      <td class="estados" ><?php echo $pesq->estado?></td>
      <td><?php echo form_checkbox($pesq->id,$pesq->id,false,'id="'.$pesq->id.'" class="escF_'.$pesq->escuela_id.'"')?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php if(isset($cartas)):?>
<h2>Cartas Impresas</h2>
<table>
 <tbody>
 	<?php $escAux=false;?>
    <?php foreach($cartas as $pesq):?>
    <?php if($pesq->escuela_id!=$escAux):?>
    	<?php $escAux=$pesq->escuela_id;?>
    	<tr>
    		<th colspan="6">
    		<?php echo $pesq->escuela?>
    		</th>
    		<th colspan="2"><div class="boton" id="escC_<?php echo $pesq->escuela_id?>">Toda la Escuela</div></th>
    	</tr>
    <?php endif;?>
    <tr class="pesquizas">
      <td><?php echo $pesq->fecha?></td>
      <td><?php echo $pesq->curso?></td>
      <td><?php echo $pesq->voluntario?></td>
      <td><?php echo $pesq->cant_alum?></td>
      <td><?php echo $pesq->cant_pres?></td>
      <td><?php echo $pesq->cant_prob?></td>
      <td class="estados" ><?php echo $pesq->estado?></td>
      <td><?php echo form_checkbox($pesq->id,$pesq->id,false,'id="'.$pesq->id.'" class="escC_'.$pesq->escuela_id.'"')?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php endif;?>
<div id="botCarta"><?php echo $texto?></div>
<?php echo form_close();?>
<script>
$(document).ready(function(){
    $("#botOcultar").button();
    $("#botOcultar").click(function(){
      $(".pesquizas").hide();
    });
	$(".boton").button({icons:{primary:'ui-icon-circle-check'}});
	$("#botCarta").button({icons:{primary:'ui-icon-document'}});
	$("#botCarta").click(function(){
		$("#form-cartas").submit();
	});
	$(".boton").click(function(){
		nombre="."+$(this).attr('id')+"";
		$(nombre).click();
	});
	$(".estados").each(function(){
		  estado=parseInt($(this).html());
		  switch(estado){
		    case 0:
		      $(this).parent().addClass('bordePendiente');
		      $(this).parent().addClass('estadoPendiente');
		      $(this).html('Pendiente');
		      break;
		    case 1:
		      $(this).parent().addClass('bordeRealizada');
		      $(this).parent().addClass('estadoRealizada');
		      $(this).html('Realizada');
		      break;
		    case 2:
		      $(this).parent().addClass('bordeFinalizada');
		      $(this).parent().addClass('estadoFinalizada');
		      $(this).html('Finalizada');
		      break;
		    case 3:
		      $(this).parent().addClass('bordeCarta');
		      $(this).parent().addClass('estadoCarta');
		      $(this).html('Cartas Enviadas');
		      break;
		    case 4:
		      $(this).parent().addClass('bordeTurno');
		      $(this).parent().addClass('estadoTurno');
		      $(this).html('Turnos Enviados');
		      break;
		    case 5:
		      $(this).parent().addClass('bordeFinalizada');
		      $(this).parent().addClass('estadoFinalizada');
		      $(this).html('Terminada');
		      break;
		  };
		});
});
</script>