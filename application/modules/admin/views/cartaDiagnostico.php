<h2>Modificacion Nota Tutores</h2>
<div><?php echo $fecha?></div>
<div><?php echo $destinatarios?>
<?php echo form_open('admin/cartadiagnosticoDo','id="nota-Form"');?>
Parrafo:<?php echo form_textarea('nota1', $nota1, 'id="nota1"');?>
Parrafo:<?php echo form_textarea('nota2', $nota2, 'id="nota2"');?>
Parrafo:<?php echo form_textarea('nota3', $nota3, 'id="nota3"');?>
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