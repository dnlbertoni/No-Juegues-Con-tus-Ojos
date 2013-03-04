<h2>Modificacion Nota de turnos</h2>
<?php echo form_open('admin/turnosDo','id="nota-Form"');?>
<?php echo form_textarea('texto', $texto, 'id="texto"');?>
<div id="Guardar">Guardar</div>
<?php echo form_close();?>
<script>
  $(document).ready(function(){
    $("#Guardar").button({icons:{primary:'ui-icon-disk'}});
    $("#Guardar").click(function(){
      $("#nota-Form").submit();
    });
  });
  </script>