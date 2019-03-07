(function($) {    
    $(document).ready(function(){
        $('.form-control').bind('change', function(){
            var text = $(this).val();
            if($(this).hasClass('is-invalid') || $(this).hasClass('is-valid')){
                
                if(text.length >= 3){
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    
                }
                else{
                    $(this).removeClass('is-valid').addClass('is-invalid');
                }
            }
        });
    }); 

})(jQuery);