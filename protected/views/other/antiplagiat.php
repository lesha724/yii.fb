<?php
/**
 * @var OtherController $this
 * @var $student St
 * @var $nkrsList mixed
 * @var $year int
 */

$this->pageHeader=tt('Антиплагиат');
$this->breadcrumbs=array(
    tt('Другое'),
);

$course = tt('Курс');
$chair = tt('Кафедра');
$themeRus = tt('Тема на русском');
$curator = tt('Научный руководитель');

$rows = '';

foreach ($nkrsList as $item){
    $curatorName = SH::getShortName($item['p3'], $item['p4'],$item['p5']);
    $rows.=<<<HTML
            <tr>
                <td>{$item['sem4']}</td>
                <td>{$item['k2']}</td>
                <td>{$item['spkr2']}</td>
                <td>{$curatorName}</td>
            </tr>
HTML;

}

$table = <<<HTML
        <table class="table table-bordered table-hover table-condensed table-striped">
            <thead>
                <tr>
                    <th>{$course}</th>
                    <th>{$chair}</th>
                    <th>{$themeRus}</th>
                    <th>{$curator}</th>
                </tr>
            </thead>
            <tbody>
                {$rows}
            </tbody>
        </table> 
HTML;

echo $table;

$warning = tt('Порядок проверки работ в системе «Антиплагиат»');
$text = tt(<<<HTML
    <ol>
    <li>Студентом бакалавриата / магистратуры / спецотделения «Второе высшее образование» в обязательном порядке проверяется текст выпускной квалификационной работы (далее – ВКР) на предмет заимствования путем загрузки файла в систему «Антиплагиат» Юридического факультета МГУ на портал;</li>
    <li>Курсовые работы проверяются в системе по требованию научного руководителя;</li>
    <li>Файл, загружаемый на портал, должен содержать в названии ФИО студента;</li>
    <li>Файл загружается в систему без титульного листа, оглавления и списка используемой литературы;</li>
    <li>Убедитесь, что за аккаунтом закреплен актуальный адрес электронной почты.</li>
    <li>После нажатия на кнопку «Отправить» не обновляйте и не закрывайте страницу до появления ссылки в верхней части экрана. В зависимости от загруженности сервиса, проверка может занимать до 2 часов.</li>
    <li>«Антиплагиат» указывает лишь на факт заимствования, не оценивая правомерность заимствования. Оценка правомерности заимствований и, соответственно, реального объёма неправомерных заимствований относится к компетенции научного руководителя обучающегося. Нормативов допустимого объёма заимствований в проверяемых работах не установлено;</li>
    <li>В случае низкого процента оригинальности, отчет прорабатывается совместно с научным руководителем;</li>
    <li>Количество проверок восполняется администратором системы по мере использования сервиса;</li>
    </ol>
HTML
    );

$textInfo = tt('Количество проверок ограничено {limit} попытками. Вы уже использовали {count} попыток.', array(
    '{limit}'  => $student->getLimitCountAntiplagiat($year),
    '{count}' => $student->getAntio($year)->getAttribute('antio3')
));

echo <<<HTML
    <div class="alert alert-info">
        <h3>{$warning}</h3>
        {$textInfo}
    </div>
    <div class="alert alert-block">
        <h3>{$warning}</h3>
        {$text}
    </div>
HTML;

?>

<div class="span4">
    <div class="widget-box">
        <div class="widget-header">
            <h4><?=tt('Антиплагиат')?></h4>
        </div>

        <div class="widget-body">
            <div class="widget-main no-padding">
                <?php
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'attach-file-form',
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                    )
                ));
                ?>

                <fieldset>
                    <?= CHtml::fileField('document', '') ?>
                </fieldset>

                <div class="form-actions center">
                    <button class="btn btn-small btn-success">
                        <?=tt('Отправить')?>
                        <i class="icon-arrow-right icon-on-right bigger-110"></i>
                    </button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>