<div id="resultadosTabs">
	<ul>
      <?php foreach($escuelas as $esc):?>
      <li><a href="#tabs-<?php echo $esc['id']?> "><?php echo substr($esc['nombre'],0,10)?></a></li>
      <?php endforeach;?>
	</ul>
  <?php $escAux=false;?>
  <?php $primero=true;?>
  <?php foreach($nene as $n):?>
    <?php if($escAux!=$n->escuela_id):?>
      <?php if($primero):?>
        <?php $primero=false;?>
        <div id="tabs-<?php echo $n->escuela_id?>">
      <?php else:?>
          </table>
          </p>
        </div>
        <div id="tabs-<?php echo $n->escuela_id?>">
      <?php endif;?>
      <p>
      <table>
      <tr>
        <th>Apellido</th>
        <th>Nombre</th>
        <th>DNI</th>
        <th>Grado</th>
        <th>Turno Asignado</th>
        <th>Accion</th>      
      </tr>
      <?php $escAux=$n->escuela_id?>
    <?php endif;?>
    <tr>
      <td><?php echo $n->apellido?></td>
      <td><?php echo $n->nombre?></td>
      <td><?php echo $n->dni?></td>
      <td><?php echo $n->grado?></td>
      <td><?php echo $n->turno?></td>
      <td>
        <?php if($n->programa!=$this->session->userdata('programa_id')):?>
          <div class="ui-state-error">Este chico no pertenece a este programa en curso</div>
        <?php else:?>
          <?php if($n->estado!=0):?>
            <div class="ui-state-error">Este chico ya fue recibido</div>
            <?php echo anchor('paper/pdf/hojaDeRuta/'.$n->id,'Reimprimir', 'class="botonPrn" target="_blank"');?>
          <?php else:?>
            <?php echo anchor('diagnostico/recibir/'.$n->id,'Recibir', 'class="boton"');?>
          <?php endif;;?>
        <?php endif;;?>
      </td>
    </tr>
  <?php endforeach;?>
    </table>
    </p>
  </div>
</div>
<script>
  $(document).ready(function(){
    $("#resultadosTabs").tabs();
    $(".boton").button({icons:{secondary:'ui-icon-circle-check'}});
    $(".botonPrn").button({icons:{secondary:'ui-icon-print'}, text:true});
    $(".botonPrn").click(function(){
      nombre = "#" + $("#resultadosTabs").parent().attr('id');
      $(nombre).dialog('destroy');
    });
  });
</script>