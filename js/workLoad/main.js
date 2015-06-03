$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#FilterForm_year').change(function(){

        var $that   = $(this);
        var $select = $that.clone();
        var $form   = $('#filter-form');
        var value   = $that.val();

        if (value.length == 0)
            return;

        $select.find('option[value='+$that.val()+']').attr('selected', 'selected');

        $form.append($select);

        $form.submit();
    });

    $('a[data-semester]').click(function(){

        var $form = $('#filter-form');

        if ($form.length == 0) {
            $form = $('<form>', {method:'post'});
            $('body').append($form);
        }

        var semester = $(this).data('semester');
        var $select  = $('#FilterForm_year').clone();

        var $input   = $('<input>', {
            type : 'hidden',
            name : 'FilterForm[semester]',
            value: semester
        });

        $form.append($select, $input);

        $form.submit();

        return false;
    });

    initDataTable('disciplines');

    initTooltips();

    $('#disciplines button').click(function(){

        var $that = $(this);
        var url   = $that.closest('table').data('getgroupurl');
		var nr = $that.data('type');
        var ids   = $that.siblings(':hidden').val();
        var year  = $('#FilterForm_year').val();
        var sem   = $('td.label-yellow a').data('semester');

        var obj = {
            ids: ids,
            year:year,
            sem: sem,
			nr: nr
        }

        $spinner1.show();

        $.getJSON(url, obj, function(data){
            $('#groups').html(data.html)
            $spinner1.hide();

            $('html, body').animate({
                scrollTop: $('#groups').offset().top
            }, 500);

        });

    });

    $('.submit-bottom').click(function(){
        var $form   = $('#filter-form');
        var $select = $('#FilterForm_year').clone();
        var $input  = $('#FilterForm_extendedForm').clone();

        $form.append($select, $input);

        $form.submit();
    });

    $('#FilterForm_extendedForm').change(function(){
        $(this).val( 1-$(this).val() );
    })

});