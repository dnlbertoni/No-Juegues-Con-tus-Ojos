<?php echo Assets::css('pesquizas', 'screen');?>
<?php echo Assets::js('vanadium-min');?>
<?php echo Assets::js('vanadium-types');?>
<?php echo form_open('diagnostico/hojaruta', 'id="hoja-Form"', $ocultos);?>
<h2>Recepcion del Niño - Caso nro:<?php echo $caso->id?></h2>
<table>
  <tr>
    <th colspan="6">Datos Personales</th>
  </tr>
  <tr>
    <th>Apellido:</th>
    <td>
      <?php echo form_input('apellido', $caso->apellido, 'id="apellido" disabled="disabled"')?>
      <div class="botEdit">Editar</div>
    </td>
    <th>Nombre:</th>
    <td>
      <?php echo form_input('nombre', $caso->nombre, 'id="nombre" disabled="disabled"')?>
      <div class="botEdit">Editar</div>
    </td>
    <td colspan="2">
      <div id="sexo" >
        <?php echo form_label('Varon', 's1');?>
        <?php echo form_label('Mujer', 's2');?>
        <?php echo form_radio('sexo', 'M',($caso->sexo=='M')?true:false,'id="s1"')?>
        <?php echo form_radio('sexo', 'F',($caso->sexo=='F')?true:false,'id="s2"')?>
      </div>
    </td>
  </tr>
  <tr>
    <th>DNI:</th>
    <td>
      <?php echo form_input('numdoc', $caso->dni, 'id="numdoc" disabled="disabled" class=":min_length;6 :max_length;8 :required :digits"' );?>
      <div class="botEdit">Editar</div>
    </td>
    <th>Fecha Nac.:</th>
    <td>
      <?php echo form_input('fecnac', $caso->fecnac, 'id="fecnac" class=":required :date"')?>
      <div class="botFec">Fecha</div>
    </td>
    <th>Edad:</th>
    <td>
      <span id="edad"></span>
    </td>
  </tr>
  <tr>
    <th colspan="6">Datos Escolares</th>
  </tr>
  <tr>
    <th>Escuela:</th>
    <td><?php echo $caso->escuela?></td>
    <th>Ciudad:</th>
    <td><?php echo $caso->ciudad?></td>
    <th>Grado:</th>
    <td><?php echo $caso->grado?></td>
  </tr>  
  <tr>
    <th colspan="6">Datos del Programa</th>
  </tr>
  <tr>
    <th>Fecha Test</th>
    <td><?php echo $caso->fechapesq?></td>
    <th>Voluntario</th>
    <td><?php echo $caso->voluntario?></td>
    <th>Dia y Hora Turno</th>
    <td><?php echo $caso->turno ,' ', $caso->hora?></td>
  </tr>  
  <tr>
    <th>Carta:</th>
    <td><?php echo $caso->carta?></td>
    <th>Asistencia</th>
    <td><?php echo $caso->confirmo?></td>
    <th>Tipo de Pesquiza</th>
    <td><?php echo $caso->tipopesq?></td>
  </tr>  
  <tr>
  <th colspan="6">&nbsp;</th>    
  </tr>
</table>
<?php echo form_close()?>
<div id="Grabar">Grabar</div>
<div id="ajax"></div>
<script>
$(document).ready(function(){
  var dni=$("#numdoc").val();
  dni=parseInt(dni);
  if(dni==0){
    $("#numdoc").removeAttr('disabled');
    //$("#numdoc").parent().addClass('estadoPendiente');
  }
  $("#Grabar").button({icons:{primary:'ui-icon-disk'}});
  $("#Grabar").click(function(){
    $("#hoja-Form").submit();
  });
  optionForms = {
    type: 'post',
    beforeSubmit: function(){
        if($("input[name=sexo]:checked").val()=="M" || $("input[name=sexo]:checked").val()=="F" ){
          return true;
        }else{
            alert('No se puede continuar sin DEFNIR EL GENERO DEL CHICO');
            return false;      
        }
        var dni=$("#numdoc").val();
        dni=parseInt(dni);
        if(dni==0 || dni.length > 8 || dni.lenth < 6 ){
          alert('No se puede continuar sin DNI');
          return false;
        }else{
          var edad=$("#edad").text();
          edad=parseInt(edad);
          if(edad>0){
            return true;
          }else{
            alert('No se puede continuar sin ingresar una FECHA DE NACIMIENTO VALIDA');
            return false;
          };
        }      
    },
    success: function(){
      window.open(<?php echo "'",base_url(),'index.php/paper/pdf/hojaDeRuta/',$caso->id,"'"?>, "_blank");
      window.location = <?php echo "'",base_url(),'index.php/diagnostico',"'"?>;
      }
  };
  $("#hoja-Form").ajaxForm(optionForms);
  $("#sexo").buttonset();
  $("#fecnac").datepicker({
    autoSize : true,
    altFormat: 'dd-mm-yy',
    dateFormat: 'yy-mm-dd',
    minDate: '-15Y',
    maxDate: '-3Y',
    changeYear: true,
    changeMonth: true,
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    onSelect:function(){
      hoy=new Date();
      nacio=new Date($(this).val());
      valor = hoy - nacio;
      valor = parseInt(valor/1000/60/60/24/30/12);
      $("#edad").html(valor);
      $('input[name=edad]').val(valor);
      $(this).blur();
    }
  });
  $('.botEdit').button({icons:{primary:'ui-icon-pencil'}, text:false});
  $('.botFec').button({icons:{primary:'ui-icon-calendar'}, text:false});
  $(".botEdit").click(function(){
    $(this).prev().removeAttr('disabled');
  });
  $(".botFec").click(function(){
    $("#fecnac").datepicker('show');
  });
  $(":text:visible:enabled:first").focus();
});
function validoVisualDatos(){
  if($("input[name=sexo]:checked").val()=="M" || $("input[name=sexo]:checked").val()=="F" ){
    $("#sexo").parent().addClass('estadoFinalizada');
  }else{
    $("#sexo").parent().addClass('estadoPendiente');    
  };
}
</script>
