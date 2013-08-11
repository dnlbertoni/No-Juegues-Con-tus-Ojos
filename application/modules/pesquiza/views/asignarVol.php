<h3>Asingar Voluntario</h3>
<?php echo form_open('pesquiza/asignaVolDo', 'id="asingacion"', $ocultos);?>
<?php echo form_dropdown('voluntario_id', $optVoluntarios, 1);?>
<?php echo form_close();?>