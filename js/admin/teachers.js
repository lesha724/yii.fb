$(document).ready(function(){

    $select = $('.chosen-select');

    $select.chosen();

    $select.on('change', function(evt, params) {
        $('#teachers').yiiGridView('update', {
            data: {
                chairId: $(this).val()
            }
        });
    });
});