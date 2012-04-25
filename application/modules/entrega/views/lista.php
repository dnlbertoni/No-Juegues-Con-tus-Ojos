<br/>
<br/>
<br/>
<table width="95%" align="center">
  <thead>
  <th>Caso</th>
  <th>Nombre</th>
  <th>Colegio</th>
  <th>Grado</th>
  <th>Division</th>
  <th>Estado</th>
  <th>Acciones</th>
  </thead>
  <tbody>
<?php foreach($casos as $caso):?>
  <tr>
    <td><?php echo $caso->id?></td>
    <td><?php echo $caso->apellido,', ', $caso->nombre?></td>
    <td><?php echo $caso->colegio?></td>
    <td><?php echo $caso->grado?></td>
    <td><?php echo $caso->division?></td>
    <td><?php $est = $caso->estado; echo $estado[$est]?></td>
    <td><?php echo anchor('entrega/casoLente/'.$caso->id,'Ver','class="boton"')?></td>
  <tr>
<?php endforeach;?>
  </tbody>
</table>

<script>
  $(document).ready(function(){
    $(".boton").button({icons:{primary:'ui-icon-pencil'}});
  });
</script>