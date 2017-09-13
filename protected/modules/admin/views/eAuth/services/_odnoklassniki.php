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

<?= $form->checkBoxRow($model,'enableOdnoklassniki')?>
<?= $form->textFieldRow($model, 'clientIdOdnoklassniki',array('class'=>'span12'))?>
<?= $form->textFieldRow($model, 'clientPublicOdnoklassniki',array('class'=>'span12'))?>
<?= $form->textFieldRow($model, 'clientSecretOdnoklassniki',array('class'=>'span12'))?>