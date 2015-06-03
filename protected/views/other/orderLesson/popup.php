<?php
    $rz = CHtml::listData(Rz::model()->findAll(), 'rz1', 'rz1');
    $freeRoomsUrl = Yii::app()->createUrl('other/freeRooms');
    $submitUrl    = Yii::app()->createUrl('other/saveLessonOrder');
?>

<div id="dialog-message" class="hide">

    <div id="info" class="lesson-order-info"></div>

    <div class="hr hr-12 hr-double"></div>

    <div>
    <form data-freeroomsurl="<?=$freeRoomsUrl?>" action="<?=$submitUrl?>">
        <table >
            <tr>
                <td><?=tt('Дата')?></td>
                <td><?=CHtml::textField('ZPZ[zpz6]', null, array('class' => 'datepicker', 'style'=>'width:140px'))?></td>
            </tr>
            <tr>
                <td><?=tt('Пара')?></td>
                <td><?=CHtml::dropDownList('ZPZ[zpz7]', null, $rz, array('style'=>'width:155px'))?></td>
            </tr>
            <tr>
                <td><?=tt('Аудитория')?></td>
                <td><?=CHtml::dropDownList('ZPZ[zpz8]', null, array(), array('style'=>'width:155px'))?></td>
            </tr>
        </table>
    </form>
    </div>
</div><!-- #dialog-message -->
