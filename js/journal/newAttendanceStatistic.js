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


    $('#btn-print-excel').click(function(){
        var action=$("#filter-form").attr("action");
        $("#filter-form").attr("action", $(this).data('url'));
        $("#filter-form").submit();
        $("#filter-form").attr("action", action);
    });
});