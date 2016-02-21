/**
 * Created by Neff on 10.02.2016.
 */
$(document).ready(function(){

    $('[data-toggle="popover"]').popover();

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    var val_=$(this).val();
    var count_=$( "#lesson-list").data('count');
    showColumn($('#lesson-list').val());
    checkDisabledButton(val_,count_);

    $( "#lesson-list" ).change(function() {
        var val=$(this).val();
        var count=$( "#lesson-list").data('count');
        showColumn(val);
        checkDisabledButton(val,count)
    });

    $('#lesson-left').click(function(){
        changeLesson(false);
    });

    $('#lesson-right').click(function(){
        changeLesson(true);
    });
});


function showColumn(date){
    $('.journal-bottom th:not(:first-child),.journal-bottom td:not(:first-child)').hide();
    var lessons = $('.journal-bottom [data-number="'+date+'"]');
    if(lessons.length>0)
        lessons.show();
    else
        alert('Not found lesson number='+date);
}

function changeLesson(type){
    var val=$( "#lesson-list").val();
    var count=$( "#lesson-list").data('count');
    var newVal = val;
    if(type)
        newVal++;
    else
        newVal--;
    if(newVal>count||newVal<1)
        alert('Not found lesson');
    else
    {
        checkDisabledButton(newVal,count);
        $( "#lesson-list").val(newVal).change();
    }
}

function checkDisabledButton(newVal,count)
{
    $('#lesson-left').removeClass('disabled').removeAttr('disabled');
    $('#lesson-right').removeClass('disabled').removeAttr('disabled');
    if(newVal==1)
        $('#lesson-left').addClass('disabled').attr('disabled','disabled');
    if(newVal==count)
        $('#lesson-right').addClass('disabled').attr('disabled','disabled');
}

