/**
 * Created by Neff on 09.02.2016.
 */
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#TimeTableForm_dateLesson').change(function(){

        var $that   = $('#TimeTableForm_dateLesson');
        var $input = $that.clone();
        var $form   = $('#filter-form');

        $input.hide();

        $form.append($input);

        $form.submit();
    });

    $('#lesson-left').click(function(){
        var toDatepicker = $('#TimeTableForm_dateLesson');
        toDatepicker.datepicker('update', moment($('#TimeTableForm_dateLesson').datepicker('getDate')).subtract(1, 'days').toDate());
    });

    $('#lesson-right').click(function(){
        var toDatepicker = $('#TimeTableForm_dateLesson');
        toDatepicker.datepicker('update', moment($('#TimeTableForm_dateLesson').datepicker('getDate')).add(1, 'days').toDate());

    });

    $('.timeTable-table .events').click(function(){
        var content = $(this).data('content');
        var modal = $('#modal-timeTable');
        $('#modal-timeTable .modal-body').html(content);
        modal.modal('show');
    });
});