(function($) {    
    window.page = window.page || {};

    $(document).ready(function(){      
        console.log('Steps Js is ready.')
        init_steps();
        $('label').on('click', giveRating);
        $('input[type="range"]').on('change', handleRangeSlide);
        $('input[type="file"]').on('change', fileSelection);
    }); 
    
    page.variables = {
        ratings : { money_rating : '', frame_rating : '' , comfort_rating : '' , design_rating : '' , gears_rating : '' , 
                    brakes_rating : '' , steering_rating : '' , wheels_rating : '' , saddle_rating : '' } ,
        form : $('#review_form')
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
        console.log('Ratings' , page.variables.ratings);
        $(this).parent().find("label").css({"color": "#cc"});
        $(this).css({"color": "#FF912C"});
        $(this).nextAll().css({"color": "#FF912C"}); 
        var name = $(this).parent().find("input").attr('name');
        page.variables.ratings[name] = $(this).text();
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

    function init_steps() {

        var form = $("#review_form").show();
        $.validator.addMethod('filesize', function (value, element, arg) {
            var minsize = 1000000; // 1000 1kb 10,000 1MB , 100,000 10MB
            if((value <= arg)){
                return true;
            }else{
                return false;
            }
        });

        form.steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
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
                if(form.valid()){
                    submitForm(event);
                    return;
                }
                return false;
            },
            onFinished: function (event, currentIndex)
            {}
        }).validate({            
            highlight: function(element) {
                jQuery(element).closest('.form-control').addClass('is-invalid');
            },
            unhighlight: function(element) {
                jQuery(element).closest('.form-control').removeClass('is-invalid');
            },
            errorElement: 'span',
            errorClass: 'label label-danger invalid-feedback',
            success: function(label,element) {
                console.log('Label', label[0]);
                
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
                    accept:"mp4",
                    filesize: 8388608   //max size 8
                }
            },messages: {
                review_video:{
                    filesize: "File size must be less than 8 MB.",
                    accept  : "Please upload .mp4 file.",
                    required: "Please upload file."
                }
            },
        });
    }
    /*
    |-------------------
    |  SUBMITTING FORM
    |-------------------
    */
   function submitForm(e){

        e.preventDefault();

        $form = $(this);

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
        form_data.append('like_level', $('input[type="range"]').val());
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
    /*
    |------------------------------------------
    |  HANDLING RESPONSE AFTER FORM SUBMISSION
    |------------------------------------------
    */
   function onFormSubmission(data){
       $('#review_form').get(0).reset();
       $('#review_form').steps('reset');
    }

})(jQuery);
