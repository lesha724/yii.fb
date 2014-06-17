$(document).ready(function(){

    $(':checkbox').change(function(){
        var $hidden = $(this).siblings(':hidden');
        $hidden.val(1 - $hidden.val());
    })

    $('.save-form').click(function(){
        var $form = $('form');
        var ps26  = $form.serialize();

        $input = $('<input>', {
            type:  'hidden',
            name:  'menu',
            value: ps26
        })

        $form.append($input);
        $form.submit();
    })
});