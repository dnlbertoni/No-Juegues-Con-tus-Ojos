<!doctype html>
<html lang="sp">
<head>
	<meta charset="UTF-8" />
	<title><?php echo $this->config->item('site_name')?></title>
	
	<?php echo Assets::css(); ?>
	<?php echo Assets::js('jquery-1.5.min'); ?>	
</head>
<body>

	<?php echo theme_view('_masthead'); ?>