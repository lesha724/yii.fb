$(document).ready(function(){

    $('#docType').change(function(){
       $(this).closest('form').submit();
    });

    $(document).on('click', '.add-doc', function(){
        var url = $(this).data('href');
        window.location = url;
    });

    $(document).on('click', 'input.datepicker', function(event) {
        $(this).datepicker({
            format: 'dd.mm.yyyy',
            language: 'ru'
        }).on('changeDate', function(ev){

            if ($(ev.currentTarget).is('#Tddo_tddo4')){
                var post = {docType:docType, tddo4:ev.date.getTime()};
                $.getJSON(getTddoNextNumberUrl, post, function(data){
                    $('#Tddo_tddo7').val(data.res)
                    $('#Tddo_tddo3:hidden').val(data.res)
                })
            }

        }).focus();
    });

    initAutoSize();

    hideShowChosens($('input:radio:checked[name="Tddo[executorType]"]').val());
    $('input:radio[name="Tddo[executorType]"]').change(function(){
        hideShowChosens($(this).val());
    });

    $('#addNewExecutor').click(function(){

        var executorType = $('input:radio:checked[name="Tddo[executorType]"]');

        var className;
        var type = executorType.val();
        if (type == 1)
            className = 'teacher';
        else if (type == 2)
            className = 'index';
        else if (type == 3)
            className = 'chair';

        $(this).before(
            '<div>' +
            (type != 2 ? '<input class="'+className+'" type="checkbox" />':'') +
            '<input data-type="'+type+'" class="'+className+' autocomplete" placeholder="исполнитель" />' +
            '<input name="'+className+'s[]" type="hidden" /></div>'
        );

        initAutoComplete();
        return false;
    });

    initAutoComplete();

    var amount = $('[name*="dkid2"]').length;
    $('#addNewExecutionDate').click(function(){
        $(this).before(
            '<input name="Dkid['+amount+'][dkid2]" class="datepicker input-medium" placeholder="Треб.дата"/> - <input name="Dkid['+amount+'][dkid3]" class="datepicker input-medium" placeholder="Факт.дата"/> <br/>'
        );
        amount++;
        return false;
    });


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

