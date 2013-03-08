<?php echo form_open($accion, 'id="ciudad-Form"')?>
<table>
  <tr>
    <th>Nombre:</th>
    <td><?php echo form_input('nombre', $ciu->nombre, 'size="20"');?></td>
  </tr>
  <tr>
    <th>Direccion:</th>
    <td><?php echo form_input('cpostal', $ciu->cpostal, 'size="40"');?></td>
  </tr>
  <tr>
    <th>Ciudad:</th>
    <td><?php echo form_input('provincia',$ciu->provincia, '');?></td>
  </tr>
  <tr>
    <th>Telefono:</th>
    <td><?php echo form_input('pais', $ciu->pais, 'size="20"');?></td>
  </tr>
  <tr>
    <td colspan="2"><div id="Guardar" class="boton"><?php echo $botGuardar?></div><div id="Cancelar" class="boton">Cancelar</div></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo form_hidden('programa_id', $ciu->programa_id, '');?></td>
    <td colspan="2"><?php echo form_hidden('id', $ciu->id, '');?></td>
  </tr>
</table>
<?php echo form_close();?>


<script>
$(document).ready(function(){
  $('input').css('float','left');
  $("#lugartransporte").css('width','250');
  $(".boton").button();
  var options = {
      //target:     '#divToUpdate',
      //url:        'comment.php',
      success:    function() {
        var nombre= $('#ciudad-Form').parent().attr('id');
        nombre = "#" + nombre;
        $(nombre).dialog('destroy');
        location.reload();
      }
  };
  $("#ciudad-Form").ajaxForm(options);
  $("#Guardar").click(function(){
    $("#ciudad-Form").submit();
  });
  $("#Cancelar").click(function(){
    var nombre = "#" + $(this).parent().attr('id');
    $(nombre).dialog("close");
  });
});
</script>