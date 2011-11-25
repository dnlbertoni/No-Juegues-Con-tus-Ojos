<h2>Programas Vigentes</h2>

<?php foreach($programas as $p):?>
  <?php echo anchor('auth/login/' . $p->id, $p->nombre . " en " .$p->ciudadNombre, 'id="boton' . $p->id . '"');?>
<div style="clear: both">&nbsp;</div>
<?php endforeach; ?>

<script>
$(document).ready(function(){
  $('div [id^=boton]').button();
  $('div [id^=boton]').css('margin','auto');
});
</script>
