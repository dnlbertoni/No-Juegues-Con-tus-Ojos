<h3>Cantidad de Alumnos derivados: <span id="derivadosAux"><?php echo count($derivados)?></span></h3>
<table>
    <thead>
        <tr>
          <th>Derivado</th>
          <th>Apellido</th>
          <th>Nombre</th>
          <th>Documento</th>
          <th>Sexo</th>
          <th>Ojo Izq</th>
          <th>Ojo Der</th>
          <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if($derivados):?>
          <?php foreach($derivados as $alu):?>
          <tr>
              <td><?php echo $alu->id?></td>
              <td><?php echo $alu->apellido?></td>
              <td><?php echo $alu->nombre?></td>
              <td><?php echo $alu->numdoc?></td>
              <td><?php echo $alu->sexo?></td>
              <td><?php echo $alu->izq?></td>
              <td><?php echo $alu->der?></td>
              <td><?php echo anchor('pesquiza/borroAlumno/'.$alu->id,'Quitar','class="delAlu"')?></td>
          </tr>
          <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
<style>
.ui-button.M {
    background-color: blue;
}
.ui-button.F {
    background-color: pink;
}
</style>

<script>
  $(document).ready(function(){
    //colores del sexo

    valor = $("#derivadosAux").text();
    $("#derivados").val(valor);
    $(".delAlu").button({icons:{primary:'ui-icon-trash'},text:false});
    $(".delAlu").click(function(e){
      e.preventDefault();
      url= $(this).attr('href');
      $.ajax({
            url:url,
            success:function(){
                    muestroDerivados();
            }           
          });
    });
  });
</script>