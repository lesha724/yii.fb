<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 17.11.2018
 * Time: 13:17
 */

/**
 * @var QuizController $this
 * @var TimeTableForm $model
 * @var St $student
 */

$oprrz = new Oprrez();
$oprrz->oprrez2 = $student->st1;

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'oprrez-list',
    'dataProvider' => $oprrz->search(),
    'filter' => null,
    'type' => 'striped bordered',
    'columns' => array(
        array(
            'name'=>'oprrez3',
            'value'=>'$data->oprrez30->opr2',
        ),
        array(
            'name'=>'oprrez4',
            'value'=>'date("d.m.Y H:i:s", strtotime($data->oprrez4))',
        ),
        array(
            'name'=>'oprrez5',
            'value'=>'$data->oprrez50->name',
        ),
    ),
));
