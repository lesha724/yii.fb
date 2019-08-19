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
                'expression' => function(){
                    return Yii::app()->user->isStd && Yii::app()->core->universityCode == U_URFAK;
                },
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
//        /$mPDF1 = Yii::app()->ePdf->mpdf();

        $setting = Mp::getSettinsBy2602();
        if(empty($setting))
            throw new CHttpException(400, tt('Не заданы настройки оплаты. Обратитесь к администратору системы!'));

        $spo = Spo::model()->findByAttributes(array(
            'spo1' => Yii::app()->user->dbModel->st1,
            'spo5' => 0,
            'spo6' => Yii::app()->core->currentYear
        ));

        if(empty($spo))
            throw new CHttpException(400, tt('Не найден план оплаты'));

        $sk = Yii::app()->user->dbModel->getSk();
        if(empty($sk) || $sk['sk3'] == 0)
            throw new CHttpException(400, tt('Не найден контракт'));

        $html = $this->_getScoreHtml($setting, 'SeventyPercent', $spo->spo2 * 0.7, $sk['sk6'], $sk['sk7']);

        $html .= $this->_getScoreHtml($setting, 'ThirtyPercent', $spo->spo2 * 0.3, $sk['sk6'], $sk['sk7']);

        return $html;
        /*$mPDF1->WriteHTML($html);

        $mPDF1->Output('score.pdf', 'D');*/
    }

    /**
     * нтмл счета
     * @param $setting array
     * @param $type string
     * @param $price double
     *
     * @return string
     * @throws CHttpException
     * @throws CException
     */
    private function _getScoreHtml($setting,$type, $price, $sk6, $sk7){
        if(!isset($setting[$type]))
            throw new CHttpException(500);

        return $this->renderPartial('score', array_merge($setting[$type], array(
            'TypeScore' => $type == 'SeventyPercent' ? 70 : 30,
            'sk6' => $sk6,
            'sk7' => $sk7,
            'price' => round($price, 2)
        )));
    }
}