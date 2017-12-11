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
    $('#modalBlock #modal-content').html('');
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function( data ) {
            if (!data.error) {
                $('#modalBlock .modal-header h4').html(data.title);
                $('#modalBlock #modal-content').html(data.html);

                initDataTableOprions('courses-list',{
                    aaSorting: [],
                    "iDisplayLength": 50,
                    "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100,200, "Все"]],
                    bPaginate: true,
                    "bFilter": true,
                    oLanguage: {
                        sSearch: 'Поиск',
                        oPaginate: {
                            sNext: 'След',
                            sPrevious: 'Пред'
                        },
                        sLengthMenu: 'Показать _MENU_ записей',
                        sInfo: 'Общее кол-во записей _TOTAL_ отображено (_START_ - _END_)',
                        sInfoEmpty: 'Ничего не найдено',
                        sInfoFiltered: ' - отсортировано _MAX_ записей',
                        sZeroRecords: 'Ничего не найдено',
                        responsive: true,
                        columnDefs: [
                            { targets: [-1, -3], className: 'dt-body-right' }
                        ]
                    }
                });

                $('#modalBlock').modal('show');
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

$(document).on('click','.btn-remove-link', function(e) {
    e.preventDefault();
    $spinner1.show();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (data) {
            if (!data.error) {
                addGritter('Успешно', data.title, 'success');
                $.fn.yiiGridView.update('disp-list')
            } else {
                addGritter(data.title, 'Ошибка', 'error');
            }
            $spinner1.hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
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

$(document).on('click','.btn-save-link', function(e) {
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
    var id = $(this).data('id');
    if ( !id) {
        addGritter('Ошибка', 'Выберите курс', 'error')
        return false;
    }

    var params = {
        uo1   : uo1,
        k1   : k1,
        id : id
    }

    var $modal = $('#modalBlock');
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