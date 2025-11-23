$(document).ready(function() {

   
       $("#enviar").on("click", function() {
        if (validarenvio()) {
          
            $("#f").submit();
       }
   

    });


    $("#enviar1").on("click", function() {
        if (validarenvio1()) {
          
            $("#f2").submit();
       }
   
    });

   
/*validaciones para registrar*/



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


    $("#telefono").on("keypress", function(e) {
        validarkeypress(/^[0-9-\b]*$/, e);

    });

    $("#telefono").on("keyup", function() {
        validarkeyup(/^[0-9-\b]{4,26}$/,
            $(this), $("#stelefono"), "el formato debe ser solo numeros");
    });

    $("#descripcion").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]*$/, e);

    });

    $("#descripcion").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
            $(this), $("#sdescripcion"), "el formato debe ser solo numeros");
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


    $("#telefonom").on("keypress", function(e) {
        validarkeypress(/^[0-9-\b]*$/, e);

    });

    $("#telefonom").on("keyup", function() {
        validarkeyup(/^[0-9-\b]{4,26}$/,
            $(this), $("#stelefonom"), "el formato debe ser solo numeros");
    });

    $("#descripcionm").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]*$/, e);

    });

    $("#descripcionm").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
            $(this), $("#sdescripcionm"), "el formato debe ser solo numeros");
    });

  
    
    });
    function modificar(id){
        $("#tabla tr").each(function(){
        
            if(id == $(this).find("th:eq(0)").text()){
                
          
                $("#nombrem").val($(this).find("th:eq(1)").text());
                $("#id").val($(this).find("th:eq(0)").text());
                $("#apellidom").val($(this).find("th:eq(2)").text());
                $("#telefonom").val($(this).find("th:eq(4)").text());
                $("#descripcionm").val($(this).find("th:eq(6)").text());
           
                

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
        if (validarkeyup(/^[A-Za-z]{4,26}$/,
        $("#nombre"), $("#snombre"), "El formato puede ser A-Z a-z 8-26") == 0) {
            $("#snombre").text("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
        }else if (validarkeyup(/^[A-Za-z]{4,26}$/,
        $("#apellido"), $("#sapellido"), "El formato puede ser A-Z a-z 8-26") == 0) {
            $("#sapellido").text("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
    
        }else if (validarkeyup(/^[0-9]{4,26}$/,
        $("#telefono"), $("#stelefono"), "El formato puede ser 12345678") == 0) {
            $("#stelefono").text("<p>El formato puede ser 12345678</p>");
            return false;
    
    
        }  else if (validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
        $("#descripcion"), $("#sdescripcion"), "El formato puede ser .....") == 0) {
            $("#sdescripcion").text("<p>El formato puede ser .....</p>");
            return false;
    
        }         
        return true;
    }

    function validarenvio1() {
        if (validarkeyup(/^[A-Za-z]{4,26}$/,
        $("#nombrem"), $("#snombrem"), "El formato puede ser A-Z a-z 8-26") == 0) {
            $("#snombrem").text("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
        }else if (validarkeyup(/^[A-Za-z]{4,26}$/,
        $("#apellidom"), $("#sapellidom"), "El formato puede ser A-Z a-z 8-26") == 0) {
            $("#sapellidom").text("<p>El formato puede ser A-Z a-z 8-26</p>");
            return false;
    
        }else if (validarkeyup(/^[0-9]{4,26}$/,
        $("#telefonom"), $("#stelefonom"), "El formato puede ser 12345678") == 0) {
            $("#stelefonom").text("<p>El formato puede ser 12345678</p>");
            return false;
    
        }  else if (validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
        $("#descripcionm"), $("#sdescripcionm"), "El formato puede ser .....") == 0) {
            $("#sdescripcionm").text("<p>El formato puede ser .....</p>");
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