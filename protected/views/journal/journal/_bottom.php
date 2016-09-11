<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */
if(!empty($model->group)):
list($uo1,$gr1) = explode("/", $model->group);

$sem1List =  Sem::model()->getSem1List($uo1);
if(count($sem1List)!=1) {
    $options =  array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');

    $html  = '<div class="span2 ace-select" style="width:100%;margin-left: 0px;margin-bottom: 5px;">';
    $html .= CHtml::label($model->getAttributeLabel('sem1'), 'FilterForm_sem1');
    $html .= CHtml::dropDownList('FilterForm[sem1]', $model->sem1, CHtml::listData($sem1List, 'sem1', 'name'), $options);
    $html .= '</div>';

    echo $html;
}else
{
    $elem =  current($sem1List);
    $model->sem1 = $elem['sem1'];
}

if (!empty($model->sem1)):

    $dates = R::model()->getDatesForJournal(
            $uo1,
            $gr1,
            $model->type_lesson,
            $model->sem1
    );

    $us = Us::model()->findByAttributes(array('us2'=>$uo1,'us3'=>$model->sem1));

    if(count($dates)==0)
        throw new CHttpException(404, tt('Не найдены занятия.'));

    echo '<div class="container">';
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'button',
        'type'=>'primary',

        'icon'=>'print',
        'label'=>tt('Печать'),
        'htmlOptions'=>array(
            'class'=>'btn-small',
            'data-url'=>Yii::app()->createUrl('/journal/journalExcel',array('sem1'=>$model->sem1)),
            'id'=>'journal-print',
        )
    ));

    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'button',
        'type'=>'success',

        'icon'=>'print',
        'label'=>tt('Печать Итог'),
        'htmlOptions'=>array(
            'class'=>'btn-small',
            'data-url'=>Yii::app()->createUrl('/journal/journalExcelItog',array('sem1'=>$model->sem1)),
            'id'=>'journal-print-itog',
        )
    ));

    $this->renderPartial('/filter_form/default/_refresh_filter_form_button');

    ?>
        <span><label class="label label-warning">&nbsp;&nbsp;</label> - <?=tt('Информация требует обновления страницы')?></span>
    <?php

    $elg1=Elg::getElg1($uo1,$model->type_lesson,$model->sem1);
    $elg = Elg::model()->findByPk($elg1);
    if(empty($elg))
        throw new CHttpException(404, tt('Не задана структура журнала. Обратитесь к Администратору системы').'.');

    $ps9  = PortalSettings::model()->findByPk(9)->ps2;
    $ps20 = PortalSettings::model()->findByPk(20)->ps2;// use sub modules
    $ps56 = PortalSettings::model()->findByPk(56)->ps2;//
    $ps57 = PortalSettings::model()->findByPk(57)->ps2;//
    $ps33=PortalSettings::model()->findByPk(33)->ps2;

    $students = St::model()->getStudentsForJournal($gr1, $uo1);
    echo '</div>';
    echo '<div class="journal-bottom">';

    $this->renderPartial('journal/_table_1', array(
        'students' => $students
    ));
    //доп колонки
    Elgd::checkEmptyElgd($elg1);
    $elgd=Elgd::model()->getDop($elg1);

    $modules = null;
    if($ps57==1)
        $modules = Vvmp::model()->getModule($uo1,$gr1);

    $exam = null;
    /*if($ps57==1)
        $xam = Stus::model()->getExam($uo1,$gr1,$model->sem1,$model->discipline);*/

    $classTable2='journal_div_table2';
    if($model->type_lesson==0 /*|| empty($elgd)*/)
        $classTable2='journal_div_table2 journal_div_table2_1';

    $this->renderPartial('journal/_table_2', array(
        'students' => $students,
        'dates'=>$dates,
        'elg'=>$elg,
        'uo1'=>$uo1,
        'gr1'=>$gr1,
        'ps20'  => $ps20,
        'ps33'  => $ps33,
        'ps55'  => $ps55,
        'ps56'  => $ps56,
        'ps57'  => $ps57,
        'ps88'  => $ps88,
        'ps9'  => $ps9,
        'modules'=>$modules,
        'read_only'=>$read_only,
        'model' => $model,
        'classTable2'=>$classTable2
    ));


    if($model->type_lesson!=0/*&&!empty($elgd)*/)
    {
        $this->renderPartial('journal/_table_3', array(
            'students' => $students,
            'elgd'=>$elgd,
            'elg'=>$elg,
            'read_only'=>$read_only,
            'ps44'=>$ps44,
            'us'=>$us,
            'gr1'=>$gr1,
            'model'=>$model
        ));
    }

    echo '</div>';

    Yii::app()->clientScript->registerScript('journal-vars', <<<JS
        ps9  = {$ps9};
JS
        , CClientScript::POS_HEAD);

    endif;
 endif;
?>

<div id="dialog-confirm" class="hide" title="Empty the recycle bin?">
    <div class="alert alert-info bigger-110">
        <?=tt('По данному пропуску есть отработки. Все отработки будут удалены!')?>
    </div>

    <div class="space-6"></div>

    <p class="bigger-110 bolder center grey">
        <i class="icon-hand-right blue bigger-120"></i>
        <?=tt('Вы уверены?')?>
    </p>
</div><!-- #dialog-confirm -->

<?php  $this->beginWidget(
        'bootstrap.widgets.TbModal',
        array(
            'id' => 'modalRetake',
            'htmlOptions'=>array('data-url'=>Yii::app()->createUrl('/journal/saveJournalRetake'))
        )
    ); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4></h4>
    </div>

    <div class="modal-body">
        <div id="modal-content">

        </div>
    </div>

    <div class="modal-footer">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Сохранить'),
                'type'=>'info',
                'url' => '#',
                'htmlOptions' => array('id' => 'save-retake-journal'),
            )
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Отмена'),
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>

<?php $this->endWidget();


$this->beginWidget(
    'bootstrap.widgets.TbModal',
    array(
        'id' => 'modalChangeTheme',
        'htmlOptions'=>array('data-url'=>Yii::app()->createUrl('/journal/saveChangeTheme'))
    )
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4></h4>
    </div>

    <div class="modal-body">
        <div id="modal-content">

        </div>
    </div>

    <div class="modal-footer">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Сохранить'),
                'type'=>'info',
                'url' => '#',
                'htmlOptions' => array('id' => 'change-theme-journal'),
            )
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Отмена'),
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>

<?php $this->endWidget();