$(document).ready(function(){

    $('.form-settings input:checkbox,#ps-extra-columns input:checkbox, #ps-appearance input:checkbox, #ps-student-info input:checkbox, #ps-antiplagiat input:checkbox').change(function(){
        var $hidden = $(this).siblings(':hidden');
        $hidden.val(1 - $hidden.val());
    });

});