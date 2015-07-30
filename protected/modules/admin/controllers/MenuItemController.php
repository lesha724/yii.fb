<?php

class MenuItemController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	public function getPageSizeArray()
        {
            return array(5=>5,10=>10,20=>20,50=>50,100=>100);
        }
        
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','update','create','delete','changeVisible'),
				'expression' => 'Yii::app()->user->isAdmin',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionChangeVisible($id,$type)
        {
            if(!Yii::app()->request->isAjaxRequest) throw new CHttpException('Нет доступа');
            $model=$this->loadModel($id);
            $model->pm7=$type;
            $model->save();
        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pm;
                $model->unsetAttributes();
                $model->pm9=0;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pm']))
		{
			$model->attributes=$_POST['Pm'];
                        if($model->validate())
                        {
                            $model->pm1=new CDbExpression('GEN_ID(GEN_PM, 1)');
                            if($model->save())
                                    $this->redirect(array('index'));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pm']))
		{
			$model->attributes=$_POST['Pm'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$model=new Pm('search');
		$model->unsetAttributes();  // clear any default values
                if (isset($_GET['pageSize'])) {
                    Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
                    unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
                }
		if(isset($_GET['Pm']))
			$model->attributes=$_GET['Pm'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Pm::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pm-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
