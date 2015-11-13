/**
 * Created by Neff on 11.11.15.
 */

$(document).ready(function(){

    initSpinner('spinner1');

    $spinner1 = $('#spinner1');

    $(document).on('change', 'tr input', function(){

        var $that = $(this);

        var jpv1	=$that.parents('[data-jpv1]').data('jpv1');

        var st1	=$that.parents('[data-st1]').data('st1');

        var params = {
            value : parseFloat( $that.val().replace(',','.') ),
            jpv1 : jpv1,
            st1:st1
        }

        var $td = $that.parent();

        if (isNaN(params.value)) {
            addGritter('', tt.error, 'error')
            $td.addClass('error')
            return false;
        }

        var url = $that.parents('[data-url]').data('url');

        $spinner1.show()

        $.ajax({
            url: url,
            dataType: 'json',
            data: params,
            success: function(data){
                if (data.error) {
                    addGritter('', tt.error, 'error')
                    $td.addClass('error');
                } else {
                    addGritter('', tt.success, 'success')
                    $td.removeClass('error').addClass('success');

                    setTimeout(function() { $td.removeClass('success') }, 1000)
                }
                recalculateBothTotal(st1);
                $spinner1.hide();
            },
            error: function(jqXHR, textStatus, errorThrown){
                if (jqXHR.status == 500) {
                    addGritter('', 'Internal error: ' + jqXHR.responseText, 'error')
                } else {
                    if (jqXHR.status == 403) {
                        addGritter('', 'Access error: ' + jqXHR.responseText, 'error')
                    } else {
                        addGritter('', 'Unexpected error.', 'error')
                    }
                }
                $td.addClass('error');
                $spinner1.hide();
            }
        });
    });
});


function recalculateBothTotal(st1)
{
    var total_1 = 0;
    var total_2 = 0;
    var total_3 = 0;


    var table_2 = 'div.modules_div_table2 tr[data-st1='+st1+']';
    var table_3 = 'div.modules_div_table3 tr[data-st1='+st1+']';

    $(table_2 +' td').each(function(){

        var mark = calculateMarkFor(this);

        if (! isNaN(mark))
            total_1 += mark;
    });
    var mark =0;

    total_2 = total_1;
    var ind = $(table_3 +' td[data-total="-1"]');
    mark = calculateMarkFor(ind);
    if (! isNaN(mark))
        total_2 = total_1+mark;

    total_3 = total_2;
    var exam = $(table_3 +' td[data-total="-2"]');
    mark = calculateMarkFor(exam);
    if (! isNaN(mark))
        total_3 = total_2+mark;

    $(table_3 +' td[data-total=1]').text(total_1);
    $(table_3 +' td[data-total=2]').text(total_2);
    $(table_3 +' td[data-total=3]').text(total_3);
}

function calculateMarkFor(el)
{
    var $that = $(el);

    var mark = $that.children('input:text').val();

    return parseFloat(mark);
}
