<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$count = Test::model()->countByAttributes(array('test4'=>$model->test4));
if($count>0)
{
    $disciplines = Test::model()->getDispArray();
    echo <<<HTML
    <div class="test-bottom">
HTML;

    $this->renderPartial('test/_table_1', array(
        'disciplines' => $disciplines
    ));

    $this->renderPartial('test/_table_2', array(
        'disciplines' => $disciplines
    ));

    $this->renderPartial('test/_table_3', array(
        'disciplines' => $disciplines
    ));
    echo <<<HTML
    </div>
HTML;
}  else {
    Yii::app()->user->setFlash('error', '<strong>'.tt('Ошибка').'!</strong> '.tt('Нет записей о тестировании').'.');
   $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>false,
        'closeText'=>false, // use transitions?
       'alerts'=>array( // configurations per alert type
            'error'=>array('block'=>true,   'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    ));
}

