<?php echo form_open('usuarios/creoPermisoDo', 'id="creoPermiso-Form"');?>
Asignar Permiso al Modulo:<?php echo form_dropdown('modulo_id', $modulos);?>, en el Programa <?php echo $programa_nombre?> al usuario <?php echo $usuario_nombre?>
<input type="hidden" id="user_id" value="<?php echo $user_id?>" />
<input type="hidden" id="programa_id" value="<?php echo $programa_id?>" />
<div id="botSave">Guardar</div>
<?php echo form_close();?>

<script>
  $(document).ready(function(){
    $("#botSave").button({icons:{primary:'ui-icon-disk'}});
    $("#botSave").click(function(){
      url=$("#creoPermiso-From").attr('action');
      $.ajax({
        type: "POST",
        url:url,
        data:{usuario:user_id,modulo:modulo_id,programa:programa-id},
        success:function(){
          $("#ventanaAjax").dialog('close');
        }
      })
    });
    $("#creoPermiso-From").css('width','60%');
    $("#creoPermiso-From").submit(function(e){
      e.preventDefault();
    });
  });
</script>