$(document).ready(function(){


    $('#modules').dataTable({
        iDisplayLength: 100,
        aaSorting: [],
        bPaginate: false,
        oLanguage: {
            sSearch: 'Поиск',
            oPaginate: {
                sNext: 'След',
                sPrevious: 'Пред'
            },
            sLengthMenu: '',//'Показать _MENU_ записей',
            sInfo: 'Общее кол-во записей _TOTAL_ отображено (_START_ - _END_)',
            sInfoEmpty: 'Ничего не найдено',
            sInfoFiltered: ' - отсортировано _MAX_ записей',
            sZeroRecords: 'Ничего не найдено'
        }
    });


    $('#id-date-range-picker-1').daterangepicker().prev().on(ace.click_event, function(){
        $(this).next().focus();
    });

});