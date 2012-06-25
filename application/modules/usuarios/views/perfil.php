<?php echo form_open($accion, 'id="datos-Form"')?>
<table width="95%" align="center">
  <tr>
    <td colspan="2"><?php echo form_hidden('id', $user->id)?></td>
  </tr>
  <tr>
    <td>
      Apellido
    </td>
    <td>
      <?php echo form_input('apellido', $user->apellido);?>      
    </td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><?php echo form_input('nombre', $user->nombre);?></td>
  </tr>
  <tr>
    <td>Telefono</td><td><?php echo form_input('telefono', $user->telefono);?></td>
  </tr>
  <tr>
    <td>
      <?php echo anchor('home', 'Volver', 'id="Back"');?>
    </td>
    <td>
      <div id="Guardar">Guardar</div>      
    </td>
  </tr>
</table>

<?php echo form_close();?>

<script>
$(document).ready(function(){
  $("#datos-Form").css('background-color', '#F79C1A');
  $("#datos-Form").addClass('ui-widget');
  $("#Guardar").button({icons:{primary:'ui-icon-disk'}});
  $("#Guardar").click(function(){
    $("#datos-Form").submit();
  });
  $("#Back").button({icons:{primary:'ui-icon-circle-arrow-w'}});
});
</script>