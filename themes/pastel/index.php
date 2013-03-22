<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Yellowing
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20110123

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('site_name')?></title>
	<?php echo Assets::css('screen'); ?>
    <?php echo Assets::css( 'css/jquery-ui');?>
    <?php echo Assets::css( 'css/jquery-ui.min');?>
	<?php echo Assets::js('jquery-1.8.3'); ?>
	<?php echo Assets::js('jquery-ui-1.9.2'); ?>
	<?php echo Assets::js('okulo'); ?>
	<?php echo Assets::js('forms'); ?>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
          <h1><?php echo anchor('home/','OKULO');?></h1>
          <p><?php echo $nombrePrograma;?> </p>
          <p><?php echo $ciudadNombre;?></p>
		</div>
		<div id="news">
		  <?php if($this->session->userdata('status')==1):?>
		  <div id="navUser">
			 <?php echo anchor('admin/','Administracion','id="bAdmin"');?>
			 <?php echo anchor('usuarios/perfil',$this->session->userdata('username'),'id="bUser"');?>
			 <?php echo anchor('auth/logout','Salir','id="bOut"');?>
		  </div>
		  <?php endif;?>
          <?php if(ENVIRONMENT==='desarrollo'):?>
			  <p>&nbsp;</p>
              <p>BASE DE DATOS DE PRUEBAS!!!</p>
          <?php endif?>

		</div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="menu">
					<ul>
                      <?php echo Template::block('menu')?>
					</ul>
				</div>
				<!-- end #menu -->
                 <?php echo Template::block('content','_content');?>
                <div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
    <div id="ventanaAjax"></div>
</div>
<div id="footer-wrapper">
	<div id="footer">
      <p id="copyright">© 2011-2013. All Rights Reserved. <br/>
      <a href="http://www.rotarysaltogrande.org.ar/" target="_blank">Rotary Salto Grande Concordia</a> by <a href="mailto:daniel.bertoni@gmail.com" >DnL</a><br/>
      Version 3.0 <?php echo ENVIRONMENT?></p>
	</div>
</div>
<!-- end #footer -->
<script>
	$(document).ready(function(){
		$("#bAdmin").button({icons:{secondary:'ui-icon-wrench'},text:true});
		$("#bUser").button({icons:{secondary:'ui-icon-person'},text:true});
		$("#bOut").button({icons:{secondary:'ui-icon-power'},text:false});
	});
</script>
</body>
</html>
