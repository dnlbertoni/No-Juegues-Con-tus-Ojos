<hr />

<h3>Template Tests</h3>
<ul>
	<li><?php echo anchor('/', 'Test Basic Theme Finding.'); ?></li>
	<li><?php echo anchor('welcome/blue', 'Test Child Themes: Style and View overrides.'); ?></li>
	<li><?php echo anchor('override', 'Test Child Themes: Controller Overrides'); ?></li>
	<li><?php echo anchor('welcome/themers', 'Test Child Themes: Theme Paths'); ?></li>
	<li><?php echo anchor('welcome/blocks', 'Test Blocks'); ?></li>
	<li><?php echo anchor('welcome/messages', 'Test Messages'); ?></li>
	<li><?php echo anchor('welcome/breadcrumbs', 'Test Breadcrumbs'); ?></li>
</ul>

<h3>Assets Tests</h3>
<ul>
	<li><?php echo anchor('asset/css', 'Test CSS Functionality.'); ?></li>
	<li><?php echo anchor('asset/images', 'Test Image Functionality.'); ?></li>
	<li><?php echo anchor('asset/js', 'Basic JS Functionality.'); ?></li>
</ul>