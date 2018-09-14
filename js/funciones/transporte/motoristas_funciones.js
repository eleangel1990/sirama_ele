 function solo_letras(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}
function validar_archivo(file,id_campo,error_campo,imagen_campo,la_indicacion){
    console.log("llega imagen",imagen_campo);
        $("#"+imagen_campo).attr("src","../../imagenes_subidas/image.svg");//31.gif
        if (typeof FileReader !== "function") {
            $("#"+imagen_campo).attr("src",'../../imagenes_subidas/image.svg');
            return;
        }
         var Lector;
         var Archivos = file[0].files;
         var archivo = file;
         var archivo2 = file.val();
         if (Archivos.length > 0) {

            Lector = new FileReader();

            Lector.onloadend = function(e) {
                var origen, tipo, tamanio;
                //Envia la imagen a la pantalla
                origen = e.target; //objeto FileReader
                //Prepara la información sobre la imagen
                tipo = archivo2.substring(archivo2.lastIndexOf("."));
                console.log(tipo);
                tamanio = e.total / 1024;
                console.log(tamanio);

                //Si el tipo de archivo es válido lo muestra, 

                //sino muestra un mensaje 

                if (tipo !== ".jpeg" && tipo !== ".JPEG" && tipo !== ".jpg" && tipo !== ".JPG" && tipo !== ".png" && tipo !== ".PNG") {
                    $("#"+imagen_campo).attr("src",'../../imagenes_subidas/photo.svg');
                    $("#"+la_indicacion).addClass('hidden');
                    $("#"+error_campo).removeClass('hidden');
                    console.log("error_tipo",imagen_campo);

                }
                else{
                    $("#"+imagen_campo).attr("src",origen.result);
                    $("#"+error_campo).addClass('hidden');
                    $("#"+la_indicacion).removeClass('hidden');

                }


           };
            Lector.onerror = function(e) {
            console.log(e)
           }
           Lector.readAsDataURL(Archivos[0]);
   }
   
}
function insertar_imagen(archivo,id_prod,contnado,cerrar){
        console.log("Insertar Imagen");
        var file =archivo.files;
        var formData = new FormData();
        formData.append('formData', $("#fm_nuevo_producto"));
        var data = new FormData();
         //Append files infos
         jQuery.each(archivo[0].files, function(i, file) {
            data.append('file-'+i, file);
         });

         console.log("data",data);
        $.ajax({  
            url: "json_administrar_transporte.php?id="+id_prod+'&subir_imagen=si_subirimagen&contando='+contnado,  
            type: "POST", 
            dataType: "json",  
            data: data,  
            cache: false,
            processData: false,  
            contentType: false, 
            context: this,
            success: function (json) {
                console.log(json);
                if(json.exito){  
                    if (cerrar=='1') {
                        iziToast.success({
                            title: exito,
                            message: exito_mensaje,
                            timeout: 3000,
                        });
                        timer=setInterval(function(){
                            location.reload();
                            clearTimeout(timer);
                        },2000);
                        NProgress.done();
                        $("#modal_registro_motorista").modal('toggle');
                    }
                    
                }
                if(json.error){
                    NProgress.done();
                    iziToast.error({
                        title: error,
                        message: error_mensaje,
                        timeout: 3000,
                    });
                    $("#modal_registro_motorista").modal('toggle');
                }
                

            }
        });
    }

