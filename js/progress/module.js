$(document).ready(function(){

    initSpinner('spinner1');

    $spinner1 = $('#spinner1');

    // flag for reloading page
    var refreshPage = false;

    $(document).on('change', 'tr input', function(){

        var $that = $(this);
		var vmpv1	=$that.parents('[data-vmpv1]').data('vmpv1');
		var st1	=$that.parents('[data-st1]').data('st1');
        var params = {
            value : parseFloat( $that.val().replace(',','.') ),
            vmpv1 : vmpv1,
			st1:st1
        }

        var $td = $that.parent();

        if (isNaN(params.value)) {
            addGritter('', tt.error, 'error')
            $td.addClass('error')
            return false;
        }

        var url = $that.parents('[data-url]').data('url');

        $spinner1.show()

        $.get(url, params, function(data){

            if (data.error) {
                addGritter('', tt.error, 'error')
                $td.addClass('error');
            } else {
                addGritter('', tt.success, 'success')
                $td.removeClass('error').addClass('success');

                setTimeout(function() { $td.removeClass('success') }, 1000)

                refreshPage = true;
            }

            $spinner1.hide();
        }, 'json')
    });

    $('#close-module').click(function(){
        var url = $(this).data('url');
        $.get(url, {vvmp1: vvmp1}, function(data){
            if (data.res)
                $('#filter-form').submit();
        }, 'json')
    });

    $('.show-extended-module').click(function(){
        var url = $(this).parents('[data-extended_module_url]').data('extended_module_url');
        var params = {
            uo1:  uo1,
            gr1:  $('#FilterForm_group').val(),
            d1:   $('#FilterForm_discipline').val(),
            module_num: $(this).parent().data('module_num')
        }

        $.get(url, params, function(data){
            $('.journal-bottom').append(data);
            $('#modal-table').modal('show');
        })
    });

    $(document).on('hide', '#modal-table', function () {
        if (refreshPage)
            $('#filter-form').submit();
    });

    $(document).on('hidden', '#modal-table', function () {
        $(this).remove();
    });
});

