$(document).ready(function(){

    $spinner1 = $('#spinner1');

    $(document).on('change', '#FilterForm_discipline,#FilterForm_type_lesson,#FilterForm_group', function() {

        var $form  = $(this).closest('form');
        var formId = $form.attr('id');
        var url    = $form.attr('action');
        $('#FilterForm_sem1').val('0');

        $spinner1.show();

        $.get(url, $form.serialize(), function(data){

            var html = $('#'+formId, data).html();
            $('div', $form).replaceWith(html);
            initChosen();
            $spinner1.hide();
        })
    });

    $(document).on('change', ' #FilterForm_sem1', function() {
        $(this).closest('form').submit();
    });

});