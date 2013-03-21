<?php echo form_open('admin/agregoFechaDo', 'id="addFecha-form"')?>
<div id="tipoevent"><?php echo $tipo?></div>
<?php echo form_label('Fecha', 'fecha')?>
<?php echo form_input('fecha', '', 'id="fecha" class="date" size="12"');?>
<br />
<?php echo form_label('Hora Inicio', 'hora_ini')?>
<?php echo form_input('hora_ini', $horaini, 'id="hora_ini" size="8"');?>
<br />
<?php echo form_label('Hora Fin', 'hora_fin')?>
<?php echo form_input('hora_fin', $horafin, 'id="hora_fin" size="8"');?>
<div id="sedeTXT">
  <?php echo form_label('Sede', 'sede')?>
  <?php echo form_input('sede', '', 'id="sede"');?>
</div>
<?php echo form_close();?>
<div id="botAdd">Agregar</div>
<script>
$(document).ready(function(){
  titulo=(parseInt($("#tipoevent").text())==1)?'Pesquiza':'Diagnostico';
  $("#ventanaAjax").dialog('option','title', 'Agrego Fecha de ' + titulo);
  $('.date').datepicker({ appendText: "(dd/mm/aaaa)",
                          autoSize : true,
                          altFormat: 'dd/mm/yyyy',
                          dateFormat: 'dd/mm/yy',
                          minDate: new Date(<?php echo $min['year']?>, <?php echo $min['mon']?>, <?php echo $min['mday']?>),
                          maxDate: new Date(<?php echo $max['year']?>, <?php echo $max['mon']?>, <?php echo $max['mday']?>),
                          changeYear: false,
                          numberOfMonths: [1,3],
                          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                          dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                          dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                          monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                        });
  $("#tipoevent").hide();
  if(parseInt($("#tipoevent").text())==1){
    $("#sedeTXT").hide();
  }else{
    $("#sedeTXT").show();
  };
  $("#botAdd").button({icons:{primary:'ui-icon-circle-plus'}});
  $("#addFecha-form").submit(function(e){
    e.preventDefault();
  });
  $("#botAdd").click(function(){
    url=$("#addFecha-form").attr('action');
    fecha=$("#fecha").val();
    hora_ini=$("#hora_ini").val();
    hora_fin=$("#hora_fin").val();
    sede=$("#sede").val()
    tipo=$("#tipoevent").text();
    $.ajax({
            type: "POST",
            url: url,
            data: {tipo:tipo , fecha:fecha , hora_ini:hora_ini, hora_fin:hora_fin, sede:sede },
            success: function(){
				$("#ventanaAjax").dialog('destroy');
                muestroTodo();
            }
          });
  });
});
</script>
