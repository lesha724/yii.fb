<?php
//$form->textField($stInfoForm, 'internationalPassport', array('autocomplete'=>'off'))
    echo CHtml::image(Yii::app()->createUrl('/other/studentPassport',array('psp1'=>$psp1,'type'=>$type)),'');//$stInfoForm->getPassport($model->student,2);
?>

