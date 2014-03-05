<?php

class DefaultController extends AdminController
{
	public function actionTeachers()
	{
        $chairId = Yii::app()->request->getParam('chairId', null);

        $model = new P;
        $model->unsetAttributes();

        if (isset($_REQUEST['P']))
            $model->attributes = $_REQUEST['P'];

        $this->render('teachers', array(
            'model' => $model,
            'chairId' => $chairId
        ));
	}

    public function actionStudents()
    {
        $model = new St;
        $model->unsetAttributes();

        if (isset($_REQUEST['St']))
            $model->attributes = $_REQUEST['St'];


        $this->render('students', array(
            'model' => $model,
        ));
    }
}