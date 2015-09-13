<?php
/**
 *
 * @var OtherController $this
 * @var TimeTableForm $model
 */

Yii::app()->clientScript->registerPackage('autocomplete');
Yii::app()->clientScript->registerPackage('gritter');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/studentInfo.js', CClientScript::POS_HEAD);

if(Yii::app()->user->hasFlash('upload_passport_success')):?>
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><?=tt('Загрузка паспорта')?></h4>
        <?php  echo Yii::app()->user->getFlash('upload_passport_success'); ?>
    </div>
<?php
endif;
if(Yii::app()->user->hasFlash('upload_passport_error')):?>
    <div class="alert alert-block alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><?=tt('Загрузка паспорта')?></h4>
        <?php  echo Yii::app()->user->getFlash('upload_passport_error'); ?>
    </div>
<?php
endif;
$this->pageHeader=tt('Данные студента');
$this->breadcrumbs=array(
    tt('Другое'),
);

?>

<?php
    if ($canSelectSt) {

        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);
        
        $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'search-form',
            'htmlOptions' => array('class' => 'form-inline noprint'),
                'method'=>'post',
                'action'=> array('other/searchStudent'),
        ));
        ?>
                <?php echo $form->textField($student,'st2',array('size'=>60,'maxlength'=>255)); ?>

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'primary',
                        'icon'=>'search',
                        'label'=>tt('Поиск'),
                        'htmlOptions'=>array(
                                'class'=>'btn-small'
                        )
                )); ?>
                <?php
        $this->endWidget();

        $this->renderPartial('/filter_form/timeTable/student', array(
            'model' => $model,
            'showDateRangePicker' => false,
            'showCheckBoxCalendar'=>false
        ));

        echo <<<HTML
            <div class="hr hr-18 dotted hr-double"></div>
HTML;
    }

    if ($model->student) :

        $this->renderPartial('studentInfo/_bottom', array(
            'model' => $model,
            'stInfoForm' => $stInfoForm,
            'canSelectSt' => $canSelectSt,
        ));

    endif;
?>