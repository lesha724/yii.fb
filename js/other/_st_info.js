$(document).ready(function(){

    initDataTable('marks');

    $('.delete-comment').click(function(){

        var $that = $(this);
        var url   = $that.attr('href');

        $.getJSON(url, {}, function(data){
            if (data.res == 1)
                window.location.reload()
        });

        return false;
    })
});