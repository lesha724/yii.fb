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

$this->pageHeader=tt('Оповещение');
$this->breadcrumbs=array(
    tt('Сообщения'),
);

Yii::app()->clientScript->registerCss('style-alert', <<<CSS
    #alert-service .well{
        margin-bottom: 2px;
        padding: 3px;
    }
    #alert-service .media{
        margin-top: 5px;
    }
    #alert-service img{
        max-height: 50px;
    }
CSS
);

if($model->isTeacher || ($model->isStudent && PortalSettings::model()->getSettingFor(PortalSettings::STUDENT_SEND_IN_ALERT) == 1))
    echo $this->renderPartial('_form');
?>
<div class="row-fluid" id="alert-service">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-header">
                <h5><?=tt('Входящие сообщения')?></h5>

                <div class="widget-toolbar">
                    <a data-action="collapse" href="#">
                        <i class="icon-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <?=$this->renderPartial('_input', array(
                        'model' => $model
                    ));?>
                </div>
            </div>
        </div>
    </div>
<?php

if($model->isTeacher || ($model->isStudent && PortalSettings::model()->getSettingFor(PortalSettings::STUDENT_SEND_IN_ALERT) == 1)):
    //echo $this->renderPartial('_form');
?>

    <div class="span6">
        <div class="widget-box">
            <div class="widget-header">
                <h5><?=tt('Отправленные сообщения')?></h5>

                <div class="widget-toolbar">
                    <a data-action="collapse" href="#">
                        <i class="icon-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <?=$this->renderPartial('_output', array(
                        'model' => $model
                    ))?>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
echo '</div>';
