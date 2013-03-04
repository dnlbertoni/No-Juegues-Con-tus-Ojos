<h2>Listado de Escuelas</h2>
<?php echo anchor('admin/escuelas/add', 'Nueva escuela', 'id="botEscuela""');?>
<div class="post">
<table>
  <thead>
  <tr>
    <th>Id</th>
    <th>Nombre</th>
    <th>Numero Establecimiento</th>
    <th>Ciudad</th>
    <th>&nbsp;</th>
  </tr>
  </thead>
<?php foreach($escuelas as $esc):?>
  <tr>
    <td><?php echo $esc->id ?></td>
    <td><?php echo $esc->nombre?></td>
    <td><?php echo $esc->numero_estab?></td>
    <td><?php echo $esc->ciudad?></td>
    <td>
        <?php echo anchor('admin/escuelas/edit/'.$esc->id,'Editar','class="botEdit"')?>
        <?php echo anchor('admin/escuelas/del/'.$esc->id,'Borrar','class="botBorrar"')?>
    </td>
  </tr>
<?php endforeach?>
</table>
</div>
<div id="ventanaAjax"></div>
<script>
$(document).ready(function(){
   $(".botTransporte").button({icons:{primary:'ui-icon-transferthick-e-w'}, text:true});
});
</script>
