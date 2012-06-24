<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('site_name')?></title>
	<?php echo Assets::css('screen'); ?>
	<?php echo Assets::css('jquery-ui'); ?>
	<?php echo Assets::js('jquery-1.5.min'); ?>	
	<?php echo Assets::js('jquery-ui-1.8.12.min'); ?>	
	<?php echo Assets::js('okulo'); ?>	
	<?php echo Assets::js('forms'); ?>	
</head>
<body>
<div id="wrap">
  <div id="header">
    <div id="logo">
      <h1>OKULO</h1>
      <h2><?php echo $nombrePrograma;?> </h2>
      <h3><?php echo CLUB_ROTARIO;?> </h3>
      <span class="ui-state-error"><?php echo $database ?> </span>
    </div>
    <div class="quest">
      <?php echo anchor('home', 'Home', 'id="Home"')?>
    </div>
  </div>
  <!-- /header -->
  <div id="content">
    <ul id="nav">
      <?php echo Template::block('menu')?>
    </ul>    
    <?php echo theme_view('_content'); ?>
    <div class="clearfix"></div>
    &nbsp;

  </div>
  <!-- /content -->
  <div id="footer">
    <div id="ftinner">
      <p id="copyright">© 2011. All Rights Reserved. <br/>
        <a href="http://www.rotarysaltogrande.org.ar/" target="_blank">Rotary Salto Grande Concordia</a> by <a href="mailto:daniel.bertoni@gmail.com" >DnL</a></p>
    </div>
  </div>
  <!-- /footer -->
</div>
</body>
</html>
