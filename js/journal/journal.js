$(document).ready(function(){

    initPopovers();

    $spinner1 = $('#spinner1');
    
    $('#journal-print').click(function(){
        $("#filter-form").attr("action", $(this).data('url'));
        $("#filter-form").submit();
    });

    $('tr.min-max input').keyup(function(event ){
        if(event.keyCode == 46)
        {
            var $that = $(this);

            var params = {
                value : 0,
                field : $that.data('name'),
                elgz1 : $that.data('elgz1')
            }

            var $td = $that.parent();

            if (isNaN(params.value)) {
                addGritter('', tt.error, 'error')
                $td.addClass('error')
                return false;
            }

            var url = $that.parents('[data-url]').data('url');

            $spinner1.show()

            $.get(url, params, function(data){

                if (data.error) {
                    addGritter('', tt.error, 'error')
                    $td.addClass('error');
                } else {
                    addGritter('', tt.success, 'success')
                    $td.removeClass('error').addClass('success');

                    setTimeout(function() { $td.removeClass('success') }, 1000)
                }

                $spinner1.hide();
            }, 'json')

            $that.val('');
        }

    })

    $('tr.min-max input').change(function(){

        var $that = $(this);

        var params = {
            value : parseFloat( $that.val().replace(',','.') ),
            field : $that.data('name'),
            elgz1 : $that.data('elgz1')
        }

        var $td = $that.parent();

        if (isNaN(params.value)&&(params.value<=0)) {
            addGritter('', tt.error, 'error')
            $td.addClass('error')
            return false;
        }

        var url = $that.parents('[data-url]').data('url');

        $spinner1.show()

        $.get(url, params, function(data){

            if (data.error) {
                addGritter('', tt.error, 'error')
                $td.addClass('error');
            } else {
                addGritter('', tt.success, 'success')
                $td.removeClass('error').addClass('success');

                setTimeout(function() { $td.removeClass('success') }, 1000)
            }

            $spinner1.hide();
        }, 'json')
    });

    $('div .journal_div_table2 tr:not(.min-max) input').keyup(function(event ){
        if(event.keyCode == 46)
        {
            var $that = $(this);

            var st1  = $that.parents('[data-st1]').data('st1');

            var gr1  = $that.parents('[data-gr1]').data('gr1');

            var params = {
                field : $that.data('name'),
                nom  : $that.parent().data('nom'),
                elgz1   : $that.parent().data('elgz1'),
                type_lesson   : $that.parent().data('type_lesson'),
                r1   : $that.parent().data('r1'),
                st1   : st1,
                gr1   : gr1,
                date:$that.parent().data('date'),
                value : '0'
            }

            var stName = $('table.journal_table_1 tr[data-st1='+st1+'] td:eq(1)').text();
            var index  = $that.parent().index();
            var nom   = $that.parents('table').find('th:eq('+index+')').html();
            var title  = stName+'<br>'+nom+'<br>';
            var $td    = $that.parent();

            var url = $that.parents('[data-url]').data('url');

            $spinner1.show();
            send(url,params,title,$td,$that,$spinner1,st1);
            $that.val('');
            $that.addClass('not-value');
            $td.find(':checkbox').attr('disabled','disabled');
        }

    })

    $('div .journal_div_table2 tr:not(.min-max) input').change(function(event){
        var $that = $(this);

        var st1  = $that.parents('[data-st1]').data('st1');

        var gr1  = $that.parents('[data-gr1]').data('gr1');

        var params = {
            field : $that.data('name'),
            nom  : $that.parent().data('nom'),
            elgz1   : $that.parent().data('elgz1'),
            type_lesson   : $that.parent().data('type_lesson'),
            r1   : $that.parent().data('r1'),
            st1   : st1,
            gr1   : gr1,
            date:$that.parent().data('date'),
            value : $that.is(':checkbox')
                ? $that.is(':checked') ? 0 : 1
                : parseFloat( $that.val().replace(',','.') )
        }

        var stName = $('table.journal_table_1 tr[data-st1='+st1+'] td:eq(1)').text();
        var index  = $that.parent().index();
        var nom   = $that.parents('table').find('th:eq('+index+')').html();
        var title  = stName+'<br>'+nom+'<br>';
        var $td    = $that.parent();
        if (isNaN(params.value)||(params.value<0)) {
            addGritter(title, tt.error, 'error')
            $td.addClass('error')
            return false;
        }
        if (params.field!='elgzst3'&&params.value==0) {
            addGritter(title, tt.error, 'error')
            $td.addClass('error')
            return false;
        }

        // min max check
        // ps9 - portal settings
        if (ps9 == '1' && $that.parents('.journal_div_table2').length > 0) {

            var $tr  = $that.closest('table').find('.min-max');
            var $th1 = $tr.find('th:eq('+(index*2)+')');
            var $th2 = $th1.next();

            var min = parseFloat( $th1.find('input').val() );
            var max = parseFloat( $th2.find('input').val() );

            if (! $that.is(':checkbox'))
                if ( params.value < min || params.value > max ) {
                    addGritter(title, tt.minMaxError, 'error')
                    $td.addClass('error')
                    return false;
                }
        }

        var url = $that.parents('[data-url]').data('url');
        var url_check = $that.parents('[data-url-check]').data('url-check');

        $spinner1.show();
        if ($that.is(':checkbox')&&params.value==1)
        {
            $.ajax({
                url: url_check,
                dataType: 'json',
                data:params,
                success: function( data ) {
                    if (data.error) {
                        addGritter(title, tt.error, 'error')
                        $td.addClass('error');
                        $enable=false;
                    } else {
                        if(data.count)
                        {
                            $( "#dialog-confirm" ).dialog({
                                resizable: false,
                                modal: true,
                                title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i>Удаление</h4></div>",
                                title_html: true,
                                buttons: [
                                    {
                                        html: "<i class='icon-trash bigger-110'></i>&nbsp; Удалить",
                                        "class" : "btn btn-danger btn-mini",
                                        click: function() {
                                            $( this ).dialog( "close" );
                                            send(url,params,title,$td,$that,$spinner1,st1);

                                        }
                                    }
                                    ,
                                    {
                                        html: "<i class='icon-remove bigger-110'></i>&nbsp; Отмена",
                                        "class" : "btn btn-mini",
                                        click: function() {
                                            $( this ).dialog( "close" );
                                            $spinner1.hide();
                                            $that.prop( 'checked', true );
                                        }
                                    }
                                ]
                            });
                        }else
                        {
                            send(url,params,title,$td,$that,$spinner1,st1);
                        }

                    }
                },
                error: function( data ) {
                    addGritter(title, tt.error, 'error');
                    $td.addClass('error');
                }
            });
        }
        else
        {
            send(url,params,title,$td,$that,$spinner1,st1);
        }

    });

    $('.elgdst-input').change(function(event){
        var $that = $(this);

        var st1  = $that.parents('[data-st1]').data('st1');
        var elg1  = $that.parents('[data-elg1]').data('elg1');

        var params = {
            elg1 : elg1,
            field : $that.data('name'),
            st1   : st1,
            value : parseFloat( $that.val().replace(',','.') )
        }

        var stName = $('table.journal_table_1 tr[data-st1='+st1+'] td:eq(1)').text();
        var index  = $that.parent().index();
        var nom   = $that.parents('table').find('th:eq('+index+')').html();
        var title  = stName+'<br>'+nom+'<br>';
        //var title  = stName;
        var $td    = $that.parent();
        if (isNaN(params.value)||(params.value<0)) {
            addGritter(title, tt.error, 'error')
            $td.addClass('error')
            return false;
        }

        var url = $that.parents('[data-url]').data('url');

        $spinner1.show();

        $.ajax({
            url: url,
            data:params,
            dataType: 'json',
            success: function( data ) {
                if (!data.error) {
                    addGritter(title, tt.success, 'success');
                } else {
                    addGritter(title, tt.error, 'error');
                }
                $spinner1.hide();
            },
            error: function( data ) {
                addGritter('', tt.error, 'error');
                $spinner1.hide();
            }
        });

    });

    $(document).on('change', '#showRetake', function(){
        var $elem = $('[name="showRetake"]').clone();
        var $form   = $('#filter-form');
        $form.append($elem);
        $form.submit();
    });

    $(document).on('click', '.btn-retake', function(){

        var $that = $(this);

        var url = $that.parents('[data-url-retake]').data('url');

        var st1  = $that.parents('[data-st1]').data('st1');

        var gr1  = $that.parents('[data-gr1]').data('gr1');

        var params = {
            field : $that.data('name'),
            nom  : $that.parent().data('nom'),
            elgz1   : $that.parent().data('elgz1'),
            type_lesson   : $that.parent().data('type_lesson'),
            r1   : $that.parent().data('r1'),
            st1   : st1,
            gr1   : gr1,
            date:$that.parent().data('date')
        }

        $spinner1.show();

        $.ajax({
            url: url,
            data:params,
            dataType: 'json',
            success: function( data ) {
                if (!data.error) {
                    $('#modalRetake .modal-header h4').html(data.title);
                    $('#modalRetake #modal-content').html(data.html);
                    if(data.show){
                        $('#save-retake').show();
                    }
                    $('.datepicker').datepicker({
                        format: 'dd.mm.yy',
                        language:'ru'
                    });
                    $('#modalRetake').modal('show');
                } else {
                    addGritter(data.html, tt.error, 'error');
                }
                $spinner1.hide();
            },
            error: function( data ) {
                addGritter('', tt.error, 'error');
                $spinner1.hide();
            }
        });
    });



});


