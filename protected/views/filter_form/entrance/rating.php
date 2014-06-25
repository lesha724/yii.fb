<?php
/**
 *
 * @var EntranceController $this
 * @var CActiveForm $form
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;'), 'style' => 'width:150px');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html = '<div>';
    $html .= '<fieldset>';

    $filials = CHtml::listData(Ks::model()->findAll(), 'ks1', 'ks2');
    if (count($filials) > 1) {
        $html .= '<div class="row-fluid span2">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $options);
        $html .= '</div>';
    }

    $sel_1 = array(
        0 => tt('Младший специалист'),
        1 => tt('Бакалавр'),
        2 => tt('Специалист'),
        3 => tt('Магистр'),
    );
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'sel_1');
    $html .= $form->dropDownList($model, 'sel_1', $sel_1, $options);
    $html .= '</div>';


    $sel_2 = array(
        0 => tt('Дневная'),
        1 => tt('Заочная'),
    );
    if (! SH::is(U_NULAU))
        $sel_2 += array(2 => tt('Вечерняя'));
    $sel_2 += array(3 => tt('Экстернат'));

    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'sel_2');
    $html .= $form->dropDownList($model, 'sel_2', $sel_2, $options);
    $html .= '</div>';

    $courses = CHtml::listData(Spab::model()->getCoursesForEntrance($model), 'spab6', 'spab6');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'course');
    $html .= $form->dropDownList($model, 'course', $courses, $options);
    $html .= '</div>';

    $html .= '</fieldset>
              <fieldset>';

    $adps = CHtml::listData(Adp::model()->getAllAdp(), 'adp1', 'adp2');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'adp1');
    $html .= $form->dropDownList($model, 'adp1', $adps, $options);
    $html .= '</div>';


    if (! SH::is(U_BSAA)) {
        $cns = CHtml::listData(Cn::model()->getAllCn(), 'cn1', 'cn2');
        $html .= '<div class="row-fluid span2">';
        $html .= $form->label($model, 'cn1');
        $html .= $form->dropDownList($model, 'cn1', $cns, $options);
        $html .= '</div>';
    }


    $specialities = CHtml::listData(Spab::model()->getSpecialitiesForEntrance($model), 'spab1', (SH::is(U_BSAA) ? 'spab3' : 'spab14'));
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'speciality');
    $html .= $form->dropDownList($model, 'speciality', $specialities, array_merge($options, array('style' => 'width:200px')));
    $html .= '</div>';


    $button =  <<<HTML
    <div class="row-fluid span2" style="padding:23px 0 0 0">
        <button class="btn btn-info btn-small">
            <i class="icon-key bigger-110"></i>
            %s
        </button>
    </div>
HTML;
    $html .= sprintf($button, tt('Ок'));

    $html .= '</fieldset>';
    $html .= '</div>';

    echo $html;

$this->endWidget();
