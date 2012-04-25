    <?php if(isset($linea)):?>
        <?php echo Template::block('lateral')?>
        <div id="ct">
          <div class="main">
    <?php else:?>
    <div id="ctMax">
      <div class="mainMax">
    <?php endif;?>
        <?php echo Template::yield(); ?>
      </div>
    </div>
