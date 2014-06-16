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
        if (SH::is(U_NULAU) && in_array($model->speciality, array(/*здесь какие-то особые специальности*/)))
            $condition = '(abd66 = 1) AND abd6 = 0';
        elseif (SH::is(U_NULAU))
            $condition = '(abd66 = 1)';
        else
            $condition = '(abd66 = 1 OR abd4 = 3) AND abd6 = 0';

        // вне конкурса
        $list_1 = Ab::model()->getStudents($model, 0, $condition);

        return $list_1;
    }

    private function getList3(FilterForm $model)
    {
        if (SH::is(U_NULAU) && in_array($model->speciality, array(/*здесь какие-то особые специальности*/)))
            $condition = 'abd66 = 0 AND ABD6 = 0';
        elseif (SH::is(U_BSAA))
            $condition = 'abd66 = 0 AND ABD4 <> 3';
        else
            $condition = 'abd66 = 0';

        // На конкурсной основе на общих основаниях
        $list_3 = Ab::model()->getStudents($model, 0, $condition);

        return $list_3;
    }

    private function getList4(FilterForm $model)
    {
        if (SH::is(U_NULAU))
            $condition = '(abd66 = 1)';
        else
            $condition = '(abd66 = 1 OR abd4 = 3)';

        // контракт - вне конкурса
        $list_4 = Ab::model()->getStudents($model, 1, $condition);

        return $list_4;
    }

    private function getList5(FilterForm $model)
    {
        if (SH::is(U_NULAU))
            $condition = '(abd66 = 0)';
        else
            $condition = 'abd66 = 0 AND abd4 <> 3';

        // контракт - на общих основаниях
        $list_5 = Ab::model()->getStudents($model, 1, $condition);

        return $list_5;
    }
}