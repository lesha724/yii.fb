<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 17.11.2018
 * Time: 13:10
 */

/**
 * @var QuizController $this
 * @var TimeTableForm $model
 */

    $st = St::model()->findByPk($model->student);

    if(empty($st)):
        echo CHtml::tag('div', array('class' => 'alert alert-warning'), tt('Студент не выбран'));
    else:
?>
    <div class="row-fluid">
        <div class="span9">
            <?=$this->renderPartial('_list', array(
                'model' => $model,
                'student' => $st
            ));?>
        </div>
        <div class="span3">
            <?=$this->renderPartial('_create', array(
                'model' => $model
            ));?>
        </div>
    </div>
<?php
    endif;