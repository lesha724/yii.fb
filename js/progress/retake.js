$(document).ready(function(){

    $spinner1 = $('#spinner1');
    
    initFilterForm($spinner1);
    
    $(document).on('click', '.datepicker', function(event) {
        $(this).datepicker({
            'format': 'dd.mm.yy',
            'language':'ru'
        })
        .on('changeDate', function(ev){
            $(this).datepicker('hide');
        })
        .focus();
    });
	
    $('#FilterForm_discipline').change(function(){

        var $form   = $('#filter-form');
        //appendSelect();
        $form.submit();
    });

    $('#filter-form').submit(function(e) {
        appendSelect();
    });
    
    function appendSelect()
    {
        var $select = $('#FilterForm_discipline').clone();
        var $form   = $('#filter-form');

        $select.find('option[value='+$('#FilterForm_discipline').val()+']').attr('selected', 'selected');

        $form.append($select);
    }
    
    
    $(document).on('click','.btn-add-retake,.btn-view-retake', function(e) {
        e.preventDefault();
        $('#myModal #modal-content').html('');
        $('#save-stego').hide(); 
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            dataType: 'json',
            success: function( data ) {
                    if (!data.error) {
                        $('#myModal .modal-header h4').html(data.title);
                        $('#myModal #modal-content').html(data.html);
                        if(data.show){
                           $('#save-stego').show(); 
                        }
                        $('.datepicker').datepicker({
                            format: 'dd.mm.yy',
                        });
                        $('#myModal').modal('show');
                    } else {
                        addGritter(data.html, tt.error_load, 'error');
                    }
            },
            error: function( data ) {
                    addGritter('', tt.error_load, 'error');
            }
      });        
    });
    
    $(document).on('click','.delete-retake', function(e) {
        e.preventDefault();
        var params = {
            stego1:$(this).data("stego1"),
            p1:$(this).data("stego4"),
            date:$(this).data("stego3"),
            value :$(this).data("stego2"),
        }
        var url = $(this).data('url');
        $.get(url, params, function(data){
            $('#myModal').modal('hide');
            if (data.error) {
                addGritter('', tt.error, 'error')
            } else {
                addGritter('', tt.success, 'success');
                $.fn.yiiGridView.update('retake');
            }
        }, 'json')
    });
    
    $(document).on('click','#save-stego', function(e) {
        var params = {
            stego1:$('#Stego_stego1').val(),
            p1:$('#Stego_stego4').val(),
            date:   $('#Stego_stego3').val(),
            value : parseFloat( $('#Stego_stego2').val().replace(',','.') )
        }
        if (isNaN(params.value)) {
                addGritter('', tt.error, 'error');
                $('#Stego_stego2').addClass('error');
                return false;
            }
        if ( params.value > 100 ) {
            addGritter('', tt.minMaxError, 'error');
            $('#Stego_stego2').addClass('error');
            return false;
        }
        if (params.date=="") {
                addGritter('', tt.error, 'error');
                $('#Stego_stego3').addClass('error');
                return false;
            } 
        
        
        var url = $('#myModal').data('url');
        $.get(url, params, function(data){
            $('#myModal').modal('hide');
            if (data.error) {
                addGritter('', tt.error, 'error')
            } else {
                addGritter('', tt.success, 'success');
                $.fn.yiiGridView.update('retake');
            }
        }, 'json')
        
        return false;
    });
	
});