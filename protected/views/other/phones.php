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
<table id="phones" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><?=tt('Подразделение')?></th>
            <th><?=tt('Отдел')?></th>
            <th><?=tt('Кафедра')?></th>
            <th><?=tt('Должность')?></th>
            <th><?=tt('Сотрудник')?></th>

            <th class="hidden-phone">
                <i class="icon-bell bigger-110 hidden-phone"></i>
                <?=tt('Внешний тел.')?>
            </th>
            <th class="hidden-phone">
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
    <td>$phone[k2]</td>
    <td>$phone[b2]</td>
    <td>$phone[teacher]</td>
    <td>
        <span class="label label-success">$phone[tso8]</span>
    </td>
    <td>
        <span class="label label-warning">$phone[tso7]</span>
    </td>
</tr>
HTML;
        }
    echo $html;

    ?>

    </tbody>
</table>

