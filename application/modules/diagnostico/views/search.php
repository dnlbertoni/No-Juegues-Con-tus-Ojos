<style>
.ui-autocomplete-loading { background: white url('../assets/img/loading.gif') right center no-repeat; }
</style>

<?php echo Assets::add_js('forms');?>
<?php echo form_open($accion, 'id="search-Form"')?>
<?php echo form_label($texto);?>
<?php echo form_input('texto','', 'id="texto"')?>
<div id="buscarDiag">Buscar</div>
<?php if(isset($pageEscuelas)):?>
  <div class="ui-widget" style="font-family:Arial">
    <div id="log" style="height: 25px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
  </div>
<?php endif;?>
<?php echo form_close()?>
<div id="resultados"></div>

<script>
$(document).ready(function(){
  $('input').keyup(function(){
    valor = $(this).val().toUpperCase();
    $(this).val(valor);
  });
  var options = {
    target:     '#resultados',
    //url:        'comment.php',
    success:    function() {
        var nombre= $('#search-Form').parent().attr('id');
        nombre = "#" + nombre;
        //$(nombre).dialog('destroy');
        //location.reload();
    }
  };
  $("#search-Form").ajaxForm(options);
  $("#buscarDiag").button({icons:{primary:'ui-icon-search'}});
  $("#buscarDiag").click(function(){
    $("#search-Form").submit()
  });
  <?php if(isset($pageEscuelas)):?>
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
  <?php endif;?>
  $("#texto").focus();
});
</script>