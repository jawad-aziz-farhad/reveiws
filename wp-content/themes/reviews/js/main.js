
(function($) {    
    $(document).ready(function(){
        console.log('Main-JS is Ready.');
        $('.owl-carousel').owlCarousel({loop:true, margin:10, nav:true,responsive:{ 0:{items:1 }, 600:{items:3 }, 1000:{items:3 }} });
        bindEvents();
        enableDisableButton();
    }); 

    function bindEvents(){
        $('input[type=text]').on('keyup blur', checkField);
        $('#searchForm').on('submit', submitForm);
        $('#commentForm').on('submit', submitComment);
    }

    function submitForm(e) {
        e.preventDefault();
        $form = $(this);
    }
    /*
    |------------------------------
    |  CHECKING FIELDS ON KEY PRESS
    |------------------------------
    */
   function checkField() {
    if($(this).attr('required')) {
      var value = $(this).val();
      var type  = $(this).attr('type');
      /* FOR TEXT INPUT TYPE */
      if(type === 'text'){
          $isValid = (value.length >= 4 ) ? true : false;
          toggleClasses($(this), $isValid)
      }
      /* FOR NUMBER INPUT TYPE */
      else if(type === 'number') {
        $isValid = value ? true : false;
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
     isValid ? $this.removeClass('is-invalid').addClass('is-valid'):
               $this.removeClass('is-valid').addClass('is-invalid'); 
  }

  function enableDisableButton(){
        let formIsValid = false;
        $form = $('#searchForm').val();
        $( '.form-control', $form ).each( function() {
            if($(this).attr('required')) {
                if($(this).attr('type') == 'text' && $(this).val().length >= 4 && $(this).hasClass('is-invalid'))
                    $(this).removeClass('is-invalid').addClass('is-valid');
                else if($(this).attr('type') === 'number' && $(this).val() > 0 )
                    $(this).removeClass('is-invalid').addClass('is-valid');
                formIsValid = ($(this).hasClass('is-invalid')) ? true : false;
            }
        });
        $( 'button[type=submit]', $form ).attr( 'disabled', formIsValid );
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
        console.log('Response', response);
        var resultTag = $('#comment-form-result');
        resultTag.className = '';
        if(response.success)
            resultTag.text('Comment inserted successfully').addClass('color-success');
        else
            resultTag.text('Comment couldn\'t be inserted').addClass('color-danger');
    }

    
})(jQuery);