<h2>Papeleria</h2>
<div class="post">
<?php echo anchor('paper/pdf/imprimeEtiquetasLentes', 'Etiquetas Lentes', 'class="boton"')?>
<?php echo anchor('paper/listadoLentes','Listado Lentes', 'class="boton" target="_blank"')?>
<?php echo anchor('paper/pdf/pesquizaPlanilla', 'Planilla de Pesquizas', 'class="boton"')?>
<?php echo anchor('paper/pdf/notaTutores', 'Nota a Tutores', 'class="boton"')?>    
<?php echo anchor('paper/pdf/cartaDiagnostico', 'Carta Diagnostico', 'class="boton"')?>    
<?php echo anchor('paper/pdf/hojaDeRuta', 'Hoja de Ruta en Blanco', 'class="boton"')?>    
</div>

<script>
  $(document).ready(function(){
    $(".boton").button();
  });
</script>  