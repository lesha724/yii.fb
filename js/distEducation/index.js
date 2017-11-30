$(document).ready(function(){

    $spinner1 = $('#spinner1');

    $select = $('.chosen-chairId');

    $select.chosen();

    $select.on('change', function(evt, params) {
        $(this).closest('form').submit();
    });
});

$(document).on('click','.btn-add-link', function(e) {
    e.preventDefault();
    $spinner1.show();
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
            $spinner1.hide();
        },
        error: function(jqXHR, textStatus, errorThrown){
            if (jqXHR.status == 500) {
                addGritter('Ошибка', 'Internal error: ' + jqXHR.responseText, 'error')
            } else {
                if (jqXHR.status == 403) {
                    addGritter('Ошибка', 'Access error: ' + jqXHR.responseText, 'error')
                } else {
                    addGritter('Ошибка', 'Ошибка', 'error');
                }
            }

            $spinner1.hide();
        }
    });
});

$(document).on('click','#save-link', function(e) {
    e.preventDefault();

    var uo1 = $('#filed_uo1').val();
    if (isNaN(uo1)) {
        addGritter('Ошибка', 'Ошибка', 'error')
        return false;
    }
    var k1 = $('#filed_k1').val();
    if (isNaN(k1)) {
        addGritter('Ошибка', 'Ошибка', 'error')
        return false;
    }
    var id = $('#chosen-dispdist3').val();
    if ( !id) {
        addGritter('Ошибка', 'Выберите курс', 'error')
        return false;
    }

    var params = {
        uo1   : uo1,
        k1   : k1,
        id : id
    }

    var $modal = $('#myModal');
    $modal.modal('hide');
    var url = $modal.data('url');

    $spinner1.show();

    $.ajax({
        url: url,
        data:params,
        dataType: 'json',
        success: function( data ) {
            if (!data.error) {
                addGritter('Успешно', data.title, 'success');
                $.fn.yiiGridView.update('disp-list')
            } else {
                addGritter('Ошибка', data.message, 'error');
            }
            $spinner1.hide();
        },
        error: function(jqXHR, textStatus, errorThrown){
            if (jqXHR.status == 500) {
                addGritter('Ошибка', 'Internal error: ' + jqXHR.responseText, 'error')
            } else {
                if (jqXHR.status == 403) {
                    addGritter('Ошибка', 'Access error: ' + jqXHR.responseText, 'error')
                } else {
                    addGritter('Ошибка', 'Ошибка', 'error');
                }
            }

            $spinner1.hide();
        }
    });
});