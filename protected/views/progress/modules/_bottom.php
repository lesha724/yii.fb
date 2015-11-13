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

    $this->renderPartial('/filter_form/default/_refresh_filter_form_button');

    list($uo1,$gr1)=explode('/',$model->group);
    $students=Jpv::model()->getStudents($uo1,$gr1);

    $modules = Jpv::model()->getModules($model->group);
    echo '<div id="modules">';
    $this->renderPartial('modules/_table_1', array(
        'students' => $students,
        'uo1'=>$uo1,
        'gr1'=>$gr1,
        'model' => $model,
    ));

    $this->renderPartial('modules/_table_2', array(
        'students' => $students,
        'modules'=>$modules,
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
    ));
    echo '</div>';
}
