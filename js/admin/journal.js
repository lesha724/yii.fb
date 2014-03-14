$(document).ready(function(){

    $('#ps-extra-columns input:checkbox').change(function(){
        var $hidden = $(this).siblings(':hidden');
        $hidden.val(1 - $hidden.val());
    });

});