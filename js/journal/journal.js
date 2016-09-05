$(document).ready(function(){

    initPopovers();

    $spinner1 = $('#spinner1');

    $('#journal-print,#journal-print-itog').click(function(){
        var action=$("#filter-form").attr("action");
        $("#filter-form").attr("action", $(this).data('url'));
        $("#filter-form").submit();
        $("#filter-form").attr("action", action);
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

    $('div .journal_div_table2 .module-ind').change(function(event ){

        var $that = $(this);
        var st1  = $that.parents('[data-st1]').data('st1');
        var gr1  = $that.parents('[data-gr1]').data('gr1');
        var vmpv1 = $that.data('vmpv1');

        var params = {
            nom  : $that.parent().data('nom'),
            nomModule  : $that.parent().data('nom-module'),
            elgz1   : $that.parent().data('elgz1'),
            r1   : $that.parent().data('r1'),
            st1   : st1,
            gr1   : gr1,
            date:$that.parent().data('date'),
            value : parseFloat( $that.val().replace(',','.') ),
            vmpv1:vmpv1
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

        var url = $that.parents('[data-url-module]').data('url-module');

        $spinner1.show();

        $.ajax({
            url: url,
            dataType: 'json',
            data:params,
            success: function( data ) {
                if (data.error) {
                    addGritter(title, tt.error, 'error')
                    $td.addClass('error');
                } else {
                    addGritter(title, tt.success, 'success')
                    $td.removeClass('error').addClass('success');
                    setTimeout(function() { $td.removeClass('success') }, 1000);


                    $('.module'+vmpv1+st1).addClass('updated');
                }
                $spinner1.hide();
            },
            error: function( data ) {
                addGritter(title, tt.error, 'error');
                $td.addClass('error');
                $spinner1.hide();
            }
        });

    });

    $('div .journal_div_table2 tr:not(.min-max) input:not(.module-ind)').keyup(function(event ){
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
                value :  ($that.data('name')=='elgzst4')?-2:0
            }

            var stName = $('table.journal_table_1 tr[data-st1='+st1+'] td:eq(1)').text();
            var index  = $that.parent().index();
            var nom   = $that.parents('table').find('th:eq('+index+')').html();
            var title  = stName+'<br>'+nom+'<br>';
            var $td    = $that.parent();

            var url = $that.parents('[data-url]').data('url');

            $spinner1.show();
            send(url,params,title,$td,$that,$spinner1,st1,ps84,ps88);
            $that.val('');
            $that.addClass('not-value');
            $td.find(':checkbox').attr('disabled','disabled');
        }

    })

    $('div .journal_div_table2 tr:not(.min-max) input:not(.module-ind)').change(function(event){
        var $that = $(this);

        var st1  = $that.parents('[data-st1]').data('st1');

        var typeLesson =$that.parents('[data-type-lesson]').data('type-lesson');

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
        if (params.field!='elgzst3'&&params.value==0&&!$that.is(':checkbox')&&ps55==0) {
            addGritter(title, tt.error, 'error')
            $td.addClass('error')
            return false;
        }

        if (params.field=='elgzst3'&&params.value==0&&ps88==0)
        {
            if($td.find('[data-name="elgzst4"]').val()!=''&&typeLesson==1) {
                addGritter(title, tt.error, 'error')
                $td.addClass('error')
                $that.removeAttr('checked');
                return false;
            }
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
        if (($that.is(':checkbox')&&params.value==1&&ps88==0)||($that.is(':checkbox')&&params.value==01&&ps88==1))
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
                                            send(url,params,title,$td,$that,$spinner1,st1,ps84,ps88);

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
                            send(url,params,title,$td,$that,$spinner1,st1,ps84,ps88);
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
            send(url,params,title,$td,$that,$spinner1,st1,ps84,ps88);
        }

    });

    $('.elgdst-input').change(function(event){
        var $that = $(this);

        var st1  = $that.parents('[data-st1]').data('st1');
        var elg1  = $that.parents('[data-elg1]').data('elg1');

        var params = {
            elg1 : elg1,
            field : $that.data('name'),
            gr1 : $that.data('gr1'),
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
                    recalculateBothTotal(st1,ps84);
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

    /*$(document).on('change', '#showRetake', function(){
        var $elem = $('[name="showRetake"]').clone();
        var $form   = $('#filter-form');
        $form.append($elem);
        $form.submit();
    });*/

    $(document).on('click', '.btn-retake', function(){

        var $that = $(this);

        var url = $that.parents('[data-url-retake]').data('url-retake');

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
                    $('.datepicker').datepicker({
                        format: 'dd.mm.yy',
                        formatView: 'dd.mm.yy',
                        language:'ru',
                        autoclose:true
                    });
                    if(data.show){
                        $('#save-retake').show();
                    }
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

    $(document).on('change','#Elgp_elgp2',function(){
        var val = $(this).val();
        if(val!=5)
            $('#elgp').hide();
        else
            $('#elgp').show();
    });

    $(document).on('click','#save-retake-journal',function(){

        var $that =$(this);

        var url = $that.parents('[data-url]').data('url');

        var st1  = $that.parents('[data-st1]').data('st1');

        var $td    = $that.parent();

        var elgp2,elgp3,elgp4,elgp5='';
        if($('form').is('#omissions-form'))
        {
            elgp2=$('#Elgp_elgp2').val();
            elgp3=$('#Elgp_elgp3').val();
            elgp4=$('#Elgp_elgp4').val();
            elgp5=$('#Elgp_elgp5').val();
        }

        var elgotr1=$('#Elgotr_elgotr1').val();
        var elgotr2=$('#Elgotr_elgotr2').val();
        var elgotr3=$('#Elgotr_elgotr3').val();
        var elgotr4=$('#Elgotr_elgotr4').val();

        var params = {
            elgp2 :elgp2,
            elgp3 :elgp3,
            elgp4 :elgp4,
            elgp5 :elgp5,
            elgotr1:elgotr1,
            elgotr2:elgotr2,
            elgotr3:elgotr3,
            elgotr4:elgotr4
        }

        title='';

        $.ajax({
            url: url,
            data:params,
            dataType: 'json',
            success: function( data ) {
                if (!data.error) {
                    addGritter(title, tt.success, 'success');
                    //$td.find('[data-name="elgzst5"]').val(elgotr2);
                    //recalculateBothTotal(st1,ps84);
                    $('#filter-form').submit();
                } else {
                    addGritter(title, tt.error, 'error');
                }
                $spinner1.hide();
                $('#modalRetake').modal('hide');
            },
            error: function( data ) {
                addGritter(title, tt.error, 'error');
                $spinner1.hide();
                $('#modalRetake').modal('hide');
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
            case 6:
                error = tt.timeAccess;
                break
            default:
                error = tt.error;
        }
        return error;
    }else {
        return tt.success;
    }
}

function send(url,params,title,$td,$that,$spinner1,st1,ps84,ps88)
{
    $.get(url, params, function(data){

        if (data.error) {
            addGritter(title, getError(data), 'error')
            $td.addClass('error');
        } else {
            addGritter(title, tt.success, 'success')
            $td.removeClass('error').addClass('success');
            setTimeout(function() { $td.removeClass('success') }, 1000);
            recalculateBothTotal(st1,ps84);

            $that.parents('tr').find('.module-tr ').addClass('updated');
        }

        $spinner1.hide();

        if(! $that.hasClass("elgdst-input"))
        {
            if ($that.is(':checkbox'))
            {
                var elem = $td.find('[data-name="elgzst5"]');
                if (($that.is(':checked')&&ps88==0)||(!$that.is(':checked')&&ps88==1)) {
                    $td.find('[data-name="elgzst4"]').attr('disabled', 'disabled');
                    //elem.removeAttr('disabled');
                }
                else
                {
                    $td.find('[data-name="elgzst4"]').removeAttr('disabled');
                    //elem.attr('disabled', 'disabled');
                    if(!elem.is(':checkbox'))
                        elem.val('');
                    else
                        elem.removeAttr('checked');
                }

                if(params.value==1) {
                    if(elem.is(':checkbox'))
                        elem.attr('disabled', 'disabled');
                    $that.attr('data-original-title', 'Присутсвует');
                }
                else {
                    if(elem.is(':checkbox'))
                        elem.removeAttr('disabled');
                    $that.attr('data-original-title', 'Отсутсвует');
                }
            }

            if ($that.is(':text'))
            {
                if($that.val()!=""&&parseFloat( $that.val().replace(',','.') )>=0)
                    $that.removeClass('not-value');
                else
                    $that.addClass('not-value');

                if($that.data('name')=='elgzst4')
                    if($that.val()!=""&&parseFloat( $that.val().replace(',','.') )>=0)
                        $td.find(':checkbox').attr('disabled','disabled');
                    else
                        $td.find(':checkbox').removeAttr('disabled');

                if($that.data('name')=='elgzst5')
                {
                    if(parseFloat( $that.val().replace(',','.') )>0)
                        $td.find('[data-name="elgzst4"]').attr('disabled','disabled');
                    else
                        $td.find('[data-name="elgzst4"]').removeAttr('disabled');
                }
            }

            var elem = $td.find('[data-name="elgzst5"]');
            if(elem.length>0){
                var elgzst3 = $td.find('[data-name="elgzst3"]');
                if(((elgzst3.is(':checked')&&ps88==0)||(!elgzst3.is(':checked')&&ps88==1))||(parseFloat($td.find('[data-name="elgzst4"]').val().replace(',','.'))<=minBal&&$td.data('type-lesson')==1)) {
                    if (parseFloat(elem.val().replace(',', '.')) > minBal) {
                        $td.find('.btn-retake').hide();
                        elem.attr('disabled', 'disabled');
                    }
                    else {
                        $td.find('.btn-retake').show();
                        elem.removeAttr('disabled');
                    }
                }
                else {
                    $td.find('.btn-retake').hide();
                    elem.attr('disabled', 'disabled');
                }
            }else{
                if((elgzst3.is(':checked')&&ps88==0)||(!elgzst3.is(':checked')&&ps88==1)) {
                    $td.find('.btn-retake').show();
                    elem.removeAttr('disabled');
                }
                else {
                    $td.find('.btn-retake').hide();
                    elem.attr('disabled', 'disabled');
                }
            }
        }
    }, 'json');
}

function recalculateBothTotal(st1,ps84)
{
    if(ps84!=1) {
        var total_1 = 0;
        var total_2 = 0;

        var table_2 = 'div.journal_div_table2 tr[data-st1=' + st1 + ']';
        var table_3 = 'div.journal_div_table3 tr[data-st1=' + st1 + ']';

        var totalCount = 0;
        $(table_2 + ' td').each(function () {

            var mark = calculateMarkFor(this);

            if (!isNaN(mark)) {
                total_1 += mark;
                totalCount++;
            }
        });

        var bal = 0;
        var sr = '';
        if (ps44 == 1) {
            bal = (total_1 / totalCount).toFixed(2);
            total_1 = Math.round(total_1 / totalCount * 12);
        }

        if (ps44 == 2) {
            bal = (total_1 / totalCount).toFixed(2);
            total_1 = Math.round(total_1 / totalCount);
        }

        $(table_3 + ' td').each(function () {

            var mark = calculateMarkFor(this);

            if (!isNaN(mark))
                total_2 += mark;
        });
        if (ps44 == 1) {
            sr = '(' + bal + ')'
        }
        if (ps44 == 2) {
            sr = '(' + bal + ')'
        }
        $(table_3 + ' td[data-total=1]').text(total_1 + sr);
        $(table_3 + ' td[data-total=2]').text(total_1 + total_2);
    }else
    {
        var stName = $('.journal_div_table3 tr[data-st1='+st1+'] td').addClass('updated');
    }

}

function calculateMarkFor(el)
{
    var $that = $(el);

    var mark;
    if ($that.children('input:text:not(.module-ind)').length > 1) {

        var $input_1 = $that.children('input:text:not(.module-ind):first');
        var $input_2 = $that.children('input:text:not(.module-ind):last');

        if ( parseFloat($input_2.val()) > 0 )
            mark = $input_2.val();
        else
            mark = $input_1.val();

    } else
        mark = $that.children('input:text:not(.module-ind)').val();

    return parseFloat(mark);
}

