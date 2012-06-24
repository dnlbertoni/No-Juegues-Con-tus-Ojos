    <?php if(isset($linea) || isset($lateralInfoData)):?>
        <?php echo Template::block('lateral')?>
        <div id="ct">
          	<div class="main">
      		  <?php echo Template::yield(); ?>
      		</div>
    	</div>
    <?php else:?>
    <div id="ctMax">
      <div class="mainMax">
        <?php echo Template::yield(); ?>
      </div>
    </div>
    <?php endif;?>
