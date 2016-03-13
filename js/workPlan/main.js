$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#FilterForm_semester').change(function(){

        var $that   = $(this);
        var $select = $that.clone();
        var $form   = $('#filter-form');
        var value   = $that.val();

        if (value.length == 0)
            return;

        $select.find('option[value='+$that.val()+']').attr('selected', 'selected');

        $form.append($select);

        $form.submit();
    });

    initDataTable('disciplines');

    initTooltips();
});