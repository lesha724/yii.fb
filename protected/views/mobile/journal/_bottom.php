<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 10.02.2016
 * Time: 9:38
 */

if(!empty($model->group)):
list($uo1,$gr1) = explode("/", $model->group);
$dates = R::model()->getDatesForJournal(
    $uo1,
    $gr1,
    $model->type_lesson
);

    $ps9  = PortalSettings::model()->findByPk(9)->ps2;
    $ps20 = PortalSettings::model()->findByPk(20)->ps2;// use sub modules
    $ps56 = PortalSettings::model()->findByPk(56)->ps2;//
    $ps57 = PortalSettings::model()->findByPk(57)->ps2;//
    $ps33=PortalSettings::model()->findByPk(33)->ps2;

$elg1=Elg::getElg1($uo1,$model->type_lesson);
$elg = Elg::model()->findByPk($elg1);
if(empty($elg))
    throw new CHttpException(404, tt('Не задана структура журнала. Обратитесь к Администратору системы').'.');

$students = St::model()->getStudentsForJournal($gr1, $uo1);

$modules = null;
$ps57 = PortalSettings::model()->findByPk(57)->ps2;
if($ps57==1)
    $modules = Vvmp::model()->getModule($uo1,$gr1);
?>
<div class="panel-actions row">
    <div class="form-actions col-xs-12">
        <button id="lesson-left" class="btn col-xs-2" type="button"><i class="arrow glyphicon arrow-left"></i></button>
        <div class="form-group col-xs-8">
            <?= CHtml::dropDownList('lesson-list',1, CHtml::listData($dates,'elgz3','text'), array('class'=>'form-control','data-count'=>count($dates)));?>
        </div>
        <button id="lesson-right" class="btn col-xs-2 disabled" type="button" disabled="disabled"><i class="arrow glyphicon arrow-right"></i></button>
    </div>
</div>
<div class="col-xs-12 table-journal">
    <div class="journal-bottom table-responsive">
        <?php
        $this->renderPartial('journal/_table', array(
            'students' => $students,
            'dates'=>$dates,
            'elg'=>$elg,
            'uo1'=>$uo1,
            'gr1'=>$gr1,
            'ps20'  => $ps20,
            'ps33'  => $ps33,
            'ps55'  => $ps55,
            'modules'=>$modules,
            'read_only'=>$read_only,
            'ps56'  => $ps56,
            'ps57'  => $ps57,
            'ps9'  => $ps9,
            'model' => $model,
        ));
        ?>
    </div>
</div>
<?php
endif;

