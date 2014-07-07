<?php

class EntranceController extends Controller
{
    public function filters() {

        return array(
            //'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    ''
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('allow',
                'actions' => array(
                    'gostem',
                    'deleteGostem'
                ),
                'expression' => 'Yii::app()->user->isStd',
            ),
            array('allow',
                'actions' => array(
                    'phones'
                ),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }



    public function actionDocumentReception()
    {
        $model = new FilterForm;
        $model->scenario = 'documentReception';

        $dateEntranceBegin  = PortalSettings::model()->findByPk(23)->getAttribute('ps2');
        $model->currentYear = date('Y', strtotime($dateEntranceBegin));

        if (isset($_REQUEST['FilterForm'])) {
            $model->attributes=$_REQUEST['FilterForm'];
        }

        $this->render('documentReception', array(
            'model' => $model
        ));
    }

    public function actionRating()
    {
        $model = new FilterForm;
        $model->scenario = 'rating';

        $dateEntranceBegin  = PortalSettings::model()->findByPk(23)->getAttribute('ps2');
        $model->currentYear = date('Y', strtotime($dateEntranceBegin));

        $list_1 = $list_3 = $list_4 = $list_5 = array();
        //var_dump();
        if (isset($_REQUEST['FilterForm'])) {
            $model->attributes=$_REQUEST['FilterForm'];

            if (! empty($model->speciality)) {

                $list_1 = $this->getList1($model);
                // $list_2 - is created in view
                $list_3 = $this->getList3($model);
                $list_4 = $this->getList4($model);
                $list_5 = $this->getList5($model);

            }
        }

        $this->render('rating', array(
            'model'  => $model,
            'list_1' => $list_1,
            'list_3' => $list_3,
            'list_4' => $list_4,
            'list_5' => $list_5,
        ));
    }

    private function getList1(FilterForm $model)
    {
        $condition = 'abd66 = 1';
        // вне конкурса
        $list_1 = Ab::model()->getStudents($model, 0, $condition);

        return $list_1;
    }

    private function getList3(FilterForm $model)
    {
        $condition = 'abd66 = 0 AND abd6=0';

        // На конкурсной основе на общих основаниях
        $list_3 = Ab::model()->getStudents($model, 0, $condition);

        return $list_3;
    }

    private function getList4(FilterForm $model)
    {
        $condition = 'abd66 = 1';

        // контракт - вне конкурса
        $list_4 = Ab::model()->getStudents($model, 1, $condition);

        return $list_4;
    }

    private function getList5(FilterForm $model)
    {
        $condition = 'abd66 = 0';

        // контракт - на общих основаниях
        $list_5 = Ab::model()->getStudents($model, 1, $condition);

        return $list_5;
    }


    public function actionRegistration()
    {
        $model = new Aap();
        $model->unsetAttributes();

        $finished = Yii::app()->request->getParam('finished', null);

        if (isset($_REQUEST['Aap'])){
            $model->aap1  = new CDbExpression('GEN_ID(GEN_AAP, 1)');
            $model->aap51 = 0; // st1
            $model->attributes = $_REQUEST['Aap'];

            if ($finished && $model->save()) {
                if (isset($_REQUEST['aapes']))
                    foreach ($_REQUEST['aapes'] as $aapes2 => $values) {

                        if (empty($values['aapes5']))
                            continue;

                        $aapes = new Aapes;
                        $aapes->aapes1 = Aap::getLastInsertId();
                        $aapes->aapes2 = $aapes2;
                        $aapes->attributes = $values;
                        $aapes->save();
                    }

            }
        }

        $viewName = 'registration';
        $params   = array(
            'model'  => $model,
        );

        if (Yii::app()->request->isAjaxRequest) {

            $res = array(
                'html'   => $this->renderPartial($viewName, $params, true),
                'errors' => $model->getErrors(),
            );
            Yii::app()->end(CJSON::encode($res));
        }

        $this->render($viewName, $params);
    }

    public function actionGetSpecialities()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $spab4 = Yii::app()->request->getParam('spab4', null); // направление подготовки
        $spab5 = Yii::app()->request->getParam('spab5', null); // форма обучения
        $spab6 = 1; // курс

        if ($spab4 == null || $spab5 == null)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $specialities = Spab::model()->getSpecialitiesForRegistration($spab4, $spab5);

        $res = array(
            'html' => CHtml::dropDownList(
                '',
                '',
                CHtml::listData($specialities, 'spab1', 'spab14'),
                array('empty' => '')
            )
        );

        Yii::app()->end(CJSON::encode($res));
    }
}