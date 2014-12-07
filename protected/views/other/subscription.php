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

$url1 = Yii::app()->createUrl('other/ciklVBloke');
$msg1 = tt('Произошла ошибка!');
$msg2 = tt('Необходимо выбрать один из вариантов!');
Yii::app()->clientScript->registerScript('orderLesson-messages', <<<JS
    var url1 = '{$url1}';
    var msg1 = '{$msg1}';
    var msg2 = '{$msg2}';

JS
    , CClientScript::POS_HEAD);

$params = $model->subscriptionParams;
$params['st1'] = $model->st1;

$_SESSION['u1_vib'] = isset($_SESSION['u1_vib']) ? $_SESSION['u1_vib'] : '';

if (isset($_SESSION['func'])) {
    $_SESSION['func']($params);
} else {
    PROCEDURA_CIKL_PO_BLOKAM($params);
}


function PROCEDURA_CIKL_PO_BLOKAM($params)
{
    extract($params);// $sg1_kod, $gr1_kod, $uch_god, $semestr, $data_nachala

    if (! $sg1_kod) {
        Yii::app()->user->setFlash('error', tt('Студент не активен'));
        return;
    }

    list($min_block, $max_block) = U::model()->getMinMAxBlocks($sg1_kod);
    $min_block = isset($_SESSION['min_block'])
                    ? $_SESSION['min_block']+1
                    : $min_block;

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
                        isset($_SESSION['u1_vib_disc'])
                            ? $_SESSION['u1_vib_disc'] .= ','.$_ul
                            : $_SESSION['u1_vib_disc'] = $_ul;

                        $_SESSION['min_block'] = $block;
                        // TODO *вызов PROCEDURA_VIBOR_DISCIPLIN
                        die(var_dump(1));
                    } else {

                        $_SESSION['min_block'] = $block;
                        PROCEDURA_VIBOR_CIKLA_V_BLOKE($params);
                        break;
                    }

                } else {
                    $_SESSION['u1_vib'] .= ','.$u1_d;
                    isset($_SESSION['u1_vib_disc'])
                        ? $_SESSION['u1_vib_disc'] .= ','.$u1_d
                        : $_SESSION['u1_vib_disc'] = $u1_d;

                    $_SESSION['min_block'] = $block;
                    // TODO *вызов PROCEDURA_VIBOR_DISCIPLIN
                    die(var_dump(3));
                }


            } else
                continue;
        }
    }
}

function PROCEDURA_VIBOR_CIKLA_V_BLOKE($params)
{
    extract($params);// $sg1_kod, $gr1_kod, $uch_god, $semestr, $data_nachala

    $block = $_SESSION['min_block'];

    $blocks = U::model()->getCiklList($block, $sg1_kod);

    echo CHtml::radioButtonList('cikl_v_bloke', false, $blocks);

    echo CHtml::button(tt('Сохранить'), array('name' => 'cikl_v_bloke'));
}

function PROCEDURA_VIBOR_DISCIPLIN($params)
{
    extract($params);// $sg1_kod, $gr1_kod, $uch_god, $semestr, $data_nachala
    // Проверяю, если ли дисциплины в выбранном цикле для выбора
    $nado_vibrat = U::model()->getNADO_VIBRAT($_SESSION['u1_vib_disc'], $uch_god, $semester);

    if ($nado_vibrat > 0) {

        // Проверяю, выбрал ли студент необходимое количество дисциплин
        $kol = U::model()->getKOL2($_SESSION['u1_vib_disc'], $uch_god, $semester);

        // не выбрал нужное количество дисциплин
        if ($nado_vibrat != $kol) {

            $disciplines = U::model()->getDisciplines($_SESSION['u1_vib_disc'], $uch_god, $semester, $gr1_kod);

            // todo here smt is wrong skype...
            foreach ($disciplines as $discipline) {
                $isChecked = ! is_null($discipline['ucsn2']);
                $value = $discipline['ucgn1_kod'];
                echo CHtml::checkBox('disciplines[]', $isChecked, array('value' => $value));
            }

        } else {
            PROCEDURA_CIKL_PO_BLOKAM($params);
        }

    } else {
        PROCEDURA_CIKL_PO_BLOKAM($params);
    }
}

var_dump($_SESSION);



