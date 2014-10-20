$(document).ready(function(){

    $('#department').change(function(){
        $(this).closest('form').submit();
    });

    initDataTable('phones');

});