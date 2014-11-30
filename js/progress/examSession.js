$(document).ready(function(){

    $spinner1 = $('#spinner1');

    $(document).on('change', '#FilterForm_discipline', function() {
        $(this).closest('form').submit();
    });

    $(document).on('click', '.datepicker', function(event) {
        $(this).datepicker({
            format: 'dd.mm.yy',
            language: 'ru'
        })
        .on('changeDate', function(ev){
            $(this).datepicker('hide');
        })
        .focus();
    });

    $('.exam-session-div input, .exam-session-div select').change(function(){

        var $that = $(this);

        var st1    = $that.parents('[data-st1]').data('st1');
        var stus0  = $that.parents('[data-stus0]').data('stus0');
        var stusp5 = $that.parents('[data-stusp5]').data('stusp5');

        var sheet = {
            date  : $('#date').val(),
            number: $('#number').val()
        };

        var params = {
            field : $that.attr('name'),
            st1   : st1,
            stus0 : stus0,
            stusp5: stusp5,
            value : $that.is(':checkbox')
                        ? $that.is(':checked') ? -1 : 0
                        : $that.val()
        }

        var stName = $('table.exam-session-table-1 tr[data-st1='+st1+'] td:eq(1)').text();
        var index  = $that.parent().index();
        var column = $that.parents('table').find('tr:eq(1) th:eq('+index+')').html();
        var title  = stName+'<br>Колонка: '+column+'<br>';
        var $td    = $that.parent();

        var isMark = params.field == 'stus8' || params.field == 'stusp8';

        if (isMark && ! $that.is(':checkbox')) {

            if (isNaN(params.value)) {
                addGritter(title, tt.error, 'error')
                $td.addClass('error')
                return false;
            }

            if ( $that.attr('name') == 'stus8' ) {
                if ( params.value < 3 || params.value > 5 ) {
                    addGritter(title, tt.minMaxError2, 'error')
                    $td.addClass('error')
                    return false;
                }
            }

            if ( params.value < 0 || params.value > 5 ) {
                addGritter(title, tt.minMaxError1, 'error')
                $td.addClass('error')
                return false;
            }
        }

        var url = $that.parents('[data-url]').data('url');

        $spinner1.show();

        $.getJSON(url, params, function(data){

            if (data.error) {
                addGritter(title, tt.error, 'error')
                $td.addClass('error');
            } else {
                //addGritter(title, tt.success, 'success')
                $td.removeClass('error').addClass('success');

                var $tr = $that.parents('tr');

                if (isMark) {
                    $td.next().find('input').val(sheet.date).change();
                    $td.next().next().find('input').val(sheet.number).change();
                    $td.prev().find('select').val(0).change();
                }

                if ($that.is('select')) {
                    if ($that.val() <= -1)
                        $td.next().find('input').val('');

                    $td.next().next().find('input').val(sheet.date).change();
                    $td.next().next().next().find('input').val(sheet.number).change();
                }

                // пересдача
                var duplicate = isMark && params.stusp5 != undefined && params.value >= 3;
                if (duplicate) {
                    $tr.find('[name=stus8]').val(params.value).change();
                    $tr.find('[name=stus6]').val(sheet.date).change();
                    $tr.find('[name=stus7]').val(sheet.number).change();
                }

                setTimeout(function() { $td.removeClass('success') }, 1000);
            }

            $spinner1.hide();
        })
    });

    $('[name="stusp6"], [name="stusp7"]').change(function(){

        var $that  = $(this);
        var stusp5 = $that.parents('[data-stusp5]').data('stusp5');
        var $tr    = $that.parents('tr');

        var mark = $('[data-stusp5='+stusp5+'] [name=stusp8]').val();

        if (mark >= 3) {
            if ($that.attr('name') == 'stusp6')
                $tr.find('[name=stus6]').val($that.val()).change();
            if ($that.attr('name') == 'stusp7')
                $tr.find('[name=stus7]').val($that.val()).change();
        }
    })
});