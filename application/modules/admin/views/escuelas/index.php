<h2>Listado de Escuelas</h2>
<table>
  <thead>
  <tr>
    <th>Id</th>
    <th>Nombre</th>
    <th colspan="2">Numero Establecimiento</th>
  </tr>
  </thead>
<?php foreach($escuelas as $esc):?>
  <tr>
    <td><?php echo $esc->id ?></td>
    <td><?php echo $esc->nombre?></td>
    <td><?php echo $esc->numero_estab?></td>
    <td>
        <?php echo anchor('admin/escuelas/edit/'.$esc->id,'Editar','class="botEdit"')?>
        <?php echo anchor('admin/escuelas/del/'.$esc->id,'Borrar','class="botBorrar"')?>
    </td>
  </tr>
<?php endforeach?>
</table>
<div id="ventanaAjax"></div>