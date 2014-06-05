$(document).ready(function(){

    $('#docType').change(function(){
       $(this).closest('form').submit();
    });

    $(document).on('click', '.add-doc', function(){
        var url = $(this).data('href');
        window.location = url;
    });

    $(document).on('click', '.print-doc', function(){
        var url = $(this).data('href');

        var $form = $('<form/>')
        $('#docs-list table thead input').each(function(i,el){
            $form.append(el);
        });
        url += '&'+$form.serialize();
        window.location = url;
    });

    initAutoComplete();

    $(document).on('click', '#docs-list .delete', function(){
        if (! confirm(tt.confirmDeleteMsg))
            return false;

        $.fn.yiiGridView.update('docs-list', {
            data: {},
            type: 'GET',
            url:  $(this).attr('href'),
            success:function(data) {
                $("#docs-list").yiiGridView("update", {
                    data: {'docType' : $('#docType').val()}
                });
            }
        });
        return false;
    });

    $(document).on('click', '#Tddo_tddo4, #Tddo_tddo9', function(event) {
        $(this).datepicker({
            format: 'dd.mm.yyyy',
            language: 'ru'
        }).focus();
    });

    initExecutorTypeFilter();
});

function hideShowChosens(val)
{
    if (val == '1') {
        $('.teacher').show()
        $('.chair').hide()
    } else {
        $('.teacher').hide()
        $('.chair').show()
    }
}

function initAutoComplete()
{
    $('.autocomplete').autocomplete({
        delay: 700,
        source: function( request, response ) {
            $input = $(this.element);
            $.ajax({
                url: "/docs/findExecutor?type="+$input.data('type')+"&query="+request.term,
                dataType: "json",
                success: function( data ) {
                    response( $.map( data, function( item ) {
                        return {
                            label: item.name,
                            value: item.name,
                            id: item.id
                        }
                    }));
                }
            });
        },
        select: function( event, ui ) {
            var id = ui.item.id;
            $(event.target).siblings('input:hidden').val(id);
            var name = $(event.target).data('type') == '1' ? 'ido5' : 'idok4';
            $(event.target).siblings('input:checkbox').attr('name', name+'['+id+']');
        },
        change: function( event, ui ) {
            if (! $(event.currentTarget).val()) {
                $(event.target).siblings('input:hidden').val('');
            }
        }
    });
}

function initExecutorTypeFilter()
{
    $('#docs-list [name="Tddo[executorType]"]').change(function(e){
        $(this).parent().siblings('input').data('type', $(this).val())
        e.stopPropagation();
    });
}
