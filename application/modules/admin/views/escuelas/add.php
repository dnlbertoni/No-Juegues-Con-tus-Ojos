<?php echo form_open($accion, 'id="escuela-Form"')?>
<?php if($esc->id==''):?>
  <?php echo form_hidden('id', '');?>
<?php else: ?>
Id : <?php echo form_input('id', $esc->id, '');?>
<?php endif?>
<br />
Nombre:<?php echo form_input('nombre', $esc->nombre, '');?>
<br/>
Direccion:<?php echo form_input('direccion', $esc->direccion, '');?>
<br/>
Telefono:<?php echo form_input('telefono', $esc->telefono, '');?>
<br/>
Director:<?php echo form_input('director', $esc->director, '');?>
Numero Establecimiento:<?php echo form_input('numero_estab', $esc->numero_estab, '');?>
<?php echo form_close();?>
<div id="Guardar" class="boton"><?php echo $botGuardar?></div><div id="Cancelar" class="boton">Cancelar</div>

<script>
$(document).ready(function(){
  $(".boton").button();
  var options = {
      //target:     '#divToUpdate',
      //url:        'comment.php',
      success:    function() {
        var nombre= $('#escuela-Form').parent().attr('id');
        nombre = "#" + nombre;
        $(nombre).dialog('destroy');
        location.reload();
      }
  };
  $("#escuela-Form").ajaxForm(options);
  $("#Guardar").click(function(){
    $("#escuela-Form").submit();
  });
  $("#Cancelar").click(function(){
    var nombre = "#" + $(this).parent().attr('id');
    $(nombre).dialog("close");
  });
});
</script>