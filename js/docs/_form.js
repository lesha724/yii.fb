$(document).ready(function(){

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

    var amount = $('[name*="dkid2"]').length;
    $('#addNewExecutionDate').click(function(){
        $(this).before(
            '<input name="Dkid['+amount+'][dkid2]" class="datepicker input-medium" placeholder="Треб.дата"/> - <input name="Dkid['+amount+'][dkid3]" class="datepicker input-medium" placeholder="Факт.дата"/> <br/>'
        );
        amount++;
        return false;
    });
});