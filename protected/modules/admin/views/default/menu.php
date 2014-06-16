<?php
/**
 *
 * @var DefaultController $this
 */

    $this->pageHeader=tt('Отображение пунктов меню');
    $this->breadcrumbs=array(
        tt('Админ. панель'),
    );

    Yii::app()->clientScript->registerPackage('nestable');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/menu.js');

    global $settings;
    $settings = PortalSettings::model()->findByPk(26)->getAttribute('ps2');

    function checkbox($name)
    {
        global $settings;

        return <<<HTML
            <input type="checkbox" />
            <input type="hidden" name="{$name}" />
HTML;

    }
?>
<form id="menu">
    <div class="span3 widget-box collapsed">
        <div class="widget-header">
            <h5><?=tt('Расписание')?></h5>

            <div class="widget-toolbar">
                <a data-action="collapse" href="#">
                    <i class="icon-chevron-down"></i>
                </a>
            </div>
            <div class="widget-toolbar no-border">
                <label>
                    <input type="checkbox" class="ace ace-switch ace-switch-3" name="timeTable[whole]"/>
                    <span class="lbl"></span>
                </label>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <ol class="dd-list">
                    <li class="dd-item" >
                        <div class="dd-handle"><?=checkbox('timeTable[group]')?> <?=tt('Академ. группы')?></div>
                    </li>
                    <li class="dd-item" >
                        <div class="dd-handle"><?=checkbox('timeTable[teacher]')?> <?=tt('Преподавателя')?></div>
                    </li>
                    <li class="dd-item" >
                        <div class="dd-handle"><?=checkbox('timeTable[student]')?> <?=tt('Студента')?></div>
                    </li>
                    <li class="dd-item" >
                        <div class="dd-handle"><?=checkbox('timeTable[classroom]')?> <?=tt('Аудитории')?></div>
                    </li>
                    <li class="dd-item" >
                        <div class="dd-handle"><?=checkbox('timeTable[freeClassroom]')?> <?=tt('Свободные аудитории')?></div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</form>
