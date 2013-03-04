<h1><?php echo $titulo?></h1>

<?php echo form_open($accion, 'id="search-Form"', $ocultos)?>
<?php echo form_input('searchTXT', 'Buscar..', 'id="searchTXT"')?>
<input type="hidden" name="filtro" value="A" id="filtro" />
<br />
<div id="buscarApe">Buscar Apellido</div>
<div id="buscarNom">Buscar Nombre</div>
<?php echo form_close();?>
<div id="formAjax"></div>

<script>
$(document).ready(function(){
  $('form').addClass('ui-widget');
  $("#searchTXT").bind('focus', '', function(){
    $(this).val('');
  });
  $("#searchTXT").change(function(){
    var valor = $(this).val().toUpperCase();
    $(this).val(valor);
  });
  $("#buscarApe").button();
  $("#buscarApe").click(function(e){
    $("#filtro").val('A');
    e.preventDefault();
    $("#search-Form").submit();
  });
  $("#buscarNom").button();
  $("#buscarNom").click(function(e){
    $("#filtro").val('N');
    e.preventDefault();
    $("#search-Form").submit();
  });
  var dialogOpts = {autoOpen:false, modal:true};
  //$("#formAjax").dialog(dialogOpts);
  //var options = {target:"#formAjax", success:function(){$("#formAjax").dialog("open")}};
  var options = {target:"#formAjax"};
  $("#search-Form").ajaxForm(options);
});
</script>