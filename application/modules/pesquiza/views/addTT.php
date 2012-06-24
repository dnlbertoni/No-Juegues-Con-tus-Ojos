<?php echo Assets::css('jquery.ptTimeSelect', 'screen');?>
<?php echo Assets::js('jquery.ptTimeSelect');?>
<?php echo form_open('pesquiza/asignarTurnotransporteDo', 'id="form-turnos"', $ocultos);?>
<table>
  <tr>
    <td>Escuela:</td>
    <td><?php echo $escuela->nombre;?></td>
  </tr>
  <tr>
    <td>Dia:</td>
    <td>
      <div id="dia">
        <?php $c=1?>
        <?php foreach($diasTurnos as $dT):?>
          <?php echo form_label($dT['label'], 'd'.$c);?>
          <?php echo form_radio('dia', $dT['value'], false, 'id="d'.$c.'"');?>
          <?php $c++;?>
        <?php endforeach;?>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      Hora:
    </td>
    <td><?php echo form_input('hora', '', 'id="hora"');?></td>
  </tr>
  <tr>
    <td>
      Transporte:
    </td>
    <td>
      <div id="transporte">
        <?php echo form_label('Facultad', 't1');?>
        <?php echo form_label('Escuela', 't2');?>
        <?php echo form_radio('transporte', 0, true, 'id="t1"');?>
        <?php echo form_radio('transporte', 1, false, 'id="t2"');?>
      </div>
    </td>
  </tr>  
  <tr id="lineaTiempo">
    <td>
      Tiempo de viaje:
    </td>
    <td><?php echo form_dropdown('viaje', $tiempoViajes, 0,'id="viaje"');?> minutos</td>
  </tr>  
  <tr id="lineaCitacion">
    <td>
      Hora de Citacion:
    </td>
    <td><?php echo form_input('citacion', '', 'id="citacion"');?></td>
  </tr>  
  <tr>
    <td colspan="2"><div id="Grabar">Asignar</div></td>
  </tr>
</table>
<?php echo form_close();?>

<div id="time"></div>

<script>
$(document).ready(function(){
  $("#lineaTiempo").hide();
  $("#lineaCitacion").hide();
  $("#transporte").buttonset();
  $("#dia").buttonset();
  $("#t2").click(function(){
    if($(this).attr('id')=='t1'){
      $("#lineaTiempo").hide();
      $("#lineaCitacion").hide();
    }else{
      $("#lineaTiempo").show();
      $("#lineaCitacion").show();      
    }
  });
  $("#viaje").change(function(){
    hor=$("#hora").val().split(':');
    min=hor[1].split(' ');
    hora=(min[1].trim()=='AM')?hor[0]:parseInt(hor[0])+12;
    horaTurno = new Date(0,0,0,parseInt(hora),parseInt(min[0]));
    horaTurno.setTime(horaTurno.getTime() - (parseInt($(this).val())*60*1000));
    $("#citacion").val(horaTurno.toTimeString());
  });
  $("#form-turnos").ajaxForm({
        success:    function(data) {
            $("#esc_<?php echo $escuela->id?>").html(data);
            var nombre= $('#form-turnos').parent().attr('id');
            nombre = "#" + nombre;
            $(nombre).dialog('destroy');
            location.reload();
        }
  });
  $("#Grabar").button();
  $("#Grabar").click(function(){
    $("#form-turnos").submit();
  });
  $("#hora").ptTimeSelect({
    containerClass: "timeCntr",
	containerWidth: "250px",
	containerHeigth: "250px",
	setButtonLabel: "Asignar",
	minutesLabel: "Minutos",
	hoursLabel: "Hora",
    zIndex:5000
  });
});
</script>