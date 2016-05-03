$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#FilterForm_sel_1,#FilterForm_sel_2 ,#FilterForm_type_rating,#FilterForm_st_rating').change(function(){

        var $that   = $('#FilterForm_sel_1');
        var $select = $that.clone();
        var value   = $that.val();

        var $that1   = $('#FilterForm_sel_2');
        var $select1 = $that1.clone();
        var value1   = $that1.val();

		var $checkbox=$('#FilterForm_type_rating').clone();
		$checkbox.hide();

		var $select2 = $('#FilterForm_st_rating').clone();
        var $form   = $('#filter-form');

        if (value.length != 0 && $(this).attr('id')=="FilterForm_sel_1")
            value1 = value;

        $select.find('option[value='+$that.val()+']').attr('selected', 'selected');
        $select1.find('option[value='+value1+']').attr('selected', 'selected');

		$select2.find('option[value='+$('#FilterForm_st_rating').val()+']').attr('selected', 'selected');

        $form.append($select);
        $form.append($select1);
		$form.append($select2);
		$form.append($checkbox);
        $form.submit();
    });

    initDataTableOprions('rating',{
        aaSorting: [],
        "iDisplayLength": 50,
        "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100,200, "Все"]],
        bPaginate: true,
        "bFilter": true,
        oLanguage: {
            sSearch: 'Поиск',
            oPaginate: {
                sNext: 'След',
                sPrevious: 'Пред'
            },
            sLengthMenu: 'Показать _MENU_ записей',
            sInfo: 'Общее кол-во записей _TOTAL_ отображено (_START_ - _END_)',
            sInfoEmpty: 'Ничего не найдено',
            sInfoFiltered: ' - отсортировано _MAX_ записей',
            sZeroRecords: 'Ничего не найдено',
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        }
    });
});