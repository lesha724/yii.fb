<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 12.01.2018
 * Time: 15:54
 */

/* @var $this DistEducationController */
/* @var $model DistEducationFilterForm */

$groups = $model->getGroupsByUo1($model->discipline);

foreach ($groups as $group){

}

echo sprintf($table, $tbody);
