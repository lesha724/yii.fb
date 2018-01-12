$(document).ready(function(){

    $spinner1 = $('#spinner1');

    $select = $('.chosen-chairId');

    $select.chosen();

    $select.on('change', function(evt, params) {
        $(this).closest('form').submit();
    });

    initFilterForm($spinner1);
});