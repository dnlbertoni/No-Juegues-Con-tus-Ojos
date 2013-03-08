aca va la ayuda de lo que se hace en este modulo
<br/>
<h2>Datos del Programa Vigente</h2>
<div><?php echo Template::message()?></div>
<div class="post">
  <div class="ui-widget-header">Datos del Programa</div>
    <div class="ui-widget-content">
      <b>Club:</b>Rotary Club <?php echo $programa->clubrotario?>
      <br />
      <b>Rotario Responsable:</b>&nbsp;<?php echo $programa->responsable?>
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
      <div id="muestroDiags"></div>
    </div>
</div>
<div class="post">
  <div class="ui-widget-header">Datos del Entrega de Lentes</div>
    <div class="ui-widget-content">
      <div id="muestroEntr"></div>
    </div>
</div>
<script>
$(document).ready(function(){
  muestroTodo();
})
function muestroTodo(){
  $("#muestroPesq").load(<?php echo $urlMuestroPesq?>);
  $("#muestroDiags").load(<?php echo $urlMuestroDiags?>);
  $("#muestroEntr").load(<?php echo $urlMuestroEntr?>);

}
</script>
