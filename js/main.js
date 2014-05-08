function initChosen()
{
    $('.chosen-select').chosen();
}

function initSpinner(id)
{
    var opts = {
        lines:  11, // The number of lines to draw
        length: 7, // The length of each line
        width:  4,  // The line thickness
        radius: 5  // The radius of the inner circle
    };
    var target = document.getElementById(id);
    var spinner = new Spinner(opts).spin(target);
}

function addGritter(title, text, className)
{
    obj = {
        title: title,
        text: text,
        class_name: 'gritter-'+className
    }
    $.gritter.add(obj)
}

function initPopovers()
{
    $('[data-rel=popover]').popover({html:true});
}

function initTooltips()
{
    $('[data-rel=tooltip]').tooltip();
}

function initFilterForm($spinner)
{
    $(document).on('change', '#tameTable-form select:not(:last)', function(){

        $spinner.show();

        var $form  = $(this).closest('form');
        var formId = $form.attr('id');
        var url    = $form.attr('action');

        $.get(url, $form.serialize(), function(data){

            var html = $('#'+formId, data).html();
            $('div', $form).replaceWith(html);
            initChosen();
            $spinner.hide();
        })

    });

    $(document).on('change', '#tameTable-form select:last', function(){
        $(this).closest('form').submit();
    });
}

