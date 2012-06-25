<table id="tablaResultados">
  <?php foreach($datos as $dato):?>
  <tr>
    <td id="texto_<?php echo $dato->id?>"><?php echo $dato->texto?></td>
    <td><div id="<?php echo $dato->id ?>" class="botoncito"></div></td>
  </tr>
  <?php endforeach; ?>
</table>
<script>
$(document).ready(function(){
  $(".botoncito").button({icons:{primary:'ui-icon-circle-check'}, text:false});
  $(".botoncito").click(function(){
    var id = $(this).attr('id');
    var nomAux = "#texto_" + id;
    var nombre = $(nomAux).html();
    var texto = "( <span id='codigo'>"+id+"</span> ) "+"<span id='texto'>"+nombre+"</span>";
    var target = <?php echo $target?>;
    $(target).html(texto);
    $(".ui-dialog-content").each(function(){
      var nom = "#" + $(this).attr('id');
      $(nom).dialog("close");
    });
  });
});
</script>