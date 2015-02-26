<?php
/**
 * @var WorkPlanController $this
 * @var FilterForm $model
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');

$data = CHtml::listData(Sem::model()->getSemestersForWorkPlan($model->group, $type), 'us3', 'sem7', 'name');

$html  = '<div class="row-fluid" style="margin-bottom:2%">';
$html .= CHtml::label(tt('Семестр'), 'FilterForm_semester');
$html .= CHtml::dropDownList('FilterForm[semester]', $model->semester, $data, $options);
$html .= '</div>';

echo $html;

if (! empty($model->semester)) :

        $disciplines = D::model()->getDisciplinesForWorkPlan($model, $type);

        $getGroupUrl = Yii::app()->createUrl('workLoad/getGroups');

        $types = array(
            15 => 'ECTS',
            19 => tt('Нац. кр'),
            0 => tt('Всего'),
            1 => tt('Лк'),
            2 => tt('Пз'),
            3 => tt('Сем'),
            4 => tt('Лб'),
            16 => tt('Кнч'),
            5 => tt('Экз'),
            6 => tt('Зч'),
            8 => tt('КП'),
            7 => tt('Кр'),
        );
?>

<table id="disciplines" class="table table-striped table-bordered table-hover small-rows"  data-getGroupUrl="<?=$getGroupUrl?>">
    <thead>
        <tr>
            <th rowspan="2">№</th>
            <th rowspan="2" style="width:25%"><?=tt('Дисциплина')?></th>
            <th rowspan="2">ECTS</th>
            <th rowspan="2"><?=tt('Нац. кр')?></th>
            <th colspan="6"><?=tt('Часов по плану')?></th>
            <th rowspan="2"><?=tt('Экз')?></th>
            <th rowspan="2"><?=tt('Зач')?></th>
            <th rowspan="2"><?=tt('КП')?></th>
            <th rowspan="2"><?=tt('Кр')?></th>
            <th rowspan="2"><?=tt('Кафедра')?></th>
        </tr>
        <tr>
            <th><?=tt('Всего')?></th>
            <th><?=tt('Лк')?></th>
            <th><?=tt('Пз')?></th>
            <th><?=tt('Сем')?></th>
            <th><?=tt('Лб')?></th>
            <th><?=tt('Кнч')?></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $html = '';
        foreach ($disciplines as $key => $discipline) {

            $html .= <<<HTML
                <tr>
                    <td>{$key}</td>
                    <td>{$discipline['d2']}</td>
HTML;

            foreach ($types as $type => $name) {
                $hours = isset($discipline['hours'][$type]) ? round($discipline['hours'][$type],2) : null;
                if (in_array($type, array(5,6,7,8)) && !is_null($hours))
                    $hours = '<span class="label label-warning">+</span>';

                $html .= '<td>'.$hours.'</td>';
            }

            $html .= <<<HTML
                    <td>{$discipline['k2']}</td>
                </tr>
HTML;

        }
        echo $html;
    ?>
    </tbody>
</table>

<?php endif ?>
