<?php
/**
 *
 * @var DefaultController $this
 */
    $this->pageHeader=tt('Настройки сервиса Эл. журнал');
    $this->breadcrumbs=array(
        tt('Админ. панель'),
    );

    $placeholder = tt('Название колонки');
    $pattern = <<<HTML
        <div class="control-group">
            <label class="control-label">%s</label>
            <div class="controls">
                <span class="span1">
                    <label>
                        <input type="checkbox" name="%s" value="%s" class="ace ace-switch ace-switch-4">
                        <span class="lbl"></span>
                    </label>
                </span>
                <span>
                   <input type="text" name="%s" value="%s" placeholder="{$placeholder}">
                </span>
            </div>
        </div>
HTML;


    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'portal-settings',
        'htmlOptions' => array('class' => 'form-horizontal'),
        'action' => '#'

    ));

    $translate1 = tt('Колонка').' №1';

    $chName     = 'settings[0]';
    $chValue    = PortalSettings::model()->findByPk(0)->ps2;
    $inputName  = 'settings[1]';
    $inputValue = PortalSettings::model()->findByPk(1)->ps2;

    echo sprintf($pattern, $translate1, $chName, $chValue, $inputName, $inputValue);



$this->endWidget();

