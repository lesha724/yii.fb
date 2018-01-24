<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 11.12.2017
 * Time: 19:14
 */

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/journal.js');

$checkboxStyle = array('class' => 'ace ace-switch ace-switch-4');
?>

    <div class="widget-box">
        <div class="widget-header">
            <h4><?=tt('Дистанционное образование')?></h4>
            <span class="widget-toolbar">
                <a data-action="collapse" href="#">
                    <i class="icon-chevron-up"></i>
                </a>
            </span>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'ps-dist-education',
                    'htmlOptions' => array('class' => 'form-horizontal'),
                    'action' => '#'
                ));
                ?>
                <?php
                $enableDistEducation = PortalSettings::ENABLE_DIST_EDUCATION;
                $hostDistEducation = PortalSettings::HOST_DIST_EDUCATION;
                $apikeyDistEducation = PortalSettings::APIKEY_DIST_EDUCATION;

                $enableInSubscriptionDistEducation = PortalSettings::ENABLE_IN_SUBSCRIPTION_DIST_EDUCATION;

                $registrationEmailDistEducation = PortalSettings::REGISTRATION_EMAIL_DIST_EDUCATION;

                $roleId = PortalSettings::ROLE_ID_FOR_MOODLE_STUDENTS;
                ?>

                <div class="">
                    <div class="control-group">
                        <?=CHtml::checkBox('', PortalSettings::model()->findByPk($enableDistEducation)->ps2, $checkboxStyle)?>
                        <span class="lbl"> <?=tt('Включено')?></span>
                        <?=CHtml::hiddenField('settings['.$enableDistEducation.']', PortalSettings::model()->findByPk($enableDistEducation)->ps2)?>
                    </div>

                    <div class="control-group">
                        <span class="lbl"> <?=tt('Host')?>:</span>
                        <?=CHtml::textField('settings['.$hostDistEducation.']', PortalSettings::model()->findByPk($hostDistEducation)->ps2)?>
                    </div>

                    <div class="control-group">
                        <span class="lbl"> <?=tt('ApiKey')?>:</span>
                        <?=CHtml::textField('settings['.$apikeyDistEducation.']', PortalSettings::model()->findByPk($apikeyDistEducation)->ps2)?>
                    </div>

                    <div class="control-group">
                        <span class="lbl"> <?=tt('RoleId for Moodle students')?>:</span>
                        <?=CHtml::textField('settings['.$roleId.']', PortalSettings::model()->findByPk($roleId)->ps2)?>
                    </div>

                    <div class="control-group">
                        <?=CHtml::checkBox('', PortalSettings::model()->findByPk($enableInSubscriptionDistEducation)->ps2, $checkboxStyle)?>
                        <span class="lbl"> <?=tt('Записывать на курсы при записи на дисциплину')?></span>
                        <?=CHtml::hiddenField('settings['.$enableInSubscriptionDistEducation.']', PortalSettings::model()->findByPk($enableInSubscriptionDistEducation)->ps2)?>
                    </div>
                </div>

                <div class="">
                    <div class="control-group">
                        <span class="lbl"> <?=tt('Письмо о регистрации на Дист. Образовании')?>:</span><br>
                        <span class="blue">{username}-логин, {password}-пароль, {email}-почта, {fio}-фио</span>
                        <?php $this->widget('application.extensions.elFinderTinyMce.TinyMce',
                            array(
                                'name'=>'settings['.$registrationEmailDistEducation.']',
                                'value'=>PortalSettings::model()->findByPk($registrationEmailDistEducation)->ps2,
                                'htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'tinymce'),
                                'fileManager' => array(
                                    'class' => 'ext.elFinder.TinyMceElFinder',
                                    'connectorRoute'=>'/admin/default/connector',
                                ),
                                /*'settings'=>array(
                                    'theme' => "advanced",
                                    'skin' => 'default',
                                    'language' => Yii::app()->language,
                                ),*/
                            )); ?>
                    </div>
                </div>

                <div class="form-actions ">
                    <button type="submit" class="btn btn-info btn-small">
                        <i class="icon-ok bigger-110"></i>
                        <?=tt('Сохранить')?>
                    </button>
                </div>

                <?php $this->endWidget();?>
            </div>
        </div>
    </div>