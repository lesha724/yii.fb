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

<?= $form->checkBoxRow($model,'enableDropbox')?>
<?= $form->textFieldRow($model, 'clientIdDropbox',array('class'=>'span12'))?>
<?= $form->textFieldRow($model, 'clientSecretDropbox',array('class'=>'span12'))?>