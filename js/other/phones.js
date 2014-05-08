$(document).ready(function(){

    $('#phones').dataTable({
         iDisplayLength: 20,
         aaSorting: [],
         bPaginate: true,
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

});