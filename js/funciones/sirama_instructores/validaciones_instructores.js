var Instructores= function() {
     
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
            $('#registro_instructor').validate({
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
                    'nombre_instructor': {
                        required: true
                    },
                    
                    'dui_instructor': {
                        required: true
                    },
                    'nit_instructor': {
                        required: true
                    },
                    'telefono_instructor': {
                        required: true
                    },
                    'especializacion_instructor': {
                        required: true
                    },
                    'nacimiento_instructor': {
                        required: true
                    }    
                },
                messages: {
                    'nombre_instructor':"Campo Oblitorio",
                    'dui_instructor':"Campo Oblitorio",
                    'nit_instructor':"Campo Oblitorio",
                    'telefono_instructor':"Campo Oblitorio",
                    'especializacion_instructor':"Campo Oblitorio",
                    'nacimiento_instructor':"Campo Oblitorio",

                }
            });


            

             
            $.mask.definitions['~']='[267]';
            $('#telefono_instructor').mask('~999-9999');
            $('#dui_instructor').mask('9999999-9');
            $('#nit_instructor').mask('9999-999999-999-9');
            


            
        }



    };
}();