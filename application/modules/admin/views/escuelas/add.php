<?php echo form_open($accion, 'id="escuela-Form"')?>
<table>
  <tr>
    <th>Nombre:</th>
    <td><?php echo form_input('nombre', $esc->nombre, 'size="20"');?></td>
  </tr>
  <tr>
    <th>Direccion:</th>
    <td><?php echo form_input('direccion', $esc->direccion, 'size="40"');?></td>
  </tr>
  <tr>
    <th>Ciudad:</th>
    <td><?php echo form_dropdown('ciudad_id', $selCiudades,$esc->ciudad_id, '');?></td>
  </tr>
  <tr>
    <th>Telefono:</th>
    <td><?php echo form_input('telefono', $esc->telefono, 'size="20"');?></td>
  </tr>
  <tr>
    <th>Director:</th>
    <td><?php echo form_input('director', $esc->director, 'size="20"');?></td>
  </tr>
  <tr>
    <th>Numero Establecimiento:</th>
    <td><?php echo form_input('numero_estab', $esc->numero_estab, 'size="5"');?></td>
  </tr>
  <tr>
    <th>lugar de retiro de Transporte:</th>
    <td><?php echo form_textarea('lugarTransporte', $esc->lugartransporte,'id="lugartransporte" ');?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div id="Guardar" class="botonGuardar" ><?php echo $botGuardar?></div><div id="Cancelar" class="botonCancelar">Cancelar</div></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo form_hidden('programa_id', $esc->programa_id, '');?></td>
    <td colspan="2"><?php echo form_hidden('id', $esc->id, '');?></td>
  </tr>
</table>
<?php echo form_close();?>


<script>
$(document).ready(function(){
  $('input').css('float','left');
  $("#lugartransporte").css('width','250');
  $("#lugartransporte").attr('rows','3');
  $('.botonGuardar').button({icons:{primary:'ui-icon-disk'},text:true})
  $('.botonCancelar').button({icons:{primary:'ui-icon-cancel'},text:true})
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