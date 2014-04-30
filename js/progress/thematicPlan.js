$(document).ready(function(){

    initSpinner('spinner1');

    $spinner1 = $('#spinner1');

    initChosen();

    $(document).on('change', '#FilterForm_filial, #FilterForm_faculty, #FilterForm_speciality, #FilterForm_year_of_admission, #FilterForm_discipline', function(){

        $spinner1.show();

        var $form  = $(this).closest('form');
        var formId = $form.attr('id');
        var url    = $form.attr('action');

        $.get(url, $form.serialize(), function(data){

            var html = $('#'+formId, data).html();
            $('div', $form).replaceWith(html);
            initChosen();
            $spinner1.hide();
        })

    });

    $(document).on('change', '#FilterForm_semester', function() {
        $(this).closest('form').submit();
    });

    $(document).on('click', '.edit-theme', function(){

        var url = $(this).attr('href');

        $.getJSON(url, {}, function(data){
            $('#themes-list').append(data.html);
            $('#modal-table').modal('show');
        })

        return false;
    })

    $(document).on('hidden', '#modal-table', function () {
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
                $("#themes-list").yiiGridView("update", {
                    data: $("#filter-form").serialize()
                });
                $('#modal-table').modal('hide');
            } else {
                var html = $('form > div', data.html);
                $('div', $form).replaceWith(html);
            }

            $spinner1.hide();
        });

        return false;
    });

    $(document).on('click', '#themes-list .delete', function(){
        if (! confirm(tt.confirmDeleteMsg))
            return false;

        var url = $(this).attr('href')

        $.getJSON(url, {}, function(data){
            if (data.deleted === true) {
                $("#themes-list").yiiGridView("update", {
                    data: $("#filter-form").serialize()
                });
            } else {
                console.log(1);
            }

            $spinner1.hide();
        })

        return false;
    });
});