<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 13.09.2017
 * Time: 14:24
 */


/**
 * @var $this EAuthController
 * @var $form TbActiveForm
 * @var $model ConfigEAuthForm
 */
?>

<?= $form->checkBoxRow($model,'enableGithub')?>
<?= $form->textFieldRow($model, 'clientIdGithub',array('class'=>'span12'))?>
<?= $form->textFieldRow($model, 'clientSecretGithub',array('class'=>'span12'))?>