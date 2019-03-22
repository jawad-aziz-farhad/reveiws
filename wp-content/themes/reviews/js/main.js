
(function($) {    
    window.page = window.page || {};
    $(document).ready(function(){
        console.log('Main-JS is Ready.');
        $('.owl-carousel').owlCarousel({loop:true, margin:10, nav:true,responsive:{ 0:{items:1 }, 600:{items:3 }, 1000:{items:3 }} });
        bindEvents();
        enableDisableButton();
    });
    
    page.variables = {
        base_url : 'http://localhost:8888/treadly_reviews/wp-content/themes/reviews/'
    }

    function bindEvents(){
        $('.form-control').on('input', enableDisableButton);
        $('select').on('change', enableDisableButton);
        $('#searchForm').on('submit', submitForm);
        $('#commentForm').on('submit', submitComment);
        $('.like_dislike_Btns').on('click', updateLikes);
    }

    function submitForm(e) {
        e.preventDefault();
        
        $form = $(this);

        var form_data = new FormData();
        var form = $form.serializeArray();
        var prices = [];
        $.each(form , function (index, input) {
            form_data.append(`${input.name}`, `${input.value}`);
        });
        
        form_data.append('action', 'searchReview');  
        form_data.append('query_vars', reviewForm.query_vars);  

        $.ajax({
            type: "POST",
            url: reviewForm.review_url,
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: onSearchSuccess,
            error: onSearchError
        });
    }

    function onSearchSuccess(response) {
        response = JSON.parse(response);
        
        var reviews = '';
        if(response.success){
            $(response.reviews).each((index ,review) => {
                reviews += singleReview(review);
            });
            $('#reviews').html(reviews);
        }

        else
            $('#reviews').html( notFoundMarkUp() );
        
    }

    function singleReview(review){
        var html = '<div class="col-lg-4 col-md-6 col-sm-12 mb-3">';
            html += '<a href="'+ review.permaLink+'">';
            html += '<div class="card">';
            html += '<div class="card-header">';
            html += '<div class="row align-items-center">';
            html += '<div class="col-sm">';
            html += '<img class="img-fluid float-left rounded-circle" width="40"  height="40" src="https://image.shutterstock.com/image-vector/avatar-man-icon-profile-placeholder-260nw-1229859850.jpg" alt="">';
            html += '<label class="text-muted">'+ review.author +' </label>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<video class="img-fluid card-img-top" id="videoTag" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" controls="controls">';
            html += '<source src="'+ review.custom_fields.review_video.value.url +'" type="video/mp4">';
            html += '</video>';

            html += '<div class="card-body">';
            html += '</div>';

            html += '<div class="card-footer text-muted">';
            html += '<div class="float-right">';
            html += '<small>'+ review.comments +'<i class="fa fa-comments"></i></small>';    
            html += '<small class="ml-1">'+ review.custom_fields.review_likes.value +'<i class="fa fa-thumbs-up"></i> </small>';
            html += '</div>';
            html += '</div>';
            html += '</div>'; // card 
            html += '</a>'; // a
            html += '</div>'; // column

            return html;
                    
    }

    /*
    |------------------------------------
    |   MAKING NO-REVIEW FOUND MARK-UP
    |------------------------------------
    */
   function notFoundMarkUp(){
    var html =  '<div class="col-sm text-center>'
        html += '<hr><div class="img-fluid"> <img src="'+page.variables.base_url+'/images/empty_product.svg" alt="No_Product"></div>'; 
        html += '</div>'; 
    return html;
}    

    function onSearchError(error){ alert('Something went wrong.');}

    function enableDisableButton(){
        let invValid = true;
        $form = $('#searchForm').val();
        $( '.form-control' , $form).each( function() {
            const type = $(this).attr('type');
            const val  = $(this).val();
            if(type == 'text' && val.length >= 2)
                invValid = false;
            else if(type == 'number' && val > 0 )
                invValid = false;
            
        });
        if(invValid){
            var category = $('#category option:selected').val();
            invValid = (category && category.indexOf('select category')) == -1 ? false : true; 
        }
        $( '#search_btn').attr( 'disabled', invValid );
    }

    function submitComment(e){

        e.preventDefault();
        $form = $(this);

        var comment = $('#comment').val();
        
        if(comment === '' || comment === null){
            alert('Please enter some comment.');
            return;
        }
        var form_data = new FormData();
        var form = $form.serializeArray();
        $.each(form , function (index, input) {
            form_data.append(`${input.name}`, `${input.value}`);
        });
        // var category = $('#cateogries option:selected').val();
        // form_data.append('category', category);
        form_data.append('action', 'insertComment');  
        form_data.append('query_vars', reviewForm.query_vars);  
        
        $.ajax({
            type: "POST",
            url: reviewForm.review_url,
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: onCommentSubmission
        });
    }

    function onCommentSubmission(response){
        var resultTag = $('#comment-form-result');
        resultTag.className = '';
        if(response.success)
            resultTag.text('Comment inserted successfully').addClass('color-success');
        else
            resultTag.text('Comment couldn\'t be inserted').addClass('color-danger');
    }

    function updateLikes(){
        var form_data = new FormData();
        form_data.append('action', 'updateLikes');  
        form_data.append('query_vars', reviewForm.query_vars);  
        form_data.append('post_id', $(this).attr('post_id'));
        form_data.append('field', $(this).attr('field'));

        console.log('Form', form_data);
        $.ajax({
            type: "POST",
            url: reviewForm.review_url,
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response){
                console.log('Response', response);
            },
            error: function(error) {
                console.error('Error', error);
            }

        });
    }

    
})(jQuery);