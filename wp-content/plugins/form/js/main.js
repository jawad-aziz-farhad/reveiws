(function($) {    
    window.page = window.page || {};
    $(document).ready(function(){      
        console.log('Steps JS ready.')
        init_jQuery_steps();
        bindEvents();        
        page.variables.ratings = {};
    });     
    page.variables = {
        ratings : { money_rating : '', frame_rating : '' , comfort_rating : '' , design_rating : '' , gears_rating : '' , 
                    brakes_rating : '' , steering_rating : '' , wheels_rating : '' , saddle_rating : '' } ,
        form : $('#review_form')
    }
    /*
    |-------------------
    |  BINDING EVENTS
    |-------------------
    */
    function bindEvents(){
        $('label').on('click', giveRating);
        $('input[type="range"]').on('change', handleRangeSlide);
        $('input[type="file"]').on('change', fileSelection);
    }
    /*
    |-----------------------------
    | Handling Rane Slider Events
    |-----------------------------
    */
    function handleRangeSlide(){
        $("label[for='"+$(this).attr('id')+"'] span").text($(this).val());
    }
    /*
    |-----------------------
    | GIVING STAR RATING
    |-----------------------
    */
   function giveRating(){
        $(this).parent().find("label").css({"color": "#cc"});
        $(this).css({"color": "#FF912C"});
        $(this).nextAll().css({"color": "#FF912C"}); 
        var name = $(this).parent().find("input").attr('name');
        page.variables.ratings[`${name}`] = $(this).text();
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
            if(!fileName.match(/.(mp4|mov)$/i)){
                window.alert('Please select a video.');
                return;
            }
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();		        
                reader.onload = function (e) {
                    $('#videoDiv').show();
                    $('#demoVideo').hide();
                    $('#videoTag').attr('src', e.target.result);
                    $('#videoDiv video')[0].load();
                    
                }
                reader.readAsDataURL(e.target.files[0]);                
            }
        }    
    }
    /*
    |--------------------------
    | Initialzing JQUERY Steps
    |--------------------------
    */
    function init_jQuery_steps() {

        var form = $("#review_form").show();
        $.validator.addMethod('filesize', function (value, element, arg) {
            if(this.optional(element) || (element.files[0].size <= arg)){
                $("span[for="+$(this).attr("id")+"]").remove();
                return true;
            }else{
                return false;
            }
        });

        form.steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            transitionEffectSpeed: 500,
            stepsOrientation: "vertical",
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex || currentIndex == 1)
                {
                    return true;
                }
                
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex){},
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                submitForm();
            }
        }).validate({            
            highlight: function(element) {                
                jQuery(element).closest('.form-control').addClass('is-invalid');
            },
            unhighlight: function(element) {
                jQuery(element).closest('.form-control').removeClass('is-invalid');
            },
            errorElement: 'span',
            errorClass: 'label label-danger invalid-feedback',
            success: function(label) {                
                label.closest('.form-group').children('.is-invalid').removeClass('is-invalid').addClass('is-valid');
                label.remove();                
            },
            errorPlacement: function(error, element) {
                if(error[0].innerHTML == 'Please enter a value between NaN and NaN.') return;
                element.closest('.form-group').children('.invalid-feedback').remove();
                element.closest('.form-group').append(error);
                if($(element).hasClass('is-valid'))
                $(element).removeClass('is-valid');
                $(element).addClass('is-invalid');
                
            },
            rules: {
                review_video:{
                    required:true,
                    accept:"mp4|mov",
                    filesize: 50000000   //max size 50 MB 
                },
                bike :  {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 5388608
                },
                tyres:  {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 5388608
                },
                gears :  {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 5388608
                },
                handlebar :  {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 5388608
                },
                suspension : {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 5388608
                }
                
            },messages: {
                review_video:{
                    filesize: "File size must be less than 5 MB.",
                    accept  : "Please upload .mp4 file.",
                    required: "Please upload a review video."
                },
                bike : { filesize: 'File size must be less than 2 MB.', accept  : "Please upload image file."},
                tyres: { filesize: 'File size must be less than 2 MB.', accept  : "Please upload image file."},
                gears: { filesize: 'File size must be less than 2 MB.', accept  : "Please upload image file."},
                handlebar : { filesize: 'File size must be less than 2 MB.', accept  : "Please upload image file."},
                suspension: { filesize: 'File size must be less than 2 MB.', accept  : "Please upload image file."},

            },
        });

        
    }
   /*
   |-------------------
   |  SUBMITTING FORM
   |-------------------
   */
   function submitForm(){

        var form_data = new FormData();

        var form = $('#review_form').serializeArray();
        $.each(form , function (index, input) {
            //console.log(input.name, input.value);
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
        form_data.append('like_level', $('input[type="range"]').val());
        $.ajax({
            type: "POST",
            url: reviewForm.review_url,
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: showLoader,
            success: onReviewSuccess,
            error: onReviewError
        });
    }

    /*
    |-----------------
    |  SHOW LOADER
    |-----------------
    */
    function showLoader() { $('.loading').show(); }
    /*
    |----------------------
    |  MAKING LOADER
    |---------------------
    */
    function getLoader(){
        var loaderMarkUp = '<div id="loader">';
        loaderMarkUp     += '<div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div>';
        loaderMarkUp     += '<div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="lading"></div></div>';
        return loaderMarkUp;
    }
    /*
    |------------------------------------------
    |  HANDLING RESPONSE AFTER FORM SUBMISSION
    |------------------------------------------
    */
   function onReviewSuccess(response) {
        $('.loading').hide();
       response = jQuery.parseJSON(response);
       console.log('Response', response);
       if(response['post']['success']){
            $('#success-message').show();
            resetForm();
       }
       else
         $('#error-message').show();
    }

    function onReviewError(error){
        $('.loading').hide();
        $('#error-message').show();
        console.error('Error', error);
    }

    /*
    |---------------------------------------
    |  RESETTING FORM TO DEFAULT CONDITION
    |---------------------------------------
    */
    function resetForm() {
       $('#review_form').steps('reset');
       $('#review_form').get(0).reset();
    
        for(var i=1; i<6; i++) {
           $('#image-'+i+'').attr('src','http://getwebsite.com.pk/jawad/treadly_reviews/wp-content/uploads/2019/03/placeholder-image.png');        
        }
        var video = $('#videoDiv video')[0];
        video.src = '';
        video.load();
        $('div.starrating').children('label').css("color", "rgb(204, 204, 204)");
    }


})(jQuery);
