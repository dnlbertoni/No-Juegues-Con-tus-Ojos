<table>
  <thead>
  <tr>
    <th>Dia</th>
    <th>Desde</th>
    <th>Hasta</th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <?php foreach($fechas as $f):?>
  <tr>
    <td><?php echo  $f->fecha?></td>
    <td><?php echo  $f->inicio?></td>
    <td><?php echo  $f->final?></td>
    <td><?php echo anchor('cfg/eliminoFecha/'.$f->id,'Eliminar')?></td>
  </tr>
  <?php endforeach;?>
</table>
<?php echo anchor('cfg/agregoFecha/', 'Agrego Fecha', 'class="botAddFecha"');?>
<script>
$(document).ready(function(){
  $(".botAddFecha").button({icons:{primary:'ui-icon-circle-plus'}});
  $(".botAddFecha").click(function(e){
    e.preventDefault();
    $("#ventanaAjax").dialog({autoOpen:false});
    url=$(this).attr('href');
    $("#ventanaAjax").load(url,[],function(){$("#ventanaAjax").dialog("open")});
  });
});
</script>