<div id="sidebar">
  <div class="ui-widget"> 
    <h3 class="ui-widget-header">Escuelas</h3>
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
    <h3 class="ui-widget-header">Voluntarios</h3>
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
  <!--fin modulo2 -->
</div>
<div style="clear:both">&nbsp;</div>
