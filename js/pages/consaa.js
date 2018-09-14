var Consaa = function() {
	 
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
           
            $('#registro_consaa').validate({
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
                    'nombre_consaa': {
                        required: true
                    },
                    
                    'abreviatura': {
                        required: true
                    },

                    'telefono': {
                        required: true
                    },
                    'direccion': {
                        required: true,
                        minlength: 10
                    },
                     'email': {
                        required: true,
                        email: true
                    }
	            },
                messages: {
                    'nombre_consaa': 'Por favor ingrese el nombre de la asociación',
                    'abreviatura': 'Ingrese la abreviatura',
                    'telefono': {
                        required: 'Por favor ingrese el teléfono del usuario',
                        
                    },
                    'direccion': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 5 caracteres'
                    },
                    'email': 'Por favor ingrese el correo electrónico de la cuenta',

                }
            });

            $('#registro_contactos').validate({
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
                    'nombre_contacto': {
                        required: true
                    },
                    
                    'email_contacto': {
                        required: true,
                        email:true
                    },

                    'telefono_contacto': {
                        required: true
                    }
                },
                messages: {
                    'nombre_contacto': 'Por favor ingrese el nombre',
                    'telefono_contacto': {
                        required: 'Por favor ingrese el teléfono',
                        
                    },
                    'email_contacto': 'Por favor ingrese el correo electrónico',

                }
            });


            $('#actualizar_contactos_form').validate({
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
                    'nombre_contacto_update': {
                        required: true
                    },
                    
                    'email_contacto_update': {
                        required: true,
                        email:true
                    },

                    'telefono_contacto_update': {
                        required: true
                    }
                },
                messages: {
                    'nombre_contacto_update': 'Por favor ingrese el nombre',
                    'telefono_contacto_update': {
                        required: 'Por favor ingrese el teléfono',
                        
                    },
                    'email_contacto_update': 'Por favor ingrese el correo electrónico',

                }
            });

            $('#crear_cuota').validate({
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
                    'nombre_quinquenio': {
                        required: true
                    },
                    
                    'cuota_pais': {
                        required: true
                    },

                    'descripcion_crearcuota': {
                        required: true,
                        minlength: 10
                    },
                    'fecha_inicio_periodo': {
                        required: true
                    },
                     'fecha_final_periodo': {
                        required: true
                    }
                },
                messages: {
                    'nombre_quinquenio': 'Por favor ingrese el nombre',
                    'cuota_pais': 'Ingrese la cuota asignada',
                    'descripcion_crearcuota': {
                        required: 'Por favor ingrese una descripción',
                        
                    },
                    'fecha_inicio_periodo': {
                        required: 'Seleccione Inicio'
                    },
                    'fecha_final_periodo': 'Seleccione Final',

                }
            });

            $.mask.definitions['~']='[267]';
            $('#telefono').mask('~999-9999');
            $('#telefono_contacto').mask('~999-9999');
            $('#telefono_contacto_update').mask('~999-9999');
            


            
        }



    };
}();