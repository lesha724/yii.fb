$(document).ready(function(){

    $('div.cell > div').click(function(){

        var $that   = $(this);
        var params  = $that.find('span.hidden').text();
        var $popup  = $('#dialog-message');
        var $info   = $popup.find('#info');
        var $form   = $popup.find('form');
        var $hidden = $('<input>', {name:'params', type:'hidden', value: params});

        $('.orderLesson').removeClass('orderLesson');
        $that.addClass('orderLesson');

        $info.attr('style', $that.attr('style'));

        var html = parseFullDescription($that);
        $info.html(html);

        $form.find('[name=params]').remove();
        $form.append($hidden);
    });

    $(document).keypress(function(event){
        event = (event) ? event : window.event;
        if(event.keyCode == 46 && $('.orderLesson').length > 0)
            showDialog()
    });

    $('#ZPZ_zpz6').datepicker({
        format: 'dd.mm.yyyy',
        language: 'ru'
    });

    $('#ZPZ_zpz6, #ZPZ_zpz7').change(function(){

        var zpz6   = $('#ZPZ_zpz6').val();
        var zpz7   = $('#ZPZ_zpz7').val();
        var filial = $('#TimeTableForm_filial').val();
        var $zpz8  = $('#ZPZ_zpz8');

        var url = $('form[data-freeroomsurl]').data('freeroomsurl');

        var post = {
            zpz6   : zpz6,
            zpz7   : zpz7,
            filial : filial
        }

        $.getJSON(url, post, function(data){
            $zpz8.replaceWith(data.html);
        });
    });
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
                    sendRequest($(this));
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

function sendRequest($dialog)
{
    var $form = $dialog.find('form');
    var url   = $form.attr('action');
    var post  = $form.serialize();

    $.post(url, post, function(data){
        if (data.res) {
            alert(tt.successful)
        } else {
            alert(tt.error)
        }
    }, 'json');
}