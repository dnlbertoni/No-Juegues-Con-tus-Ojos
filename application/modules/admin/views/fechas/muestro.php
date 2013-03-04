<table>
  <thead>
  <tr>
    <th>Dia</th>
    <th>Sede</th>
    <th>Desde</th>
    <th>Hasta</th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <?php foreach($fechas as $f):?>
  <tr>
    <td><?php echo  $f->fecha?></td>
    <td><?php echo  $f->sede?></td>
    <td><?php echo  $f->inicio?></td>
    <td><?php echo  $f->final?></td>
    <td><?php echo anchor('admin/borroFecha/'.$f->id,'Eliminar', 'class="botDelFecha boton"')?></td>
  </tr>
  <?php endforeach;?>
</table>
<?php echo anchor('admin/agregoFecha/', 'Agrego Fecha', 'class="botAddFecha boton ventana"');?>
<script>
$(document).ready(function(){
  $(".botAddFecha").button({icons:{primary:'ui-icon-circle-plus'}});
  $(".botDelFecha").button({icons:{primary:'ui-icon-circle-minus'}, text:false});
  $(".boton").click(function(e){
    e.preventDefault();
    $("#ventanaAjax").dialog({
		autoOpen:false
		});
    url=$(this).attr('href');
    if($(this).hasClass('ventana')){
		$("#ventanaAjax").load(url,[],function(){$("#ventanaAjax").dialog("open")});
	}else{
		$.ajax({url:url, success:function(){$("#ventanaAjax").dialog("destroy")}});
	};
  });
});
</script>
