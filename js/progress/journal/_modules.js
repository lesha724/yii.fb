$(document).ready(function(){

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

    initSpinner('spinner2');

    $spinner2 = $('#spinner2');

    $('#addNewModule').click(function(){

        if ( $('#modules-list table tbody tr').length >= 5 ) {
            addGritter('', tt.moduleRestriction, 'error');
            return;
        }

        var $that = $(this);
        var url   = $that.closest('form').attr('action');

        params = {
            mej3 : $('[name=mej3]').val(),
            mej4 : $('[name=mej4]').val(),
            mej5 : $('[name=mej5]').val(),
            vvmp1: vvmp1
        };

        $spinner2.show();

        $.get(url, params, function(data){

            $spinner2.hide();

            if (data.error)
                addGritter('', tt.moduleError, 'error')
            else {
                $("#modules-list").yiiGridView("update", {
                    data: $("#filter-form").serialize()
                });
                addGritter('', tt.moduleSuccess, 'success')
            }

        }, 'json')

    });

    $(document).on('click', '#modules-list .delete', function(){
        if (! confirm(tt.confirmDeleteMsg))
            return false;

        params = {
            nr1 : $('[name=mej3]').val(),
            vvmp1: vvmp1
        };

        $spinner2.show();

        $.fn.yiiGridView.update('modules-list', {
            data: params,
            type: 'GET',
            url:  $(this).attr('href'),
            success:function(data) {

                $spinner2.hide();

                $("#modules-list").yiiGridView("update", {
                    data: $("#filter-form").serialize()
                });
                addGritter('', tt.moduleDeleted, 'success')
            }
        })
        return false;
    });

});