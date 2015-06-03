$(document).ready(function(){

    $spinner1 = $('#spinner1');

    $(document).on('change', '#filter-form select:not(:last)', function(){
        $spinner1.show();

        var $form  = $(this).closest('form');
        var formId = $form.attr('id');
        var url    = $form.attr('action');

        var $option = $('#FilterForm_nr1 option:selected');
        var post = {
            'FilterForm[chair]' : $option.data('k1'),
            'FilterForm[d1]'    : $option.data('d1'),
            'FilterForm[nr1]'   : $option.val()
        };

        $.get(url, post, function(data){

            var html = $('#'+formId, data).html();
            $('div', $form).replaceWith(html);
            initChosen();
            $spinner1.hide();
        })

    });

    $(document).on('change', '#filter-form select:last', function(){
        $spinner1.show();
        $(this).closest('form').submit();
    });

    initDataTable('gostems');

    $('#confirm-subscription').click(function(){
        var $form = $('#filter-form');
        var $input = $('<input>', {
            'type' : 'hidden',
            'name' : 'subscribe',
            'value' : '1'
        });
        $form.append($input)
        $form.submit();
    });

    $(document).on('click', '.delete-item', function(){
        if (! confirm(tt.confirmDeleteMsg))
            return false;

        var url = $(this).attr('href')

        $.getJSON(url, {}, function(data){
            if (data.deleted === true) {
                $('#filter-form').submit();
            } else {
                console.log(1);
            }

            $spinner1.hide();
        })

        return false;
    });
});