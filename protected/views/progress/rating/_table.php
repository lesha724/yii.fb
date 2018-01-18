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
            <th><?=$model->getAttributeLabel('course')?></th>
            <th><?=($ps81==0)?tt('5'):tt('Многобальная')?></th>
            <th><?=tt('Не сдано')?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        $val='0';
        $val100='0';

        foreach($rating as $key)
        {
            $_bal = round($key[$tmp], 2);
            if($_bal!=$val)
            {
                $val=$_bal;
                $i++;
            }

            echo '<tr>'.
                '<td>'.$i.'</td>'.
                '<td>'.ShortCodes::getShortName($key['fio'], $key['name'], $key['otch']).'</td>'.
                '<td>'.$key['group_name'].'</td>'.
                '<td>'.$key['kyrs'].'</td>'.
                '<td>'.$_bal.'</td>'.
                '<td>'.$key['ne_sdano'].'</td>'.
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