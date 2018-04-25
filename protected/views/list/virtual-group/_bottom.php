<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 02.12.2016
 * Time: 22:30
 */
/**
 * @var ListController $this
 * @var FilterForm $model
 */
	$students=St::model()->getListVirtualGroup($model->group);
	Yii::app()->clientScript->registerScript('list-virtual-group', "
		initDataTable('list-virtual-group');
	");

//$ps34=PortalSettings::model()->findByPk(34)->ps2;

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'button',
    'type'=>'primary',

    'icon'=>'print',
    'label'=>tt('Печать'),
    'htmlOptions'=>array(
        'class'=>'btn-small',
        'data-url'=>Yii::app()->createUrl('/list/virtualGroupExcel'),
        'id'=>'journal-print',
    )
));
?>

<table id="list-virtual-group" class="table table-striped table-hover">
    <thead>
    <tr>
        <th style="width:40px">№</th>
        <th><?=tt('ФИО студента')?></th>
        <th><?=tt('Академ. группа')?></th>
        <th style="width:200px">№ <?=tt('зач. книжки')?></th>
        <?php /*if($ps34==1):?>
            <th style="width:90px"><?=tt('Вид фин.')?></th>
        <?php endif;*/?>

    </tr>
    </thead>
    <tbody>
    <?php
    /*$type=array(
        0=>tt('бюджет'),
        1=>tt('контракт')
    );*/
    $i=1;
    foreach($students as $student)
    {
        /*if($ps34==1){
            if($student['sk3']==0){
                echo '<tr class="success">';
            }else
            {
                echo '<tr class="warning">';
            }
        }else*/
            echo '<tr class="info">';
        echo '<td>'.$i.'</td>';
        $name = $student['st2'].' '.$student['st3'].' '.$student['st4'];
        if(Yii::app()->language == 'en' && !empty($student['st74']))
            $name = $student['st74'].' '.$student['st75'].' '.$student['st76'];
        echo '<td>'.$name.'</td>';
        echo '<td>'.Gr::model()->getGroupName($model->course, $student).'</td>';
        echo '<td>'.$student['st5'].'</td>';
        /*if($ps34==1)
            echo '<td>'.$type[$student['sk3']].'</td>';*/
        echo '</tr>';
        $i++;
    }
    ?>
    </tbody>
</table>
