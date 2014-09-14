$(document).ready(function(){

    var option = {
        'headerClass' : 'authorization-header'
    }
    $("#sign-in, #registration, #forgot-password").on('click', function() {

        var $that = $(this);
        var header = $that.text();

        var options = jQuery.extend(option, {'header': header});

        $.get($(this).attr('href'), {}, function(response){
            bootbox.dialog($('#content', response).html(), '', options);
        });

        return false;
    });

    $(document).on('submit', '#login-form, #registration-form, #forgot-password-form', function(){

        var data  = $(this).serialize();
        var url   = $(this).attr('action');
        var $that = $(this);

        $that.find('button').button('loading');

        $.ajax({
            type: 'POST',
            url:  url,
            data: data,
            success:function(data){
                $that.find('button').button('reset')
                if (data == 'ok') {
                    window.location.reload();
                } else if (data == 'registered') {
                    alert(tt.registerConfirm)
                   window.location.reload();
                } else if (data == 'send') {
                    alert(tt.sendingConfirm)
                    window.location.reload();
                } else
                    $($that).replaceWith( $('#replace-there', data).html() )
            },
            error: function(data) { // if error occured
                $that.find('button').button('reset')
                alert("Error occurred. Please try again");
            },

            dataType:'html'
        });

        return false;
    })

});
