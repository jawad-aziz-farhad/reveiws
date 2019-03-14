(function($) {  

    window.page = window.page || {};

    $(document).ready(function(){   
        console.log('Form3 Js is ready.')   
        enableDisableButton();  
        bindEvents();
        onRaneSlide()
    }); 

    page.variables = {
        ratings : { money_rating : '', frame_rating : '' , comfort_rating : '' , design_rating : '' , gears_rating : '' , 
                    brakes_rating : '' , steering_rating : '' , wheels_rating : '' , saddle_rating : '' } 
    }
    
    function bindEvents(){
      $('input[type=text] , input[type=email] , input[type=number]').on('keyup blur', checkField);
      $('input[type="file"]').on('change', fileSelection);
      $('select').on('change', checkField);
      $('label').on('click', giveRating);
      $('#reviewForm').on('submit', submitForm);
    }

    /*
    |-----------------------
    | GIVING STAR RATING
    |-----------------------
    */
    function giveRating(){
        console.log('Ratings' , page.variables.ratings);
        $(this).parent().find("label").css({"color": "#cc"});
        $(this).css({"color": "#FF912C"});
        $(this).nextAll().css({"color": "#FF912C"});           
        
        var name = $(this).parent().find("input").attr('name');
        page.variables.ratings[name] = $(this).text();
    }

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    /*
    |------------------------------
    |  CHECKING FIELDS ON KEY PRESS
    |------------------------------
    */
    function checkField() {
        console.log('checking field.')
      if($(this).attr('required')) {

        var value = $(this).val();
        var type  = $(this).attr('type');
        /* FOR EMAIL INPUT TYPE */
        if(type === 'email'){
            $isValid = isEmail( value ) ?  true : false;
            toggleClasses($(this), $isValid);
            showErrorMessage($(this) , $isValid );
        }
        /* FOR TEXT INPUT TYPE */
        else if(type === 'text'){
            $isValid = (value.length >= 5 ) ? true : false;
            console.log('valid', $isValid)
            toggleClasses($(this), $isValid)
            showErrorMessage($(this) , $isValid )
        }
        /* FOR NUMBER INPUT TYPE */
        else if(type === 'number') {
          $isValid = value ? true : false;
          toggleClasses($(this), $isValid);  
        }
        /* FOR SELECT TYPE */
        else if(type === 'select'){
            value = $(this).children("option:selected").val();
            $isValid = (value.indexOf('select') > -1) ? false : true;
            toggleClasses($(this), $isValid);  
        }
      }
      
      enableDisableButton();
    }
    /*
    |-------------------------------------
    |  TOGGLING VALID AND INVALID CLASSES
    |-------------------------------------
    */
    function toggleClasses($this , isValid){
       console.log('parent', $this.parent().find('fieldset').className);        
       isValid ? $this.parent().find('fieldset').removeClass('border-danger').addClass('border-success'):
                 $this.parent().removeClass('border-success').addClass('border-danger'); 
    }

    /*
    |-----------------------------------------------
    |  SHOWING ERROR MESSAGE TO THE REGARDING FIELD
    |-----------------------------------------------
    */
    function showErrorMessage($this , $isValid ){
        $legend   = $("legend[for='"+$this.attr('id')+"']");

        if($this.val().length >=1 && $this.val().length < 5){
            if($this.attr('type') === 'text')
                $error = 'Min 5 characters required.';
            else
                $error = 'Email address is invalid.'
        }
        else
            $legend_error = $legend.text() + ' is required.';
        
            $descibedBy = $this.attr('aria-describedby');

        if($isValid) {        
            $('#' + $descibedBy).hide();
        }
        else {
            $('#' + $descibedBy).text($legend_error);
            $('#' + $descibedBy).show();
        }
    }

    

    /*
    |----------------------------------------   
    |    CHECKING ALL THE REQUIRED FIELDS ,
    |    IF ALL REQUIRED FIELDS ARE FILLED,
    |    ENABLING SUBMIT BUTTON,
    |    OTHERWISE
    |    DISABLING SUBMIT BUTTON
    |----------------------------------------
    */
    function enableDisableButton(){
        let formIsValid = false;
        $form = $('#reviewForm').val();
        $( '.form-control', $form ).each( function() {
            if($(this).attr('required')) {

                if($(this).attr('type') == 'text' && $(this).val().length >= 4 && $(this).hasClass('is-invalid'))
                    $(this).removeClass('is-invalid').addClass('is-valid');
                else if($(this).attr('type') == 'email' && isEmail($(this).val()) && $(this).hasClass('is-invalid'))
                    $(this).removeClass('is-invalid').addClass('is-valid');
                else if($(this).attr('type') === 'number' && $(this).val() > 0 )
                    $(this).removeClass('is-invalid').addClass('is-valid');
                else if($(this).attr('type') === 'select' && ($(this).children("option:selected").val().indexOf('select') == -1))
                    $(this).removeClass('is-invalid').addClass('is-valid');

                formIsValid = ($(this).hasClass('is-invalid')) ? true : false;
            }
        });
        $( 'button[type=submit]', $form ).attr( 'disabled', formIsValid );
    }

    /*
    |-------------------
    |  SUBMITTING FORM
    |-------------------
    */
    function submitForm(e){

        e.preventDefault();

        $form = $(this);

        $('button[type="submit"]', $form).each(function()
        {
            $btn = $(this);
            $btn.prop('type','button' );
            $btn.prop('orig_label',$btn.text());
            $btn.text('Sending ...');
        });
        
        var form_data = new FormData();

        var form = $form.serializeArray();
        $.each(form , function (index, input) {
            form_data.append(`${input.name}`, `${input.value}`);
        });
        
        var files = ['bike', 'gears', 'tyres', 'handlebar', 'suspension' , 'review_video'];
        for(var i=0; i<files.length; i++) {
            var file_data = $('input[name="'+files[i]+'"]')[0].files[0];
            form_data.append(files[i] , file_data);           
        }
        form_data.append('action', 'submitReviewForm');  
        form_data.append('query_vars', reviewForm.query_vars);  
        for ( var rating in page.variables.ratings ) {
            var val = page.variables.ratings[rating] ? page.variables.ratings[rating] : 0;
            form_data.append(rating, val);
        }
        $.ajax({
            type: "POST",
            url: reviewForm.review_url,
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: onFormSubmission
        });
    }

    function formFieldsToObject( fields  ) {
        var product = {};
      
        for( var i = 0; i < fields.length; i++ ) {
          var field = fields[ i ];
          if( ! product.hasOwnProperty( field.name ) ) {
            product[ field.name ] = field.value;
          }
          else {
            if( ! product[ field.name ] instanceof Array ){
              product[ field.name ] = [ product[ field.name ] ];
            }
            else {
                product[ field.name ] = field.value ;
            }
          }
        }
      
        return product;
      }
    /*
    |------------------------------------------
    |  HANDLING RESPONSE AFTER FORM SUBMISSION
    |------------------------------------------
    */
    function onFormSubmission(data){

        $('button[type="button"]', $('#reviewForm').val()).each(function()
        {
            $btn = $(this);
            $btn.prop('type','submit' );
            $btn.prop('orig_label',$btn.text());
            $btn.text('Submit');
        });
        console.log('Data', data);
    }

    /*
    |------------------------------------------
    |       FILE SELECTION EVENT HANDLER
    |------------------------------------------
    */
    function fileSelection(e){
        var fileName = e.target.files[0].name;
        var imageId = $(this).attr('imageNum');
        
        if(imageId > -1) {
            if(!fileName.match(/.(jpg|jpeg|png|gif)$/i)){
                window.alert('Please select an image file.');
                return;
            }

            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();		        
                reader.onload = function (e) {
                    $('#image-'+ imageId).attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);                
            }
        }
        
        else {            
            if(!fileName.match(/.(mp4|ogg|h264|hls|vp9)$/i)){
                window.alert('Please select a video.');
                return;
            }
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();		        
                reader.onload = function (e) {
                    $('#videoTag').attr('src', e.target.result);
                    $('#videoDiv video')[0].load();
                }
                reader.readAsDataURL(e.target.files[0]);                
            }

        }
        
    }

})(jQuery);
