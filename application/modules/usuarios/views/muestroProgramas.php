<?php foreach($programas as $p):?>
  <?php echo anchor('usuarios/agregoProgramaDo/'.$p->id.'/'.$usuario,  $p->nombre . '-' . $p->ciudad, 'class="botAddProg"' );?>
<?php endforeach; ?>
<script>
  $(document).ready(function(){
    $(".botAddProg").button({icons:{secondary:'ui-icon-circle-plus'}});
  });
</script>