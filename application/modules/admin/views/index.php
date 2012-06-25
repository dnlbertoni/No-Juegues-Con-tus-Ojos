<?php echo anchor('admin/escuelas',    'Escuelas',    'id="Escuelas"');?>
<br/>
<?php echo anchor('admin/voluntarios', 'Voluntarios', 'id="Vols"');?>
<br/>
<?php echo anchor('admin/notaTutores', 'Modificar Nota Tutores', 'id="Tutores"');?>
<?php echo anchor('admin/cartaDiagnostico', 'Modificar Carta Diagnosico', 'id="Diagnostico"');?>
<div id="ventanaAjax"></div>
<script>
$(document).ready(function(){
    $("#Escuelas").button({icons:{primary:'ui-icon-home'}});
    $("#Vols").button({icons:{primary:'ui-icon-person'}});
    $("#Tutores").button({icons:{primary:'ui-icon-document'}});
    $("#Diagnostico").button({icons:{primary:'ui-icon-search'}});
    $("#Volver").button({icons:{primary:'ui-icon-circle-arrow-w'}});
});
</script>