<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 18.01.2018
 * Time: 19:41
 */

/**
 * @var $model RatingForm
 */
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'primary',
    'icon'=>'print',
    'label'=>tt('Печать'),
    'htmlOptions'=>array(
        'class'=>'btn-mini',
        'id'=>'rating-print',
    )
));


$rating = $model->getRating($model->ratingType==1 ? RatingForm::COURSE : RatingForm::GROUP);

if(!empty($rating))
{
    ?>
    <table id="rating" class="table table-striped table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:40px">№</th>
            <th><?=tt('Ф.И.О.')?></th>
            <th><?=$model->getAttributeLabel('group')?></th>
            <th><?=tt('Балл')?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        $val='';

        foreach($rating as $key)
        {
            $_bal = round($key['value'], 2);
            if($_bal!=$val)
            {
                $val=$_bal;
                $i++;
            }

            echo '<tr>'.
                '<td>'.$i.'</td>'.
                '<td>'.ShortCodes::getShortName($key['stInfo']['st2'], $key['stInfo']['st3'], $key['stInfo']['st4']).'</td>'.
                '<td>'.$key['stInfo']['group'].'</td>'.
                '<td>'.$_bal.'</td>'.
                /*'<td>'.$key['stInfo']['sym100'].'</td>'.
                '<td>'.$key['stInfo']['count'].'</td>'.*/
                '</tr>';
        }
        ?>
        </tbody>
    </table>
    <?php
}else
{
    ?>
    <div class="alert alert-danger" role="alert">
        <?=tt('Нет данных')?>
    </div>
    <?php
}