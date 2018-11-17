$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    function updateList(){
        $.fn.yiiGridView.update('oprrez-list',{ data: $('#filter-form').serialize() });
    }

    $(document).on('submit', '#create-oprrez-form', function(){

        var data  = $(this).serialize();
        var url   = $(this).attr('action');
        var $that = $(this);

        $that.find('button').button('loading');

        $.ajax({
            type: 'POST',
            url:  url,
            data: data,
            success:function(data){
                if (data == 'ok') {
                    addGritter( 'Удачно', 'Сохранено', 'success')
                    updateList();
                } else
                    addGritter('Ошибка', '"Ошибка добавления', 'error');

                $that.find('button').button('reset');
            },
            error:function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 500) {
                    addGritter( 'Ошибка', 'Internal error: ' + jqXHR.responseText, 'error')
                } else {
                    if (jqXHR.status == 403) {
                        addGritter('Ошибка','Access error: ' + jqXHR.responseText, 'error')
                    } else {
                        addGritter('Ошибка','Unexpected error.', 'error')
                    }
                }
                $that.find('button').button('reset');
            },

            dataType:'html'
        });

        return false;
    })
});