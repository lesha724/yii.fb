$(document).ready(function(){

    initChosen();

    initSpinner();

    $spinner = $('#spinner');

    $(document).on('change', '#JournalForm_discipline', function() {
        var params = {
            type : $('#type').val(),
            discipline : $(this).val()
        }

        $spinner.show();

        $.get(getGroupsUrl, params, function(data){
            $('[id*=JournalForm_group]').remove();
            $('#journal-form').append(data)
            initChosen();
            $spinner.hide();
        })
    });

    $(document).on('change', '#JournalForm_group', function() {
        $(this).closest('form').submit();
    });

    $('div[class*=journal_div_table] input').change(function(){

        $that = $(this);

        var st1  = $that.parents('[data-st1]').data('st1');

        var params = {
            field : $that.data('name'),
            date  : $that.parent().data('r2'),
            nr1   : nr1,
            st1   : st1,
            value : $that.is(':checkbox')
                        ? $that.is(':checked') ? 1 : 0
                        : parseFloat( $that.val().replace(',','.') )
        }

        var stName = $('table.journal_table_1 tr[data-st1='+st1+'] td:eq(1)').text();
        var index  = $that.parent().index();
        var date   = $that.parents('table').find('th:eq('+index+')').html();
        var title  = stName+'<br>' +date+'<br>';
        var $td    = $that.parent();

        if (isNaN(params.value)) {
            addGritter(title, tt.error, 'error')
            $td.addClass('error')
            return false;
        }

        var url = $that.parents('[data-url]').data('url');

        $spinner.show();

        $.get(url, params, function(data){

            if (data.error) {
                addGritter(title, tt.error, 'error')
                $td.addClass('error');
            } else {
                addGritter(title, tt.success, 'success')
                $td.removeClass('error');

                recalculateTotal(st1);
            }

            $spinner.hide();
        }, 'json')
    });

});


function recalculateTotal(st1)
{
    var total = 0;
    $('tr[data-st1='+st1+'] td').each(function(){
        var mark;
        if ($(this).children('input:text').length > 1) {

            var $input_1 = $(this).children('input:text:first');
            var $input_2 = $(this).children('input:text:last');

            if ( parseFloat($input_2.val()) > 0 )
                mark = $input_2.val();
            else
                mark = $input_1.val();

        } else
            mark = $(this).children('input:text').val();

        mark = parseFloat(mark);
        if (! isNaN(mark))
            total += mark;
    });

    $('.journal_div_table3 tr[data-st1='+st1+'] td:last').text(total);
}