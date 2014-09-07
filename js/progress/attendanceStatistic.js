$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#FilterForm_semester, #FilterForm_month').change(function(){

        var $form = $('#filter-form');

        var selects = [];
        selects.push($('#FilterForm_semester'));
        if ($(this).is('#FilterForm_month'))
            selects.push($(this));

        for (var i in selects) {
            var $that   = selects[i];
            var $select = $that.clone();
            var value   = $that.val();

            if (value.length == 0)
                continue;

            $select.find('option[value='+$that.val()+']').attr('selected', 'selected');

            $form.append($select);
        }

        $form.submit();
    });

    initTooltips();

    $('[name="show-percents"]').change(function(){
        $('.attendance-statistic-table-2 tr span').toggleClass('hide');
    });
});