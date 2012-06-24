  $(document).ready(function(){
    /***DEFINICION DE BOTONES DE MENU******/
    $("#Home").button({icons:{primary:'ui-icon-home'}, text:false});
    $("#Configuracion").button({icons:{primary:'ui-icon-wrench'}});
    $("#Bpesq").button({text:true,icons:{primary:'ui-icon-search'}});
    $("#Badmi").button({text:true,icons:{primary:'ui-icon-gear'}});
    $("#Bpape").button({text:true,icons:{primary:'ui-icon-document'}});
    $("#Bdiag").button({text:true,icons:{primary:'ui-icon-bookmark'}});
    $("#Bentr").button({text:true,icons:{primary:'ui-icon-flag'}});
    /***DEFINICION DE BOTONES DE MENU******/
    //
    $("#botEscuela").button({icons:{primary:'ui-icon-home'}})
    $("#botEscuela").click(function(e){
      e.preventDefault();
      var nombre = $(this).text();
      LinkAjax($(this).attr('href'), nombre);
    });

    $("#botCurso").button({icons:{primary:'ui-icon-suitcase'}})
    $("#botVol").button({icons:{primary:'ui-icon-person'}})
    $("#botVol").click(function(e){
      e.preventDefault();
      var nombre = $(this).text();
      LinkAjax($(this).attr('href'), nombre);
    });
    $("#Volver").button({icons:{primary:'ui-icon-circle-arrow-w'}});
    $("#Pesq").button({icons:{primary:'ui-icon-document'}});
    $("#bplPesq").click(function(e){
      e.preventDefault();
      var nombre = $(this).text();
      LinkAjax($(this).attr('href'), nombre);
    });
    /*
    $("div [id^=bot]").click(function(e){
      e.preventDefault();
      var nombre = "Busqueda por " + $(this).text();
      LinkAjax($(this).attr('href'), nombre);
    });*/
    $('.botEdit').button({icons:{primary:'ui-icon-pencil'}, text:false})
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
     height:500,
     width:500,
     title: nombre
   };
   $("#ventanaAjax").dialog(options);
   $("#ventanaAjax").load(url, [],function (){$("#ventanaAjax").dialog("open")});
 }