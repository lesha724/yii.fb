$(document).ready(function(){

    $('#docType').change(function(){
       $(this).closest('form').submit();
    });

    $(document).on('click', '#Tddo_tddo4, #Tddo_tddo9', function(event) {
        $(this).datepicker({
            format: 'dd.mm.yyyy',
            language: 'ru'
        }).focus();
    });
});
