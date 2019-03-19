(function($) {    

    $(document).ready(function(){      
        console.log('Steps Js is ready.')
        init_steps_1();
    }); 
    

 function init_steps_jquery() {
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        stepsOrientation: "vertical",
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Back Step',
            next : '<i class="fa fa-arrow-right"></i>',
            finish : '<i class="fa fa-arrow-left"></i>',
            current : ''
        },
    })
};

function init_steps(){
    var form = $("#form-total");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            brand: "required"
        }
    });
    form.steps({
        headerTag: "h2",
        bodyTag: "section",
        stepsOrientation: "vertical",
        titleTemplate : '<div class="title">#title#</div>',
        transitionEffect: "slideLeft",
        labels: {
            previous : 'Back Step',
            next : '<i class="fa fa-arrow-right"></i>',
            finish : '<i class="fa fa-arrow-left"></i>',
            current : ''
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // form.validate().settings.ignore = ":disabled,:hidden";
            // return form.valid();
            console.log(currentIndex, newIndex);
            return true;
        },
        onFinishing: function (event, currentIndex)
        {
            // form.validate().settings.ignore = ":disabled";
            // return form.valid();
            console.log(currentIndex, event);
            return true;
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        }
    });
}

function init_steps_1(){
    $("#review_form").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical"
    });
}

})(jQuery);
