$(document).ready(function(){

    initChosen();

    $(document).on('change', '#JournalForm_discipline', function() {
        var params = {
            type : $('#type').val(),
            discipline : $(this).val()
        }
        $.get(getGroupsUrl, params, function(data){
            $('[id*=JournalForm_group]').remove();
            $('#journal-form').append(data)
            initChosen();
        })
    });

    $(document).on('change', '#JournalForm_group', function() {
        $(this).closest('form').submit();
    });

    $('.journal_div_table2 table input').change(function(){

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
            $.gritter.add({
                title: title,
                text: tt.error,
                class_name: 'gritter-error'
            });
            $td.addClass('error')
            return false;
        }

        $.get(insertMarkUrl, params, function(data){
            if (data.error) {
                obj = {
                    title: title,
                    text: tt.error,
                    class_name: 'gritter-error'
                }
                $td.addClass('error');
            } else {
                obj = {
                    title: title,
                    text: tt.success,
                    class_name: 'gritter-success'
                }
                $td.removeClass('error')
                $.gritter.add(obj)
            }
        }, 'json')

    });
});

function initChosen()
{
    $('.chosen-select').chosen();
}
