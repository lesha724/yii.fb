/**
 * Created by Neff on 21.09.2016.
 */

$(document).ready(function(){

    $(document).on('click','.btn-check-user',function(event){
        event.preventDefault();
        var $type = $(this).data('type');
        var $id = $(this).data('id');
        var $name = $(this).data('name');
        var $typeName = $(this).data('type-name');
        if(!$("li").is('[data-id="'+$id+'"][data-type="'+$type+'"]')) {
            addItem($id, $type, $name, $typeName);
        }else{
            alert('alredy exist');
        }
    });

    $(document).on('click','.btn-generate-user',function(event){
        event.preventDefault();
        var $result = '';

        $(".user-list .li-user").each(function(){
            $result += $(this).data('id')+'-'+$(this).data('type')+',';
        });

        var $form = $(this).parents('form');

        $('#GenerateUserForm_users').val($result);

        $form.submit();
    });

    $(document).on('click','.remove-user',function(event){
        event.preventDefault();
        var $item = $(this).parent();
        removeItem($item);
    });

});

function checkCount(){
    var $count = $('.user-list .li-user').length;
    if($count>0){
        $('.user-list .li-empty').hide();
    }else{
        $('.user-list .li-empty').show();
    }
}

function addItem($id, $type, $name, $typeName){
    var $classLabel = '';
    switch ($type){
        case 0:
            $classLabel = 'label-success';
            break
        case 1:
            $classLabel = 'label-primary';
            break
        case 2:
            $classLabel = 'label-warning';
            break
    }
    $('<li class="li-user" data-id="'+$id+'" data-type="'+$type+'">'+
        $name+
    '<span class="pull-right label '+$classLabel+'">'+$typeName+'</span>'+
    '<button type="button" class="remove-user close" aria-hidden="true">&times;</button>' +
    '</li>').insertAfter('.user-list .li-empty');
    checkCount();
}

function removeItem($item){
    $item.remove();
    checkCount();
}