<br />
<table cellspacing="10">
<?php foreach($botones as $boton):?>
  <tr><td>
  <?php if(isset($boton['accion'])):?>
    <?php echo anchor($boton['accion'],
                      $boton['texto'],
                      'id="'.$boton['id'].'" target="'.$boton['target'].'" class="'.$boton['clase'].'"');?>
  <?php else:?>
      <div id="<?php echo $boton['id']?>" class="<?php echo $boton['clase']?>" ><?php echo $boton['texto']?></div>
  <?php endif;?>
  </td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
<?php endforeach;?>
</table>


<script>
  $(".print").button({icons:{primary:'ui-icon-print'}});
  $(".print").css('font-size', '12px');
  $(".edit").button({icons:{primary:'ui-icon-pencil'}});
  $(".edit").css('font-size', '12px');
  $(".print").click(function(){
    window.location = <?php echo $back?>;
  });
  $('.save').button({icons:{primary:'ui-icon-disk'}});
  $(".save").css('font-size', '12px');
  $('.back').button({icons:{primary:'ui-icon-circle-arrow-w'}});
  $(".back").css('font-size', '12px');
  $('#Bsave').click(function(){
    $('#update-Form').submit();
  });
  $('.back').click(function(){
    history.go(-1);
  })
</script>