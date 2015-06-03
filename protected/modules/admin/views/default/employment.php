<?php
/**
 *
 * @var DefaultController $this
 */
    $this->pageHeader=tt('Настройки сервиса Трудоустройство');
    $this->breadcrumbs=array(
        tt('Админ. панель'),
    );


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

    $title = tt('Внешний вид списка студентов');
    $html  = $this->renderPartial('employment/_list_type', array(), true);
    echo sprintf($widget, $title, $html);

