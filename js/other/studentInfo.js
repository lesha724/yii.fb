$(document).ready(function(){

    $('#id-input-file-3').ace_file_input({
        style:'well',
        btn_choose:'Drop files here or click to choose',
        btn_change:null,
        no_icon:'icon-cloud-upload',
        droppable:true,
        thumbnail:'small'
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
        /**,before_remove : function() {
						return true;
					}*/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            console.log(error_code);
        }

    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });

    $(document).on('submit', '#fill-data-form, #attach-file-form', function(){

        var $that   = $(this);
        var $inputs = $('#filter-form select');

        $inputs.each(function(i, el){
            $that.append( $(el).clone() )
        });

        return true;
    });

    $('.autocomplete').autocomplete({
        serviceUrl: $('[data-autocompleteurl]').data('autocompleteurl'),
        minChars:2,
        delimiter: /(,|;)\s*/, // regex or character
        maxHeight:300,
        width:'auto',
        zIndex: 9999,
        deferRequestBy: 0, //miliseconds
        params: { }, //aditional parameters
        noCache: true, //default is false, set to true to disable caching
        // callback function:
        onSelect: function(obj){
            var url = $('[data-updatenkrs]').data('updatenkrs');
            var post = {
                'field' : 'nkrs6',
                'value' : obj.p1,
                'nkrs1' : $(this).parent().data('nkrs1')
            };

            $.post(url, post, function(data){
                if (data.res)
                    addGritter('', 'Имя руководителя было изменено!', 'success')
                else
                    addGritter('', 'Произошла ошибка!', 'error')
            }, 'json')
        }
    });

    $(document).on('change', '[name=nkrs7]', function(){

        var $that = $(this);

        var url = $('[data-updatenkrs]').data('updatenkrs');
        var post = {
            'field' : 'nkrs7',
            'value' : $that.val(),
            'nkrs1' : $(this).parent().data('nkrs1')
        };

        $.post(url, post, function(data){
            if (data.res) {
                addGritter('', 'Название курсовой было изменено!', 'success');
                $('#nkrs7-eng').val(post.value);
            } else
                addGritter('', 'Произошла ошибка!', 'error')
        }, 'json')
    });
});