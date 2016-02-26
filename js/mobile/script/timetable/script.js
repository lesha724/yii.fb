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
});