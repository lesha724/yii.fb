<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 13.09.2017
 * Time: 12:40
 */

/**
 * @var $this EAuthController
 * @var $form TbActiveForm
 * @var $model ConfigEAuthForm
 */
?>
    <?= $form->checkBoxRow($model,'enableLinkedin')?>
    <?= $form->textFieldRow($model, 'keyLinkedin',array('class'=>'span12'))?>
    <?= $form->textFieldRow($model, 'secretLinkedin',array('class'=>'span12'))?>

