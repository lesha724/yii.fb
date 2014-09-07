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

        $user = $this->loadUsersModel($model->grants2);

        if (isset($_REQUEST['Users'])) {
            $user->attributes = $_REQUEST['Users'];
            $user->save(false);
        }

        $this->render('grants', array(
            'model' => $model,
            'user'  => $user
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

    public function loadUsersModel($p1)
    {
        $user = Users::model()->findByAttributes(array(
            'u5' => 1,  // teacher
            'u6' => $p1 //p1
        ));

        if (empty($user)) {
            $user = new Users();
            $user->u1 = new CDbExpression('GEN_ID(GEN_USERS, 1)');
            $user->u2 = '';
            $user->u3 = '';
            $user->u4 = '';
            $user->u5 = 1;
            $user->u6 = $p1;
            $user->u7 = 0;
            $user->save(false);
        }

        return $user;
    }

    public function actionJournal()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {

            if ($key == 27)
                $value = intval($value);

            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }


        $this->render('journal', array(
        ));
    }

    public function actionModules()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {
            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }

        $this->render('modules', array(
        ));
    }

    public function actionEntrance()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {
            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }

        $this->render('entrance', array(
        ));
    }

    public function actionMenu()
    {
        $webroot = Yii::getPathOfAlias('application');
        $file = $webroot . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.txt';

        if (isset($_REQUEST['menu']))
            file_put_contents($file, $_REQUEST['menu']);

        $settings = file_get_contents($file);

        $this->render('menu', array(
            'settings' => $settings
        ));
    }
}