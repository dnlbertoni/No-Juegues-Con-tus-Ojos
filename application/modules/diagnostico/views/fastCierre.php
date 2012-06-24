<?php echo form_open($accion, 'id="add-caso"');?>
<?php echo form_label($titulo);?>
<p>&nbsp;</p>
<?php echo form_label($texto, 'texto');?>
<?php echo form_input('texto', '', 'id="texto"');?>
<?php echo form_submit($texto, $texto);?>
<?php echo form_close();?>

<div id="resultados"></div>

<script>
$(document).ready(function(){
  $("#add-caso").addClass('ui-widget');
  $("#add-caso").addClass('formCentral');
  $("#texto").focus();  
  $("#resultados").load(<?php echo $pagina?>);
  options={
    target: '#resultados',
    success: function(){
      $("#texto").val('');
      $("#texto").focus();
    }
  };
  $("#add-caso").ajaxForm(options);
});
</script>