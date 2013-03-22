<?php echo form_open();?>
<table>
<?php $userAux=false;?>
<?php foreach($todos as $user):?>
<?php if($userAux!=$user->username):?>
  <?php $userAux=$user->username;?>
  <?php $progAux=false;?>
  <tr>
    <td colspan="4"><?php echo "$userAux"?></td>
  </tr>      
<?php endif;?>
<?php if($progAux!=$user->programa):?>
  <?php $progAux=$user->programa;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo "$user->programa"?></td>
    <td></td>
  </tr>
<?php endif;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo $user->modulo_nombre?></td>
    <td>
      <div class="permisos">
        <?php echo form_label('Disponible', 'd_'.$user->modulo_id)?>
        <?php echo form_radio('p_'. $user->modulo_id,1, ($user->modulo_permiso==1)?true:false, 'id="d_'.$user->modulo_id.'" class="yes"');?>
        <?php echo form_label('No Permitido', 'n_'.$user->modulo_id)?>
        <?php echo form_radio('p_'. $user->modulo_id,0, ($user->modulo_permiso==0)?true:false, 'id="n_'.$user->modulo_id.'" class="no"');?>
      </div>
    </td>
    <td></td>
  </tr>
<?php endforeach; ?>
</table>
<?php echo form_close();?>
<script>
  $(document).ready(function(){
    $(".permisos").buttonset(
      $(".yes").button({icons:{primary:'ui-icon-circle-check'}, text:false}),
      $(".no").button({icons:{primary:'ui-icon-cancel'}, text:false})
    );
  });
</script>