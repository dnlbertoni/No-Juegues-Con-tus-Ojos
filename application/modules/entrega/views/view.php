<div class="ui-widget">
  <div class="ui-widget-header">Datos Personales</div>
  <div class="ui-widget-content">
    <p><span>Caso</span> <?php echo $caso->id?></p>
    <p><span>Nombre</span> <?php echo $caso->apellido?>, <?php echo $caso->nombre?></p>
    <p><span>DNI</span> <?php echo $caso->numdoc?></p>
    <p><span>Fecha Nacimiento</span> <?php echo $caso->fecnac?></p>
  </div>
</div>
<div class="ui-widget">
  <div class="ui-widget-header">Datos Escolares</div>
  <div class="ui-widget-content">
    <p><span>Colegio</span> <?php echo $caso->escuela_id?> - <?php echo $caso->colegio?></p>
    <p><span>Grado</span> <?php echo $caso->grado?>&nbsp;<?php echo $caso->division?></p>
  </div>
</div>
<div class="ui-widget">
  <div class="ui-widget-header">Datos del Programa</div>
  <div class="ui-widget-content">
    <p><span>Pesquiza</span> <?php echo $caso->pesquiza_id?></p>
    <p><span>Voluntario</span> <?php echo $caso->voluntario?> - <?php echo $caso->apevol?>, <?php echo $caso->nomvol?></p>
    <p><span>Dia Pesquiza</span> <?php echo $caso->fechapesq?></p>
    <p><span>Diagnostico</span> <?php echo $caso->fechadiag?> - <?php echo $caso->horadiag?></p>
    <p><span>Se receto Lentes</span> <?php echo ($caso->lentes==1)?"Si":"No"?></p>
    <p><span>Estado</span> <?php $est= $caso->estado; echo $estado[$est]?></p>
  </div>
</div>

<script>
$(document).ready(function(){
  $(".ui-widget-content").css('font-size','16px');
  $(".ui-widget-header").css('font-size','20px');
  $("span").css('font-weight','bold');
  $("#botPrint").button({icons:{primary:'ui-icon-print'}});
  $("#botBack").button({icons:{primary:'ui-icon-cancel'}});
});
</script>