$(document).ready(function(){

    var options = {
        'header': tt.authorization,
        'headerClass' : 'authorization-header'
    }
    $("#sign-in").on('click', function() {
        $.get(loginUrl, {}, function(response){
            bootbox.dialog($('#content', response).html(), '', options);
        });
    });

    $(document).on('submit', '#login-form', function(){

        var data  = $(this).serialize();
        var url   = $(this).attr('action');
        var $that = $(this);

        $.ajax({
            type: 'POST',
            url:  url,
            data: data,
            success:function(data){
                if (data == 'ok')
                    window.location.reload();
                else
                    $($that).replaceWith( $('#replace-there', data).html() )
            },
            error: function(data) { // if error occured
                alert("Error occurred. Please try again");
            },

            dataType:'html'
        });

        return false;
    })

});
