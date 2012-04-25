<?php echo form_open('pesquiza/observDo', 'id="observ-form"', $ocultos);?>
<?php echo form_textarea('texto', $observ, 'id="texto"');?>
<div id="save">Guardar</div>
<?php echo form_close();?>

<script>
$(document).ready(function(){
  $("#texto").css('width','300');
  $("#save").button({icons:{primary:'ui-icon-disk'}});
    var options = {
    success:    function() {
        nombre=<?php echo $idTarget?>;
        $(nombre).html($("#texto").val());
        $("#ventanaAjax").dialog('destroy');
    }
  };
  $("#observ-form").ajaxForm(options);
  $("#save").click(function(){
    $("#observ-form").submit();
  })
});
</script>