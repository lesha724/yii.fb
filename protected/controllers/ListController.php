<?php

class ListController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
        );
    }

    public function accessRules() {

        return array(
            /*array('allow',
                'actions' => array(
                    'journal',
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),*/
            array('allow',
                'actions' => array('group','chair')
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
	
    public function actionGroup()
    {
        $model = new FilterForm();
        $model->scenario = 'list-group';

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];

        $this->render('group', array(
            'model' => $model,
        ));
    }
    
    public function actionChair()
    {
        $model = new FilterForm();
        $model->scenario = 'list-chair';

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];

        $this->render('chair', array(
            'model' => $model,
        ));
    }
}