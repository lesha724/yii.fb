$(document).ready(function(){

    $spinner1 = $('#spinner1');

    $(document).on('change', '#FilterForm_discipline', function() {
        var params = {
            type : $('#type').val(),
            discipline : $(this).val()
        }

        $spinner1.show();

        $.get(getGroupsUrl, params, function(data){
            $('[id*=FilterForm_group]').remove();
            $('#filter-form').append(data)
            initChosen();
            $spinner1.hide();
        })
    });

    $(document).on('change', '#FilterForm_group', function() {
        $(this).closest('form').submit();
    });

});