$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    $('#RatingForm_semStart ,#RatingForm_semEnd ,#RatingForm_ratingType,#RatingForm_stType').change(function(){

        submitForm();
    });

    function submitForm() {
        var $that   = $('#RatingForm_semStart');
        var $select = $that.clone();
        var value   = $that.val();

        var $that1   = $('#RatingForm_semEnd');
        var $select1 = $that1.clone();
        var value1   = $that1.val();

        var $checkbox=$('#RatingForm_ratingType').clone();
        $checkbox.hide();

        var $that2   = $('#RatingForm_stType');
        var $select2 = $that2.clone();
        var value2   = $that2.val();

        var $form   = $('#filter-form');

        if (value.length != 0 && $(this).attr('id')=="RatingForm_semStart")
            value1 = value;

        $select.find('option[value='+value+']').attr('selected', 'selected');
        $select1.find('option[value='+value1+']').attr('selected', 'selected');

        $select2.find('option[value='+value2+']').attr('selected', 'selected');

        $form.append($select);
        $form.append($select1);
        $form.append($select2);
        $form.append($checkbox);
        $form.submit();
    }

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
    
    $('.a-show-st-disp').click(function (event) {
        event.preventDefault();

        var $that = $(this);

        var $st1  = $that.data('st1');

        //var $group = $('#RatingForm_group').val();

        var $semStart   = $('#RatingForm_semStart').val();

        var $semEnd   = $('#RatingForm_semEnd').val();

        //var $ratingType=$('#RatingForm_ratingType').val();

        //var $stType   = $('#RatingForm_stType').val();

        var params = {
            st1  : $st1,
            semStart: $semStart,
            semEnd: $semEnd
            /*ratingType: $ratingType,
            stType: $stType,
            group:$group*/
        };

        var url = $that.parents('[data-url-st]').data('url-st');

        $spinner1.show();

        $.ajax({
            url: url,
            dataType: 'json',
            data:params,
            success: function( data ) {
                if (!data.error) {
                    $('#modalBlock .modal-header h4').html(data.title);
                    $('#modalBlock #modal-content').html(data.html);
                    $('#modalBlock').modal('show');
                } else {
                    addGritter(data.html, 'Ошибка', 'error');
                }
                $spinner1.hide();
            },
            error: function( data ) {
                addGritter(data.html, 'Ошибка', 'error');
                $spinner1.hide();
            }
        });
    });
});