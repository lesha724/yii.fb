$(document).ready(function(){

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    initPopovers();

    initTooltips();

    $(document).on('click', 'input.datepicker', function(event) {
        $(this).datepicker({
            format: 'dd.mm.yyyy',
            language: 'ru'
        }).focus();
    });

    $('i.show-info').click(function(){
        showDialog();
    });
    $('#save-change-omissions').click(function(){
        var $that = $(this);
        var stegn1 = $that.data('stegn1');
        var date1=$('#date1_omissions_change').val();
        var date2=$('#date2_omissions_change').val();
        var check=$('#ck_omissions').is(':checked') ? 2 : 1;
        var number=$('#number_reference').val();
        var type_omissions=$('#select-type').val();
        var stegnp4=$('#stegnp4').val();
        var stegnp5=$('#stegnp5').val();
        var title =$('#myModal .modal-header h4').html();
        var params = {
            stegn1:stegn1,
            date1:date1,
            date2:date2,
            check:check,
            number:number,
            stegnp4:stegnp4,
            stegnp5:stegnp5,
            type_omissions:type_omissions
        }
        
        var url = $that.data('url');
        $('#myModal').modal('hide');
        $spinner1.show();
        $.getJSON(url, params, function(data){

            if (data.error) {
                addGritter(title, tt.error, 'error')
            } else {
                addGritter(title, tt.success, 'success')
                setTimeout(function() {
                    $td.removeClass('success') }, 1000);
                $('#filter-form').submit();
            }

            $spinner1.hide();
        })
    });


    $('#select-type').change(function(){
        var val = $(this).val();
        if(val!=5)
            $('#stegnp').hide();
        else
            $('#stegnp').show();
    });

    $('#omissions .input-stegn11, #omissions .select-stegn10,#omissions .input-stegnp4 ,#omissions .input-stegnp5').change(function(){

        var $that = $(this);

        var stegn1    = $that.parents('[data-stegn1]').data('stegn1');
        var stegn2    = $that.parents('[data-stegn2]').data('stegn2');
        var stegn3    = $that.parents('[data-stegn3]').data('stegn3');
        

        var params = {
            field : $that.data('field'),
            stegn1:stegn1,
            stegn2:stegn2,
            stegn3:stegn3,
            value : $that.val()
        }
        var $td    = $that.parent();
        
        var date   = $that.parents('tr').find('.date').html();
        var title  = date;

        var url = $that.parents('[data-url]').data('url');

        $spinner1.show();

        $.getJSON(url, params, function(data){

            if (data.error) {
                addGritter(title, tt.error, 'error')
                $td.addClass('error');
            } else {
                addGritter(title, tt.success, 'success')
                $td.removeClass('error').addClass('success');
                setTimeout(function() {
                    $td.removeClass('success') }, 1000);
                if($that.is("select"))
                {
                    $val='';
                    if(params.value<5)
                    {
                        $val=$that.parents('[data-type2]').data('type2');
                    }else
                    {
                        $val=$that.parents('[data-type1]').data('type1');
                    }
                    //alert($val);
                    $that.parents('tr').find('.stegn4').html($val);
                }
            }

            $spinner1.hide();
        })
        $('#filter-form').submit();
    });
});

function showDialog()
{
    $( "#dialog-message" ).dialog({
        modal: true,
        title: "<div class='widget-header'><h4 class='smaller'>"+tt.popupTitle+"</h4></div>",
        title_html: true,
        buttons: [
            {
                html: "<i class='icon-remove bigger-110'></i>&nbsp; Ok",
                class : "btn btn-info btn-mini",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
        ]
    });
}