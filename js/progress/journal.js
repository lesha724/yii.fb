$(document).ready(function(){

    initSpinner('spinner1');

    initPopovers();

    $spinner1 = $('#spinner1');

    $('div[class*=journal_div_table] tr:not(.min-max) input').change(function(){

        $that = $(this);

        var st1  = $that.parents('[data-st1]').data('st1');

        var params = {
            field : $that.data('name'),
            date  : $that.parent().data('r2'),
            nr1   : $that.parent().data('nr1'),
            st1   : st1,
            value : $that.is(':checkbox')
                        ? $that.is(':checked') ? 0 : 1
                        : parseFloat( $that.val().replace(',','.') )
        }

        var stName = $('table.journal_table_1 tr[data-st1='+st1+'] td:eq(1)').text();
        var index  = $that.parent().index();
        var date   = $that.parents('table').find('th:eq('+index+')').html();
        var title  = stName+'<br>'+date+'<br>';
        var $td    = $that.parent();

        if (isNaN(params.value)) {
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

        $spinner1.show();

        $.get(url, params, function(data){

            if (data.error) {
                addGritter(title, tt.error, 'error')
                $td.addClass('error');
            } else {
                addGritter(title, tt.success, 'success')
                $td.removeClass('error').addClass('success');

                setTimeout(function() { $td.removeClass('success') }, 1000)

                recalculateBothTotal(st1);
            }

            $spinner1.hide();
        }, 'json')
    });

    $('tr.min-max input').change(function(){

        var $that = $(this);

        var params = {
            value : parseFloat( $that.val().replace(',','.') ),
            field : $that.data('name'),
            mmbj1 : $that.data('mmbj1')
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

                recalculateValueFor(params.field);
            }

            $spinner1.hide();
        }, 'json')
    });

});


function recalculateBothTotal(st1)
{
    var total_1 = 0;
    var total_2 = 0;

    var table_2 = 'div.journal_div_table2 tr[data-st1='+st1+']';
    var table_3 = 'div.journal_div_table3 tr[data-st1='+st1+']';

    var submodules = [];
    if (ps20 == 1)
        var submodules = getSubmodulesIndexes();

    $(table_2 +' td').each(function(){

        var onlySubmodules = (ps20 == 1 && $.inArray($(this).index(), submodules) == -1);
        if (onlySubmodules)
            return;

        var mark = calculateMarkFor(this);

        if (! isNaN(mark))
            total_1 += mark;
    });

    $(table_3 +' td').each(function(){

        var mark = calculateMarkFor(this);

        if (! isNaN(mark))
            total_2 += mark;
    });

    if (ps20 == 1) {
        if (submodules.length > 0) {
            total_1 = (total_1/submodules.length).toFixed(1);
            if (typeof pbal[total_1] != "undefined"){
                total_1 = pbal[total_1]; // convert mark
            }
        }
    }

    $(table_3 +' td[data-total=1]').text(total_1);
    $(table_3 +' td[data-total=2]').text(total_1 + total_2);
}

function calculateMarkFor(el)
{
    var $that = $(el);

    var mark;
    if ($that.children('input:text').length > 1) {

        var $input_1 = $that.children('input:text:first');
        var $input_2 = $that.children('input:text:last');

        if ( parseFloat($input_2.val()) > 0 )
            mark = $input_2.val();
        else
            mark = $input_1.val();

    } else
        mark = $that.children('input:text').val();

    return parseFloat(mark);
}

function recalculateValueFor(name)
{
    var total = 0;

    var table_2 = 'div.journal_div_table2 tr.min-max';
    var table_3 = 'div.journal_div_table3 tr.min-max';

    $(table_2 +' input[data-name='+name+']').each(function(){

        var mark = parseFloat($(this).val());

        if (! isNaN(mark))
            total += mark;
    });

    $(table_3 +' th[data-total='+name+']').text(total);
}

function getSubmodulesIndexes()
{
    var submodules = [];
    $('.journal_div_table2 th[data-submodule]').each(function(){
        submodules.push($(this).index());
    });
    return submodules;
}
