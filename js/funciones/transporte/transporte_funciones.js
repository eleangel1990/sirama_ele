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

$(function(){
  /***funcion que abre modal de gps***/
  $(document).on("click", "#agregar_motorista", function (e) {
       $(location).attr('href','perfil_motorista.php?id='+elgetid+'&date='+date);
  });

  $('#fecha_inicio_periodo').datepicker({
    format: 'dd/mm/yyyy',
    language: "es",
    autoclose: true,
    todayBtn: "linked", 
    todayHighlight: true,
    toggleActive: true
  });

  $('#fecha_final_periodo').datepicker({

    format: 'dd/mm/yyyy',
    language: "es",
    autoclose: true,
    todayBtn: "linked", 
    todayHighlight: true,
    toggleActive: true
  });

  $('#fecha_inicio_periodo_seguro').datepicker({
    format: 'dd/mm/yyyy',
    language: "es",
    autoclose: true,
    todayBtn: "linked", 
    todayHighlight: true,
    toggleActive: true
  });

  $('#fecha_final_periodo_seguro').datepicker({

    format: 'dd/mm/yyyy',
    language: "es",
    autoclose: true,
    todayBtn: "linked", 
    todayHighlight: true,
    toggleActive: true
  });


  /****abrir modales****/
  /***funcion que abre modal de gps***/
  $(document).on("click", "#agregar_gps", function (e) {
      var elem=$(this);
      $("#modal_ele_gps").modal({
          show: 'false'
      });
  });
  /***funcion que abre modal de seguro***/
  $(document).on("click", "#agregar_seguro", function (e) {
      var elem=$(this);
      $("#modal_ele_seguro").modal({
          show: 'false'
      });
  });
  /****insertar***/
  //registro gps
  $(document).on("submit", "#registro_gps", function (e) {
    console.log("Inertar GPS");
    e.preventDefault();
    NProgress.start();
    var datos=$("#registro_gps").serialize();
    console.log("el formulario registro_gps",datos);
    $.ajax({
        dataType: "json",
        method: "POST",
        url:'json_administrar_transporte.php',//mando POST a mi controlador
        data : datos,
    }).done(function(msg){
        console.log("esto trae",msg);
        if(msg.exito){
            iziToast.success({
                title: exito,
                message: exito_mensaje,
                timeout: 3000,
            });

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

  //registro seguro
  $(document).on("submit", "#registro_seguro", function (e) {
    console.log("Inertar seguro");
    e.preventDefault();
    NProgress.start();
    var datos=$("#registro_seguro").serialize();
    console.log("el formulario registro_seguro",datos);
    $.ajax({
        dataType: "json",
        method: "POST",
        url:'json_administrar_transporte.php',//mando POST a mi controlador
        data : datos,
    }).done(function(msg){
        console.log("esto trae",msg);
        if(msg.exito){
            iziToast.success({
                title: exito,
                message: exito_mensaje,
                timeout: 3000,
            });

            NProgress.done();
            $("#modal_ele_seguro").modal('toggle');

            var timer=setInterval(function(){
                location.reload();
                clearTimeout(timer);
            },3500);
            
        } else if(msg.error){
            NProgress.done();
        }
    });
  });
});
