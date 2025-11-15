$(document).ready(function() {

   
       $("#registrar").on("click", function() {
        if (validarenvio()) {
          
            $("#f").submit();
       }
   

    });


    $("#modificar").on("click", function() {
        if (validarenvio1()) {
          
            $("#f2").submit();
       }
   
    });

   
/*validaciones para registrar*/


    $("#user").on("keypress", function(e) {
        validarkeypress(/^[0-9-\b]*$/, e);

    });

    $("#user").on("keyup", function() {
        validarkeyup(/^[0-9]{6,10}$/,
        $(this), $("#suser"), "El formato debe ser en solo numeros");
    });

    $("#nombre").on("keypress", function(e) {
        validarkeypress(/^[A-Za-z]$/, e);

    });

    $("#nombre").on("keyup", function() {
        validarkeyup(/^[A-Za-z]{4,26}$/,
            $(this), $("#snombre"), "El formato puede ser A-Z a-z 8-26");
    });

    $("#apellido").on("keypress", function(e) {
        validarkeypress(/^[A-Za-z]$/, e);

    });

    $("#apellido").on("keyup", function() {
        validarkeyup(/^[A-Za-z]{4,26}$/,
            $(this), $("#sapellido"), "El formato puede ser A-Z a-z 8-26");
    });

    $("#contraseña").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]$/, e);
    });

    $("#contraseña").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\b\s\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]{8,16}$/,
            $(this), $("#scontraseña"), "la contraseña puede llevar: A-Z a-z (.),(#),(@)(*),  8-16 caracteres");
    });
      
    

    $("#userm").on("keypress", function(e) {
        validarkeypress(/^[0-9-\b]*$/, e);

    });

    $("#userm").on("keyup", function() {
        validarkeyup(/^[0-9]{6,10}$/,
        $(this), $("#suserm"), "El formato debe ser en solo numeros");
    });

    $("#nombrem").on("keypress", function(e) {
        validarkeypress(/^[A-Za-z]$/, e);

    });

    $("#nombrem").on("keyup", function() {
        validarkeyup(/^[A-Za-z]{4,26}$/,
            $(this), $("#snombrem"), "El formato puede ser A-Z a-z 8-26");
    });

    $("#apellidom").on("keypress", function(e) {
        validarkeypress(/^[A-Za-z]$/, e);

    });

    $("#apellidom").on("keyup", function() {
        validarkeyup(/^[A-Za-z]{4,26}$/,
            $(this), $("#sapellidom"), "El formato puede ser A-Z a-z 8-26");
    });

    $("#contraseñam").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]$/, e);
    });

    $("#contraseñam").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\b\s\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]{8,16}$/,
            $(this), $("#scontraseñam"), "la contraseña puede llevar: A-Z a-z (.),(#),(@)(*),  8-16 caracteres");
    });
      

  

/*aqui termina registrar*/

$("#cedula1").on("keypress", function(e) {
    validarkeypress(/^[0-9-\b]*$/, e);

});

$("#cedula1").on("keyup", function() {
    validarkeyup(/^[0-9]{6,10}$/,
    $(this), $("#scedula1"), "La Cedula debe ser en el siguiente formato 00000000");
});

$("#nombre1").on("keypress", function(e) {
    validarkeypress(/^[A-Za-z]$/, e);

});

$("#nombre1").on("keyup", function() {
    validarkeyup(/^[A-Za-z]{4,10}$/,
        $(this), $("#snombre1"), "El formato puede ser A-Z a-z 4-10");
});


$("#correo1").on("keypress", function(e) {
    validarkeypress(/^[0-9A-Za-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1\u0040]$/, e);

});

$("#correo1").on("keyup", function() {
    validarkeyup(/^[0-9a-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1]{4,26}[\u0040]{1}[a-z]{5,7}[\u002E]{1}[a-z]{3}$/,
        $(this), $("#scorreo1"), "El formato puede ser A-Z a-z 0-9 ejemplo: nombreUsuari+@+servidor+.+dominio");
});
$("#contraceña2").on("keypress", function(e) {
    validarkeypress(/^[0-9A-Za-z\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]$/, e);
});

$("#contraceña2").on("keyup", function() {
    validarkeyup(/^[0-9A-Za-z\b\s\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]{8,10}$/,
        $(this), $("#scontraceña2"), "la contraseña puede llevar: A-Z a-z (.),(#),(@)(*),  8-10 caracteres");
});
$("#contraceña3").on("keypress", function(e) {
    validarkeypress(/^[0-9A-Za-z\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]$/, e);
});

