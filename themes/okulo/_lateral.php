    <div class="side fr">
      <div class="si">
        <ul>
          <?php foreach($linea as $elem):?>
            <li><?php echo anchor($elem['link'], $elem['nombre'], $elem['extra'])?></li>
            <br/>
          <?php endforeach; ?>
          </ul>
      </div>
    </div>
<?php echo Assets::js('menuLateral')?>
