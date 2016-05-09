<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 31.08.15
 * Time: 15:19
 */

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'button',
    'type'=>'warning',
    'icon'=>'refresh',
    'label'=>tt('Обновить'),
    'htmlOptions'=>array(
        'id'=>'refresh-filter-form-button',
        'class'=>'btn-small'
    )
));

Yii::app()->clientScript->registerScript('refresh-filter-form',"
    $(document).on('click','#refresh-filter-form-button', function() {
                $('#filter-form').submit();
	    });
",CClientScript::POS_READY);
?>