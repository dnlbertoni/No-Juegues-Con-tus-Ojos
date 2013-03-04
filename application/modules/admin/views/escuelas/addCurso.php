<?php echo form_open($accion, 'id="curso-Form"')?>
<?php echo form_hidden('id',$cur->id);?>
Escuela:<?php echo form_dropdown('escuela_id', $escuelaOpts, $cur->escuela_id);?>
<br/>
Grado:<?php echo form_input('grado', $cur->grado, 'size="3"');?>
<br/>
Division:<?php echo form_input('division', $cur->division, 'size="3"');?>
<br/>
Turno:<?php echo form_dropdown('turno', $turnoOpts, $cur->turno);?>
<br/>
Cant. Alumnos:<?php echo form_input('alumnos', $cur->alumnos, 'size="10"');?>
<?php echo form_close();?>
<div id="Guardar" class="boton"><?php echo $botGuardar?></div><div id="Cancelar" class="boton">Cancelar</div>

<script>
$(document).ready(function(){
  $(".boton").button();
  var options = {
      //target:     '#divToUpdate',
      //url:        'comment.php',
      success:    function() {
        var nombre= $('#curso-Form').parent().attr('id');
        nombre = "#" + nombre;
        $(nombre).dialog('destroy');
        location.reload();
      }
  };
  $("#curso-Form").ajaxForm(options);
  $("#Guardar").click(function(){
    $("#curso-Form").submit();
  });
  $("#Cancelar").click(function(){
    var nombre = "#" + $(this).parent().attr('id');
    $(nombre).dialog("close");
  });
});
</script>