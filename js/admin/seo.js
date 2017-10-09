$(document).ready(function(){

    $('.save-form').click(function(){
        var $form = $('form');
        var ps26  = $form.serialize();

        $input = $('<input>', {
            type:  'hidden',
            name:  'seo',
            value: ps26
        })

        $form.append($input);
        $form.submit();
    });

});