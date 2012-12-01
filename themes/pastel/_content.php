    <div id="content">
        <?php echo Template::yield(); ?>
    </div>
    <?php if(isset($linea) || isset($lateralInfoData)):?>
        <?php echo Template::block('lateral','_lateral')?>
    <?php endif;?>
