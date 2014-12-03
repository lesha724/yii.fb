<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */

if (! empty($model->discipline)):

    list($gr1, $stus18, $stus19, $stus20, $stus21) = explode(':', $model->discipline);

    $params = array(
        'gr1'    => $gr1,
        'stus18' => $stus18,
        'stus19' => $stus19,
        'stus20' => $stus20,
        'stus21' => $stus21,
    );
    $students = St::model()->getStudentsForExamSession($params);

    echo tt('Ведомость').': <br>'.
         CHtml::textField('date', date('d.m.y'), array('class' => 'datepicker','style'=>'width:6%')).
         CHtml::textField('number', null, array('placeholder' => tt('№ ведомости'), 'maxlength'=>15));

echo '<div>';
    $this->renderPartial('examSession/_students', array(
        'students' => $students
    ));

    echo '<div class="exam-session-div">';
    $this->renderPartial('examSession/_table', array(
        'students' => $students,
        'params'   => $params
    ));
    echo '</div>';
echo '</div>';



endif;