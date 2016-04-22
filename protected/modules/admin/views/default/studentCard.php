<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 25.12.2015
 * Time: 10:06
 */

$this->pageHeader=tt('Настройки сервиса Карточка студента');
$this->breadcrumbs=array(
    tt('Админ. панель'),
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/journal.js');
$widget = <<<HTML
    <div class="span4">
        <div class="widget-box">
            <div class="widget-header">
                <h4>%s</h4>
                <span class="widget-toolbar">
                    <a data-action="collapse" href="#">
                        <i class="icon-chevron-up"></i>
                    </a>
                </span>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                %s
                </div>
            </div>
        </div>
    </div>
HTML;

$title = tt('Отображение');
$html  = $this->renderPartial('studentCard/settings', array(), true);
echo sprintf($widget, $title, $html);

$title = tt('Доступ');
$html  = $this->renderPartial('studentCard/settings-access', array(), true);
echo sprintf($widget, $title, $html);

$title = tt('Модульный контроль');
$html  = $this->renderPartial('studentCard/module', array(), true);
echo sprintf($widget, $title, $html);