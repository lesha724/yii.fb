<?php

class DefaultController extends AdminController
{
    public function actionStudentCard()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {
            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }

        $this->render('studentCard');
    }

    public function actionRating()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {
            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }

        $this->render('rating');
    }
	
	public function actionMail()
    {
        $file = YiiBase::getPathOfAlias('application.config').'/mail.inc';
        $content = file_get_contents($file);
        $arr = unserialize(base64_decode($content));
        $model = new ConfigMailForm();
        $model->setAttributes($arr);

        if (isset($_POST['ConfigMailForm']))
        {
            $config = array(
                //'Class'=>'application.extensions.smtpmail.PHPMailer',
                'Host'=>$_POST['ConfigMailForm']['Host'],
                'Username'=>$_POST['ConfigMailForm']['Username'],
                'Password'=>$_POST['ConfigMailForm']['Password'],
                'Mailer'=>$_POST['ConfigMailForm']['Mailer'],
                'Port'=>$_POST['ConfigMailForm']['Port'],
                //'SMTPAuth'=>true,
            );
            $model->setAttributes($config);
            if($model->validate())
            {
                $str = base64_encode(serialize($config));
                if(file_put_contents($file, $str))
                    Yii::app()->user->setFlash('config',tt("Настройки почты сохранены!"));
                else
                    Yii::app()->user->setFlash('config_error',tt("Ошибка! Настройки почты не сохранены!"));

            }
        }

        $this->render('mail',array('model'=>$model));
    }
	
    public function actionCloseChair()
    {
        $model = new Kcp();
        $model->unsetAttributes();
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
        }
        if (isset($_REQUEST['Kcp']))
            $model->attributes = $_REQUEST['Kcp'];

        $this->render('closeChair', array(
            'model' => $model,
        ));
    }

    public function actionUserHistory()
    {
        /*if (!isset($_SERVER['HTTP_REFERER'])or(!strpos($_SERVER['HTTP_REFERER'], 'userHistory'))) //change _ControllerName_ to your controller page
        {
            Yii::app()->user->setState('SearchParamsUH', null);
            Yii::app()->user->setState('CurrentPageUH', null);
        }*/
        $model = new UsersHistory();
        $model->unsetAttributes();
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
        }

        if (isset($_REQUEST['UsersHistory']))
        {
            $model->attributes = $_REQUEST['UsersHistory'];
            Yii::app()->user->setState('SearchParamsUH', $_REQUEST['UsersHistory']);
            Yii::app()->user->setState('CurrentPageUH', null);
        }
        else
        {
            $searchParams = Yii::app()->user->getState('SearchParamsUH');
            if ( isset($searchParams) )
            {
                $model->attributes = $searchParams;
            }
        }

        /*if (isset($_GET['UsersHistory_page']))
        {
            Yii::app()->user->setState('CurrentPageUH', $_GET['UsersHistory_page']);
        }
        else
        {
            $page = Yii::app()->user->getState('CurrentPageUH');
            if ( isset($page) )
            {
                $_GET['UsersHistory_page'] = $page;
            }
        }*/

        /*if (isset($_REQUEST['UsersHistory']))
            $model->attributes = $_REQUEST['UsersHistory'];*/

        $this->render('userHistory', array(
            'model' => $model,
        ));
    }

    public function actionDeleteUserHistory($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $model = UsersHistory::model()->findByPk($id);
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            //if(!isset($_GET['ajax']))
                $this->redirect(array('userHistory'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionCreateCloseChair()
    {
        $model=new Kcp();
        $model->unsetAttributes();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Kcp']))
        {
            $model->attributes=$_POST['Kcp'];
            $model->kcp1 = $model->getMax()+1;
            if($model->save())
                $this->redirect(array('closeChair'));
            print_r($model->getErrors());
        }else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionDeleteCloseChair($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $model = Kcp::model()->findByPk($id);
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('closeChair'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

	public function actionTeachers()
	{
       $chairId = Yii::app()->request->getParam('chairId', null);

        /*if (!isset($_SERVER['HTTP_REFERER'])or(!strpos($_SERVER['HTTP_REFERER'], 'teachers'))) //change _ControllerName_ to your controller page
        {
            Yii::app()->user->setState('SearchParamsP', null);
            Yii::app()->user->setState('CurrentPageP', null);
        }*/

        $model = new P;
        $model->unsetAttributes();
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
        }
        /*if (isset($_REQUEST['P']))
            $model->attributes = $_REQUEST['P'];*/

        if (isset($_REQUEST['P']))
        {
            $model->attributes = $_REQUEST['P'];
            Yii::app()->user->setState('SearchParamsP', $_REQUEST['P']);
            Yii::app()->user->setState('CurrentPageP', null);
        }
        else
        {
            $searchParams = Yii::app()->user->getState('SearchParamsP');
            //print_r($searchParams);
            if ( isset($searchParams) )
            {
                $model->attributes = $searchParams;
            }
        }
        /*$page = null;
        if (isset($_REQUEST['P_page']))
        {
            Yii::app()->user->setState('CurrentPageP', $_REQUEST['P_page']);
            $page = $_REQUEST['P_page'];
        }
        else
        {
            $page = Yii::app()->user->getState('CurrentPageP');
            print_r($page);
            if ( isset($page) )
            {
                $_REQUEST['P_page'] = $page;
            }
        }*/

        $this->render('teachers', array(
            'model' => $model,
            'chairId' => $chairId,
            //'page'=>$page
        ));
	}

    public function actionAdmin()
    {
        $model = new Users();
        $model->unsetAttributes();
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
        }
        if (isset($_POST['Users']))
            $model->attributes = $_POST['Users'];

        $model->u7=1;
        $this->render('admin/admin', array(
            'model' => $model,
        ));
    }

    public function actionAdminCreate()
    {
        $model=new Users('admin-create');
        $model->unsetAttributes();

        if(isset($_POST['Users']))
        {

            $model->attributes=$_POST['Users'];
            $model->u1=0;
            //$model->u1=new CDbExpression('GEN_ID(GEN_USERS, 1)');
            $model->u7=1;
            //$model->u6=0;
            $model->u5=1;
            if($model->validate())
            {
                $model->u1=new CDbExpression('GEN_ID(GEN_USERS, 1)');
                if($model->save(false))
                    $this->redirect(array('admin'));
            }

        }

        $this->render('admin/create',array(
            'model'=>$model,
        ));
    }

    public function actionAdminUpdate($id)
    {
        $model=$this->loadAdminModel($id);
        $model->scenario='admin-update';

        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            $model->u7=1;
            //$model->u6=0;
            $model->u5=1;
            if($model->save())
                $this->redirect(array('admin'));
        }


        $this->render('admin/update',array(
            'model'=>$model,
        ));
    }

    public function actionAdminDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            if(Yii::app()->user->id==$id)
                throw new CHttpException(400,'Вы не можете удалить пользователя под которым авторизировались.');
            // we only allow deletion via POST request
            $this->loadAdminModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function loadAdminModel($id)
    {
        $model=Users::model()->findByAttributes(array('u1'=>$id,'u7'=>'1'));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionStudents()
    {
        $model = new St;
        $model->unsetAttributes();
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
        }
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

    public function actionSettingsPortal()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {
            /*if ($key == 38)
                $value = intval($value);*/
            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }

        $this->render('portal_settings', array());
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
				//'attendanceStatistic'=>$_POST['ConfigForm']['attendanceStatistic'],
				'timeTable'=>$_POST['ConfigForm']['timeTable'],
				'fixedCountLesson'=>$_POST['ConfigForm']['fixedCountLesson'],
				'countLesson'=>$_POST['ConfigForm']['countLesson'],
				'analytics'=>$_POST['ConfigForm']['analytics'],
				'top1'=>$_POST['ConfigForm']['top1'],
				'top2'=>$_POST['ConfigForm']['top2'],
                                'banner'=>$_POST['ConfigForm']['banner'],
                                'month'=>$_POST['ConfigForm']['month'],
			);
			$str = base64_encode(serialize($config));
			$errors=!file_put_contents($file, $str);
			if(!$errors)
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
            if($user->save())
                $this->redirect(array('teachers'));
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

    public function actionTimeTable()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {

            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }


        $this->render('timeTable', array(
        ));
    }

    public function actionList()
    {
        $settings = Yii::app()->request->getParam('settings', array());

        foreach ($settings as $key => $value) {

            PortalSettings::model()
                ->findByPk($key)
                ->saveAttributes(array(
                    'ps2' => $value
                ));
        }


        $this->render('list', array(
        ));
    }

    public function actionModules()
    {
        $settings = Yii::app()->request->getParam('settings', array());
        print_r($settings);
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