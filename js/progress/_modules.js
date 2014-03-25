$(document).ready(function(){


    $('#modules').dataTable({
        iDisplayLength: 100,
        aaSorting: [],
        bPaginate: false,
        oLanguage: {
            sSearch: 'Поиск',
            oPaginate: {
                sNext: 'След',
                sPrevious: 'Пред'
            },
            sLengthMenu: '',//'Показать _MENU_ записей',
            sInfo: 'Общее кол-во записей _TOTAL_ отображено (_START_ - _END_)',
            sInfoEmpty: 'Ничего не найдено',
            sInfoFiltered: ' - отсортировано _MAX_ записей',
            sZeroRecords: 'Ничего не найдено'
        }
    });


    $('#id-date-range-picker-1').daterangepicker({
        format: 'DD/MM/YYYY',
        locale: {
            applyLabel: 'Ок',
            cancelLabel: 'Отмена',
            fromLabel: 'С',
            toLabel: 'По',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                'Июл','Авг','Сен','Окт','Ноя','Дек'],
            daysOfWeek: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            firstDay: 1
        }
    }, function(start, end) {
        $('[name=mej4]').val(start.format('YYYY-MM-DD'));
        $('[name=mej5]').val(end.format('YYYY-MM-DD'));
    });


    $('#addNewModule').click(function(){

        var $that = $(this);
        var url   = $that.closest('form').attr('action');

        params = {
            mej3: nr1,
            mej4: $('[name=mej4]').val(),
            mej5: $('[name=mej5]').val()
        };
        $.get(url, params, function(data){
            if (data.error)
                addGritter('', tt.moduleError, 'error')
            else {
                $("#modules-list").yiiGridView("update", {
                    data: $("#journal-form").serialize()
                });
                addGritter('', tt.moduleSuccess, 'success')
            }

        }, 'json')

    });

    $(document).on('click', '#modules-list .delete', function(){
        if (! confirm(tt.confirmDeleteMsg))
            return false;

        $.fn.yiiGridView.update('modules-list', {
            type: 'GET',
            url:  $(this).attr('href'),
            success:function(data) {
                $("#modules-list").yiiGridView("update", {
                    data: $("#journal-form").serialize()
                });
            }
        })
        return false;
    });

});