var Motorista= function() {
     
     // Function for switching form views (login, reminder and register forms)
    var switchView = function(viewHide, viewShow, viewHash){
        viewHide.slideUp(250);
        viewShow.slideDown(250, function(){
            $('input').placeholder();
        });

        if ( viewHash ) {
            window.location = '#' + viewHash;
        } else {
            window.location = '#';
        }
    };

    return {
        init: function() {
            /* Switch Login, Reminder and Register form views */
           
            $('#registro_motorista').validate({
                errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'nombre': {
                        required: true
                    },
                    
                    'dui': {
                        required: true
                    },
                    'numero_licencia': {
                        required: true
                    },

                    'tipo_licencia': {
                        required: true
                    },
                    'telefono': {
                        required: true
                    },
                    'planilla_isss': {
                        required: true
                    },
                    'vencimiento_licencia': {
                        required: true
                    }
                },
                messages: {
                    

                }
            });


            

             
            $.mask.definitions['~']='[267]';
            $('#telefono').mask('~999-9999');
            $('#dui').mask('9999999-9');
            $('#numero_licencia').mask('9999-999999-999-9');
            


            
        }



    };
}();