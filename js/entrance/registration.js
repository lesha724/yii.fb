$(document).ready(function(){

    $(document).on('click', 'input.datepicker', function(event) {
        $(this).datepicker({
            format: 'dd.mm.yyyy',
            language: 'ru'
        }).on('changeDate', function(ev){

        }).focus();
    });

    $(".select2").css('width','150px').select2({allowClear:true})
        .on('change', function(){
            $(this).closest('form').validate().element($(this));
        });

    $('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
        if(!$('#validation-form').valid())
            return false;
    }).on('finished', function(e) {
        bootbox.dialog("Thank you! Your information was successfully saved!", [{
            "label" : "OK",
            "class" : "btn-small btn-primary",
        }]
        );
    }).on('stepclick', function(e){
        //return false;//prevent clicking on steps
    });

    initAutoSize();

    $('#validation-form').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            'Aap[aap2]': {
                required: true,
                minlength: 2,
                maxlength: 35
            },
            'Aap[aap3]': {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            'Aap[aap4]': {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            'Aap[aap7]': 'required',
            'Aap[aap5]': 'required',
            'Aap[aap6]': {
                required: true,
                minlength: 2,
                maxlength: 100
            },
            'Aap[aap43]': 'required',
            'Aap[aap15]': 'required',
            'Aap[aap57]': 'required',
            'Aap[aap16]': 'required',
            'Aap[aap34]': 'required',
            'Aap[aap44]': 'required',
            'Aap[aap45]': 'required',
            'Aap[aap47]': 'required',
            'Aap[aap49]': {
                digits : true,
                minlength: 4
            },
            'Aap[aap62]': 'required',
            'Aap[aap35]': 'required',
            'Aap[aap33]': 'required',
            'Aap[aap50]': 'required',
        },

        invalidHandler: function (event, validator) { //display error alert on form submit
            $('.alert-error', $('.login-form')).show();
        },

        highlight: function (e) {
            $(e).closest('.control-group').removeClass('info').addClass('error');
        },

        success: function (e) {
            $(e).closest('.control-group').removeClass('error').addClass('info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is(':checkbox') || element.is(':radio')) {
                var controls = element.closest('.controls');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element);
        },

        submitHandler: function (form) {
        },
        invalidHandler: function (form) {
        }
    });

    $.extend($.validator.messages, {
        required: tt.required,
        maxlength: $.validator.format(tt.maxLength),
        minlength: $.validator.format(tt.minLength),
        digits: tt.digits
    });

    initSpinner('spinner1');
    $spinner1 = $('#spinner1');

    $('#Aap_aap15, #Aap_aap57').change(function(){

        $spinner1.show();

        var post = {
            'spab4': $('#Aap_aap15 option:selected').val(),
            'spab5': $('#Aap_aap57 option:selected').val()
        };

        $.getJSON(getSpecialitiesUrl, post, function(data){
            $('#Aap_aap16').html($(data.html).html())
            $spinner1.hide();
        })

    });

    $('#agroClasses').change(function(){

        $next = $(this).parents('.control-group').next();
        if ($(this).val() == 1)
            $next.show();
        else
            $next.hide();
    }).change();
});