<?php
foreach($dataMenu as $m):?>
  <?if($m->id!=0):?>
  <li class="current"><?php echo anchor($m->link, $m->nombre)?></li>
  <?php endif;?>
<?php endforeach?>