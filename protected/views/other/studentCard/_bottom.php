<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 27.11.2015
 * Time: 9:51
 */

/* @var $st St */


$studentInfo = $st->getStudentInfoForCard();

if(empty($studentInfo))
    echo tt('Error');
else {

echo '<div id="studentCard">';
    echo '<div class="top-block"></div>';

    $id   = $st->st1;
    $type = Users::FOTO_ST1;
    $url = $this->createUrl('/site/userPhoto', array('_id' => $id, 'type' => $type));

    $class='img-circle';
    //img-polaroid
    $infoHtml = <<<HTML
    <div class="student-info row">
        <div class="student-photo span3">
             <img alt="photo" src="{$url}" class="{$class}">
        </div>
        <table class="table span9">
            <tbody>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
            </tbody>
        </table>
    </div>
HTML;

    echo sprintf($infoHtml,
        tt('ФИО'),$st->st2.' '.$st->st3.' '.$st->st4,
        tt('Гражданство'),$studentInfo['sgr2'],
        tt('Дата рождения'),date("m.d.y",strtotime($st->st7)),
        tt('Факультет'), $studentInfo['f3'],
        tt('Специальность'), $studentInfo['sp2'],
        tt('Форма обучения'),SH::convertEducationType($studentInfo['sg4']),
        tt('Курс'), $studentInfo['sem4'],
        tt('Группа'), Gr::model()->getGroupName($studentInfo['sem4'], $studentInfo)

    );

    echo '</div>';//.top-block
    echo '<div class="bottom-block">';

     $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'top',
        'tabs'=>array(
            array('label'=>tt('Успеваемость'), 'content'=>$this->renderPartial('studentCard/_journal', array(),true), 'active'=>true),
            array('label'=>Yii::t('main', 'Поточная задолженость'), 'content'=>$this->renderPartial('studentCard/_retake', array('gr1'=>$studentInfo['gr1'],'st'=>$st),true)),
            array('label'=>Yii::t('main', 'Модульный контроль'), 'content'=>$this->renderPartial('studentCard/_module', array('gr1'=>$studentInfo['gr1'],'st'=>$st),true)),
        ),
    ));

    echo '</div>';//.bottom-block
echo'</div>';//#studentCard

}