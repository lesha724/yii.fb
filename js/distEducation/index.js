$(document).ready(function(){

    $select = $('.chosen-chairId');

    $select.chosen();

    $select.on('change', function(evt, params) {
        $(this).closest('form').submit();
    });
});

$(document).on('click','.btn-add-link', function(e) {
    e.preventDefault();
    $('#myModal #modal-content').html('');
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function( data ) {
            if (!data.error) {
                $('#myModal .modal-header h4').html(data.title);
                $('#myModal #modal-content').html(data.html);

                $_select = $('#chosen-dispdist3');

                $_select.chosen();

                $('#myModal').modal('show');
            } else {
                addGritter(data.title, 'Ошибка', 'error');
            }
        },
        error: function( data ) {
            addGritter('', 'Ошибка', 'error');
        }
    });
});