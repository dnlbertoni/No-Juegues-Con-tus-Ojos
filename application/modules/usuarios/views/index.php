<table>
<?php $userAux=false;?>
<?php foreach($todos as $user):?>
<?php if($userAux!=$user->username):?>
  <?php $userAux=$user->username;?>
  <?php $progAux=false;?>
  <?php echo "<tr><td>&nbsp;</td><td>$userAux</td></tr>"?>
<?php endif;?>
<?php if($progAux!=$user->programa):?>
  <?php $progAux=$user->programa;?>
  <?php echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>$user->programa</td></tr>"?>
<?php endif;?>
  <?php echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>$user->modulo_nombre</td><td>$user->modulo_permiso</td></tr>"?>
<?php endforeach; ?>
</table>
