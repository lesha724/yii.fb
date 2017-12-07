<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 06.12.2017
 * Time: 22:33
 */

/**
 * @var $model DistEducationFilterForm
 */
/** @var $this DistEducationController */
/** @var array $disp */
/** @var DistEducationFilterModel $searchModel */
/** @var CArrayDataProvider $dataProvider */
/**
 * @var DistEducation $connector
 */

$params = array(
    'uo1'=>$disp['uo1'],
    'k1'=>$model->chairId
);

$this->widget('bootstrap.widgets.TbGridView', array(
    'ajaxUrl' => Yii::app()->createAbsoluteUrl('/distEducation/searchCourse', $params),
    'id'=>'courses-grid-disteducation',
    'dataProvider'=>$dataProvider,
    'columns'=>$connector->getColumnsForGridView(),
    'filter'=>$searchModel,
));
