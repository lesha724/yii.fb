<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 29.08.2019
 * Time: 10:49
 */

/**
 * @var $this QuizController
 * @var $st St
 */

$oprrezList = Oprrez::model()->getByStudent($st->st1);

if(count($oprrezList) == 0):
     $this->renderPartial('index2/_quiz', array(
         'st' => $st
     ));
else:
    $this->renderPartial('index2/_oprrez', array(
        'st' => $st,
        'oprrezList' => $oprrezList
    ));
endif;


