<?php
/**
 * @var OtherController $this
 * @var array $students
 */

foreach ($students as $gr => $students) : ?>

    <table class="table table-striped table-bordered table-hover small-rows" style="width:55%;">
        <thead>
            <tr>
                <th style="width:5%"><?=tt('Рейтинг')?></th>
                <th><?=tt('Группа')?></th>
                <th><?=tt('Ф.И.О.')?></th>
                <th><?=tt('Средний балл')?></th>
            </tr>
        </thead>
    <tbody>
    <?php
        $html = '';
        $avg  = $rating = 0;

        foreach ($students as $student) {

            if ($student['avg'] != $avg) {
                $avg = $student['avg'];
                $rating++;
            }

            $title = $student['st2'].' '.$student['st3'].' '.$student['st4'];
            $href  = $this->createUrl('other/employment', array('id' => $student['st1']));
            $link  = CHtml::link($title, $href, array('target'=>'_blank'));

            $html .= <<<HTML
            <tr>
                <td>$rating</td>
                <td>$gr</td>
                <td>$link</td>
                <td>$avg</td>
            </tr>
HTML;

        }

        echo $html;
    ?>
    </tbody>
</table>
<?php endforeach;