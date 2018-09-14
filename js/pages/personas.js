var Personas = function() {
	 
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
            var formLogin       = $('#update_contrasena');
            var formLogin1       = $('#update_usuario_nuevo');
            

            

           
            $('#update_contrasena').validate({
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
                    'contra': {
                        required: true,
                        minlength: 5,   
                    },
                    'recontra': {
                        required: true,
                        minlength: 5,
                        equalTo : "#contra"
                    }
               },

                messages: {
                    'contra': {
                        required: 'Por favor ingrese su contraseña',
                        minlength: 'Su contraseña debe tener al menos 5 caracteres de largo'
                    },
                    'recontra': {
                        required: 'Por favor repita su contraseña',
                        minlength: 'Su contraseña debe tener al menos 5 caracteres de largo',
                        equalTo: "La contraseña ingresada no coincide"

                    },

                }
            });

          $('#update_usuario_nuevo').validate({
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
                    'usuario1': {
                        required: true,
                        minlength: 5,   
                    },
                    'correo1': {
                        required: true,
                        minlength: 5,
                        email: true,
                    }
               },

                messages: {
                    'usuario1': {
                        required: 'Por favor ingrese su nombre de usuario',
                        minlength: 'Su nombre de usuario debe tener al menos 5 caracteres de largo'
                    },
                    'correo1': {
                        required: 'Por favor ingrese su correo',
                        minlength: 'Su correo debe tener al menos 5 caracteres de largo',
                        email:'Ingrese un correo valido',

                    },

                }
            });



        
        }

    };
}();