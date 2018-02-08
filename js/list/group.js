/**
 * Created by Neff on 02.12.2016.
 */
$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    initTooltips();

    $('#btn-print-excel').click(function(){
        var action=$("#filter-form").attr("action");
        $("#filter-form").attr("action", $(this).data('url'));
        $("#filter-form").submit();
        $("#filter-form").attr("action", action);
    });

    $(document).on('click','.btn-unsubscript-student, .btn-subscript-student', function(e) {
        e.preventDefault();
        $spinner1.show();
        var $that = $(this);
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            dataType: 'json',
            success: function( data ) {

                if(data.error){
                    addGritter(data.title, data.html, 'error');
                }else{
                    addGritter(data.title, data.html, 'success');


                    $that.parents('.action-td').find('.btn').show();

                    $that.hide();
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
});