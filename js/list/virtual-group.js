/**
 * Created by Neff on 02.12.2016.
 */
$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    initTooltips();

    $('#journal-print').click(function(){
        var action=$("#filter-form").attr("action");
        $("#filter-form").attr("action", $(this).data('url'));
        $("#filter-form").submit();
        $("#filter-form").attr("action", action);
    });
});