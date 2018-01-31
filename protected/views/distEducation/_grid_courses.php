<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 06.12.2017
 * Time: 22:33
 */


function evaluateExpression($_expression_,$_data_=array())
{
    if(is_string($_expression_))
    {
        extract($_data_);
        try
        {
            return eval('return ' . $_expression_ . ';');
        }
        catch (ParseError $e)
        {
            return false;
        }
    }
    else
    {
        return call_user_func_array($_expression_, $_data_);
    }
}
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
        $value = '';

        if(isset($column['value'])){
            $value = evaluateExpression($column['value'], array(
                'course'=>$course
            ));
        }else
            $value = $course->$key;

        $tbody .= <<<HTML
                <td>{$value}</td>
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


