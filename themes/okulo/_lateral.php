    <div class="side fr">
      <div class="si">
        <?php if(isset($titulo)):?>
        <h2><?php echo $titulo?></h2>
        <?php endif;?>
        <ul>
          <?php foreach($linea as $elem):?>
            <li><?php echo anchor($elem['link'], $elem['nombre'], $elem['extra'])?></li>
          <?php endforeach; ?>
          </ul>
      </div>
    </div>
<?php echo Assets::js('menuLateral')?>

<script>
$(document).ready(function(){
	$("li").css('padding','5px');
});
</script>