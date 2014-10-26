<style>
    div#students_wrapper {
        width:50%
    }
</style>
<?php
/**
 * @var OtherController $this
 * @var FilterForm $model
 */
?>

<table id="students" class="table table-striped table-bordered table-hover small-rows" >
    <thead>
        <tr>
            <th style="width:15%"><?=tt('Рейтинг')?></th>
            <th><?=tt('Ф.И.О.')?></th>
            <th><?=tt('Общий балл')?></th>
        </tr>
    </thead>

    <tbody>
    <?php
        $html = '';
        $sum  = 0;
        $rating = 1;

        foreach ($students as $student) {

            $link = CHtml::link($student['st2'].' '.$student['st3'].' '.$student['st4'], $this->createUrl('other/employment', array('id' => $student['st1'])));
            $html .= <<<HTML
        <tr>
            <td>$rating</td>
            <td>$link</td>
            <td>$sum</td>
        </tr>
HTML;

            if ($student['s'] != $sum) {
                $sum = $student['s'];
                $rating++;
            }

        }

        echo $html;
    ?>
    </tbody>
</table>