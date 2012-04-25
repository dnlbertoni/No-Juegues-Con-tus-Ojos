<br/>
<br/>
<br/>
<table>
  <thead>
    <th colspan="2">
      Datos Personales
    </th>
  </thead>
  <tr>
    <td>Caso</td>
    <td><?php echo $caso->id?></td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><?php echo $caso->apellido?>, <?php echo $caso->nombre?></td>
  </tr>
  <tr>
    <td>DNI</td>
    <td><?php echo $caso->numdoc?></td>
  </tr>
  <tr>
    <td>Fecha Nacimiento</td>
    <td><?php echo $caso->fecnac?></td>
  </tr>
  <thead>
    <th colspan="2">
    Datos Escolares
    </th>
</thead>
  <tr>
    <td>Colegio</td>
    <td><?php echo $caso->escuela_id?> - <?php echo $caso->colegio?></td>
  </tr>
  <tr>
    <td>Grado</td>
    <td><?php echo $caso->grado?>&nbsp;<?php echo $caso->division?></td>
  </tr>
  <thead>
    <th colspan="2">
    Datos Del Programa
  </th>
</thead>
  <tr>
    <td>Pesquiza Nro</td>
    <td><?php echo $caso->pesquiza_id?></td>
  </tr>
  <tr>
    <td>Voluntario</td>
    <td><?php echo $caso->voluntario?> - <?php echo $caso->apevol?>, <?php echo $caso->nomvol?></td>
  </tr>
  <tr>
    <td>Dia Pesquiza</td>
    <td><?php echo $caso->fechapesq?></td>
  </tr>
  <tr>
    <td>Diagnostico</td>
    <td><?php echo $caso->fechadiag?> - <?php echo $caso->horadiag?></td>
  </tr>
  <tr>
    <td>Se receto Lentes</td>
    <td><?php echo ($caso->lentes==1)?"Si":"No"?></td>
  </tr>
  <tr>
    <td>Estado</td>
    <td><?php $est= $caso->estado; echo $estado[$est]?></td>
  </tr>
</table>
<?php echo anchor($accion, $textoBoton, 'id="Baccion"')?>

<script>
$(document).ready(function(){
  $("table").css('font-size','16px');
  $("#Baccion").button();
});
</script>