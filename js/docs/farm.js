$(document).ready(function(){

    $('#docType').change(function(){
       $(this).closest('form').submit();
    });

});