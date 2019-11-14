$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#ModuleForm_countModules').change(function(){
        alert(1);
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
});