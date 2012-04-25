<?php echo form_open('personas/searchDo', 'id="search-Form"')?>
Apellido:<?php echo form_input('apellidoTXT')?>
<br />
Nombre:<?php echo form_input('nombreTXT')?>
<?php echo form_submit('Buscar', "Buscar");?>
<?php echo form_close()?>

<script>
$(document).ready(function(){
  $("#search-Form").submit(function(e){
    e.preventDefault();
  });
});
</script>