$(function(){
    /*****funcion redirigir***/
    
    $(document).on("click", "#btnver", function (e) {
        var elem=$(this);
        var perfil =elem.attr('data-iid');
        $(location).attr('href','descripcion_motorista.php?id='+perfil+'&date='+date+'&empres='+empresa);

    });

    /****FUNCION ELIMINAR***/
     /*****Proces eliminar Eliminar Contactos ***********/
        $(document).on("click", "#btneliminar", function (e) {
            var elem=$(this);
            var elid = elem.attr('data-iid');
            
            swal({
                title: eliminar_alerta,
                text: "",
                html: 
                '<br><button class="btn btn-danger" data-elcorreo ="'+elid+'" id="btn_eliminar" data-toggle="tooltip" data-original-title="Eliminar">'+eliminar+'</button> ' +
                '<button class="btn btn-warning" id="btn_cancelar" data-toggle="tooltip" data-original-title="Cancelar">'+cancelaralerta+'</button>'
                ,
                type: 'info',
                showCancelButton: false,
                showConfirmButton: false,
                allowEscapeKey:false,
                allowOutsideClick:false,
            });
            
             
            
        });

        $(document).on('click', "#btn_cancelar", function() {
            swal.close();
        });

        $(document).on('click', "#btn_eliminar", function(e) {
            swal.close();
            var elem=$(this);
            var elcorreo = elem.attr('data-elcorreo');
            console.log("llega correo2",elcorreo);
            swal({
            title: eliminar_alerta_confirma,
            text: "",
            html: '<button class="btn btn-danger" data-correo="'+elcorreo+'" id="btn_sip" data-toggle="tooltip" data-original-title="Si, eliminar">'+confirmaeliminar+'</button> ' +
            '<button class="btn btn-info" id="btn_nop" data-toggle="tooltip" data-original-title="No">'+cancelaralerta+'</button>',
            type: 'info',
            showCancelButton: false,
            showConfirmButton: false,
            allowEscapeKey:false,
            allowOutsideClick:false,
            });
        });
        $(document).on('click', "#btn_sip", function() {
            var elem=$(this);
            var elid = elem.attr('data-correo');
            console.log("llega correo3 listo para ajax",elid);
            //funcion ajax eliminar

            swal.close();
            var get = { elid:elid,eliminar:"eliminar_motorista"};
            console.log(get);
            $.ajax({
                dataType: "json",
                method: "POST",
                url:'json_administrar_transporte.php',
                data : get,
            }).done(function(msg) {
                console.log(msg);
                 if(msg.exito[0]){
                    iziToast.success({
                        title: eliminar_estado,
                        message: eliminar_mensaje,
                        timeout: 3000,
                    });

                    NProgress.done();
                    $(this).prop('disabled', true);
                    var timer=setInterval(function(){
                        location.reload();
                        clearTimeout(timer);
                    },3500);
                    
                }
                else {
                    NProgress.done();
                    iziToast.error({
                        title: error,
                        message: error_mensaje,
                        timeout: 3000,
                    });
                }
            });

        });


    /***TERMINA FUNCION ELIMINAR***/


    /***Funcion Generica para Imagenes***/
    /*Datos necesarios
    1. id_campo: id del campo file
    2. error_campo: campo error del file
    3. la_imagen: imagen asociada al campo file
    4. la_indicacion: id de la indicación*/
    $(document).on("click", ".boton_subir", function (e) {
        var elem=$(this);
        var elcamputfile =elem.attr('data-idboton');
        $("#"+elcamputfile).click();
    });
    $("input:file").change(function(event) {
        var elem=$(this);
        var el_idcampo =elem.attr('data-id');
        var error_campo =elem.attr('data-elerror');
        var la_imagen =elem.attr('data-idimagen');
        var la_indicacion =elem.attr('data-indicacion'); 
        console.log("prueba",la_imagen);
        validar_archivo($(this),el_idcampo,error_campo,la_imagen,la_indicacion);
    });
    /***End Funcion Generica para Imagenes***/
    $(document).on("click", "#agregar_motorista", function (e) {
        var elem=$(this);
        $("#modal_registro_motorista").modal({
        show: 'false'
        });
    });

    $('#vencimiento_licencia').datepicker({

        format: 'dd/mm/yyyy',
        language: "es",
        autoclose: true,
        todayBtn: "linked", 
        todayHighlight: true,
        toggleActive: true
    });

    //registro gps
  $(document).on("submit", "#registro_motorista", function (e) {
    console.log("Insertar motorista");
    e.preventDefault();
    NProgress.start();
    var datos=$("#registro_motorista").serialize();
    console.log("el formulario registro_motorista",datos);
    $.ajax({
        dataType: "json",
        method: "POST",
        url:'json_administrar_transporte.php',//mando POST a mi controlador
        data : datos,
    }).done(function(msg){
        console.log("esto trae",msg);
        if(msg.exito){
            if ($("#file_dui").val()!="") {
                insertar_imagen($("#file_dui"),msg.exito[1],"1","-1");
            }
            if ($("#file_licencia").val()!="") {
                insertar_imagen($("#file_licencia"),msg.exito[1],"2","-1");
            }
            if ($("#file_capacitacion").val()!="") {
                insertar_imagen($("#file_capacitacion"),msg.exito[1],"3","-1");
            }
            if ($("#file_perfil").val()!="") {
                insertar_imagen($("#file_perfil"),msg.exito[1],"4","1");
            }else{
                iziToast.success({
                    title: exito,
                    message: exito_mensaje,
                    timeout: 3000,
                });
            }
            

            NProgress.done();
            $("#modal_ele_gps").modal('toggle');

            var timer=setInterval(function(){
                location.reload();
                clearTimeout(timer);
            },3500);
            
        } else if(msg.error){
            NProgress.done();
        }
    });
  });


    Highcharts.chart('container', {
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'Transporte de Contenedores'
        },
        subtitle: {
            text: 'Nominación: 05/07/2018'
        },
        xAxis: [{
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}°C',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Temperature',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: 'Rainfall',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value} mm',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [{
            name: 'Rainfall',
            type: 'column',
            yAxis: 1,
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
            tooltip: {
                valueSuffix: ' mm'
            }

        }, {
            name: 'Temperature',
            type: 'spline',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
            tooltip: {
                valueSuffix: '°C'
            }
        }]
    });
});