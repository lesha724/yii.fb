<?php

class DocsController extends Controller
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
                    'tddo',
                    'tddoCreate',
                    'findExecutor',
                    'getTddoNextNumber',
                    'deleteTddo',
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }



    public function actionTddo()
    {
        $docType = Yii::app()->request->getParam('docType', null);

        $this->render('tddo/list', array(
            'docType' => $docType
        ));
    }

    public function actionTddoCreate()
    {
        $docType = Yii::app()->request->getParam('docType', null);
        if (empty($docType))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $model = new Tddo;
        $model->unsetAttributes();

        $model->tddo2 = $docType;
        // next input registration number
        $model->tddo3 = $model->getNextNumberFor($docType);
        $model->tddo7 = $model->getNextNumberFor($docType);
        // default executor type
        $model->executorType = $docType == 2 ? Tddo::ONLY_INDEXES : Tddo::ONLY_TEACHERS;

        if (isset($_REQUEST['Tddo'])) {
            $model->attributes = $_REQUEST['Tddo'];
            $model->tddo1 = new CDbExpression('GEN_ID(GEN_TDDO, 1)');
            $model->tddo11 =isset($_REQUEST['Dkid']) ? 1 : 2;

            if ($model->save()) {

                $tddo1 = Tddo::getLastInsertId();

                if (isset($_REQUEST['Dkid']))
                    foreach ($_REQUEST['Dkid'] as $dates) {

                        if (empty($dates['dkid2']))
                            continue;

                        $date = new Dkid;
                        $date->dkid1 = $tddo1;
                        $date->dkid2 = $dates['dkid2'];
                        $date->dkid3 = $dates['dkid3'];
                        $date->save();
                    }

                if ($model->executorType == Tddo::ONLY_TEACHERS) {
                    if (isset($_REQUEST['teachers'])) {
                        $teachers = array_filter($_REQUEST['teachers']);
                        foreach ($teachers as $teacher) {
                            $executor = new Ido;
                            $executor->ido1 = $tddo1;
                            $executor->ido2 = $teacher;
                            $executor->ido5 = isset($_REQUEST['ido5'][$teacher]) ? 1 : 2;
                            $executor->save();
                        }
                    }
                }
                if ($model->executorType == Tddo::ONLY_INDEXES) {
                    if (isset($_REQUEST['indexs'])) {
                        $indexes = array_filter($_REQUEST['indexs']);
                        foreach ($indexes as $index) {
                            $executor = new Ido;
                            $executor->ido1 = $tddo1;
                            $executor->ido4 = $index;
                            $executor->ido5 = 2;
                            $executor->save();
                        }
                    }
                }
                if ($model->executorType == Tddo::ONLY_CHAIRS) {
                    if (isset($_REQUEST['chairs'])) {
                        $chairs = array_filter($_REQUEST['chairs']);
                        foreach ($chairs as $chair) {
                            $executor = new Idok;
                            $executor->idok1 = $tddo1;
                            $executor->idok2 = $chair;
                            $executor->idok4 = isset($_REQUEST['idok4'][$chair]) ? 1 : 2;
                            $executor->save();
                        }
                    }
                }

                Yii::app()->request->redirect(Yii::app()->createUrl('/docs/tddo', array('docType' => $docType)));
            }
            //(var_dump($_REQUEST));
        }


        $this->render('tddo/create', array(
            'model' => $model,
        ));
    }

    public function actionFindExecutor()
    {
        $query = Yii::app()->request->getParam('query', null);
        $type  = Yii::app()->request->getParam('type', null);

        if (empty($type))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        if ($type == Tddo::ONLY_TEACHERS)
            $items = P::model()->findTeacherByName($query);
        elseif($type == Tddo::ONLY_INDEXES)
            $items = Innf::model()->getIndexesByArray();
        elseif($type == Tddo::ONLY_CHAIRS)
            $items = K::model()->findChairsByName($query);

        $res = array();
        foreach ($items as $item) {
            $res[] = array('id' => $item['id'], 'name' => $item['name']);
        }

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionGetTddoNextNumber()
    {
        $docType = Yii::app()->request->getParam('docType', null);
        $tddo4   = Yii::app()->request->getParam('tddo4', null);

        if (empty($docType) || empty($tddo4))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $nextNumber = Tddo::getNextNumberFor($docType, date('d.m.Y H:i', $tddo4/1000));

        $res = array('res' => $nextNumber);
        Yii::app()->end(CJSON::encode($res));
    }

    public function actionDeleteTddo()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $tddo1 = Yii::app()->request->getParam('tddo1', null);

        $deleted = (bool)Tddo::model()->deleteByPk($tddo1);

        $res = array(
            'deleted' => $deleted
        );

        Yii::app()->end(CJSON::encode($res));
    }

}