<div class="post">
  <h2>Programas Vigentes</h2>

  <?php foreach($programas as $p):?>
    <?php echo anchor('auth/login/' . $p->id, $p->nombre . " en " .$p->ciudadNombre, 'class="boton"');?>
  <div style="clear: both">&nbsp;</div>
  <?php endforeach; ?>
</div>
<div class="post">
  <h2>Programas Finalizados</h2>

  <?php foreach($programasVie as $p):?>
    <?php echo anchor('auth/login/' . $p->id, $p->nombre . " en " .$p->ciudadNombre, 'class="boton"');?>
  <div style="clear: both">&nbsp;</div>
  <?php endforeach; ?>
</div>
<script>
$(document).ready(function(){
  $('.boton').button();
  $('.boton').css('margin','auto');
});
</script>
