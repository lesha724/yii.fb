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

    public function actionParents()
    {
        $model = new St;
        $model->unsetAttributes();

        if (isset($_REQUEST['St']))
            $model->attributes = $_REQUEST['St'];

        $this->render('parents', array(
            'model' => $model,
        ));
    }
	
	public function actionSettings()
    {
        $file = YiiBase::getPathOfAlias('application.config').'/params.inc';
        $content = file_get_contents($file);
        $arr = unserialize(base64_decode($content));
        $model = new ConfigForm();
        $model->setAttributes($arr);

        if (isset($_POST['ConfigForm']))
        {
            $config = array(
                'attendanceStatistic'=>$_POST['ConfigForm']['attendanceStatistic'],
				'timeTable'=>$_POST['ConfigForm']['timeTable'],
				'fixedCountLesson'=>$_POST['ConfigForm']['fixedCountLesson'],
				'countLesson'=>$_POST['ConfigForm']['countLesson'],
				'analytics'=>$_POST['ConfigForm']['analytics'],
            );
            $str = base64_encode(serialize($config));
            if(file_put_contents($file, $str))
				Yii::app()->user->setFlash('config', tt('Новые настройки сохранены!'));
			else
				Yii::app()->user->setFlash('config_error', tt('Ошибка! Новые настройки не сохранены!'));
            $model->setAttributes($config);
        }

        $this->render('settings',array('model'=>$model));
    }

    public function actionStGrants($id)
    {
        if (empty($id))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $type = 0; // student
        $user = $this->loadUsersModel($type, $id);

        if (isset($_REQUEST['Users'])) {
            $user->attributes = $_REQUEST['Users'];
            $user->save();
        }

        $this->render('stGrants', array(
            'user'  => $user
        ));
    }

    public function actionPGrants($id)
    {
        if (empty($id))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $model = $this->loadGrantsModel($id);
		$model->scenario = 'admin-teachers';
        if (isset($_REQUEST['Grants'])) {
            $model->attributes = $_REQUEST['Grants'];
            $model->save();
        }

        $type = 1; // teacher
        $user = $this->loadUsersModel($type, $model->grants2);

        if (isset($_REQUEST['Users'])) {
            $user->attributes = $_REQUEST['Users'];
            $user->save();
        }

        $this->render('pGrants', array(
            'model' => $model,
            'user'  => $user
        ));
    }

    public function actionPrntGrants($id)
    {
        if (empty($id))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $type = 2; // parent
        $user = $this->loadUsersModel($type, $id);

        if (isset($_REQUEST['Users'])) {
            $user->attributes = $_REQUEST['Users'];
            $user->save();
        }

        $this->render('prntGrants', array(
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
			$model->grants7 = 0;
            $model->save(false);
        }

        return $model;
    }

    public function loadUsersModel($type, $id)
    {
        $user = Users::model()->findByAttributes(array(
            'u5' => $type,  // teacher || student || parents
            'u6' => $id     // p1 || st1
        ));

        if (empty($user)) {
            $user = new Users();
            $user->u1 = new CDbExpression('GEN_ID(GEN_USERS, 1)');
            $user->u2 = '';
            $user->u3 = '';
            $user->u4 = '';
            $user->u5 = $type;
            $user->u6 = $id;
            $user->u7 = 0;
            $user->save(false);

            $user->scenario = 'create';
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

    public function actionEmployment()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {
            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }

        $this->render('employment', array(
        ));
    }
}