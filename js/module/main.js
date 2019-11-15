$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#ModuleForm_countModules').change(function(){aw
        submitForm();
    });

    function submitForm() {
        var $that   = $('#ModuleForm_countModules');
        var $field = $that.clone();
        $field.hide();

        var $form   = $('#filter-form');

        $form.append($field);
        $form.submit();
    }

    $('.btn-select-module').click(function(e){
        e.preventDefault();
        var $tr = $(this).parents('tr');
        $('#ModuleForm_module').val($tr.data('id'));
        $('#filter-form').submit();
    });
});