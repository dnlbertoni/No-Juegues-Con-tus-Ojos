<p>&nbsp;</p>
<h2>Cantidad de Confirmados:<?php echo count($chicos);?></h2>
<p>&nbsp;</p>
<table>
  <thead>
  <th>Turno</th>
  <th>Apellido y Nombre</th>
  <th>Escuela</th>
  <th>Turno</th>
  <th>Apellido y Nombre</th>
  <th>Escuela</th>  </thead>
  <?php $lado=1?>
  <?php foreach($chicos as $ch):?>
  <?php if($lado==1):?>
    <tr>
  <?php endif;?>
    <td><?php echo $ch->id?></td>
    <td><?php echo $ch->apellido, ', ', $ch->nombre?></td>
    <td><?php echo $ch->colegio?></td>
  <?php $lado *=-1;?>
  <?php if($lado==1):?> 
    </tr>
  <?php endif;?>
  <?php endforeach;?>
  <?php if($lado==-1):?> 
    </tr>
  <?php endif;?>
</table>