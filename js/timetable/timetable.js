$(document).ready(function(){

    initChosen();

    initSpinner('spinner1');

    $spinner1 = $('#spinner1');

    $(document).on('change', '#TimeTableForm_filial, #TimeTableForm_chair, #TimeTableForm_faculty, #TimeTableForm_course', function(){

        $spinner1.show();

        var $form  = $(this).closest('form');
        var formId = $form.attr('id');
        var url    = $form.attr('action');

        $.get(url, $form.serialize(), function(data){

            var html = $('#'+formId, data).html();
            $('div', $form).replaceWith(html);
            initChosen();
            $spinner1.hide();
        })

    });

    $(document).on('change', '#TimeTableForm_teacher, #TimeTableForm_group', function(){
        $(this).closest('form').submit();
    });

    initPopovers();

    initTooltips();

});