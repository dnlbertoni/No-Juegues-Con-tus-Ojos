  $(document).ready(function(){
    $("#Volver").button({icons:{primary:'ui-icon-circle-arrow-w'}})
    $("div [id^=bot]").click(function(e){
      e.preventDefault();
      var nombre = "Busqueda por " + $(this).text();
      LinkAjax($(this).attr('href'), nombre);
    });
    /* botones genericos */
    $('.boton').button();
    $(".botEscuela").button({icons:{primary:'ui-icon-home'}, text:false});
    $(".botDocumento").button({icons:{primary:'ui-icon-document'}, text:false});
    $(".botCurso").button({icons:{primary:'ui-icon-suitcase'}, text:false})
    $(".botVol").button({icons:{primary:'ui-icon-person'}, text:false})
    $(".botCiu").button({icons:{primary:'ui-icon-image'}, text:false})
    $('.botAdd').button({icons:{primary:'ui-icon-circle-plus'}, text:false});
    $('.botMinus').button({icons:{primary:'ui-icon-circle-minus'}, text:false});
    $('.botPrint').button({icons:{primary:'ui-icon-print'}, text:false});
    $('.botEdit').button({icons:{primary:'ui-icon-pencil'}, text:false})
    /* fin botones genericos */
    $(".botEdit").click(function(e){
      e.preventDefault();
      var nombre = $(this).text();
      LinkAjax($(this).attr('href'), nombre);
    });
    $('.botBorrar').button({icons:{primary:'ui-icon-trash'},text:false})
    $(".botBorrar").click(function(e){
      e.preventDefault();
      var nombre = $(this).text();
      LinkAjax($(this).attr('href'), nombre);
    });
    $('.botMail').button({icons:{primary:'ui-icon-mail-closed'}, text:false})
    $(".botMail").click(function(e){
      e.preventDefault();
      var nombre = $(this).text();
      LinkAjax($(this).attr('href'), nombre);
    });
    /// reveer funciones de busqueda
    $('#botNombre').button({icons:{primary:'ui-icon-person'}});
    $('#botNombre').css('padding', '10px');
    $('#botNombre').css('font-size', '15px');
    $('#botDNI').button({icons:{primary:'ui-icon-contact'}});
    $('#botDNI').css('padding', '10px');
    $('#botDNI').css('font-size', '15px');
    $('#botTurno').button({icons:{primary:'ui-icon-clock'}});
    $('#botTurno').css('padding', '10px');
    $('#botTurno').css('font-size', '15px');
    var alto = parseInt($("#content").css("height"));
    var top  = $("#content").offset().top;
    var altoX = parseInt($('#botNombre').css('height')) + 40;
    var topX =  top + ( alto - altoX ) - 20;
    $('.bt').offset({top: topX, left : 455});
  });

 function LinkAjax(url, nombre){
   var options = {
     autoOpen : false,
     modal:true,
     title: nombre
   };
   $("#ventanaAjax").dialog(options);
   $("#ventanaAjax").load(url, [],function (){$("#ventanaAjax").dialog("open")});
 }
