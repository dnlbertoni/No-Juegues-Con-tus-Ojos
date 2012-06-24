<style>
.ui-autocomplete-loading { background: white url('../assets/img/loading.gif') right center no-repeat; }
</style>
<?php echo Assets::add_js('forms');?>
<?php echo form_open($accion, 'id="search-Form" target="_blank"')?>
Escuela:<?php echo form_input('texto','', 'id="texto"')?>
<div id="buscarDiag">Buscar</div>
  <div class="ui-widget" style="font-family:Arial">
    <div id="log" style="height: 25px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
  </div>
<?php echo form_close()?>
<div id="resultados"></div>

<script>
$(document).ready(function(){
  $('input').keyup(function(){
    valor = $(this).val().toUpperCase();
    $(this).val(valor);
  });
  $("#buscarDiag").button({icons:{primary:'ui-icon-search'}});
  $("#buscarDiag").click(function(){
    $("#search-Form").submit()
  });
  function log( message ) {
      $( "<div/>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
  }
  $( "#texto" ).autocomplete({
      source:<?php echo $pageEscuelas;?>,
      minLength: 3,
      select: function( event, ui ) {
          log( ui.item ?
              "Escuela: " + ui.item.label :
              "No se encontro ninguna escuela con: " + this.value );
      }
  });  
  $("#texto").focus();
});
</script>