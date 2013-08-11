<h3>Genera Pesquiza de una Escuela</h3>
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
    <td>
        <div id="grados" class="radios">
            <?php echo form_label('1er', 'grados1')?>
            <?php echo form_checkbox('g_1', 1, false, 'id="grados1"')?>
            <?php echo form_label('2do', 'grados2')?>
            <?php echo form_checkbox('g_2', 2, false, 'id="grados2"')?>
            <?php echo form_label('3er', 'grados3')?>
            <?php echo form_checkbox('g_3', 3, false, 'id="grados3"')?>
            <?php echo form_label('4to', 'grados4')?>
            <?php echo form_checkbox('g_4', 4, false, 'id="grados4"')?>
            <?php echo form_label('5to', 'grados5')?>
            <?php echo form_checkbox('g_5', 5, false, 'id="grados5"')?>
            <?php echo form_label('6to', 'grados6')?>
            <?php echo form_checkbox('g_6', 6, false, 'id="grados6"')?>
        </div>
    </td>
  </tr>
  <tr>
    <th>Divisiones</th>
    <td>
        <div id="division" class="radios">
            <?php echo form_label('A', 'divi1')?>
            <?php echo form_checkbox('d_A', 'A', false, 'id="divi1"')?>
            <?php echo form_label('B', 'divi2')?>
            <?php echo form_checkbox('d_B', 'B', false, 'id="divi2"')?>
            <?php echo form_label('C', 'divi3')?>
            <?php echo form_checkbox('d_C', 'C', false, 'id="divi3"')?>
            <?php echo form_label('D', 'divi4')?>
            <?php echo form_checkbox('d_D','D' , false, 'id="divi4"')?>
            <?php echo form_label('E', 'divi5')?>
            <?php echo form_checkbox('d_E', 'E', false, 'id="divi5"')?>
            <?php echo form_label('F', 'divi6')?>
            <?php echo form_checkbox('d_F', 'F', false, 'id="divi6"')?>
        </div>    </td>
  </tr>
</table>
<?php echo form_close()?>

<div id="Generar">Generar</div>
<div id="pesquizasAux">
</div>
<div id="guardar">Grabar</div>
<script>
$(document).ready(function(){
  $(".radios").buttonset();
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
    $("#pesquizasAux").html('');
    var escuela    = "<span>"+$('#escuela').val()+"</span>";
    $("#grados :checked").each(function(){
        var grado=$(this).val();
        $("#division :checked").each(function(){
            texto  ="<div>";
            texto += escuela;
            texto += grado;
            texto += $(this).val();
            texto += "</div>";
            $("#pesquizasAux").append(texto);    
        });    
    })
  });  
  $("#guardar").button({icons:{primary:'ui-icon-disk'}});
  $("#guardar").click(function(){
    $("#autoPesquiza").submit();
  });
});
</script>