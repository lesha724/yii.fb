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

});