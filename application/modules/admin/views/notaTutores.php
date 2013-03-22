<h2>Modificacion Nota Tutores</h2>
<div><?php echo $fecha?></div>
<div><?php echo $destinatarios?></div>
<?php echo form_open('admin/notaTutoresDo','id="nota-Form"');?>
<?php echo form_textarea('texto', $texto, 'id="texto"');?>
<div id="Guardar">Guardar</div>
<?php echo form_close();?>
<script>
  $(document).ready(function(){
    $("textarea").attr('cols', '70');
    $("#Guardar").button({icons:{primary:'ui-icon-disk'}});
    $("#Guardar").click(function(){
      $("#nota-Form").submit();
    });
  });
  </script>