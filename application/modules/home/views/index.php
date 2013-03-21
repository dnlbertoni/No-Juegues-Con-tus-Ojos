<?php echo Assets::css('pesquizas', 'screen');?>
<?php if(!isset($nombreUsuario)):?>
  <?php echo Template::message()?>
<?php endif;?>
<div class="post">
  <div class="ui-widget-header">1 - Escuelas</div>
    <div class="ui-widget-content">
  <p>La cantidad de escuelas que participan de este Programa son: <b><?php echo $escuelasInfo?></b></p>
  <p>La cantidad de escuelas que se Pesquizaron fueron: <b><?php echo $pesquizadas?></b></p>
</div>
<div class="post">
  <div class="ui-widget-header">2 - Pesquiza</div>
    <div class="ui-widget-content">
  <table align="center">
      <?php foreach($pesqTotales as $pesq):?>
      <tr>
        <td class="estados"><?php echo $pesq->estado;?></td>
        <td><?php echo $pesq->cantidad;?></td>
        <td><?php echo sprintf("%02.2f", $pesq->cantidad/$total*100),"%";?></td>
      </tr>
      <?php endforeach;?>
  </table>
  <table align="center">
      <?php foreach($pesqExcep as $pesq):?>
      <tr>
        <td class="estados"><?php echo $pesq->estado;?></td>
        <td><?php echo $pesq->cantidad;?></td>
        <td><?php echo sprintf("%02.2f", $pesq->cantidad/$total*100),"%";?></td>
      </tr>
      <?php endforeach;?>
  </table>
  Total Alumnos: <?php echo $totAlu;?>
  <br />
  Total Alumnos Vistos: <?php echo $totPre;?>
  <br />
  <?php $numero=($totAlu==0)?100:($totAlu-$totPre)/$totAlu*100;?>
  Indice No Vistos: <?php echo sprintf("%02.2f",$numero)."%";?>
  <br />
  Total Derivados: <?php echo $totDer?>
  <br />
  <?php $numero=($totPre==0)?0:$totDer/$totPre*100;?>
  Indice de Deriv.: <?php echo sprintf("%02.2f",$numero)."%";?>
  </div>
</div>
<div class="post">
  <div class="ui-widget-header">3 - Notificaciones</div>
    <div class="ui-widget-content">
  resumen de las notificaciones a escuelas y niños
  </div>
</div>
<div class="post">
  <div class="ui-widget-header">4 - Diagnostico</div>
    <div class="ui-widget-content">
  resumen del diagnostico
  </div>
</div>
<div class="post">
  <div class="ui-widget-header">5 - Notificaciones</div>
  <div class="ui-widget-content">
  resuemn de las notificiaiones a los chicos que van a recibir lentes
  </div>
</div>
<div class="post ui-widget">
  <div class="ui-widget-header">6 - Entrega</div>
  <div class="ui-widget-content">
    resumen de la entrega de lentes
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $(".estados").each(function(){
    estado=parseInt($(this).html());
    switch(estado){
      case 0:
        $(this).siblings().addClass('estadoPendiente');
        $(this).addClass('bordePendiente');
        $(this).html('Pendiente');
        break;
      case 1:
        $(this).siblings().addClass('estadoRealizada');
        $(this).addClass('bordeRealizada');
        $(this).html('Realizada');
        break;
      case 2:
        $(this).siblings().addClass('estadoFinalizada');
        $(this).addClass('bordeFinalizada');
        $(this).html('Finalizada');
        break;
      case 3:
        $(this).siblings().addClass('estadoCarta');
        $(this).addClass('bordeCarta');
        $(this).html('Cartas Enviadas');
        break;
      case 4:
        $(this).siblings().addClass('estadoTurno');
        $(this).addClass('bordeTurno');
        $(this).html('Turnos Enviados');
        break;
      case 5:
        $(this).siblings().addClass('estadoFinalizada');
        $(this).addClass('bordeFinalizada');
        $(this).html('Terminada');
        break;
    }
  });
});
$(document).ready(function(){
  $("#Logout").button({icons:{primary:'ui-icon-circle-close'}});
  $("#Perfil").button({icons:{primary:'ui-icon-person'}});
  $("#Eliminarse").button({icons:{primary:'ui-icon-trash'}});
  $("#Password").button({icons:{primary:'ui-icon-key'}});
  $("#Registrarse").button({icons:{primary:'ui-icon-contact'}});
});
</script>