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

    public function actionGrants($id)
    {
        if (empty($id))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $model = $this->loadGrantsModel($id);

        if (isset($_REQUEST['Grants'])) {
            $model->attributes = $_REQUEST['Grants'];
            $model->save();
        }

        $this->render('grants', array(
            'model' => $model,
        ));
    }

    public function loadGrantsModel($id)
    {
        $model = Grants::model()->findByAttributes(array(
            'grants2' => $id,
        ));

        if (empty($model)) {
            $model = new Grants();
            $model->grants1 = new CDbExpression('GEN_ID(GEN_GRANTS, 1)');
            $model->grants2 = $id;
            $model->save(false);
        }

        return $model;
    }

    public function actionJournal()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {
            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }


        $this->render('journal', array(
        ));
    }
}