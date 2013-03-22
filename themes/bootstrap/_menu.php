<?php
foreach($dataMenu as $m):?>
  <li class="current"><?php echo anchor($m->link, $m->nombre)?></li>
<?php endforeach?>