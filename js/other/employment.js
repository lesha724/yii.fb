$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#FilterForm_category').change(function(){

        var $that   = $(this);
        var $select = $that.clone();
        var $form   = $('<form>', {'method':'post'});
        var value   = $that.val();

        if (value.length == 0)
            return;

        $select.find('option[value='+$that.val()+']').attr('selected', 'selected');

        $('body').append($form);

        $form.append($select);
        $form.submit();
    });

    if ($('#filter-form').length > 0) {
        var $select = $('#FilterForm_category').clone();
        $select.removeClass('chosen-select').addClass('hidden');
        $('#filter-form').append($select);
    }

    initDataTable('marks');
});