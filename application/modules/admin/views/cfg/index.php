<h2>Configuraciones</h2>
<div><?php echo Template::message()?></div>
<div class="post">
  <div class="ui-widget-header">Datos del Programa</div>
    <div class="ui-widget-content">
      <b>Lugar de realizacion:</b>&nbsp;<?php echo $programa->clubRotario?>
      <b>Lugar de realizacion:</b>&nbsp;<?php echo $programa->responsable?>
    </div>
</div>
<div class="post">
  <div class="ui-widget-header">Datos de la Pesquiza</div>
    <div class="ui-widget-content">
      <div id="muestroPesq"></div>
    </div>
</div>
<div class="post">
  <div class="ui-widget-header">Datos del Diagnostico</div>
    <div class="ui-widget-content">
      <b>Lugar de realizacion:</b>&nbsp;<?php echo $programa->sede_diagnostico?>
      <div id="muestroDiags"></div>
    </div>
</div>
<div class="post">
  <div class="ui-widget-header">Datos del Entrega de Lentes</div>
    <div class="ui-widget-content">
      <b>Lugar de realizacion:</b>&nbsp;<?php echo $programa->sede_entrega?>
      <div id="muestroEntr"></div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#muestroPesq").load(<?php echo $urlMuestroPesq?>);
  $("#muestroDiags").load(<?php echo $urlMuestroDiags?>);
  $("#muestroEntr").load(<?php echo $urlMuestroEntr?>);
});
</script>