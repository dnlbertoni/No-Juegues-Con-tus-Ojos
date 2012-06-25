<?php echo Assets::css('pesquizas', 'screen');?>
<?php if(!isset($nombreUsuario)):?>
  <?php echo Template::message()?>
<?php endif;?>
<div class="ui-widget boxCh Izq">
  <div class="ui-widget-header">Datos del Usuario</div>
    <div class="ui-widget-content">
      <p>Nombre del usuario: <?php echo $nombreUsuario?></p>
      <p>Ingresaste por ultima vez: <?php echo $lastLog?></p>
      <?php echo anchor('auth/logout', 'Salir Sistema','id="Logout"');?>    
    </div>
</div>
  <div class="ui-widget boxCh Der">
  <div class="ui-widget-header">Documentacion</div>
  <div class="ui-widget-content">
    <h2>Roles y Funciones</h2>
    <ul>
      <li>Responsable de Escuelas	
Estar al menos 20 minutos antes del horario de llegada del colectivo al colegio.
Aglutinar a las personas que van llegando.
Tomar asistencia de las que están presentes. 
Una vez que llegue el colectivo le entrega 
</li>
    </ul>        
  </div>
  </div>
<div class="clearfix">&nbsp;</div>
<div class="ui-widget boxCh Izq">
  <div class="ui-widget-header">1 - Escuelas</div>
  <p>La cantidad de escuelas que participan de este Programa son: <b><?php echo $escuelasInfo?></b></p>
</div>
<div class="boxCh Der">
  <h2>2 - Pesquiza</h2>
  <div class="boxCh Izq">
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
  </div>
  <div class="boxCh Der">
    Total Alumnos: <?php echo $totAlu;?>
    <br />
    Total Alumnos Vistos: <?php echo $totPre;?>
    <br />
    Indice No Vistos: <?php echo sprintf("%02.2f",($totAlu-$totPre)/$totAlu*100)."%";?>
    <br />
    Total Derivados: <?php echo $totDer?>
    <br />
    Indice de Deriv.: <?php echo sprintf("%02.2f",$totDer/$totPre*100)."%";?>
  </div>  
</div>
<div class="clearfix">&nbsp;</div>
<div class="boxCh Izq">
  <h2>3 - Notificaciones</h2>
  resumen de las notificaciones a escuelas y niños
</div>
<div class="boxCh Der">
  <h2>4 - Diagnostico</h2>
  resumen del diagnostico
</div>
<div class="clearfix">&nbsp;</div>
<div class="boxCh Izq">
  <h2>5 - Notificacione</h2>
  resuemn de las notificiaiones a los chicos que van a recibir lentes
</div>
<div class="boxCh Der">
  <h2>6 - Entrega</h2>
  resumen de la entrega de lentes
</div>
<div class="clearfix">&nbsp;</div>

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