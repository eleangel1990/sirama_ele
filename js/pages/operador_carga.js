var Operador = function() {
	 
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
           
            var formLogin       = $('#registro_direccion_operador_carga');

            

           
            $('#registro_direccion_operador_carga').validate({
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
                    'nombre_responsable': {
                        required: true
                    },

                    'direccion_nueva': {
                        required: true
                    },
                    'telefono_nuevo': {
                        required: true
                    }
	            },
                messages: {
                    'nombre_responsable': 'Por favor ingrese el nombre',
                    'direccion_nueva':'Por favor ingrese la dirección',
                    'telefono_nuevo':'Ingrese el teléfono'

                }
            });


            $('#registro_barco_operador_carga').validate({
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
                    'nombre_barco': {
                        required: true
                    },

                    'eta': {
                        required: true
                    },
                    'etd': {
                        required: true
                    },
                    'imo': {
                        required: true
                    },
                    'numero_viaje': {
                        required: true
                    }
                },
                messages: {
                    'nombre_barco': 'Ingrese el nombre del barco',
                    'eta':'Seleccione la fecha ETA',
                    'etd':'Seleccione la fecha ETD',
                    'imo':'Ingrese el IMO',
                    'numero_viaje':'Ingrese el número de viaje'

                }
            });

            

             $.mask.definitions['~']='[267]';
        $('#telefono_nuevo').mask('~999-9999');
                       
        }

       

    };
}();