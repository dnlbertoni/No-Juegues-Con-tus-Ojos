<h2>Genera Pesquiza de una escuela Automaticamente</h2>
<?php echo form_open($accion, 'id="autoPesquiza"');?>
<table>
  <tr>
    <th>
     Escuela 
    </th>
    <td><?php echo form_dropdown('escuela', $escuelasSel, '' ,'id="escuela"');?></td>
  </tr>
  <tr>
    <th>Fecha Posible</th>
    <td><?php echo form_input('fecha', $fecha->format('d/m/Y'), 'id="fecha"');?></td>
  </tr>
  <tr>
    <th>Grado</th>
    <td><?php echo form_input('grado', 1, 'id="grados"');?></td>
  </tr>
  <tr>
    <th>Cantidad</th>
    <td><?php echo form_input('cantidad', 3, 'id="cantidad"');?></td>
  </tr>
</table>
<?php echo form_close()?>

<div id="Generar">Generar</div>
<div id="pesquizasAux">
  <span>Escuela</span>
  <span>Grado</span>
  <span>Division</span>
</div>
<div id="guardar">Grabar</div>
<script>
$(document).ready(function(){
  $("#fecha").datepicker({
    autoSize : true,
    altFormat: 'dd/mm/yy',
    dateFormat: 'dd/mm/yy',
    minDate: new Date(<?php echo $fechini->format('Y')?>,<?php echo $fechini->format('m')-1?>,<?php echo $fechini->format('d')?> ),
    maxDate: new Date(<?php echo $fechfin->format('Y')?>,<?php echo $fechfin->format('m')-1?>,<?php echo $fechfin->format('d')?> ),
    changeYear: false,
    numberOfMonths: [1,2],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    onSelect: function() { $("#grados").focus() }
  });
  $("#Generar").button();
  $("#Generar").click(function(){
    cursos     = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
    escuela    = "<span>"+$('#escuela').val()+"</span>";
    grado      = "<span>"+$('#grados').val()+"</span>";
    cantidad   = parseInt($('#cantidad').val());
    for(i=0;i<cantidad;i++){
      texto  ="<div>";
      texto += escuela;
      texto += grado;
      texto += "<span>"+cursos[i]+"</span>";
      texto += "</div>";
      $("#pesquizasAux").append(texto);
    };
  });  
  $("#guardar").button({icons:{primary:'ui-icon-disk'}});
  $("#guardar").click(function(){
    $("#autoPesquiza").submit();
  });
});
</script>