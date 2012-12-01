<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 3.0 License

Name       : RedAllOver  
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120604

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('site_name')?></title>
	<?php echo Assets::css('screen'); ?>
	<?php echo Assets::css('jquery-ui'); ?>
	<?php echo Assets::js('jquery-1.5.min'); ?>	
	<?php echo Assets::js('jquery-ui-1.8.12.min'); ?>	
	<?php echo Assets::js('okulo'); ?>	
	<?php echo Assets::js('forms'); ?>	
</head>
<body>
<div id="wrapper">
	<div id="menu-wrapper">
	<div id="menu">
		<ul>
          <?php echo Template::block('menu')?>
		</ul>
	</div>
	</div>
	<!-- end #menu -->
	<div id="header">
		<div id="logo">
      <h1>OKULO</h1>
      <h2><?php echo $nombrePrograma;?> </h2>
      <h3><?php echo CLUB_ROTARIO;?> </h3>
      <?php if(DEVELOP==='ALL'):?>
        <span class="ui-state-error"><?php echo $database ?> POR FAVOR NO GRABAR NADA IMPORTANTE YA QUE ES UNA BASE DE DATOS DE PRUEBAS Y SERA BORRADO TODO</span>
      <?php endif?>
      <?php if(DEVELOP===1):?>
        <span class="ui-state-error"><?php echo $database ?> POR FAVOR PREGUTNAR ANTES DE TRABAJAR YA QUE PUEDE SER UNA BASE DE DATOS DE PRUEBAS Y SERA BORRADO TODO</span>
      <?php endif?>
		</div>
	</div>
	<!-- end #header -->
	<div id="about">
		<h2 class="title">Amet mattis fringilla nisl</h2>
		<p><img src="images/pics01.jpg" alt="" width="225" height="225" class="alignleft" />Libero rutrum felis dignissim accumsan cum at purus. Nisi lacinia duis dignissim purus. Cubilia mollis scelerisque a faucibus orci congue. Faucibus tristique elit varius nibh tristique lectus lorem. Donec risus mi egestas ultricies. Velit enim diam id magna hendrerit. Augue massa odio tempus. Metus nisl purus semper massa viverra. Auctor tincidunt dignissim montes duis integer faucibus. Eget felis nascetur magnis magnis ultricies velit. Libero rutrum felis dignissim accumsan cum at purus. Donec risus mi egestas ultricies. Velit enim diam id magna hendrerit. Augue massa odio tempus. Metus nisl purus semper massa viverra.</p>
	</div>
	<div id="page">
		<div id="content">
			<div class="post">
				<h2 class="title"><a href="#">Lorem ipsum sed aliquam</a></h2>
				<p class="meta">Posted by <a href="#">Someone</a> on May 27, 2012
					&nbsp;&bull;&nbsp; <a href="#" class="comments">Comments (64)</a> &nbsp;&bull;&nbsp; <a href="#" class="permalink">Full article</a></p>
				<div class="entry">
					<p>This is <strong>RedAllOver</strong>, a free, fully standards-compliant CSS template designed by <a href="http://www.freecsstemplates.org">FCT</a>.  The picture is from <a href="http://fotogrph.com/"><strong>FotoGrph</strong></a>.  This free template is released under a <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attributions 3.0</a> license, so you’re pretty much free to do whatever you want with it (even use it commercially) provided you keep the links in the footer intact. Aside from that, have fun with it :)</p>
				</div>
			</div>
			<div class="post">
				<h2 class="title"><a href="#">Phasellus pellentesque turpis </a></h2>
				<p class="meta">Posted by <a href="#">Someone</a> on May 21, 2012
					&nbsp;&bull;&nbsp; <a href="#" class="comments">Comments (64)</a> &nbsp;&bull;&nbsp; <a href="#" class="permalink">Full article</a></p>
				<div class="entry">
					<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc. Donec ipsum. Proin imperdiet est. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc.</p>
				</div>
			</div>
		</div>
		<div id="sidebar">
			<ul>
				<li>
					<h2>Categories</h2>
					<ul>
						<li><a href="#">Aliquam libero</a></li>
						<li><a href="#">Consectetuer adipiscing elit</a></li>
						<li><a href="#">Metus aliquam pellentesque</a></li>
						<li><a href="#">Suspendisse iaculis mauris</a></li>
						<li><a href="#">Urnanet non molestie semper</a></li>
						<li><a href="#">Proin gravida orci porttitor</a></li>
					</ul>
				</li>
				<li>
					<h2>Blogroll</h2>
					<ul>
						<li><a href="#">Aliquam libero</a></li>
						<li><a href="#">Consectetuer adipiscing elit</a></li>
						<li><a href="#">Metus aliquam pellentesque</a></li>
						<li><a href="#">Suspendisse iaculis mauris</a></li>
						<li><a href="#">Urnanet non molestie semper</a></li>
						<li><a href="#">Proin gravida orci porttitor</a></li>
					</ul>
				</li>
			</ul>
		</div>
		
	</div>
</div>
<div id="footer">
      <p id="copyright">© 2011-2013. All Rights Reserved. <br/>
        <a href="http://www.rotarysaltogrande.org.ar/" target="_blank">Rotary Salto Grande Concordia</a> by <a href="mailto:daniel.bertoni@gmail.com" >DnL</a></p>
</div>
<!-- end #footer -->
</body>
</html>
