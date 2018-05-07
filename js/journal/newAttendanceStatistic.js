$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#type').change(function () {
        $(this).closest('form').submit();
    });

    $('#AttendanceStatisticForm_semester').change(function(){

        var $form = $('#filter-form');

        var $select = $(this).clone();
        var value   = $(this).val();

        $select.find('option[value="'+$(this).val()+'"]').attr('selected', 'selected');

        $form.append($select);
        $form.submit();
    });
});