$(document).ready(function(){

    $('#docType').change(function(){
       $(this).closest('form').submit();
    });

    $(document).on('click', '.add-doc', function(){
        var url = $(this).data('href');
        window.location = url;
    });
});