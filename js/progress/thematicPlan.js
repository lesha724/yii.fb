$(document).ready(function(){

    initSpinner('spinner1');

    $spinner1 = $('#spinner1');

    initChosen();

    initFilterForm($spinner1);

    $(document).on('click', '.edit-theme', function(){

        var url = $(this).attr('href');

        $.getJSON(url, {}, function(data){
            $('#themes').append(data.html);
            initChosen();
            $('div#Nr_nr6_chosen').attr('style', '');
            $('#modal-table').modal('show');
        })

        return false;
    })

    $(document).on('hidden', '#modal-table', function (){
        $(this).remove();
    });

    $(document).on('click', '#save-theme', function(){
        $('#theme-form').submit();
    });

    $(document).on('submit', '#theme-form', function(){

        var $form = $(this);
        var url   = $form.attr('action');

        $spinner1.show();

        $.getJSON(url, $form.serialize(), function(data){
            if (data.errors.length  === 0) {
                window.location = window.location.href+'?'+$('#filter-form').serialize();
                $('#modal-table').modal('hide');
            } else {
                var html = $('form > div', data.html);
                $('div', $form).replaceWith(html);
            }

            $spinner1.hide();
        });

        return false;
    });

    $(document).on('click', '.delete-theme', function(){
        if (! confirm(tt.confirmDeleteMsg))
            return false;

        var url = $(this).attr('href')

        $.getJSON(url, {}, function(data){
            if (data.deleted === true) {
                window.location.reload();
            } else {
                console.log(1);
            }

            $spinner1.hide();
        })

        return false;
    });

    initDataTable('themes');

    $(document).on('change', '#FilterForm_teacher', function(){
        $('#FilterForm_code').val(1);
    });
});