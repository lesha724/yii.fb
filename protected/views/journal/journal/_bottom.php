<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */


if (! empty($model->group)):

    echo '<div class="container">';
    $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'type'=>'primary',
                
		'icon'=>'print',
		'label'=>tt('Печать'),
		'htmlOptions'=>array(
            'class'=>'btn-small',
            'data-url'=>Yii::app()->createUrl('/journal/journalExcel'),
            'id'=>'journal-print',
		)
	));

    $this->renderPartial('/filter_form/default/_refresh_filter_form_button');?>

    <div class="control-group inline pull-right">
    <?=CHtml::label(tt('Показывать кнопку отработки'), 'showRetake', array('class' => 'control-label'))?>
        <div class="controls">
            <label>
                <?php
                echo CHtml::checkBox('showRetake', Yii::app()->user->getState('showRetake',0),
                    array(
                        'class' => 'ace ace-switch',
                        'uncheckValue' => '0'
                    )
                );
                ?>
                <span class="lbl"></span>
            </label>
        </div>
    </div>
<?php


    list($uo1,$gr1) = explode("/", $model->group);
    $dates = R::model()->getDatesForJournal(
            $uo1,
            $gr1,
            $model->type_lesson
    );

    $elg1=Elg::getElg1($uo1,$model->type_lesson);
    $elg = Elg::model()->findByPk($elg1);
    if(empty($elg))
        throw new CHttpException(404, tt('Не задана структура журнала. Обратитесь к Администратору системы').'.');

    $ps9  = PortalSettings::model()->findByPk(9)->ps2;
    //$ps20 = PortalSettings::model()->findByPk(20)->ps2;// use sub modules
    $ps33=PortalSettings::model()->findByPk(33)->ps2;

    $students = St::model()->getStudentsForJournal($gr1, $uo1);
    echo '</div>';
    echo '<div class="journal-bottom">';

    $this->renderPartial('journal/_table_1', array(
        'students' => $students
    ));
    //доп колонки
    $elgd=Elgd::model()->getDop($elg1);

    $classTable2='journal_div_table2';
    if($model->type_lesson==0 || empty($elgd))
        $classTable2='journal_div_table2 journal_div_table2_1';

    $this->renderPartial('journal/_table_2', array(
        'students' => $students,
        'dates'=>$dates,
        'elg'=>$elg,
        'uo1'=>$uo1,
        'gr1'=>$gr1,
        //'ps20'  => $ps20,
        'ps33'  => $ps33,
        'ps9'  => $ps9,
        'read_only'=>$read_only,
        'model' => $model,
        'classTable2'=>$classTable2
    ));


    if($model->type_lesson!=0&&!empty($elgd))
    {
        $this->renderPartial('journal/_table_3', array(
            'students' => $students,
            'elgd'=>$elgd,
            'elg'=>$elg,
            'read_only'=>$read_only
        ));
    }

    echo '</div>';

    Yii::app()->clientScript->registerScript('journal-vars', <<<JS
        ps9  = {$ps9};
JS
        , CClientScript::POS_HEAD);

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