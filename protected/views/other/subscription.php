<?php
/**
 * @var $model St
 * @var $this OtherController
 */
    $params = $model->subscriptionParams;
    extract($params);// $sg1_kod, $gr1_kod, $uch_god, $semestr, $data_nachala

    if (! $sg1_kod) {
        Yii::app()->user->setFlash('error', tt('Студент не активен'));
        return;
    }

    list($min_block, $max_block) = U::model()->getMinMAxBlocks($sg1_kod);

    $u1_vib = '';

    for ($block = $min_block; $block <= $max_block; $block ++) {

        // Определяю является ли родитель блоком по выбору
        $u9_root = U::model()->getU9($sg1_kod, $block);

        // это корень блока
        if ($u9_root == 0) {

            $u1_root = U::model()->getU17($sg1_kod, $block);

            if (empty($u1_vib))
                $u1_vib = $u1_root;
            else
                $u1_vib .= ','.$u1_root;
        }


        // Проверяю анализировать ли блок
        // (нужно, когда повторно буду заходить внутрь и там нет дисциплин, то понять,
        // нужно ли в него дальше в глубь идти т.е. выбрал студент его или нет ранее)
        $u1 = U::model()->getU1($sg1_kod, $block, $u1_vib);

        if ($u1 > 0) {

            // Проверяю попадает ли блок в анализируемый учебный год и семестр
            // (анализирую максимум 2 вложения циклов, если больше будет, то нужно дописать условие по аналогии с ниже на u17)
            $analyze = U::model()->getAnalyze($uch_god, $semester, $block, $sg1_kod);

            if ($analyze > 0) {

                // Проверяю, выбрал ли цикл в этом блоке студент
                $u1_d = 0;
                $u1_kods = U::model()->getU1_KOD($block, $sg1_kod);

                foreach ($u1_kods as $u1_kod) {

                    $u1_vibral = U::model()->getU1_VIBRAL($model->st1, $u1_kod, $block, $sg1_kod);

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
                        $u1_vib .= ','.$_ul;
                        $u1_vib_disc = $_ul;
                        // TODO *вызов PROCEDURA_VIBOR_DISCIPLIN

                    } else {

                        // TODO вызов PROCEDURA_VIBOR_CIKLA_V_BLOKE

                    }

                } else {
                    $u1_vib .= ','.$u1_d;
                    $u1_vib_disc = $u1_d;
                    // TODO *вызов PROCEDURA_VIBOR_DISCIPLIN
                }


            } else
                continue;
        }
    }




