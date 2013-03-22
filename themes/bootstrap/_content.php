<div id="content">
    <?php echo Template::message();?>
    <?php echo Template::yield(); ?>
</div>
<div class="clearfix"></div>
    <?php if(isset($linea) || isset($lateralInfoData)):?>
        <?php echo Template::block('lateral','_lateral')?>
    <?php endif;?>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<br />