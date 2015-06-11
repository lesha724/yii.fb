$(document).ready(function(){

    $('input[type=button][name=cikl_v_bloke]').click(function(){

        var value = $(':radio[name=cikl_v_bloke]:checked').val();

        if (value == undefined) {
            alert(msg2);
            return;
        }

        $.getJSON(url1, {'u1_cikl' : value}, function(data){
            if (! data.res)
                alert(msg1)
            else
                window.location.reload();
        });
    });
	
	$('.disp-ad').click(function(){
		var content=$(this).data('content');
		var disp=$(this).data('disp');
		alert(disp);
		alert(content);
		$('#myModal .modal-header h3').val(disp);
		$('#myModal .modal-body p').val(content);
		$('#myModal').modal('show');
    });

    $('input[type=button][name=vibor_discipline]').click(function(){

        var values = [];
        $(':checkbox[name="disciplines[]"]:checked').each(function() {
            values.push($(this).val())
        });

        var min = $(this).data('min');

        if (values.length != min) {
            alert(msg3);
            return;
        }

        $.getJSON(url2, {'disciplines' : values}, function(data){
            if (! data.res)
                alert(msg1)
            else
                window.location.reload();
        });
    });

    $('#cancelSubscription').click(function(){

        $.getJSON(url3, {}, function(data){
            if (! data.res)
                alert(msg1)
            else
                window.location.reload();
        });

    });

});