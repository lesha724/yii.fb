<?php
/**
 *
 * @var DocsController $this
 */
$this->pageHeader=tt('Добавить документ');
$this->breadcrumbs=array(
    tt('Док.-оборот') => Yii::app()->createUrl('docs/farm', array('docType' => $docType)),
    Ddo::model()->findByPk($docType)->getAttribute('ddo2')
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/docs/farm.js', CClientScript::POS_HEAD);

$pattern = <<<HTML
<div class="control-group">
    %s
    <div class="controls">
        %s
    </div>
</div>
HTML;

$labelOptions = array('class' => 'control-label');

?>

<div class="span12">
    <?php
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'new-document',
            'htmlOptions' => array('class' => 'form-horizontal')
        ));

            $html = '';

            if ($docType == 1) {

                if (Yii::app()->params['code'] === U_NULAU) {
                    $label = $form->label($model, 'tddo12', $labelOptions);
                    $input = $form->textField($model, 'tddo12');
                } else {
                    $label = $form->label($model, 'tddo7', $labelOptions);
                    $input = $form->textField($model, 'tddo7', array('class' => 'input-mini'));
                }

                $html .= sprintf($pattern, $label, $input);
            }

            if ($docType != 1) {
                $label = $form->label($model, 'tddo3', $labelOptions);
                $input = $form->textField($model, 'tddo3');
                $html .= sprintf($pattern, $label, $input);
            }


            echo $html;

        $this->endWidget();
    ?>
</div>