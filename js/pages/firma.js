var Firma_ingenio = function() {
	 
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
            var formLogin       = $('#registro_firma_ingenio');

            

           
            $('#registro_firma_ingenio').validate({
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
                    'nombre3': {
                        required: true
                    },

                    'firma1': {
                        required: true
                    }
	            },
                messages: {
                    'nombre3': 'Ingrese responsable de firma',
                    'firma1': {
                        required: 'Por favor agregue la firma',
                        
                    },

                }
            });
            $.mask.definitions['~']='[267]';
            $('#telefono1').mask('~999-9999');
            $('#fax').mask('~999-9999');
        
        }

    };
}();