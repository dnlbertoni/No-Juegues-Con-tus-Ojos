<br/>
<br/>
<br/>
<div class="box">
  <?php echo form_open('entrega/casoLente')?>
  <?php echo form_label('Por DNI:')?>
  <?php echo form_input('dniTXT', '', 'id="dniTXT"')?>
  <?php if($error=="dni"):?>
   se produjo un error en la carga del D.N.I
  <?php endif;?>
  <?php echo form_submit('dni', 'Buscar')?>
  <?php echo form_close();?>
</div>
<div class="box">
  <?php echo form_open('entrega/apellidoSearch')?>
  <?php echo form_label('Por Apellido:')?>
  <?php echo form_input('apellidoTXT', '', 'id="apellidoTXT"')?>
  <?php echo form_submit('Buscar', 'Buscar')?>
  <?php echo form_close();?>
</div>
<div class="box">
  <?php echo form_open('entrega/colegioSearch')?>
  <?php echo form_label('Por Colegio:')?>
  <?php echo form_dropdown('colegioTXT', $colSel)?>
  <?php echo form_submit('Buscar', 'Buscar')?>
  <?php echo form_close();?> 
</div>
