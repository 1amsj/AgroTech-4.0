

$(document).ready(function() {  
    $('.carousel').carousel()  

    $('#login').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')})

    $("#user").on("keypress", function(e) {
          validarkeypress(/^[0-9A-Za-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1]$/, e);
  
      });
  
      $("#user").on("keyup", function() {
          validarkeyup(/^[0-9A-Za-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1]{4,10}$/,
              $(this), $("#suser"), "El formato puede ser A-Z a-z (.)(#)(@)(*) 4-10");
      });
  
      $("#password").on("keypress", function(e) {
          validarkeypress(/^[0-9A-Za-z\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]$/, e);
      });
  
      $("#password").on("keyup", function() {
          validarkeyup(/^[0-9A-Za-z\b\s\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]{8,10}$/,
              $(this), $("#spassword"), "la contraseña puede llevar: A-Z a-z (.),(#),(@)(*),  4-10 caracteres ");
      });



    $("#enviar").on("click", function() {
        
          if (validarenvio()) {
               $("#f").submit();
               
  
          }
      });


});




 function validarkeyup(er, etiqueta, etiquetamensaje,
      mensaje) {
      a = er.test(etiqueta.val());
      if (a) {
          etiquetamensaje.text("");
          return 1;
      } else {
        etiquetamensaje.text(mensaje);
        setTimeout(function() {
            etiquetamensaje.text("");
        }, 5000);
  
          return 0;
      }
  }
  
  
  
  
  
  function validarkeypress(er, e) {
  
      key = e.keyCode;
  
  
      tecla = String.fromCharCode(key);
  
  
      a = er.test(tecla);
  
      if (!a) {
  
          e.preventDefault();
      }
  
  
  }
  

    function validarenvio() {
      if (validarkeyup(/^[0-9A-Za-z\b\s\u002A\u002E\u00F1\u00D1]{4,26}$/, $("#user"),
              $("#suser"), "El usuario debe tener de [8 - 26] caracteres, solo(.)(#)") == 0) {
          mensaje("<p>El usuario debe coincidir con el formato <br/>" +
              "de 8 a 26 caracteres y puede llevar (.)(#)</p>");
          return false;
      } else if (validarkeyup(/^[0-9A-Za-z\b\s\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]{8,16}$/,
              $("#password"), $("#spassword"), "Solo letras entre 8 y 16 caracteres, numeros, (.),(#),(@)(*)") == 0) {
          mensaje("<p>la clave debe tener entre 8 y 16 caracteres</p>");
          return false;
  
      }
      return true;
  }
