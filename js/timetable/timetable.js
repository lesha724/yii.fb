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

    $('i.show-info').click(function(){
        showDialog();
    })
});

$(document).on('click','.print-btn',
    function(){
        $("#filter-form").attr("action", $(this).data('url'));
        $("#filter-form").submit();
    }
);

$(document).on('click','.print-btn-tch',
    function(){
        var action=$("#timeTable-form").attr("action");
        $("#timeTable-form").attr("action", $(this).data('url'));
        $("#timeTable-form").submit();
        $("#timeTable-form").attr("action", action);

    }
);

function showDialog()
{
    $( "#dialog-message" ).dialog({
        modal: true,
        title: "<div class='widget-header'><h4 class='smaller'>"+tt.popupTitle+"</h4></div>",
        title_html: true,
        buttons: [
            {
                html: "<i class='icon-remove bigger-110'></i>&nbsp; Ok",
                class : "btn btn-info btn-mini",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
        ]
    });
}