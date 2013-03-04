<?php echo form_open($accion, 'id="vol-Form"')?>
<?php echo form_hidden('id', $vol->id)?>
Apellido:<?php echo form_input('apellido', $vol->apellido, '');?>
<br/>
Nombre:<?php echo form_input('nombre', $vol->nombre, '');?>
<br/>
Telefono:<?php echo form_input('telefono', $vol->telefono, '');?>
<br/>
Email:<?php echo form_input('email', $vol->email, '');?>
<?php echo form_close();?>
<div id="Guardar" class="boton"><?php echo $botGuardar?></div><div id="Cancelar" class="boton">Cancelar</div>

<script>
$(document).ready(function(){
  $(".boton").button();
  var options = {
      //target:     '#divToUpdate',
      //url:        'comment.php',
      success:    function() {
        var nombre= $('#vol-Form').parent().attr('id');
        nombre = "#" + nombre;
        $(nombre).dialog('destroy');
        location.reload();
      }
  };
  $("#vol-Form").ajaxForm(options);
  $("#Guardar").click(function(){
    $("#vol-Form").submit();
  });
  $("#Cancelar").click(function(){
    var nombre = "#" + $(this).parent().attr('id');
    $(nombre).dialog("close");
  });
});
</script>