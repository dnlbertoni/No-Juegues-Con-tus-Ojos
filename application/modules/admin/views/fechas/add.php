<?php echo form_open('cfg/agregoFechaDo', 'id="addFecha-form"')?>
<?php echo form_label('Fecha', 'fecha')?>
<?php echo form_input('fecha', '', 'id="fecha" class="date"');?>
<?php echo form_label('Hora Inicio', 'hora_ini')?>
<?php echo form_input('hora_ini', '', 'id="hora_ini"');?>
<?php echo form_label('Hora Fin', 'hora_fin')?>
<?php echo form_input('hora_fin', '', 'id="hora_fin" ');?>
<?php echo form_close();?>
<div id="botAdd">Agregar</div>
<script>
$(document).ready(function(){
  $("#botAdd").button({icons:{primary:'ui-icon-circle-plus'}});
  $("#addFecha-form").submit(function(e){
    e.preventDefault();
  });
  $("#botAdd").click(function(){
    url=$("#addFecha-form").attr('action');
    $.ajax({
            type: "POST",
            url: url,
            data: {tipo:2 , fecha:fecha , hora_ini:hora_ini, hora_fin:hora_fin},
            success: function(){
				$("#addFecha-form").parent().dialog('destroy');
    }
          });
  });
});
</script>
