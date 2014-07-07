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

        if(!$('#validation-form').valid())
            return false;

        var $form  = $('form');
        var $input = $('<input>', {
            type:  'hidden',
            name:  'finished',
            value: '1'
        })
        $form.append($input)

        $.post('', $form.serialize(), function(data){
            bootbox.dialog(tt.finish,
                [{
                    'label' : 'OK',
                    'class' : 'btn-small btn-primary',
                    'callback': function(){
                        window.location.reload();
                    }
                }]
            );
        });



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
            'Aap[aap8]' : 'required',
            'Aap[aap18]': 'required',
            'Aap[aap19]': {
                required: true,
                maxlength: 10
            },
            'Aap[aap20]': {
                required: true,
                digits : true,
                maxlength: 15
            },
            'Aap[aap21]': {
                required: true,
                maxlength: 100
            },
            'Aap[aap22]': 'required',
            'Aap[aap37]': {
                maxlength: 50
            },
            'Aap[aap29]': {
                maxlength: 10
            },
            'Aap[aap30]': {
                maxlength: 100
            },
            'Aap[aap31]': {
                maxlength: 15
            },
            'Aap[aap32]': {
                maxlength: 50
            },
            'Aap[aap36]': {
                maxlength: 50
            },
            'Aap[aap24]': {
                maxlength: 10
            },
            'Aap[aap25]': {
                maxlength: 100
            },
            'Aap[aap26]': {
                maxlength: 15
            },
            'Aap[aap27]': {
                maxlength: 50
            },
            'Aap[aap9]': 'required',
            'Aap[aap11]': {
                required : true,
                maxlength: 5
            },
            'Aap[aap12]': {
                required : true,
                maxlength: 15,
                digits: true
            },
            'Aap[aap13]': 'required',
            'Aap[aap14]': {
                digits : true,
                minlength: 4,
                required: true
            },
            'Aap[aap61]': {
                maxlength: 50
            },
            'Aap[aap54]': 'required',
            'Aap[aap38]': {
                required : true,
                maxlength: 50
            },
            'Aap[aap58]': 'required',
            'Aap[aap28]': 'required',
            'Aap[aap23]': 'required'
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

    $('#Aap_aap16').change(function(){

        $spinner1.show();

        var $form  = $(this).closest('form');

        $.getJSON('', $form.serialize(), function(data){
            var html = $('#exams', data.html).outerHTML();
            $('#exams', $form).replaceWith(html);
            $spinner1.hide();
        });
    });

    $(document).on('change', '#exams select', function(){

        var type = $(this).find('option:selected').val();
        var $tr  = $(this).closest('tr');

        var $spans = $tr.find('[data-type]');
        $spans.hide();
        $spans.find('[data-name]').removeAttr('name');

        var $span = $tr.find('[data-type='+type+']');
        $span.show();
        var $input = $span.find('[data-name]');
        $input.attr('name', $input.data('name'));

    });

    initSelects('[id*=Aap_country], [id*=Aap_region]');

    initOtherCity('#Aap_aap28, #Aap_aap23, #Aap_aap55');

    $('.copy-address').click(function(){

        $select1 = $('#Aap_country1');
        $('#Aap_country2').html( $select1.html() ).val( $select1.val() );

        $select2 = $('#Aap_region1');
        $('#Aap_region2').html( $select2.html() ).val( $select2.val() );

        $select3 = $('#Aap_aap28');
        $('#Aap_aap23').html( $select3.html() ).val( $select3.val()).change();

        $('#Aap_aap36').val( $('#Aap_aap37').val() );
        $('#Aap_aap24').val( $('#Aap_aap29').val() );
        $('#Aap_aap25').val( $('#Aap_aap30').val() );
        $('#Aap_aap26').val( $('#Aap_aap31').val() );
        $('#Aap_aap27').val( $('#Aap_aap32').val() );

    });
});

function initSelects(selector)
{
    $(document).on('change', selector, function(){

        $spinner1.show();

        var $that  = $(this);
        var $form  = $that.closest('form');
        var nextSelect = $that.parents('.control-group').next().find('select');

        $.getJSON('', $form.serialize(), function(data){
            var id = '#'+nextSelect.attr('id');
            var html = $(id, data.html).outerHTML();
            $(id, $form).replaceWith(html);
            $spinner1.hide();
        })
    });
}

function initOtherCity(selector)
{
    $(document).on('change', selector, function(){

        var $that  = $(this);
        var $div   = $that.parents('.control-group').next();

        if ($(this).val() == '0')
            $div.removeClass('hide');
        else
            $div.addClass('hide');
    });
}