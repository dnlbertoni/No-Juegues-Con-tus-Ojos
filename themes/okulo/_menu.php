<?php
foreach($dataMenu as $m):?>
<li class="first"><?php echo anchor($m->link, $m->nombre, 'id="'.$m->clase.'"')?></li>
<?php endforeach?>