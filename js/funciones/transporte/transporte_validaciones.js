var Transporte= function() {
     
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
           
            $('#registro_gps').validate({
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
                    'nombre_compa': {
                        required: true
                    },
                    
                    'telefono_compa': {
                        required: true
                    },
                    'email_compa': {
                        required: true,
                        email: true
                    },

                    'direccion_compa': {
                        required: true
                    },
                    'nombre_contacto_gps': {
                        required: true,
                        minlength: 10
                    },
                    'imei_gps': {
                        required: true,
                        minlength: 10
                    },
                    'codigo_pnc': {
                        required: true
                    },
                    'fecha_inicio_periodo': {
                        required: true
                    },
                    'fecha_final_periodo': {
                        required: true
                    }
                },
                messages: {
                    

                }
            });


            $('#registro_seguro').validate({
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
                    'nombre_compa_seguro': {
                        required: true
                    },
                    
                    'telefono_compa_seguro': {
                        required: true
                    },
                    'email_compa_seguro': {
                        required: true,
                        email: true
                    },

                    'direccion_compa_seguro': {
                        required: true,
                        minlength: 10
                    },
                    'codigo_seguro': {
                        required: true
                    },
                    'fecha_inicio_periodo_seguro': {
                        required: true
                    },
                    'fecha_final_periodo_seguro': {
                        required: true
                    },
                    'nombre_contacto_seguro': {
                        required: true
                    }
                },
                messages: {
                    

                }
            });

             
            $.mask.definitions['~']='[267]';
            $('#telefono_compa').mask('~999-9999');
            $('#telefono_compa_seguro').mask('~999-9999');
            $.mask.definitions['~']='[2]';
            $('#telefono_transporte').mask('~999-9999');
            


            
        }



    };
}();