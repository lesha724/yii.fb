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

    $('input[name=stus3], input[name=stusp3]').change(function(){

        var $that = $(this);

        var st1    = $that.parents('[data-st1]').data('st1');
        var stus0  = $that.parents('[data-stus0]').data('stus0');
        var stusp5 = $that.parents('[data-stusp5]').data('stusp5');
        var k1     = $that.parents('[data-k1]').data('k1');
        var cxmb0  = $that.parents('[data-cxmb0]').data('cxmb0');

        var sheet = {
            date  : $('#date').val(),
            number: $('#number').val()
        };

        var params = {
            field : $that.attr('name'),
            st1   : st1,
            stus0 : stus0,
            stusp5: stusp5,
            k1    : k1,
            cxmb0 : cxmb0,
            value : $that.is(':checkbox')
                        ? $that.is(':checked') ? -1 : 0
                        : $that.val(),
            stus6 : sheet.date,
            stus7 : sheet.number
        }

        var stName = $('table.exam-session-table-1 tr[data-st1='+st1+'] td:eq(1)').text();
        var index  = $that.parent().index();
        var column = $that.parents('table').find('tr:eq(1) th:eq('+index+')').html();
        var title  = stName+'<br>Колонка: '+column+'<br>';
        var $td    = $that.parent();


        if (! $that.is(':checkbox')) {

            if (isNaN(params.value)) {
                addGritter(title, tt.error, 'error')
                $td.addClass('error')
                return false;
            }

            if ( params.value > 100 ) {
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

                $td.next().find('input').val(sheet.date);
                $td.next().next().find('input').val(sheet.number);
                $td.prev().find('select').val(0);

                // пересдача
                var duplicate = params.stusp5 != undefined && params.value >= 0;
                if (duplicate) {
                    $tr.find('[name=stus3]').val(params.value).change();
                    $tr.find('[name=stus6]').val(sheet.date).change();
                    $tr.find('[name=stus7]').val(sheet.number).change();
                }

                setTimeout(function() {
                    $td.removeClass('success') }, 1000);
            }

            $spinner1.hide();
        })
    });

    $('.exam-session-div select').change(function(){

        var $that = $(this);

        var st1    = $that.parents('[data-st1]').data('st1');
        var stus0  = $that.parents('[data-stus0]').data('stus0');
        var stusp5 = $that.parents('[data-stusp5]').data('stusp5');
        var k1     = $that.parents('[data-k1]').data('k1');
        var cxmb0  = $that.parents('[data-cxmb0]').data('cxmb0');

        var sheet = {
            date  : $('#date').val(),
            number: $('#number').val()
        };

        var params = {
            field : $that.attr('name'),
            st1   : st1,
            stus0 : stus0,
            stusp5: stusp5,
            k1    : k1,
            value : $that.val(),
            stus6 : sheet.date,
            stus7 : sheet.number,
            cxmb0 : cxmb0
        }

        var stName = $('table.exam-session-table-1 tr[data-st1='+st1+'] td:eq(1)').text();
        var index  = $that.parent().index();
        var column = $that.parents('table').find('tr:eq(1) th:eq('+index+')').html();
        var title  = stName+'<br>Колонка: '+column+'<br>';
        var $td    = $that.parent();

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

                //if ($that.val() <= -1)
                   $td.next().find('input').val('');

                $td.next().next().find('input').val(sheet.date);
                $td.next().next().next().find('input').val(sheet.number);

                setTimeout(function() { $td.removeClass('success') }, 1000);
            }

            $spinner1.hide();
        })
    });

    $('input[name=stus6], input[name=stus7], input[name=stusp6], input[name=stusp7]').change(function(){

        var $that = $(this);

        var st1    = $that.parents('[data-st1]').data('st1');
        var stus0  = $that.parents('[data-stus0]').data('stus0');
        var stusp5 = $that.parents('[data-stusp5]').data('stusp5');
        var k1     = $that.parents('[data-k1]').data('k1');

        var stName = $('table.exam-session-table-1 tr[data-st1='+st1+'] td:eq(1)').text();
        var index  = $that.parent().index();
        var column = $that.parents('table').find('tr:eq(1) th:eq('+index+')').html();
        var title  = stName+'<br>Колонка: '+column+'<br>';
        var $td    = $that.parent();

        var params = {
            field : $that.attr('name'),
            st1   : st1,
            stus0 : stus0,
            stusp5: stusp5,
            k1    : k1,
            value : $that.val(),
            stus6 : $that.is('[name=stus6]') ? $that.val() : $td.next().find('input').val(),
            stus7 : $that.is('[name=stus7]') ? $that.val() : $td.prev().find('input').val()
        }

        if ($that.is('[name=stus6]') || $that.is('[name=stusp6]')) {
            params.stus6 = $that.val();
            params.stus7 = $td.next().find('input').val();
        }
        if ($that.is('[name=stus7]') || $that.is('[name=stusp7]')) {
            params.stus6 = $td.prev().find('input').val();
            params.stus7 = $that.val();
        }


        $spinner1.show();

        var url = $that.parents('[data-url]').data('url');

        $.getJSON(url, params, function(data){

            if (data.error) {
                addGritter(title, tt.error, 'error')
                $td.addClass('error');
            } else {
                //addGritter(title, tt.success, 'success')
                $td.removeClass('error').addClass('success');

                var $tr = $that.parents('tr');

                var mark = $('[data-stusp5='+stusp5+'] input[name=stusp3]').val();

                if ($that.is('[name=stusp6]') || $that.is('[name=stusp7]')) {
                    if (mark >= 0) {
                        if ($that.attr('name') == 'stusp6')
                            $tr.find('[name=stus6]').val($that.val()).change();
                        if ($that.attr('name') == 'stusp7')
                            $tr.find('[name=stus7]').val($that.val()).change();
                    }
                }

                setTimeout(function() { $td.removeClass('success') }, 1000);
            }
            $spinner1.hide();
        })
    });

});