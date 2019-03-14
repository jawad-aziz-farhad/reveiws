
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


    
})(jQuery);