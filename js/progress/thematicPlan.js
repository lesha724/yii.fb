$(document).ready(function(){
    var add_rows=$('#themes tbody tr').length;
    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    function appendSelect()
    {
        var $select = $('#FilterForm_semester').clone();
        var $select2 = $('#FilterForm_discipline').clone();
        var $select3 = $('#FilterForm_type_lesson').clone();
        var $form   = $('#filter-form');

        $select.find('option[value='+$('#FilterForm_semester').val()+']').attr('selected', 'selected');
        $select2.find('option[value='+$('#FilterForm_discipline').val()+']').attr('selected', 'selected');
        $select3.find('option[value='+$('#FilterForm_type_lesson').val()+']').attr('selected', 'selected');

        $form.append($select);
        $form.append($select2);
        $form.append($select3);
    }

	initDataTable('themes');
	
        $('#themes').on('click','.delete-new-theme',function(e){
		var elem=$(this).parents('.new-theme');
		elem.remove();
		e.preventDefault();
	});
        
	$('#themes').on('click','.save-new-theme',function(e){
		var elem=$(this).parents('.new-theme');
		var us1	=$(this).parents('[data-us1]').data('us1');
		var url	=$(this).parents('[data-url]').data('url');
                var ustem3=elem.find(".ustem3").val();
                var ustem4=elem.find(".ustem4").val();
                var ustem5=elem.find(".ustem5").val();
                var ustem6=0;
                if (elem.find(".ustem6").is(':checked')) {
                    ustem6=1;
                }
                var params = {
                    us1 : us1,
                    ustem3 : ustem3,
                    ustem4 : ustem4,
                    ustem5 : ustem5,
                    ustem6 : ustem6,
                }
                
                if (isNaN(params.ustem3)||isNaN(params.ustem4)||params.ustem5=='') {
                    addGritter('', tt.error, 'error')
                    elem.addClass('error')
                    return false;
                }
                
                 $spinner1.show()

                $.get(url, params, function(data){

                    if (data.error) {
                        addGritter('', tt.error, 'error')
                        elem.addClass('error');
                    } else {
                        addGritter('', tt.success, 'success')
                        elem.removeClass('error').addClass('success');

                        setTimeout(function() { elem.removeClass('success') }, 3000);
                        type=type0;
                        if(params.ustem6==1)
                            type=type1;
                        elem.html('<td>'+params.ustem4+'</td>'+
                            '<td>'+params.ustem3+'</td>'+
                            '<td>'+params.ustem5+'</td>'+
                            '<td>'+type+'</td>'+
                            '<td>'+
                                '<a href="'+urlEdit+data.ustem1+'" class="edit-theme btn btn-mini btn-info">'+
                                    '<i class="icon-edit bigger-120"></i>'+
                                '</a>'+
                                '<a href="'+urlDelete+data.ustem1+'" class="delete-theme btn btn-mini btn-danger">'+
                                    '<i class="icon-trash bigger-120"></i>'+
                               ' </a>'+
                            '</td>');
                        refreshPage = true;
                    }

                    $spinner1.hide();
                }, 'json');
	});
	
	$('[name=delete-thematic-plan]').click(function(e){

        e.preventDefault();

        $( "#dialog-confirm" ).dialog({
            resizable: false,
            modal: true,
            title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i> Удалить тем. план?</h4></div>",
            title_html: true,
            buttons: [
                {
                    html: "<i class='icon-trash bigger-110'></i>&nbsp; Удалить",
                    "class" : "btn btn-danger btn-mini",
                    click: function() {
                        var $input = $('<input>', {
                            'type' : 'hidden',
                            'value': '1',
                            'name' : 'delete-thematic-plan'
                        })
                        appendSelect();
                        $('#filter-form').append($input);
                        $('#filter-form').submit();
                    }
                }
                ,
                {
                    html: "<i class='icon-remove bigger-110'></i>&nbsp; Отмена",
                    "class" : "btn btn-mini",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });

    });
	function getNew(number)
	{
            return '<tr class="new-theme">'+
                //'<td><input type="number" class="ustem4" value="'+(number)+'"></td>'+
                '<td><input type="number" class="ustem4"></td>'+
                '<td><input type="number" class="ustem3"></td>'+
                '<td><input type="text" class="ustem5"></td>'+
                '<td><input type="checkbox" class="ustem6">Субмодуль</td>'+
                '<td>'+
                '<a class="save-new-theme btn btn-mini btn-success"><i class="icon-ok bigger-120"></i></a>'+
                '<a class="delete-new-theme btn btn-mini btn-warning"><i class="icon-trash bigger-120"></i></a>'+
                '</td>'+
            '</tr>';
	}
	
	$('[name=add-thematic-plan]').click(function(e){

        e.preventDefault();
		$( "#dialog-confirm-add" ).dialog({
            resizable: false,
            modal: true,
            title: "<div class='widget-header'><h4 class='smaller'><i class='icon-question-sign green'></i> Добавить тем. план?</h4></div>",
            title_html: true,
            buttons: [
                {
                    html: "<i class='icon-plus bigger-110'></i>&nbsp; Добавить",
                    "class" : "btn btn-success btn-mini",
                    click: function() {
						var count=$('#count-rows').val();
						if(count!=""){
							$('#dialog-confirm-add .control-group').removeClass('error');
							$('#dialog-confirm-add .control-group .help-inline').hide();
							var i=1;
							for (i = 1; i <= count; i++) {
							  $('#themes tbody').append(getNew(add_rows+i));
							}
							add_rows=count;
							$( this ).dialog( "close" );
						}else
						{
							$('#dialog-confirm-add .control-group').addClass('error');
							$('#dialog-confirm-add .control-group .help-inline').show();
						}
                    }
                }
                ,
                {
                    html: "<i class='icon-remove bigger-110'></i>&nbsp; Отмена",
                    "class" : "btn btn-mini",
                    click: function() {
						$('#count-rows').val('');
						$('#dialog-confirm-add .control-group').removeClass('error');
						$('#dialog-confirm-add .control-group .help-inline').hide();
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });
    });
	
    $(document).on('click', '.delete-theme', function(){
        if (! confirm(tt.confirmDeleteMsg))
            return false;

        var url = $(this).attr('href')

        $.getJSON(url, {}, function(data){
            if (data.deleted === true) {
                window.location.reload();
            } else {
                console.log(1);
                addGritter('', 'error', 'error')
            }

            $spinner1.hide();
        })

        return false;
    });
	
    $(document).on('click', '.edit-theme', function(){
		var url = $(this).attr('href');
		
        $.getJSON(url, {}, function(data){
            $('#themes').append(data.html);
            initChosen();
            $('#theme-form').find('div.chosen-container').attr('style', 'min-width:220px');
            $('#modal-table').modal('show');
        })

        return false;
    })

    $(document).on('hidden', '#modal-table', function (){
        $(this).remove();
    });

    $(document).on('click', '#save-theme', function(){
        appendSelect();
        $('#theme-form').submit();
    });

    $(document).on('submit', '#theme-form', function(){

        var $form = $(this);
        var url   = $form.attr('action');

        $spinner1.show();

        $.getJSON(url, $form.serialize(), function(data){
            if (data.errors.length  === 0) {
                window.location = window.location.href+'?'+$('#filter-form').serialize();
                $('#modal-table').modal('hide');
            } else {
                var html = $('form > div', data.html);
                $('div', $form).replaceWith(html);
            }

            $spinner1.hide();
        });

        return false;
    });
});