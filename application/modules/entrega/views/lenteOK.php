<h1>Entrega Lente</h1>

<?php echo form_open('entrega/lenteOkDo', 'id="entrego-Form"')?>
<?php echo form_input('caso', 'Caso...', 'id="caso"')?>
<div id="buscar">Entregar</div>
<?php echo form_close();?>

<script>
$(document).ready(function(){
  $('form').addClass('ui-widget');
  $("#caso").bind('focus', '', function(){
    $(this).val('');
  });
  $("#buscar").button();
  $("#buscar").click(function(e){
    e.preventDefault();
    $("#entrego-Form").submit();
  });
  var dialogOpts = {autoOpen:false, modal:true};
  //$("#formAjax").dialog(dialogOpts);
  var options = { success:function(){
                    $(".ui-dialog-content").each(function(){
                      var nom = "#" + $(this).attr('id');
                      location.reload();
                      $(nom).dialog("close");
                    });
                  }
                };
  //var options = {target:"#formAjax"};
  $("#entrego-Form").ajaxForm(options);
});
</script>