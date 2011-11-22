<?php echo theme_view('_header'); ?>

	<div class="main">
		<?php echo Template::yield(); ?>
		
		<?php echo theme_view('toc'); ?>
	</div>

<?php echo theme_view('_footer'); ?>