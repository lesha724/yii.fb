<?php
/**
 *
 * @var DefaultController $this
 */
    $this->pageHeader=tt('Настройки сервиса Эл. журнал');
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

    $title = tt('Дополнительные колонки');
    $html  = $this->renderPartial('journal/_extra_columns', array(), true);
    echo sprintf($widget, $title, $html);


    $title = tt('Внешний вид журнала');
    $html  = $this->renderPartial('journal/_journal_type', array(), true);
    echo sprintf($widget, $title, $html);

