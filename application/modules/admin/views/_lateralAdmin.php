<div id="sidebar">
  <div class="ui-widget">
    <h3 class="ui-widget-header" title="Escuelas"><span class="expande"></span>Escuelas</h3>
    <div class="ui-widget-content">
		<ul>
          <li>
				<?php echo anchor('admin/escuelas/add', 'Nueva Escuela', 'class="botAdd"');?>
				<?php echo anchor('admin/escuelas/add', 'Nueva Escuela');?>
			</li>
			<li>
				<?php echo anchor('admin/escuelas', 'Listado Escuelas',  'class="botEscuela"');?>
				<?php echo anchor('admin/escuelas', 'Listado Escuelas');?>
			</li>
			<li>
				<?php echo anchor('admin/pdf/listadoTransporte/1', 'Listado Transporte',  'class="botPrint"');?>
				<?php echo anchor('admin/pdf/listadoTransporte/1', 'Listado Transporte');?>
			</li>
			<li>
				<?php echo anchor('admin/pdf/listadoTransporte/0', 'Listado a la Facultad',  'class="botPrint"');?>
				<?php echo anchor('admin/pdf/listadoTransporte/0', 'Listado a la Facultad');?>
			</li>
		</ul>
    </div>
  </div>
  <div style="clear:both">&nbsp;</div>
  <!--fin modulo1 -->
  <div class="ui-widget">
    <h3 class="ui-widget-header"><span class="expande"></span>Voluntarios</h3>
    <div class="ui-widget-content">
		<ul>
			<li>
				<?php echo anchor('admin/voluntarios/add', 'Nuevo voluntario', 'class="botAdd"');?>
				<?php echo anchor('admin/voluntarios/add', 'Nuevo voluntario');?>
			</li>
			<li>
				<?php echo anchor('admin/voluntarios', 'Admin. voluntarios',  'class="botVol"');?>
				<?php echo anchor('admin/voluntarios', 'Admin. voluntarios');?>
			</li>
		</ul>
    </div>
  </div>
  <div style="clear:both">&nbsp;</div>
  <!--fin modulo2 -->
  <div class="ui-widget">
    <h3 class="ui-widget-header">Papeleria</h3>
    <div class="ui-widget-content">
		<ul>
			<li>
				<?php echo anchor('admin/notaTutores', 'Nota Tutores', 'class="botDocumento"');?>
				<?php echo anchor('admin/notaTutores', 'Nota Tutores');?>
			</li>
			<li>
				<?php echo anchor('admin/cartaDiagnostico', 'Carta Diagnosico', 'class="botDocumento"');?>
				<?php echo anchor('admin/cartaDiagnostico', 'Carta Diagnosico');?>
			</li>
			<li>
				<?php echo anchor('admin/turnos', 'Turnos', 'class="botDocumento"');?>
				<?php echo anchor('admin/turnos', 'Turnos');?>
			</li>
			<li>
				<?php echo anchor('admin/cartaEntrega', 'Carta Entrega', 'class="botDocumento"');?>
				<?php echo anchor('admin/cartaEntrega', 'Carta Entrega');?>
			</li>
		</ul>
    </div>
  </div>
  <div style="clear:both">&nbsp;</div>
  <!--fin modulo3 -->
  <div style="clear:both">&nbsp;</div>
  <div class="ui-widget">
    <h3 class="ui-widget-header">Ciudades</h3>
    <div class="ui-widget-content">
		<ul>
          <li>
              <?php echo anchor('admin/ciudad', 'Nueva Ciudad', 'class="botAdd"');?>
              <?php echo anchor('admin/ciudad', 'Nueva Ciudad');?>
          </li>
          <li>
              <?php echo anchor('admin/ciudades', 'Admin. ciudades',  'class="botCiu"');?>
              <?php echo anchor('admin/ciudades', 'Admin. ciudades');?>
          </li>
		</ul>
    </div>
  </div>
  <div style="clear:both">&nbsp;</div>
  <!--fin modulo4 -->
  <div style="clear:both">&nbsp;</div>
</div>
<script>
  $(document).ready(function(){
    $(".expande").addClass('ui-icon ui-icon-circle-plus');
    $(".expande").css('float', 'left');
    $(".expande").css('margin', '7px');
    $("#sidebar .ui-widget-content").hide();
    $(".ui-widget-header").click(function(){
      $(this).next().toggle();
      icono=$(this).children();
      icono.toggle();
      });
  });
</script>