<h3>Asingar Voluntario</h3>
<?php echo form_open('pesquiza/asignaVolDo', 'id="asignacion"', $ocultos);?>

  <?php echo form_dropdown('voluntario_id', $optVoluntarios, 1);?>
<div id="botAsignar">Asignar</div>
<?php echo form_close();?>

<script>
  $(document).ready(function(){
    $("#botAsignar").button();
    $("#asignacion").ajaxForm();
    $("#botAsignar").click(function(){
      $("#asignacion").submit();
      ventana = $("#asignacion").parent();
      ventana.dialog("close");
    });
  });
</script>