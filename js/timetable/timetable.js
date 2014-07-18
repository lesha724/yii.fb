$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    initPopovers();

    initTooltips();

    $(document).on('click', 'input.datepicker', function(event) {
        $(this).datepicker({
            format: 'dd.mm.yyyy',
            language: 'ru'
        }).focus();
    });
});