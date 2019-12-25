<?php
/**
 * @var PortfolioFarmController $this
 * @var AcceptProgressDataForm $model
 * @var $form TbActiveForm
 */

$this->pageHeader=tt('Согласие на обработку персональных данных');
$this->breadcrumbs=array(
    $this->pageHeader,
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm');

echo $form->checkBoxRow($model, 'accept');
?>
    <div class="buttons">
        <?php echo CHtml::submitButton( tt('Отправить'), array(
            'class' => 'btn btn-small btn-success'
        )); ?>
    </div>
<?php
$this->endWidget();