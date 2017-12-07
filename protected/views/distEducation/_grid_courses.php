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
/** @var array $coursesList*/
/**
 * @var DistEducation $connector
 */

$thead = $tbody = '';

$columns = $connector->getColumnsForGridView();

$idName = $connector->getNameIdFiled();

foreach ($columns as $key=>$column){
    $thead.=<<<HTML
        <th>{$column['header']}</th>
HTML;
}

$thead= '<tr>'.$thead.'<th></th></tr>';

foreach ($coursesList as $course) {
    $tbody .= '<tr>';
    foreach ($columns as $key => $column) {
        $tbody .= <<<HTML
            <td>{$course->$key}</td>
HTML;
    }

    $tbody.=<<<HTML
        <td>
            <button class="btn btn-small btn-success btn-save-link" data-id="{$course->$idName}"><i class="icon-ok"></i></button>
        </td>
HTML;

    $tbody.='</tr>';
}

?>

<table id="courses-list" class="table table-striped table-bordered table-hover">
    <thead>
        <?=$thead?>
    </thead>
    <tbody>
        <?=$tbody?>
    </tbody>
</table>


