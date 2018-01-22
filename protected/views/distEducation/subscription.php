<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 12.01.2018
 * Time: 11:50
 */

/* @var $this DistEducationController */
/* @var $model DistEducationFilterForm */

$this->pageHeader=tt('Дистанционное образование: запись');
$this->breadcrumbs=array(
    tt('Дистанционное образование'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/distEducation/subscription.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/default/year_sem');

$discipline = $model->discipline;

echo <<<HTML
    <span id="spinner1"></span>
HTML;

/**
 * @var $form CActiveForm
 */
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

$chairs = CHtml::listData(K::model()->getAllChairs(), 'k1', 'k3');
echo CHtml::dropDownList('chairId', $model->chairId, $chairs, array('class'=>'chosen-select chosen-chairId', 'autocomplete' => 'off', 'empty' => ''));



if(!empty($model->chairId)) {



    echo '<div>';

    $disciplines = CHtml::listData($model->getDispListForDistEducation(true)->data, 'uo1', function ($data) {
        return $data['d2'] . ' / ' . $data['sp2'] . '-'.$data['sem4'].' курс';
    });

    echo '<fieldset>'.
        '<div class="span2 ace-select">' .
            $form->label($model, 'discipline') .
            $form->dropDownList($model, 'discipline', $disciplines, array('class' => 'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')) .
        '</div>';
    echo '</fieldset>';
    echo '</div>';

}

$this->endWidget();




if(!empty($discipline)):

    echo $this->renderPartial('subscription/_bottom', array(
        'model'=>$model
    ));

    $this->beginWidget(
        'bootstrap.widgets.TbModal',
        array(
            'id' => 'modalBlock',
            'htmlOptions'=>array(
                'class'=>'full-modal'
            )
        )
    ); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4></h4>
    </div>

    <div class="modal-body" style="overflow-y: unset">
        <div id="modal-content" >

        </div>
    </div>

    <div class="modal-footer">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Закрыть'),
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>

    <?php $this->endWidget();

endif;