<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 11.09.2019
 * Time: 12:42
 */


/**
 * @var PortfolioFarmController $this
 * @var Stppart $model
 */

/**
 * @var $form TbActiveForm
 */

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array());
echo CHtml::errorSummary($model);
echo $form->dropDownListRow($model, 'stppart3', $model->getStppart3Types());
echo $form->textFieldRow($model, 'stppart4');
echo $form->textFieldRow($model, 'stppart5', array(
    'type' => 'number'
));
echo $form->dropDownListRow($model, 'stppart6', $model->getStppart6Types());
echo $form->dropDownListRow($model, 'stppart7', $model->getStppart7Types());
echo $form->dropDownListRow($model, 'stppart8', $model->getStppart8Types());
?>
<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? tt('Добавить') : tt('Изменить'), array(
		        'class' => 'btn btn-small btn-success'
        )); ?>
</div>
<?php
$this->endWidget();