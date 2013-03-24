<?php echo form_open('usuarios/setPermiso','id="permisos-Form"');?>
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
    <td>
      <?php echo anchor('usuarios/creoPermiso/'.$user->user_id.'/'.$user->programa_id,'Agrega Permiso','class="botAddPermiso ajax"');?>
     </td>
  </tr>
<?php endif;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td ><?php echo $user->modulo_nombre?></td>
    <td id="<?php echo $user->programa_id,'_',$user->modulo_id?>">
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
    $(".botAddPermiso").button({icons:{primary:'ui-icon-circle-plus'}});
    $(".permisos").buttonset(
      $(".yes").button({icons:{primary:'ui-icon-circle-check'}, text:false}),
      $(".no").button({icons:{primary:'ui-icon-cancel'}, text:false})
    );
    $(".yes").click(function(){
      estado = $(this).val();
      id = $(this).parent().parent().attr('id').split('_');
      cambioPermiso(id[1],id[0],estado);
    });
    $(".no").click(function(){
      estado = $(this).val();
      id = $(this).parent().parent().attr('id').split('_');
      cambioPermiso(id[1],id[0],estado);
    });
    $("permisos-Form").submit(function(e){
      e.preventDefault();
    })
  });
  function cambioPermiso(modulo_id,programa_id,estado){
    pagina = $("#permisos-Form").attr('action');
    $.ajax({
      type:"POST",
      url:pagina,
      data:{modulo:modulo_id,accion:estado,programa:programa_id},
      success:function(){
        location.reload();
      }
    })
  }
</script>