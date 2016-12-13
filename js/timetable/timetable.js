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
        var action=$("#filter-form").attr("action");
        var url = $(this).data('url');
        $("#filter-form").attr("action", getUrlPrint(url));
        $("#filter-form").submit();
        $("#filter-form").attr("action", action);
    }
);

function getUrlPrint(url){
    var type = 1;
    if(!$("#TimeTableForm_printAttr").is(':checked'))
        type=0;
    return url.replace('%type%', type);
}

$(document).on('click','.print-btn-tch',
    function(){
        var action=$("#timeTable-form").attr("action");
        var url = $(this).data('url');
        $("#timeTable-form").attr("action", getUrlPrint(url));
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