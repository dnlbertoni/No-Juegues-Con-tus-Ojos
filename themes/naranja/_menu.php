<?php
foreach($dataMenu as $m):?>
  <li class="<?php echo $m->clase?>"><?php echo anchor($m->link, $m->nombre)?></li>
<?php endforeach?>