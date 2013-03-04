<h2>Listado de Voluntarios</h2>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Telefono</th>
      <th colspan="3">Acciones</th>
    </tr>
  </thead>
<?php foreach($voluntarios as $vol):?>
  <tr>
    <td><?php echo $vol->id ?></td>
    <td><?php echo $vol->apellido, ', ',$vol->nombre?></td>
    <td><?php echo $vol->telefono ?></td>
    <td><?php echo anchor('admin/voluntarios/mail/'.$vol->id,'Enviar Mail','class="botMail"')?></td>
    <td><?php echo anchor('admin/voluntarios/edit/'.$vol->id,'Editar','class="botEdit"')?></td>
    <td><?php echo anchor('admin/voluntarios/del/'.$vol->id,'Editar','class="botBorrar"')?></td>
  </tr>
<?php endforeach?>
</table>
<div id="ventanaAjax"></div>