var Empleado = function() {
	 
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
            //var formLogin       = $('#registro');

            

           
            $('#registro_empleado').validate({
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
                    'nombre_empleado': {
                        required: true
                    },

                    'correo_empleado': {
                        required: true
                    },
                    'telefono_empleado': {
                        required: true,
                    },
                     'nit_empleado': {
                        required: true,
                    },
                    'dui_empleado': {
                        required: true,
   
                    }
	            },
                messages: {
                    'nombre_empleado': 'Por favor ingrese el nombre del empleado',
                    'correo_empleado': 'Por favor ingrese el correo electrónico de la cuenta',
                    'telefono_empleado': 'Por favor ingrese el numero de telefono',
                    'nit_empleado': 'Por favor ingrese el NIT',
                    'dui_empleado': 'Por favor ingrese el DUI',
                    

                }
            });
            $.mask.definitions['~']='[267]';
            $('#telefono_empleado').mask('~999-9999');
            $('#fax').mask('~999-9999');
            $('#nit_empleado').mask('9999-999999-999-9');
            $('#dui_empleado').mask('99999999-9');
        
        }

    };
}();