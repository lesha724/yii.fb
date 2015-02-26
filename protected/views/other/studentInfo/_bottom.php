<style>
    .autocomplete-suggestions-w1 { background:url(img/shadow.png) no-repeat bottom right; position:absolute; top:0px; left:0px; margin:6px 0 0 6px; /* IE6 fix: */ _background:none; _margin:1px 0 0 0; }
    .autocomplete-suggestions { border:1px solid #999; background:#FFF; cursor:pointer; text-align:left; max-height:350px; overflow:auto; margin:-6px 6px 6px -6px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
    .autocomplete-selected { background:#F0F0F0; }
    .autocomplete-suggestions div { padding:2px 5px; white-space:nowrap; overflow:hidden; }
    .autocomplete-suggestions strong { font-weight:normal; color:#3399FF; }
</style>
<?php
/**
 * @var CActiveForm $form
 * @var TimeTableForm $model
 * @var stInfoForm $stInfoForm
 */
$params = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');

?>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'fill-data-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    )
));
?>
    <?= $form->errorSummary($stInfoForm) ?>

    <div class="control-group">
        <?= $form->label($stInfoForm, 'st74', array('class' => 'control-label'))?>
        <div class="controls">
            <?= $form->textField($stInfoForm, 'st74', array('autocomplete'=>'off'))?>
        </div>
    </div>

    <div class="control-group">
        <?= $form->label($stInfoForm, 'st75', array('class' => 'control-label'))?>
        <div class="controls">
            <?= $form->textField($stInfoForm, 'st75', array('autocomplete'=>'off'))?>
        </div>
    </div>

    <div class="control-group">
        <?= $form->label($stInfoForm, 'st76', array('class' => 'control-label'))?>
        <div class="controls">
            <?= $form->textField($stInfoForm, 'st76', array('autocomplete'=>'off'))?>
        </div>
    </div>

    <div class="control-group">
        <?= $form->label($stInfoForm, 'st107', array('class' => 'control-label'))?>
        <div class="controls">
            <?= $form->textField($stInfoForm, 'st107', array('autocomplete'=>'off'))?>
        </div>
    </div>

    <div class="control-group">
        <?= $form->label($stInfoForm, 'st34', array('class' => 'control-label'))?>
        <div class="controls">
            <?php
                $specializations = Sp::model()->getSpecializations($stInfoForm->speciality);
                $options = CHtml::listData($specializations, 'spc1', 'spc4');
                echo $form->dropDownList($stInfoForm, 'st34', $options, $params);
            ?>
        </div>
    </div>

    <?php $url1 = $this->createUrl('/other/autocompleteTeachers') ?>
    <?php $url2 = $this->createUrl('/other/updateNkrs') ?>

    <div class="control-group" data-autocompleteUrl="<?= $url1?>" data-updateNkrs="<?= $url2?>">
        <?= CHtml::label(tt('Тема курсовой'), '', array('class' => 'control-label')) ?>
        <div class="controls">
            <?php
                $discipline = D::model()->getDisciplineForCourseWork($model->student);
                list($rus, $eng) = Spkr::model()->findAllInArray();
                if ($discipline) {

                    echo '<strong>'.$discipline['d2'].'</strong>'.'<br>';

                    $courseWork = D::model()->getFirstCourseWork($model->student, $discipline['us1']);

                    $nkrs1 = $courseWork['nkrs1'];
                    $p1    = $courseWork['nkrs6'];
                    $nkrs6 = P::model()->getTeacherNameWithDol($courseWork['nkrs6']);
                    $nkrs7 = $courseWork['nkrs7'];

                    echo CHtml::tag('div', array('data-nkrs1' => $nkrs1)).
                            CHtml::textField('nkrs6', $nkrs6, array('class' => 'autocomplete')).'<br>'.
                            CHtml::dropDownList('nkrs7', $nkrs7, $rus, array('id' => false, 'class' => 'chosen-select', 'style'=>'width:50%')).
                         CHtml::closeTag('div');
                }
            ?>
        </div>
    </div>

    <div class="control-group">
        <?= CHtml::label(tt('Тема курсовой (англ.)'), '', array('class' => 'control-label')) ?>
        <div class="controls">
            <?php
                if ($discipline) {

                    echo '<strong>'.$discipline['d2'].'</strong>'.'<br>';

                    echo CHtml::tag('div').
                            CHtml::dropDownList('nkrs7-eng', $nkrs7, $eng, array('style'=>'width:72%', 'disabled' => true)).
                         CHtml::closeTag('div');
                }
            ?>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>
<?php $this->endWidget(); ?>

<div class="hr hr-18 dotted hr-double"></div>

<?php if (isset($nkrs1)) : ?>
<div class="span4">
        <div class="widget-box">
            <div class="widget-header">
                <h4><?=tt('Антиплагиат')?></h4>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <?php
                        $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'attach-file-form',
                            'htmlOptions' => array(
                                'enctype' => 'multipart/form-data',
                            )
                        ));
                    ?>

                    <fieldset>
                        <?= CHtml::fileField('document', '', array('id' => 'id-input-file-3')) ?>
                        <?= CHtml::hiddenField('nkrs1', $nkrs1) ?>
                        <?= CHtml::hiddenField('nkrs6', isset($p1)?$p1:null) ?>
                    </fieldset>

                    <div class="form-actions center">
                        <button class="btn btn-small btn-success">
                            <?=tt('Отправить')?>
                            <i class="icon-arrow-right icon-on-right bigger-110"></i>
                        </button>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
</div>
<?php endif ?>