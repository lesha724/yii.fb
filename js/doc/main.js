/**
 * Created by Neff on 15.12.2016.
 */

$(document).ready(function() {

    $(document).on('change', '#filter-form select', function(){
        $(this).closest('form').submit();
    });
});
