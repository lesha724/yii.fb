<?php
/**
 * @var $model St
 * @var $this OtherController
 */
$this->pageHeader=tt('Запись на дисциплины');
$this->breadcrumbs=array(
    tt('Запись на дисциплины'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/subscription.js', CClientScript::POS_HEAD);

$url1 = Yii::app()->createUrl('other/saveCiklVBloke');
$url2 = Yii::app()->createUrl('other/saveDisciplines');
$url3 = Yii::app()->createUrl('other/cancelSubscription');
$msg1 = tt('Произошла ошибка!');
$msg2 = tt('Необходимо выбрать один из вариантов!');
$msg3 = tt('Выберите нужное количество дисциплин!');

Yii::app()->clientScript->registerScript('orderLesson-messages', <<<JS
    var url1 = '{$url1}';
    var url2 = '{$url2}';
    var url3 = '{$url3}';
    var msg1 = '{$msg1}';
    var msg2 = '{$msg2}';
    var msg3 = '{$msg3}';

JS
    , CClientScript::POS_HEAD);

$params = $model->subscriptionParams;
$params['st1'] = $model->st1;

$_SESSION['u1_vib']       = isset($_SESSION['u1_vib']) ? $_SESSION['u1_vib'] : '';
$_SESSION['u1_vib_disc']  = isset($_SESSION['u1_vib_disc']) ? $_SESSION['u1_vib_disc'] : '';
$_SESSION['uch_god']      = $params['uch_god'];
$_SESSION['semester']     = $params['semester'];
$_SESSION['st1']          = $params['st1'];
$_SESSION['gr1_kod']      = $params['gr1_kod'];
$_SESSION['data_nachala'] = $params['data_nachala'];

if (isset($_SESSION['func'])) {
    $_SESSION['func']($params);
} else {
    PROCEDURA_CIKL_PO_BLOKAM($params);
}


function PROCEDURA_CIKL_PO_BLOKAM($params)
{
    unset($_SESSION['func']);
    extract($params);// $sg1_kod, $gr1_kod, $uch_god, $semestr, $data_nachala

    if (! $sg1_kod) {
        Yii::app()->user->setFlash('error', tt('Студент не активен'));
        return;
    }

    list($min_block, $max_block) = U::model()->getMinMAxBlocks($sg1_kod);
    $min_block = isset($_SESSION['min_block']) ? $_SESSION['min_block'] : (int)$min_block;

    for ($block = $min_block; $block <= $max_block; $block ++) {

        // Определяю является ли родитель блоком по выбору
        $u9_root = U::model()->getU9($sg1_kod, $block);

        // это корень блока
        if ($u9_root == 0) {

            $u1_root = U::model()->getU17($sg1_kod, $block);

            if (empty($_SESSION['u1_vib']))
                $_SESSION['u1_vib'] = $u1_root;
            else
                $_SESSION['u1_vib'] .= ','.$u1_root;
        }

        // Проверяю анализировать ли блок
        // (нужно, когда повторно буду заходить внутрь и там нет дисциплин, то понять,
        // нужно ли в него дальше в глубь идти т.е. выбрал студент его или нет ранее)
        $u1 = U::model()->getU1($sg1_kod, $block, $_SESSION['u1_vib']);

        if ($u1 > 0) {

            // Проверяю попадает ли блок в анализируемый учебный год и семестр
            // (анализирую максимум 2 вложения циклов, если больше будет, то нужно дописать условие по аналогии с ниже на u17)
            $analyze = U::model()->getAnalyze($uch_god, $semester, $block, $sg1_kod);

            if ($analyze > 0) {

                // Проверяю, выбрал ли цикл в этом блоке студент
                $u1_d = 0;
                $u1_kods = U::model()->getU1_KOD($block, $sg1_kod);

                foreach ($u1_kods as $u1_kod) {

                    $u1_vibral = U::model()->getU1_VIBRAL($st1, $u1_kod, $block, $sg1_kod);

                    if ($u1_vibral) {
                        $u1_d = $u1_kod;
                        break;
                    }
                }

                if ($u1_d == 0) {

                    $kol = U::model()->getKOL($block, $sg1_kod);

                    // если в блоке только 1 строка цикла, в случае просто выбора дисциплин
                    if ($kol == 1){

                        $_ul = U::model()->get_U1($block, $sg1_kod);
                        $_SESSION['u1_vib'] .= ','.$_ul;
                        $_SESSION['u1_vib_disc'] = $_ul;

                        $_SESSION['min_block'] = $block;
                        PROCEDURA_VIBOR_DISCIPLIN($params);
                        break;

                    } else {

                        $_SESSION['min_block'] = $block;
                        PROCEDURA_VIBOR_CIKLA_V_BLOKE($params);
                        break;
                    }

                } else {
                    $_SESSION['u1_vib'] .= ','.$u1_d;
                    $_SESSION['u1_vib_disc'] = $u1_d;

                    $_SESSION['min_block'] = $block;
                    PROCEDURA_VIBOR_DISCIPLIN($params);
                    break;
                }


            } else
                continue;
        }
    }
}

function PROCEDURA_VIBOR_CIKLA_V_BLOKE($params)
{
    $widget = <<<HTML
<div class="widget-box" style="margin:0 0 10px 0">
    <div class="widget-header">
        <h4>%s</h4>
    </div>
    <div class="widget-body">
        <div class="widget-main no-padding">
            %s
        </div>
    </div>
</div>
HTML;

    unset($_SESSION['func']);
    extract($params);// $sg1_kod, $gr1_kod, $uch_god, $semestr, $data_nachala

    $block = $_SESSION['min_block'];

    $blocks = U::model()->getCiklList($block, $sg1_kod);

    $options = array(
        'labelOptions' => array('class' => 'lbl'),
        'class' => 'ace',
        'template' => '<div class="cikl">{input}{label}</div>',
        'separator' => ''
    );
    $controls =  CHtml::radioButtonList('cikl_v_bloke', false, $blocks, $options);

    echo sprintf($widget, tt('Выберите один из блоков'), $controls);
    echo CHtml::button(tt('Сохранить'), array('name' => 'cikl_v_bloke', 'class' => 'btn btn-small btn-success', 'style'=>'margin:0 1% 0 0'));
}

function PROCEDURA_VIBOR_DISCIPLIN($params)
{
    $widget = <<<HTML
<div class="widget-box" style="margin:0 0 10px 0">
    <div class="widget-header">
        <h4>%s</h4>
    </div>
    <div class="widget-body">
        <div class="widget-main no-padding">
            %s
        </div>
    </div>
</div>
HTML;

    unset($_SESSION['func']);
    extract($params);// $sg1_kod, $gr1_kod, $uch_god, $semestr, $data_nachala
    // Проверяю, если ли дисциплины в выбранном цикле для выбора
    $nado_vibrat = U::model()->getNADO_VIBRAT($_SESSION['u1_vib_disc'], $uch_god, $semester);

    if ($nado_vibrat > 0) {

        // Проверяю, выбрал ли студент необходимое количество дисциплин
        $kol = U::model()->getKOL2($_SESSION['u1_vib_disc'], $uch_god, $semester, $st1);

        // не выбрал нужное количество дисциплин
        if ($nado_vibrat != $kol) {

            $disciplines = U::model()->getDisciplines($_SESSION['u1_vib_disc'], $uch_god, $semester, $gr1_kod);

            // ставиш точку напротив дисциплины, которую студент ранее выбрал (если изменили количество дисциплин для выбора)
            $alreadyCheckedDisc = U::model()->getAlreadyChecked($_SESSION['u1_vib_disc'], $uch_god, $semester, $st1);

            $controls = '';
            foreach ($disciplines as $discipline) {
                $isChecked = in_array($discipline['d1'], $alreadyCheckedDisc);
                $value     = $discipline['ucgn1_kod'];
                $controls .= '<div class="subscription-disc">'.
                                CHtml::checkBox('disciplines[]', $isChecked, array('value' => $value)).
                                '<span>'.$discipline['d2'].'</span>'.
                             '</div>';
            }

            echo sprintf($widget, tt('Количество дисциплин, которые необходимо выбрать').': '.$nado_vibrat, $controls).
                 CHtml::button(tt('Сохранить'), array('name' => 'vibor_discipline', 'data-min' => $nado_vibrat, 'class' => 'btn btn-small btn-success', 'style'=>'margin:0 1% 0 0'));

        } else {
            $_SESSION['min_block']++;
            PROCEDURA_CIKL_PO_BLOKAM($params);
        }

    } else {
        $_SESSION['min_block']++;
        PROCEDURA_CIKL_PO_BLOKAM($params);
    }
}


$html = <<<HTML

HTML;


echo CHtml::button(tt('Отмена'), array('id' => 'cancelSubscription', 'class' => 'btn btn-small btn-danger'));

$disciplines = U::model()->getSubscribedDisciplines();
if (! empty($disciplines)) : ?>
    <table class="table table-striped table-bordered subscription">
        <caption><?=tt('Дисциплины, на которые Вы уже записались')?></caption>
        <tbody>
         <?php
            foreach ($disciplines as $discipline) {
                echo '<tr><td>'.$discipline.'</td></tr>';
            }
         ?>
        </tbody>
    </table>
<?php endif;