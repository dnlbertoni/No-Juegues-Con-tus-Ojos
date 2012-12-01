<?php
foreach($dataMenu as $m):?>
<li class="current"><?php echo anchor($m->link, $m->nombre, 'id="'.$m->clase.'"')?></li>
<?php endforeach?>