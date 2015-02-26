<div class="row-fluid" style="margin-top:2%">

    <h3 class="header smaller lighter blue"><?=tt('Список экзаменов')?></h3>

    <?php
        $alert = <<<HTML
<div class="alert alert-info">
    <button data-dismiss="alert" class="close" type="button">
        <i class="icon-remove"></i>
    </button>
    <strong>%s</strong>
    %s
    <br>
</div>
HTML;

        $dateStart = PortalSettings::model()->findByPk(21)->getAttribute('ps2');
        $dateEnd   = PortalSettings::model()->findByPk(22)->getAttribute('ps2');

        $showAlert = ! empty($dateStart) &&
                     ! empty($dateEnd);

        if ($showAlert)
            echo sprintf(
                $alert,
                tt('Внимание').'!',
                tt('Отменить подписку на экзамен Вы можете в течении следующего периода времени').': '.'<strong>'.$dateStart.' - '.$dateEnd.'</strong>');
    ?>

    <table id="gostems" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>№</th>
            <th><?=tt('Кафедра')?></th>
            <th><?=tt('Гос. экзамен')?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
            $gostems = Nrst::model()->getGostemsForStudent();

            $today = strtotime('now');
            $canDelete = strtotime($dateStart) <= $today &&
                         strtotime($dateEnd)   >= $today;

            $html = '';
            $i = 1;
            foreach ($gostems as $gostem) {

                $href   = Yii::app()->createUrl('other/deleteGostem', array('nrst1' => $gostem['nrst1'], 'nrst3' => $gostem['nrst3']));
                $button = $canDelete
                            ? CHtml::link('<i class="icon-trash bigger-120"></i>', $href, array('class' => 'delete-item btn btn-mini btn-danger'))
                            : '';

                $html .= <<<HTML
                    <td>$i</td>
                    <td>$gostem[k3]</td>
                    <td>$gostem[gostem4]</td>
                    <td>$button</td>
HTML;
                $i++;
            }
            echo $html;
        ?>
        </tbody>
    </table>
</div>