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
    <?= $form->checkBoxRow($model,'enableTwitter')?>
    <?= $form->textFieldRow($model, 'keyTwitter',array('class'=>'span12'))?>
    <?= $form->textFieldRow($model, 'secretTwitter',array('class'=>'span12'))?>

