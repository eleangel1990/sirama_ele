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
           
            $('#registro_transporte').validate({
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
                    'nombre_transporte': {
                        required: true
                    },
                    
                    'abreviatura_transporte': {
                        required: true
                    },

                    'nit_transporte': {
                        required: true
                    },
                    'direccion_predio_transporte': {
                        required: true,
                        minlength: 10
                    },
                    'direccion_oficinas_transporte': {
                        required: true,
                        minlength: 10
                    },
                    'dui_representante_transportista': {
                        required: true
                    },
                    'telefono_transporte': {
                        required: true
                    },
                    'movil_transporte': {
                        required: true
                    },
                    'correo_transporte': {
                        required: true,
                        email: true
                    }
	            },
                messages: {
                    'nombre': 'Por favor ingrese el nombre de la asociación',
                    'dui_representante_transportista': 'Ingrese DUI de representante',
                    'abreviatura': 'Ingrese la abreviatura',
                    'nit': {
                        required: 'Por favor ingrese el teléfono del usuario',
                        
                    },
                    'direccion_predio': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 5 caracteres'
                    },
                    'direccion_oficina': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 5 caracteres'
                    },
                    'telefono_fijo': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 5 caracteres'
                    },
                    'telefono_movil': {
                        required: 'Por favor ingrese una dirección',
                        minlength: 'Debe de ser mayor a 5 caracteres'
                    },
                    'email': 'Por favor ingrese el correo electrónico de la cuenta',

                }
            });

             
            $.mask.definitions['~']='[67]';
            $('#nit_transporte').mask('9999-999999-999-9');
            $('#dui_representante_transportista').mask('99999999-9');
            $('#movil_transporte').mask('~999-9999');
            $.mask.definitions['~']='[2]';
            $('#telefono_transporte').mask('~999-9999');
            


            
        }



    };
}();