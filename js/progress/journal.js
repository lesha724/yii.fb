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

        var params = {
            field : $that.data('name'),
            date  : $that.parent().data('r2'),
            nr1   : nr1,
            st1   : $that.parents('[data-st1]').data('st1'),
            value : $that.is(':checkbox')
                        ? $that.is(':checked') ? 1 : 0
                        : parseFloat( $that.val().replace(',','.') )
        }

        if (isNaN(params.value)) {
            // TODO here
        }

        $.get(insertMarkUrl, params, function(data){
            console.log(1);
        })

    });
});

function initChosen()
{
    $('.chosen-select').chosen();
}
