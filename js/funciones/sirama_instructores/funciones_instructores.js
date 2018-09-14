$(function(){
	Instructores.init();
	 /****modal abrir despido****/
    $(document).on("click", "#ingreso_instructor", function (e) {
    	console.log("llega");
        var elem=$(this);
        $("#modal_registro_instructor").modal({
        show: 'false'
        });
    });


    $('#nacimiento_instructor').datepicker({
	    format: 'dd/mm/yyyy',
	    language: "es",
	    autoclose: true,
	    todayBtn: "linked", 
	    todayHighlight: true,
	    toggleActive: true
	 });


});

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