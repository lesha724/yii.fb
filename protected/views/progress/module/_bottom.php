<?php
/**
 * @var ProgressController $this
 * @var ModuleForm $model
 */

$html  = '<div class="row-fluid" style="margin-bottom:2%">';
$html .= '<div class="span3 ace-select">';
$html .= CHtml::activeLabel($model, 'countModules');
$html .= CHtml::activeNumberField($model, 'countModules', [
    'disabled' => $model->countModules > 0
]);
$html .= '</div>';
$html .= '</div>';

echo $html;

if(!empty($model->countModules)) {
    $modules = $model->getModules();
    $this->renderPartial('module/_modules', array(
        'model' => $model,
        'modules' => $modules
    ));

    if(isset($modules[$model->module]))
        $this->renderPartial('module/_module', array(
            'model' => $model,
            'module' => $modules[$model->module]
        ));
}