function getError(data)
{
    if (data.error) {
        var error='';
        switch (data.errorType) {
            case 0:
                error = tt.error;
                break
            case 2:
                error = tt.error2;
                break
            case 3:
                error = tt.access;
                break
            case 4:
                error = tt.minMaxError;
                break
            case 5:
                error = tt.st;
                break
            default:
                error = tt.error;
        }
        return error;
    }else {
        return tt.success;
    }
}

function send(url,params,title,$td,$that,$spinner1,st1)
{
    $.get(url, params, function(data){

        if (data.error) {
            addGritter(title, getError(data), 'error')
            $td.addClass('error');
        } else {
            addGritter(title, tt.success, 'success')
            $td.removeClass('error').addClass('success');
            setTimeout(function() { $td.removeClass('success') }, 1000)
        }

        $spinner1.hide();

        if(! $that.hasClass("elgdst-input"))
        {
            if ($that.is(':checkbox'))
            {
                if ($that.is(':checked'))
                    $td.find('[data-name="elgzst4"]').attr('disabled','disabled');
                else
                {
                    $td.find('[data-name="elgzst4"]').removeAttr('disabled');
                    $td.find('[data-name="elgzst5"]').val('');
                }
                if(params.value==1)
                    $that.attr('data-original-title','Присутсвует');
                else
                    $that.attr('data-original-title','Отсутсвует');
            }

            if ($that.is(':text'))
            {
                if(parseFloat( $that.val().replace(',','.') )>0)
                    $that.removeClass('not-value');
                else
                    $that.addClass('not-value');

                if($that.data('name')=='elgzst4')
                    if(parseFloat( $that.val().replace(',','.') )>0)
                        $td.find(':checkbox').attr('disabled','disabled');
                    else
                        $td.find(':checkbox').removeAttr('disabled');
            }

            if($td.find('[data-name="elgzst3"]').is(':checked')||parseFloat($td.find('[data-name="elgzst4"]').val().replace(',','.'))<=min)
                $td.find('.btn-retake').show();
            else
                $td.find('.btn-retake').hide();
        }
    }, 'json');
}
