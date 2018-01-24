$(document).ready(function(){

    $spinner1 = $('#spinner1');

    $select = $('.chosen-chairId');

    $select.chosen();

    $select.on('change', function(evt, params) {
        $(this).closest('form').submit();
    });

    initFilterForm($spinner1);
});

$(document).on('click','.btn-show-group', function(e) {
    e.preventDefault();
    $spinner1.show();
    $('#modalBlock #modal-content').html('');
    $('#modalBlock .modal-header h4').html();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function( data ) {
            $('#modalBlock .modal-header h4').html(data.title);
            $('#modalBlock #modal-content').html(data.html);
            $('#modalBlock').modal('show');

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

$(document).on('click','.btn-unsubscript-student, .btn-subscript-student', function(e) {
    e.preventDefault();
    $spinner1.show();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function( data ) {

            if(data.error){
                addGritter(data.title, data.html, 'error');
            }else{
                addGritter(data.title, data.html, 'success');
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

$(document).on('click','.btn-subscript-group,.btn-unsubscript-group', function(e) {
    e.preventDefault();
    $spinner1.show();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function( data ) {


            $select = $('.chosen-chairId');
            $select.closest('form').submit();
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