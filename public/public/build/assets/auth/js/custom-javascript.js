(function($) {
    "use strict";
    $('#show_hide_password').click(function(){
        const attr_value = ($('#password').attr('type'));
        if(attr_value == 'password'){
        $('#password').attr('type', 'text');
        $('#confirm_password').attr('type', 'text');
        }else{
            $('#password').attr('type', 'password');
            $('#confirm_password').attr('type', 'password');
        }
    });

 
})(jQuery);