$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#FilterForm_semester, #FilterForm_month').change(function(){

        var $form = $('#filter-form');

        $('#FilterForm_semester, #FilterForm_month').each(function(){
            var $that   = $(this);
            var $select = $that.clone();
            var value   = $that.val();

            if (value.length == 0)
                return;

            $select.find('option[value='+$that.val()+']').attr('selected', 'selected');

            $form.append($select);
        });

        $form.submit();
    });

    initTooltips();

    $('[name="show-percents"]').change(function(){
        $('.attendance-statistic-table-2 tr span').toggleClass('hide');
    });
});