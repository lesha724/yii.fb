<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 16.05.2018
 * Time: 10:33
 */

class SelfController extends Controller
{
    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'workLoad'
                ),
                'expression' => function(){
                    return Yii::app()->user->isTch;
                }
            ),
            array('allow',
                'actions' => array(
                    'subscription'
                ),
                'expression' => function(){
                    return Yii::app()->user->isStd;
                },
            ),
            array('allow',
                'actions' => array(
                    'score',
                ),
                /*'expression' => function(){
                    return Yii::app()->user->isStd && Yii::app()->core->universityCode == U_URFAK;
                },*/
            ),

            array('allow',
                'actions' => array(
                    'studentInfo',
                    'studentCard',
                ),
            ),
            array('allow',
                'actions' => array(
                    'timeTable',
                ),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionWorkLoad()
    {
        $this->forward('workLoad/self');
    }

    public function actionTimeTable()
    {
        $this->forward('timeTable/self');
    }

    public function actionStudentCard()
    {
        $this->forward('other/studentCard');
    }

    public function actionSubscription()
    {
        $this->forward('other/subscription');
    }

    public function actionStudentInfo()
    {
        $this->forward('other/studentInfo');
    }

    /**
     * Печать счета для оплаты
     */
    public function actionScore(){
        //$mPDF1 = Yii::app()->ePdf->mpdf();

        $setting = Mp::getSettinsBy2602();
        if(empty($setting))
            throw new CHttpException(400, tt('Не заданы настройки оплаты. Обратитесь к администратору системы!'));

        $html = $this->_getScoreHtml($setting, 'SeventyPercent');

        $html .= $this->_getScoreHtml($setting, 'ThirtyPercent');

        /*$mPDF1->WriteHTML($html);

        $mPDF1->Output();*/

        return $html;
    }

    /**
     * нтмл счета
     * @param $setting array
     * @param $type string
     *
     * @return string
     * @throws CHttpException
     */
    private function _getScoreHtml($setting,$type){
        if(!isset($setting[$type]))
            throw new CHttpException(500);

        return $this->renderPartial('score', array_merge($setting[$type], array(
            'TypeScore' => $type == 'SeventyPercent' ? 70 : 30
        )));

    }
}