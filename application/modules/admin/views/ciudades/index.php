<h2>Listado de Ciudades</h2>
<div class="post">
<table>
  <thead>
  <tr>
    <th>Id</th>
    <th>Nombre</th>
    <th>Cod. Postal</th>
    <th>Provincia</th>
    <th>Argentina</th>
    <th>&nbsp;</th>
  </tr>
  </thead>
<?php foreach($ciudades as $ciu):?>
  <tr>
    <td><?php echo $ciu->id ?></td>
    <td><?php echo $ciu->nombre?></td>
    <td><?php echo $ciu->cpostal?></td>
    <td><?php echo $ciu->provincia?></td>
    <td><?php echo $ciu->pais?></td>
    <td>
        <?php echo anchor('admin/ciudades/edit/'.$ciu->id,'Editar','class="botEdit"')?>
        <?php echo anchor('admin/ciudades/del/'.$ciu->id,'Borrar','class="botBorrar"')?>
    </td>
  </tr>
<?php endforeach?>
</table>
</div>
<script>
$(document).ready(function(){

});
</script>
