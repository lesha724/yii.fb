$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $(document).on('click', '.edit-theme', function(){

        var course = $('#FilterForm_year_of_admission option:selected').data('sem4');
        var url = $(this).attr('href')+'&sem4='+course;

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

    $(document).on('click', '.delete-theme', function(){
        if (! confirm(tt.confirmDeleteMsg))
            return false;

        var url = $(this).attr('href')

        $.getJSON(url, {}, function(data){
            if (data.deleted === true) {
                window.location.reload();
            } else {
                console.log(1);
            }

            $spinner1.hide();
        })

        return false;
    });

    initDataTable('themes');

    $(document).on('change', '#FilterForm_teacher', function(){
        $('#FilterForm_code').val(1);
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
                            'name' : $(this).attr('name')
                        })
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

    })

});