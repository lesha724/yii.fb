<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 15.02.2019
 * Time: 12:57
 */

/**
 * @var $this AlertController
 * @var $model Users
 */

echo $this->renderPartial('_input', array(
    'model' => $model
));


if($model->isTeacher){
    echo $this->renderPartial('_output', array(
        'model' => $model
    ));
}
