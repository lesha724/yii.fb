<?php
/**
 *
 * @var WorkPlanController $this
 */
Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/phones.js', CClientScript::POS_HEAD);


$this->pageHeader=tt('Телефонный справочник');
$this->breadcrumbs=array(
    tt('Другое'),
);

?>

<form class="form-inline">
    <?php
        echo CHtml::label(tt('Подразделение'), 'department');
        $departments = CHtml::listData(Tsg::model()->findAll('tsg1 > 0'), 'tsg1', 'tsg2');
        echo CHtml::dropDownList('department', $department, $departments, array('empty' => 'Все'));
    ?>
</form>

<table id="phones" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><?=tt('Подразделение')?></th>
            <th><?=tt('Отдел').' / '.tt('Кафедра')?></th>
            <th style="width:10%"><?=tt('Должность')?></th>
            <th style="width:20%"><?=tt('Сотрудник')?></th>

            <th class="hidden-phone" style="width:11%">
                <i class="icon-bell bigger-110 hidden-phone"></i>
                <?=tt('Внешний тел.')?>
            </th>
            <th class="hidden-phone" style="width:11%">
                <i class="icon-bell-alt bigger-110 hidden-phone"></i>
                <?=tt('Внутренний тел.')?>
            </th>
        </tr>
    </thead>

    <tbody>
    <?php
        $html = '';
        foreach ($phones as $phone) {
            $html .= <<<HTML
<tr>
    <td>$phone[tsg2]</td>
    <td>$phone[tso3]</td>
    <td>$phone[b2]</td>
    <td>$phone[teacher]</td>
    <td>
        <span class="label label-warning">$phone[tso7]</span>
    </td>
    <td>
        <span class="label label-success">$phone[tso8]</span>
    </td>
</tr>
HTML;
        }
    echo $html;

    ?>

    </tbody>
</table>

