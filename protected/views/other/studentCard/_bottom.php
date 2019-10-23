<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 27.11.2015
 * Time: 9:51
 */

/* @var $st St */
/* @var $this OtherController */


if(Yii::app()->user->isStd)
{
    $ps73 = PortalSettings::model()->findByPk(73)->ps2;
    if($ps73==0)
        throw new CHttpException(403, tt('Доступ закрыт для студентов.'));
}

if(Yii::app()->user->isPrnt)
{
    $ps74 = PortalSettings::model()->findByPk(74)->ps2;
    if($ps74==0)
        throw new CHttpException(403, tt('Доступ закрыт для родителей.'));
}

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
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th></th>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
HTML;

<<<<<<< HEAD
    $fioTranslate = Pefio::model()->findByAttributes(array('pefio1'=>$st->st200, 'pefio2'=>1, 'pefio3' =>0));
    if(empty($fioTranslate))
        $fioTranslate = new Pefio();

    $uCode = Yii::app()->core->universityCode;
=======
    $uCode = $this->universityCode;
>>>>>>> master

    $isFarm = $uCode == U_FARM;

    echo sprintf($infoHtml,
        //tt('ФИО'),$name,
        tt('Фамилия'),$st->person->pe2,
        tt('Фамилия (англ.)'),$fioTranslate->pefio5,

        tt('Имя'),$st->person->pe3,
        tt('Имя (англ.)'),$fioTranslate->pefio6,

        tt('Отчество'),$st->person->pe4,
        tt('Отчество (англ.)'),$fioTranslate->pefio7,

        tt('Гражданство'),$studentInfo['sgr2'],
        tt('Дата рождения'),date("d.m.Y",strtotime($st->person->pe9)),

        tt('Факультет'), $studentInfo['f3'],
        tt('Специальность'), $studentInfo['sp2'],

        tt('Форма обучения'),SH::convertEducationType($studentInfo['sg4']),
        tt('Курс'), $studentInfo['sem4'],

        tt('Группа'), Gr::model()->getGroupName($studentInfo['sem4'], $studentInfo),
        tt('Email'),$st->st107,

        $isFarm ? tt('ИНН') : '', $isFarm ? $st->person->pe20 : ''
    );

    echo '</div>';//.top-block

    echo '<div class="bottom-block">';

    $disciplines = Elg::model()->getDispBySt($st->st1);
    $_pref = '_new';//Клименко сказал оставить только стусв 19.04.2018

    $params = array('gr1'=>$studentInfo['gr1'],'st'=>$st);
    $ps50 = PortalSettings::model()->getSettingFor(50);
    $tabs = array();
    if(PortalSettings::model()->getSettingFor(47)==1)
        array_push($tabs,array('label'=>tt('Успеваемость (журнал)'), 'content'=>$this->renderPartial('studentCard/_journal', $params+array('disciplines'=>$disciplines),true), 'active'=>$ps50==0));
    if(PortalSettings::model()->getSettingFor(48)==1)
        array_push($tabs,array('label'=>tt('Текущая задолженость (журнал)'), 'content'=>$this->renderPartial('studentCard/_retake', $params+array('disciplines'=>$disciplines),true), 'active'=>$ps50==1));
    if(PortalSettings::model()->getSettingFor(49)==1)
        array_push($tabs,array('label'=>tt('Модульный контроль'), 'content'=>$this->renderPartial('studentCard/_module_pmk', $params,true), 'active'=>$ps50==2));
    if(PortalSettings::model()->getSettingFor(51)==1)
        array_push($tabs,array('label'=>tt('Екзаменационная сессия'), 'content'=>$this->renderPartial('studentCard/_exam'.$_pref, $params,true), 'active'=>$ps50==3));
    if(PortalSettings::model()->getSettingFor(52)==1)
        array_push($tabs,array('label'=>tt('Общая успеваемость'), 'content'=>$this->renderPartial('studentCard/_progress'.$_pref, $params,true), 'active'=>$ps50==4));
    if(PortalSettings::model()->getSettingFor(PortalSettings::SHOW_GENERAL_INFO_TAB)==1)
        array_push($tabs,array('label'=>tt('Общая информация'), 'content'=>$st->st165, 'active'=>$ps50==5));
    if(PortalSettings::model()->getSettingFor(PortalSettings::SHOW_SVOD_JOURNAL_TAB)==1)
        array_push($tabs,array('label'=>tt('Сводный электронный журнал'), 'content'=>$this->renderPartial('studentCard/_itog_progress', $params+array('disciplines'=>$disciplines),true), 'active'=>$ps50==6));
    if(PortalSettings::model()->getSettingFor(PortalSettings::SHOW_REGISTRATION_PASS_TAB)==1)
        array_push($tabs,array('label'=>tt('Регистрация пропусков'), 'content'=>$this->renderPartial('studentCard/_registration_pass', $params+array('disciplines'=>$disciplines),true), 'active'=>$ps50==7));
    if(PortalSettings::model()->getSettingFor(PortalSettings::SHOW_GOSTEM_TAB)==1)
        array_push($tabs,array('label'=>tt('Гос. экзамены'), 'content'=>$this->renderPartial('studentCard/_gostem', $params,true), 'active'=>$ps50==8));

    $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'top',
        'tabs'=>$tabs,
    ));

    echo '</div>';//.bottom-block
echo'</div>';//#studentCard

}

$this->beginWidget(
    'bootstrap.widgets.TbModal',
    array(
        'id' => 'modalBlock',
        'htmlOptions'=>array(
            'class'=>'full-modal'
        )
    )
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4></h4>
    </div>

    <div class="modal-body">
        <div id="modal-content">

        </div>
    </div>
    <div class="modal-footer">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Закрыть'),
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>

<?php $this->endWidget();