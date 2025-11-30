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
        validarkeypress(/^[A-Za-z\u00C0-\u017F\s]$/, e);

    });

    $("#nombre").on("keyup", function() {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
            $(this), $("#snombre"), "Solo letras (incluye acentos) y espacios 4-26");
    });

    $("#apellido").on("keypress", function(e) {
        validarkeypress(/^[A-Za-z\u00C0-\u017F\s]$/, e);

    });

    $("#apellido").on("keyup", function() {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
            $(this), $("#sapellido"), "Solo letras (incluye acentos) y espacios 4-26");
    });

    $("#correo").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1\u0040]$/, e);

    });

    $("#correo").on("keyup", function() {
        validarkeyup(/^[0-9a-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1]{4,26}[\u0040]{1}[a-z]{5,7}[\u002E]{1}[a-z]{3}$/,
            $(this), $("#scorreo"), "El formato puede ser A-Z a-z 0-9 ejemplo: nombreUsuari+@+servidor+.+dominio");
    });

    $("#telefono").on("keypress", function(e) {
        validarkeypress(/^[0-9-\b]*$/, e);

    });

    $("#telefono").on("keyup", function() {
        validarkeyup(/^[0-9-]{4,26}$/,
            $(this), $("#stelefono"), "Solo números y guiones 4-26");
    });

    $("#direccion").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]*$/, e);

    });

    $("#direccion").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
            $(this), $("#sdireccion"), "Letras, números, acentos y .,-/#º* 3-120");
    });
    $("#descripcion").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]*$/, e);

    });

    $("#descripcion").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
            $(this), $("#sdescripcion"), "Letras, números, acentos y .,-/#º* 3-120");
    });
   
   
    $("#nombrem").on("keypress", function(e) {
        validarkeypress(/^[A-Za-z\u00C0-\u017F\s]$/, e);

    });

    $("#nombrem").on("keyup", function() {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
            $(this), $("#snombrem"), "Solo letras (incluye acentos) y espacios 4-26");
    });

    $("#apellidom").on("keypress", function(e) {
        validarkeypress(/^[A-Za-z\u00C0-\u017F\s]$/, e);

    });

    $("#apellidom").on("keyup", function() {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
            $(this), $("#sapellidom"), "Solo letras (incluye acentos) y espacios 4-26");
    });

    $("#correom").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1\u0040]$/, e);

    });

    $("#correom").on("keyup", function() {
        validarkeyup(/^[0-9a-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1]{4,26}[\u0040]{1}[a-z]{5,7}[\u002E]{1}[a-z]{3}$/,
            $(this), $("#scorreom"), "El formato puede ser A-Z a-z 0-9 ejemplo: nombreUsuari+@+servidor+.+dominio");
    });

    $("#telefonom").on("keypress", function(e) {
        validarkeypress(/^[0-9-\b]*$/, e);

    });

    $("#telefonom").on("keyup", function() {
        validarkeyup(/^[0-9-]{4,26}$/,
            $(this), $("#stelefonom"), "Solo números y guiones 4-26");
    });

    $("#direccionm").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]*$/, e);

    });

    $("#direccionm").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
            $(this), $("#sdireccionm"), "Letras, números, acentos y .,-/#º* 3-120");
    });
    $("#descripcionm").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]*$/, e);

    });

    $("#descripcionm").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
            $(this), $("#sdescripcionm"), "Letras, números, acentos y .,-/#º* 3-120");
    });

  
    
    });
    function modificar(id){
        $("#tabla tr").each(function(){
        
            if(id == $(this).find("th:eq(0)").text()){
                
          
                $("#nombrem").val($(this).find("th:eq(1)").text());
                $("#id").val($(this).find("th:eq(0)").text());
                $("#apellidom").val($(this).find("th:eq(2)").text());
                $("#correom").val($(this).find("th:eq(3)").text());
                $("#telefonom").val($(this).find("th:eq(4)").text());
                $("#direccionm").val($(this).find("th:eq(5)").text());
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
        if (validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
        $("#nombre"), $("#snombre"), "Solo letras (incluye acentos) y espacios 4-26") == 0) {
            $("#snombre").text("<p>Solo letras (incluye acentos) y espacios 4-26</p>");
            return false;
    
        }else if (validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
        $("#apellido"), $("#sapellido"), "Solo letras (incluye acentos) y espacios 4-26") == 0) {
            $("#sapellido").text("<p>Solo letras (incluye acentos) y espacios 4-26</p>");
            return false;
    
        }else if (validarkeyup(/^[0-9a-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1]{4,26}[\u0040]{1}[a-z]{5,7}[\u002E]{1}[a-z]{3}$/,
        $("#correo"), $("#scorreo"), "ejemplo@dominio.com") == 0) {
            $("#scorreo").text("<p>ejemplo@dominio.com</p>");
            return false;
    
        }else if (validarkeyup(/^[0-9-]{4,26}$/,
        $("#telefono"), $("#stelefono"), "Solo números y guiones 4-26") == 0) {
            $("#stelefono").text("<p>Solo números y guiones 4-26</p>");
            return false;
    
        } else if (validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
        $("#direccion"), $("#sdireccion"), "Letras, números, acentos y .,-/#º* 3-120") == 0) {
            $("#sdireccion").text("<p>Letras, números, acentos y .,-/#º* 3-120</p>");
            return false;
    
        }  else if (validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
        $("#descripcion"), $("#sdescripcion"), "Letras, números, acentos y .,-/#º* 3-120") == 0) {
            $("#sdescripcion").text("<p>Letras, números, acentos y .,-/#º* 3-120</p>");
            return false;
    
        }         
        return true;
    }

    function validarenvio1() {
        if (validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
        $("#nombrem"), $("#snombrem"), "Solo letras (incluye acentos) y espacios 4-26") == 0) {
            $("#snombrem").text("<p>Solo letras (incluye acentos) y espacios 4-26</p>");
            return false;
    
        }else if (validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
        $("#apellidom"), $("#sapellidom"), "Solo letras (incluye acentos) y espacios 4-26") == 0) {
            $("#sapellidom").text("<p>Solo letras (incluye acentos) y espacios 4-26</p>");
            return false;
    
        }else if (validarkeyup(/^[0-9a-z\u002A\u002E\u00F1\u00D1\u00D1\u00F1]{4,26}[\u0040]{1}[a-z]{5,7}[\u002E]{1}[a-z]{3}$/,
        $("#correom"), $("#scorreom"), "ejemplo@dominio.com") == 0) {
            $("#scorreom").text("<p>ejemplo@dominio.com</p>");
            return false;
    
        }else if (validarkeyup(/^[0-9-]{4,26}$/,
        $("#telefonom"), $("#stelefonom"), "Solo números y guiones 4-26") == 0) {
            $("#stelefonom").text("<p>Solo números y guiones 4-26</p>");
            return false;
    
        } else if (validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
        $("#direccionm"), $("#sdireccionm"), "Letras, números, acentos y .,-/#º* 3-120") == 0) {
            $("#sdireccionm").text("<p>Letras, números, acentos y .,-/#º* 3-120</p>");
            return false;
    
        }  else if (validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
        $("#descripcionm"), $("#sdescripcionm"), "Letras, números, acentos y .,-/#º* 3-120") == 0) {
            $("#sdescripcionm").text("<p>Letras, números, acentos y .,-/#º* 3-120</p>");
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