<?php
/* @var $this DefaultController
 * @var $model FilterForm
 */


if (!empty($model->group))
{
    /*$this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'button',
        'type'=>'primary',
        'icon'=>'print',
        'label'=>tt('Печать'),
        'htmlOptions'=>array(
            'class'=>'btn-small',
            'data-url'=>Yii::app()->createUrl('/progress/modulesExcel'),
            'id'=>'btn-print',
        )
    ));*/

    $bal = Cxmb::model()->findAll();

    /*$js_array = json_encode($bal);
    Yii::app()->clientScript->registerScript('journal-pbal', <<<JS
        var bpal  = {$js_array};
JS
        , CClientScript::POS_HEAD);*/

    $this->renderPartial('/filter_form/default/_refresh_filter_form_button');

    list($uo1,$gr1)=explode('/',$model->group);
    $students=Jpv::model()->getStudents($uo1,$gr1);

    Jpv::model()->fillPermition($uo1, $gr1);

    $modules = Jpv::model()->getModules($model->group);
    $url = Yii::app()->createUrl('/progress/getCxmb');
    echo '<div id="modules" data-url-cxmb="'.$url.'">';
    $this->renderPartial('modules/_table_1', array(
        'students' => $students,
        'uo1'=>$uo1,
        'gr1'=>$gr1,
        'model' => $model,
    ));

    $this->renderPartial('modules/_table_2', array(
        'students' => $students,
        'modules'=>$modules,
        'cxm' => $this->getCxmByUo1AndSemestr($uo1),
        'uo1'=>$uo1,
        'gr1'=>$gr1,
        'model' => $model,
    ));
    $ps42 = PortalSettings::model()->findByPk(42)->ps2;
    if($ps42==1)
    $this->renderPartial('modules/_table_3', array(
        'students' => $students,
        'uo1'=>$uo1,
        'gr1'=>$gr1,
        'model' => $model,
        'bal'=>$bal
    ));
    echo '</div>';
}
