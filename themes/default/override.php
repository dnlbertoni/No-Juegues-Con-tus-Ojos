<?php echo theme_view('_header'); ?>

	<div class="main">
		<?php echo Template::yield(); ?>
		
		<?php echo theme_view('toc'); ?>
	</div>

	<p class="override"><b>Look, Ma! No footer!</b> (That's because the default layout is being override right now.)</p>
	
	<?php echo Assets::js(); ?>