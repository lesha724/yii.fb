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

    $infoHtml = <<<HTML
    <div class="student-info">
        <table class="table">
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
            </tbody>
        </table>
    </div>
HTML;

    echo sprintf($infoHtml,
        tt('Факультет'), $studentInfo['f3'],
        tt('Специальность'), $studentInfo['sp2'],
        tt('Курс'), $studentInfo['sem4'],
        tt('Группа'), Gr::model()->getGroupName($studentInfo['sem4'], $studentInfo)
    );

    echo '</div>';//.top-block
    echo '<div class="bottom-block">';

     $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'top',
        'tabs'=>array(
            array('label'=>Yii::t('main', 'Journal'), 'content'=>$this->renderPartial('studentCard/_journal', array(),true), 'active'=>true),
            array('label'=>Yii::t('main', 'Module'), 'content'=>$this->renderPartial('studentCard/_module', array('gr1'=>$studentInfo['gr1'],'st'=>$st),true)),
        ),
    ));

    echo '</div>';//.bottom-block
echo'</div>';//#studentCard

}