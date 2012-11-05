<p>&nbsp;</p>
<h2>Cantidad de Finalizados:<?php echo count($chicos);?></h2>
<p>&nbsp;</p>
<?php echo $mensaje?>
<p>&nbsp;</p>
<table>
  <thead>
    <th>Turno</th>
    <th>Apellido y Nombre</th>
    <th>Escuela</th>
    <th>Tiempo</th>
    <th>Turno</th>
    <th>Apellido y Nombre</th>
    <th>Escuela</th>  
    <th>Tiempo</th>
  </thead>
  <?php $lado=1?>
  <?php $total=0?>   
  <?php foreach($chicos as $ch):?>
  <?php if($lado==1):?>
    <tr>
  <?php endif;?>
    <td><?php echo $ch->id?></td>
    <td><?php echo $ch->apellido, ', ', $ch->nombre?></td>
    <td><?php echo $ch->colegio?></td>
    <td><?php echo $ch->tiempo?></td>
    <?php $total += $ch->tiempo?>
  <?php $lado *=-1;?>
  <?php if($lado==1):?> 
    </tr>
  <?php endif;?>
  <?php endforeach;?>
  <?php $total = $total / count($chicos);?>
  <?php if($lado==-1):?> 
    </tr>
  <?php endif;?>
</table>
Promedio: <?php echo $total;?>