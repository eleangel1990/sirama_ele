/******funcion para validar solo numeros con 2 decimales***/
function verificar_numeros(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{       
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {     
              return true;              
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{       
                    return true;
                }
          }else{
              return false;
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,3})$/; 
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
    
}

function validar(e,table,quees,emailte){
    var de = $(e).val();
    var datos = (quees == '1') ? {emailte:emailte,validar:"validar_cote",valor_delcampo:de, table:table,quees:quees,antiguo:"0"} : {emailte:emailte,validar:"validar_cote",correo:de, table:table,quees:quees,antiguo:$("#valor_antiguo").val()};

    console.log("datos que envia",datos);
    $.ajax({
        dataType: "json",
        method: "POST",
        url: '../../php/json_genericos/json_genericos_bd.php',
        data : datos,
    }).done(function(msg) {
        console.log(msg);
        if(msg.exito){
          iziToast.error({
              title: ERROR,
              message: ERROR_CORREO,
              timeout: 3000,
          });
          $(e).val("");
        }else if (msg.error){
          //si no existe
          console.log(msg.error);
        }
        else{
           console.log(msg.error2);
        }


    });

}



 