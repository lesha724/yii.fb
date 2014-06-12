$(document).ready(function(){

    $('#ps-extra-columns input:checkbox, #ps-appearance input:checkbox').change(function(){
        var $hidden = $(this).siblings(':hidden');
        $hidden.val(1 - $hidden.val());
    });


    $(document).on('click', '#settings_23, #settings_24', function(event) {
        $(this).datepicker({
            format: 'dd.mm.yyyy',
            language: 'ru'
        }).focus();
    });

});