$("#contraceña3").on("keyup", function() {
    validarkeyup(/^[0-9A-Za-z\b\s\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]{8,10}$/,
        $(this), $("#scontraceña3"), "la contraseña puede llevar: A-Z a-z (.),(#),(@)(*),  8-10 caracteres");
});




    
    });
    function modificar(id){
        $("#tabla tr").each(function(){
        
            if(id == $(this).find("th:eq(0)").text()){
                $("#userm").val(id);
          
                $("#nombrem").val($(this).find("th:eq(2)").text());
               
                $("#apellidom").val($(this).find("th:eq(3)").text());
     
           
                

            }
        });
    
    }

    function eliminar1(id){
        $("#eliminar").val(id);
        $("#confirmDeleteButton").on("click", function(){
            $("#f3").submit();
        
        });

    }



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

    // Safety: ensure modals are direct children of <body> to avoid positioning/z-index issues
    // This moves #loginModal and #loginModal1 to body on load without changing markup/styles.
    $(function(){
        try{
            // Move any modal elements to the document body to avoid clipping
            // by transformed/overflowing ancestor containers (fixes backdrop-only issue).
            $('.modal').appendTo('body');
        }catch(e){
            // ignore if elements not present or jQuery error
            console.warn('Could not move modals to body:', e);
        }
    });


    function validarenvio() {
        if (validarkeyup(/^[0-9]{4,26}$/,
        $("#user"), $("#suser"), "El formato puede ser A-Z a-z 8-26") == 0) {
            mensaje("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
        }else if (validarkeyup(/^[A-Za-z]{4,26}$/,
        $("#nombre"), $("#snombre"), "El formato puede ser A-Z a-z 8-26") == 0) {
            mensaje("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
        }else if (validarkeyup(/^[A-Za-z]{4,26}$/,
        $("#apellido"), $("#sapellido"), "El formato puede ser A-Z a-z 8-26") == 0) {
            $("#sapellido").text("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
        }else if (valselect($('#rol').val(),$("#srol")) == 0) {
            $("#srol").text("<p>Debe de seleccionar un Rol</p>");
            return false;
        }else if (valselect($('#cdt').val(),$("#scdt")) == 0) {
            $("#scdt").text("<p>Debe de seleccionar un CDT</p>");
            return false;
        } else if (validarkeyup(/^[0-9A-Za-z\b\s\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]{8,16}$/,
            $("#contraceña"), $("#scontraceña"), "Solo letras entre 8 y 16 caracteres, numeros, (.),(#),(@)(*)") == 0) {
            $("#scontraceña").text("<p>la contraseña debe tener entre 8 y 16 caracteres</p>");
            return false;
        }        
        return true;
    }

    function validarenvio1() {
        if (validarkeyup(/^[0-9]{4,26}$/,
        $("#userm"), $("#suserm"), "El formato puede ser A-Z a-z 8-26") == 0) {
            mensaje("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
        }else if (validarkeyup(/^[A-Za-z]{4,26}$/,
        $("#nombrem"), $("#snombrem"), "El formato puede ser A-Z a-z 8-26") == 0) {
            mensaje("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
        }else if (validarkeyup(/^[A-Za-z]{4,26}$/,
        $("#apellidom"), $("#sapellidom"), "El formato puede ser A-Z a-z 8-26") == 0) {
            $("#sapellidom").text("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
            }else if (valselect($('#cdtm').val(),$("#scdtm")) == 0) {
            $("#scdtm").text("<p>Debe de seleccionar un CDT</p>");
            return false;
        }else if (valselect($('#rolm').val(),$("#srolm")) == 0) {
            $("#srolm").text("<p>Debe de seleccionar un Rol</p>");
            return false;
        
        } else if (validarkeyup(/^[0-9A-Za-z\b\s\u00f1\u002E\u0040\u00d1\u00E0-\u00FC\u0023\u002A]{8,16}$/,
            $("#contraseñam"), $("#scontraseñam"), "Solo letras entre 8 y 16 caracteres, numeros, (.),(#),(@)(*)") == 0) {
            $("#scontraseñam").text("<p>la contraseña debe tener entre 8 y 16 caracteres</p>");
            return false;
        }        
        return true;
    }





    
function valselect(rol,srol) {
    

    if (rol != 'seleccionar') {
        
        return true;
    } else {
        srol.text("seleccione un rol")
        setTimeout(function() {
            srol.fadeOut();
        }, 3000);
        return false;
    }



}