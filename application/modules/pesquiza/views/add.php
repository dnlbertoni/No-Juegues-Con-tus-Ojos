<h2>Finalizacion Pesquiza</h2>
<?php echo form_open($accion, 'id="pesquiza-Form"', $ocultos)?>
<table cellpadding="3" cellspacing="10">
  <tr>
    <th>Fecha</th>
    <td><?php echo form_input('fecha', $pesq->fecha,'class="date" size="8"');?></td>
    <th><?php echo anchor('admin/voluntarios/search/voluntario', 'Buscar', 'id="buscarVol"')?> Voluntario </th>
    <td colspan="5">
      <div id="voluntario">( <span id='codigo'><?php echo $pesq->voluntario_id?></span> ) <span id='texto'><?php echo $voluntarioNombre?></span></div>
    </td>
  </tr>
  <tr>
    <th>Escuela</th>
    <td colspan="6">
        <div id="escuela">( <span id='codigo'><?php echo $pesq->escuela_id?></span> ) <span id='texto'><?php echo $escuelaNombre?></span></div>
      <?php //echo anchor('admin/escuelas/search/escuela', 'Buscar', 'id="buscarEsc"')?>
    </td>
  </tr>
  <tr>
    <th>Grado</th>
    <td><?php echo form_input('grado', $pesq->grado, 'size="2"')?></td>
    <th>Division</th>
    <td><?php echo form_input('division', $pesq->division, 'size="2"')?></td>
    <td colspan="3">
      <div id="turnos">
        <?php echo form_label('Turno Mañana', 'turnoM');?>
        <?php echo form_radio('turno', 'M', ($pesq->turno!='T')?true:false, 'id="turnoM"');?>
        <?php echo form_label('Turno Tarde', 'turnoT');?>
        <?php echo form_radio('turno', 'T', ($pesq->turno=='T')?true:false, 'id="turnoT"');?>
      </div>
    </td>
  </tr>
  <tr>
    <th>Alumnos</th>
    <td><?php echo form_input('cant_alum', $pesq->cant_alum, 'size="5"')?></td>
    <th>Presentes</th>
    <td><?php echo form_input('cant_pres', $pesq->cant_pres, 'size="5"')?></td>
    <th>Derivados</th>
    <td><?php echo form_input('cant_prob', $pesq->cant_prob, 'size="5" id="derivados"')?></td>
    <input type="hidden" name="escuela_id" id="escuela_id" value="" />
    <input type="hidden" name="voluntario_id" id="voluntario_id" value="" />
  </tr>
  <tr>
    <td colspan="8">
      <div id="tipos">
        <?php $c=1?>
        <?php foreach($tipos as $dT):?>
          <?php echo form_label($dT['label'], 't'.$c);?>
          <?php echo form_radio('tipo', $dT['value'],$dT['valor'] , 'id="t'.$c.'"');?>
          <?php $c++;?>
        <?php endforeach;?>
      </div>     
    </td>
  </tr>
</table>
<div class="clearfix"><p>&nbsp;</p></div>
<div align="center">
  <div id="Cancelar">Cancelar</div>
  <div id="Guardar"><?php echo $textoBoton?></div>
  <?php echo anchor('pesquiza/agregoAlumno/'.$pesq->id, 'Nuevo Derivado', 'id="botAlumno"');?>
</div>
<div class="clearfix"><p>&nbsp;</p></div>
<div id="alumnos"></div>
<?php echo form_close();?>
<div id="ventanaBusqueda"></div>
<script>
$(document).ready(function(){
  $("#turnos").buttonset();
  $("#tipos").buttonset({ icons: { primary: 'ui-icon-triangle-1-ne'} });
  muestroDerivados();
  $("#Cancelar").button({icons:{primary:'ui-icon-circle-close'}});
  $("#Guardar").button({icons:{primary:'ui-icon-document'}});
  $("#botAlumno").button({icons:{primary:'ui-icon-person'}});
  $("#Cancelar").button({icons:{primary:'ui-icon-circle-close'}});
  $("form").addClass('ui-widget');
  $(".date").datepicker({
    autoSize : true,
    altFormat: 'dd-mm-yy',
    dateFormat: 'dd-mm-yy',
    minDate: new Date(2012, 4 - 1, 1),
    maxDate: new Date(2012, 5 - 1, 30),
    changeYear: false,
    numberOfMonths: [1,2],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    onSelect: function() { $("#voluntario_id").focus() }
  });
  var options = {
      //target:     '#divToUpdate',
      //url:        'comment.php',
      success:    function() {
        var nombre= $('#pesquiza-Form').parent().attr('id');
        nombre = "#" + nombre;
        $(nombre).dialog('destroy');
        location.reload();
      }
  };
  //$("#pesquiza-Form").ajaxForm(options);
  $("#Guardar").click(function(){
    escuela    = $("#escuela > #codigo").text();
    voluntario = $("#voluntario > #codigo").text();
    $("#escuela_id").val(escuela);
    $("#voluntario_id").val(voluntario);
    
    $("#pesquiza-Form").submit();
  });
  $("#Cancelar").click(function(){
    var nombre = "#" + $(this).parent().attr('id');
    $(nombre).dialog("close");
  });
  $("#botAlumno").click(function(e){
    e.preventDefault();
    agregoAlumno();
  });
  $("#buscarVol").button({icons:{primary:'ui-icon-search'}, text:false});
  $("#buscarVol").click(function(e){
    e.preventDefault();
    buscoVoluntario();
  });
  $("#buscarEsc").button({icons:{primary:'ui-icon-search'}});
  $("#buscarEsc").click(function(e){
    e.preventDefault();
    buscoEscuela();
  });
});
function buscoVoluntario(){
  url = $("#buscarVol").attr('href');
  var Options = {
    autoOpen: false,
    modal: true,
    title: "Buscar Voluntario"
  };
  $("#ventanaBusqueda").dialog(Options);
  $("#ventanaBusqueda").load(url, [], function(){
      $("#ventanaBusqueda").dialog("open");
  });
}
function buscoEscuela(){
  url = $("#buscarEsc").attr('href');
  var Options = {
    autoOpen: false,
    modal: true,
    title: "Buscar Escuela"
  };
  $("#ventanaBusqueda").dialog(Options);
  $("#ventanaBusqueda").load(url, [], function(){
      $("#ventanaBusqueda").dialog("open");
  });
}
function agregoAlumno(){
  url = $("#botAlumno").attr('href');
  var Options = {
    autoOpen: false,
    modal: true,
    title: "Agrego Alumno"
  };
  $("#ventanaBusqueda").dialog(Options);
  $("#ventanaBusqueda").load(url, [], function(){
      $("#ventanaBusqueda").dialog("open");
  });
}
function muestroDerivados(){
  url = <?php echo $paginaDerivados?>;
  $('#alumnos').load(url, '', '');
}
</script>