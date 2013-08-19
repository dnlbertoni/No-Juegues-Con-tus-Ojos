<?php echo form_open($accion,'id="alumno-Form"',$ocultos)?>
Apellido:<?php echo form_input('apellido', '', 'id="apellido" class="texto"')?>
<br />
Nombre:<?php echo form_input('nombre', '', 'id="nombre" class="texto"')?>
<div id='radio_sexo'>
  <?php echo form_label('Femanino', 'sexo1');?>
  <?php echo form_radio('sexo', 'F', true, 'id="sexo1"');?>
  <?php echo form_label('Masculino', 'sexo2');?>
  <?php echo form_radio('sexo', 'M', false, 'id="sexo2"');?>
</div>
<br />
D.N.I:<?php echo form_input('dni', '', 'id="dni"')?>
<br />
Ojo IZQ:<?php echo form_input('izq', '', 'id="izq"')?>
<br />
Ojo DER:<?php echo form_input('der', '', 'id="der"')?>
<?php echo form_close()?>
<div id="GuardarAlumno">Guardar</div>

<script>
  $(document).ready(function(){
    $("#radio_sexo").buttonset();
    $(".texto").keyup(function(){
      valor=$(this).val().toUpperCase();
      $(this).val(valor);
    });
      var options = {
        //target:     '#divToUpdate',
        //url:        'comment.php',
        success:    function() {
            var nombre= $('#alumno-Form').parent().attr('id');
            nombre = "#" + nombre;
            muestroDerivados();
            $(nombre).dialog('destroy');
            //location.reload();
        }
      };
      $("#alumno-Form").ajaxForm(options);
      $("#GuardarAlumno").button({icons:{primary:'ui-icon-disk'}});
      $("#GuardarAlumno").click(function(){
        $("#alumno-Form").submit();
        /*
        $(".ui-dialog-content").each(function(){
          var nom = "#" + $(this).attr('id');
          $(nom).dialog("close");
        });
        */
      });
  });
</script>