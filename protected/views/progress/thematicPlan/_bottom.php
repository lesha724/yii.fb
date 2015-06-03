<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');

$data = CHtml::listData(Sem::model()->getSemestersForThematicPlan($model->group), 'us3', 'sem7', 'name');
$html  ='<div class="row-fluid">';
$html .= '<div class="span3 ace-select">';
$html .= CHtml::label(tt('Семестр'), 'FilterForm_semester');
$html .= CHtml::dropDownList('FilterForm[semester]', $model->semester, $data, $options);
$html .= '</div>';
$disciplines = CHtml::listData(D::model()->getDisciplineForThematicPlan($model->group,$model->semester), 'uo1', 'd2');
$html .='<div class="span3 ace-select">'.
		CHtml::label($model->getAttributeLabel('discipline'), 'FilterForm_discipline').
		CHtml::dropDownList('FilterForm[discipline]', $model->discipline, $disciplines,$options).
	'</div>';
$lessons = CHtml::listData(Us::model()->getLessonsForThematicPlan($model->semester,$model->discipline), 'us1', 'type');
$html .='<div class="span3 ace-select">'.
		CHtml::label($model->getAttributeLabel('type_lesson'), 'FilterForm_type_lesson').
		CHtml::dropDownList('FilterForm[type_lesson]', $model->type_lesson, $lessons,$options).
	'</div>';
$html .= '</div>';
echo $html;

if (!empty($model->type_lesson)) {
    $urlDelete = Yii::app()->controller->createAbsoluteUrl("progress/deleteUstemTheme", array("ustem1" => ''));
    $urlEdit   = Yii::app()->controller->createAbsoluteUrl("progress/renderUstemTheme", array('d1' => $model->discipline,"ustem1" =>''));
    $type0=('Занятие');
    $type1=('Субмодуль');
     Yii::app()->clientScript->registerScript('url_ustem6', <<<JS
        urlDelete       = "{$urlDelete}"
        urlEdit    = "{$urlEdit}"
        type0="{$type0}"
        type1="{$type1}"
JS
    , CClientScript::POS_READY);
    
?>
<div class="row-fluid" >
	
    <h3 class="header smaller lighter blue"><?=tt('Темы занятий')?></h3>
	<button class="btn btn-mini btn-success" name="add-thematic-plan">
        <i class="icon-plus"></i>
        <?=tt('Добавить тематический план')?>
    </button>
<?php $urlInsert   = Yii::app()->controller->createAbsoluteUrl("progress/insertUstemTheme");?>
    <table id="themes" data-us1="<?=$model->type_lesson?>" data-url="<?=$urlInsert?>" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th><?=tt('№ занятия')?></th>
            <th><?=tt('№ темы')?></th>
            <th><?=tt('Тема')?></th>
            <th><?=tt('Тип')?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $themes = Ustem::model()->getTheme($model->type_lesson);

                $html = '';
                $i = 1;
                foreach ($themes as $theme) {

                    $tip = $theme['ustem6'] == 0 ? tt('Занятие') : tt('Субмодуль');
                    $urlDelete = Yii::app()->controller->createAbsoluteUrl("progress/deleteUstemTheme", array("ustem1" => $theme['ustem1']));
                    $urlEdit   = Yii::app()->controller->createAbsoluteUrl("progress/renderUstemTheme", array("ustem1" => $theme['ustem1'], 'd1' => $model->discipline));

                    $html .= <<<HTML
                        <tr>
							<td>$theme[ustem4]</td>
                            <td>$theme[ustem3]</td>
                            <td>$theme[ustem5]</td>
                            <td>$tip</td>
                            <td>
                                <a href="$urlEdit" class="edit-theme btn btn-mini btn-info">
                                    <i class="icon-edit bigger-120"></i>
                                </a>
                                <a href="$urlDelete" class="delete-theme btn btn-mini btn-danger">
                                    <i class="icon-trash bigger-120"></i>
                                </a>
                            </td>
                        </tr>
HTML;
                    $i++;
                }
                echo $html;
            ?>
        </tbody>
    </table>

    <button class="btn btn-mini btn-danger" name="delete-thematic-plan">
        <i class="icon-trash"></i>
        <?=tt('Удалить тематический план')?>
    </button>
<?php
?>
</div>
<div id="dialog-confirm" class="hide" title="Empty the recycle bin?">
    <div class="alert alert-info bigger-110">
        <?=tt('Все темы будут удалены')?>
    </div>

    <div class="space-6"></div>

    <p class="bigger-110 bolder center grey">
        <i class="icon-hand-right blue bigger-120"></i>
        <?=tt('Вы уверены?')?>
    </p>
</div><!-- #dialog-confirm -->
<div id="dialog-confirm-add" data-action="<?= Yii::app()->controller->createAbsoluteUrl("progress/addUstemTheme")?>" class="hide" title="Empty the recycle bin?">
	<div class="control-group">
	  <label class="control-label" for="count-rows"><?=tt('Количество занятий')?></label>
	  <div class="controls">
		<input type="number" id="count-rows">
		<span class="help-inline" style="display:none"><?=tt('Введите коректные данные')?></span>
	  </div>
	</div>
</div><!-- #dialog-confirm -->
<?php } ?>