<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 11.09.2019
 * Time: 12:42
 */


/**
 * @var PortfolioFarmController $this
 * @var Stpeduwork $model
 */

/**
 * @var $form TbActiveForm
 */

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array());
echo CHtml::errorSummary($model);
echo $form->dropDownListRow($model, 'stpeduwork3', $model->getStpeduwork3Types());
echo $form->textFieldRow($model, 'stpeduwork4');
echo $form->dropDownListRow($model, 'stpeduwork5', Stportfolio::getYears());
?>
<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? tt('Добавить') : tt('Изменить'), array(
		        'class' => 'btn btn-small btn-success'
        )); ?>
</div>
<?php
$this->endWidget();