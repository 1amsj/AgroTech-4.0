$(document).ready(function() {

    $("#enviarp").on("click", function() {
            $("#id2").val($("#id_rol").val());
          
            enviaAjax($("#fpp"));
            $("#SetModal").modal('hide');
                $("body").removeClass('modal-open');
                $('.modal-backdrop').remove();

       
        

    });

    $("#enviar1").on("click", function() {
        if (validarenvio()) {
                $("#f1").submit();

       }
   

    });

    $("#modificar").on("click", function() {
        if (validarenvio1()) {
                $("#f2").submit();

       }
   

    });




    


    
/*validaciones para registrar*/


    $("#selectAllPerms").on("click", function(e) {
        e.preventDefault();
        marcar();
    });

    $("#clearAllPerms").on("click", function(e) {
        e.preventDefault();
        marcar2();
    });


  
    $("#rol").on("keypress", function(e) {
        validarkeypress(/^[A-Za-z\u00C0-\u017F\s]$/, e);

    });

    $("#rol").on("keyup", function() {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,80}$/,
            $(this), $("#srol"), "Solo letras (incluye acentos) y espacios 4-80");
    });

    $("#descripcion").on("keypress", function(e) {
        validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,-]$/, e);

    });

    $("#descripcion").on("keyup", function() {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,-]{4,80}$/,
            $(this), $("#sdescripcion"), "Letras, números, acentos, espacios y .,- 4-80");
    });

   





$("#rol1").on("keypress", function(e) {
    validarkeypress(/^[A-Za-z\u00C0-\u017F\s]$/, e);

});

$("#rol1").on("keyup", function() {
    validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,80}$/,
        $(this), $("#srol1"), "Solo letras (incluye acentos) y espacios 4-80");
});

$("#descripcion1").on("keypress", function(e) {
    validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,-]$/, e);

});

$("#descripcion1").on("keyup", function() {
    validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,-]{4,80}$/,
        $(this), $("#sdescripcion1"), "Letras, números, acentos, espacios y .,- 4-80");
});



    
    });
   
    function modificar(id){
        $("#table tr").each(function(){
        
            if(id == $(this).find("th:eq(0)").text()){
                $("#rol1").val($(this).find("th:eq(1)").text());
                $("#descripcion1").val($(this).find("th:eq(2)").text());
                
               
                

            }
        });
    
    }

    function check(permiso,id){
        $("#tablaP tr").each(function(){
        
            if(permiso == $(this).find("th:eq(0)").text()){
                $(id).prop("checked",true);
                
               
                

            }
        });
    
    }



    function eliminar(id){
        $("#cedula2").val(id);
        $("#borrar").on("click", function(){
           
        enviaAjax($("#f3"));
        });

    }

    function enviaAjax(datos){
    
        $.ajax({
                url: '', 
                type: 'POST',
                data: datos.serialize(),
                beforeSend: function(){
         
                },
                
                success: function(respuesta) {
                 $("#tablaP").html(respuesta);
                 
                   
                },
                error: function(request, status, err){
                    if (status == "timeout") {
                        mensaje("Servidor ocupado, intente de nuevo");
                    } else {
                        mensaje("ERROR: <br/>" + request + status + err);
                    }
                },
                complete: function(){
                    
                }
                
        });
        
    }

    

    function enviaAjax2(datos){
    
        $.ajax({
                url: '', 
                type: 'POST',
                data: datos.serialize(),
                beforeSend: function(){
         
                },
                
                success: function(respuesta) {
                 $("#tabla").html(respuesta);
                   
                },
                error: function(request, status, err){
                    if (status == "timeout") {
                        mensaje("Servidor ocupado, intente de nuevo");
                    } else {
                        mensaje("ERROR: <br/>" + request + status + err);
                    }
                },
                complete: function(){
                    
                }
                
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
            }, 2000);
            
    
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

     function permisos(valor){
        $("#id_rol").val(valor);
        enviaAjax($("#fP"));
        $("#table tr").each(function(){
        
                if( valor  == $(this).find("th:eq(0)").text()){
                    $("#nombreRol").html($(this).find("th:eq(1)").text()); 
    
                }
            });
        setTimeout(function(){

            

            $("input:checkbox").prop("checked",false);

            check("agregar_usuario", "#1");
            check("agregar_usuario", "#2");
            check("eliminar_usuario", "#3");
            check("consutar_usuario", "#4");

            check("agregar_inventario", "#6");
            check("modificar_inventario", "#7");
            check("eliminar_inventario", "#8");
            check("consultar_inventario", "#9");

            check("permisos_seguridad", "#72");
            check("agregar_permisos", "#23");
            check("modificar_permisos", "#24");
            check("eliminar_permisos", "#25");
            
            check("consultar_permisos", "#26");
            check("cunsultar_bitacora", "#5");
            check("consultar_reportes", "#27");
            check("agregar_destinatario", "#29");

            check("modificar_destinatario", "#30");
            check("eliminar_destinatario", "#31");
            check("consultar_destinatario", "#62");
            check("agregar_proveedores", "#63");

            check("modificar_proveedores", "#64");
            check("eliminar_proveedores", "#65");
            check("consultar_proveedores", "#66");
            check("generar_reportes", "#75");
            


        }, 500);
        

     }

         function marcar(){
             $("#SetModal input:checkbox").prop("checked",true);
       
        
     }

     function marcar2(){
      
             $("#SetModal input:checkbox").prop("checked",false);
      
        
     }

    function validarenvio() {
        if (validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,80}$/,
        $("#rol"), $("#srol"), "Solo letras (incluye acentos) y espacios 4-80") == 0) {
            mensaje("<p>Solo letras (incluye acentos) y espacios 4-80</p>");
            return false;
    
        } else if (validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,-]{4,80}$/,
        $("#descripcion"), $("#sdescripcion"), "Letras, números, acentos, espacios y .,- 4-80") == 0) {
            mensaje("<p>Letras, números, acentos, espacios y .,- 4-80</p>");
            return false;
        }
        return true;
    }

    function validarenvio1() {
        if (validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,80}$/,
        $("#rol1"), $("#srol1"), "Solo letras (incluye acentos) y espacios 4-80") == 0) {
            mensaje("<p>Solo letras (incluye acentos) y espacios 4-80</p>");
            return false;
    
        } else if (validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,-]{4,80}$/,
        $("#descripcion1"), $("#sdescripcion1"), "Letras, números, acentos, espacios y .,- 4-80") == 0) {
            mensaje("<p>Letras, números, acentos, espacios y .,- 4-80</p>");
            return false;
        }
        return true;
    }


    function valfecha(fecha,sfecha) {
        fechaq = fecha.val();
        if (fechaq == '') {
            sfecha.text("seleccione una fecha");
            setTimeout(function() {
                sfecha.text("");
            }, 3000);
            return false;
        } else {
            return true;
        }
    
    
    
    }