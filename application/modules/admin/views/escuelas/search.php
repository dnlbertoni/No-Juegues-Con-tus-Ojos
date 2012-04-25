<h1><?php echo $titulo?></h1>

<?php echo form_open($accion, 'id="search-Form"', $ocultos)?>
<?php echo form_input('searchTXT', 'Buscar..', 'id="searchTXT"')?>
<div id="buscar">Buscar</div>
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
  $("#buscar").button();
  $("#buscar").click(function(e){
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