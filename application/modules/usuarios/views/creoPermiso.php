<?php echo form_open('usuarios/creoPermisoDo', 'id="creoPermiso-Form"');?>
Asignar Permiso al Modulo:<?php echo form_dropdown('modulo_id', $modulos,1,'id="modulo_id"');?>, en el Programa <?php echo $programa_nombre?> al usuario <?php echo $usuario_nombre?>
<input type="hidden" id="user_id" value="<?php echo $user_id?>" />
<input type="hidden" id="programa_id" value="<?php echo $programa_id?>" />
<div id="botSave">Guardar</div>
<?php echo form_close();?>

<script>
  $(document).ready(function(){
    $("#botSave").button({icons:{primary:'ui-icon-disk'}});
    $("#botSave").click(function(){
      url=$("#creoPermiso-Form").attr('action');
      modulo_id=$("#modulo_id").val();
      programa_id=$("#programa_id").val();
      user_id=$("#user_id").val();
      $.ajax({
        type: "POST",
        url:url,
        data:{usuario:user_id,modulo:modulo_id,programa:programa_id},
        success:function(){
          $("#ventanaAjax").dialog('close');
        }
      })
    });
    $("#creoPermiso-Form").css('width','60%');
    $("#creoPermiso-Form").submit(function(e){
      e.preventDefault();
    });
  });
</script>