$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#FilterForm_semester,#FilterForm_type_rating,#FilterForm_st_rating').change(function(){

        var $that   = $('#FilterForm_semester');
        var $select = $that.clone();
		var $checkbox=$('#FilterForm_type_rating').clone();
		$checkbox.hide();
		var $select2 = $('#FilterForm_st_rating').clone();
        var $form   = $('#filter-form');
        var value   = $that.val();

        if (value.length == 0)
            return;

        $select.find('option[value='+$that.val()+']').attr('selected', 'selected');
		$select2.find('option[value='+$('#FilterForm_st_rating').val()+']').attr('selected', 'selected');

        $form.append($select);
		$form.append($select2);
		$form.append($checkbox);
        $form.submit();
    });

    initDataTable('disciplines');
});