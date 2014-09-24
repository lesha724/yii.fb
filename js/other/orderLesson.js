$(document).ready(function(){

    $('div.cell > div').click(function(){

        var $that  = $(this);
        var params = $that.find('span.hidden').text();
        var $popup = $('#dialog-message');
        var $info  = $popup.find('#info');

        $('.orderLesson').removeClass('orderLesson');
        $that.addClass('orderLesson');

        $info.attr('style', $that.attr('style'));

        var html = parseFullDescription($that);
        $info.html(html);
    });

    $(document).keypress(function(event){
        event = (event) ? event : window.event;
        if(event.keyCode == 46 && $('.orderLesson').length > 0)
            showDialog()
    });

    $('#ZPZ_zpz6').datepicker({
        format: 'dd.mm.yyyy',
        language: 'ru'
    })

});

function showDialog()
{
    $( "#dialog-message" ).dialog({
        modal: true,
        title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i>"+tt.orderLesson+"</h4></div>",
        title_html: true,
        buttons: [
            {
                html: "<i class='icon-exchange bigger-110'></i>&nbsp; Ok",
                class : "btn btn-info btn-mini",
                click: function() {

                }
            },{
                html: "<i class='icon-remove bigger-110'></i>&nbsp; "+tt.cancel,
                class : "btn btn-mini",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
        ]
    });
}

function parseFullDescription($el)
{
	var $parent = $el.parent();
	var content = $parent.data('content');
	var index   = $el.index()
	
	var parts = content.split('<br><br>');
	
	var html = parts[index];
	
	return html;
}
