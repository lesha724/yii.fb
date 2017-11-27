<?php

class DistEducationController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
            'checkPermission'
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'index',
                    'addLink'
                ),
                'expression' => 'Yii::app()->user->isTch',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * @param $filterChain
     * @throws CHttpException
     */
    public function filterCheckPermission($filterChain)
    {
        if(!Yii::app()->user->isAdmin) {
            /**
             * @var $grants Grants
             */
            $grants = Yii::app()->user->dbModel->grants;

            if (empty($grants))
                throw new CHttpException(404, 'Invalid request. You don\'t have access to the service.');

            if ($grants->getGrantsFor(Grants::DIST_EDUCATION_ADMIN) != 1) {
                if ($grants->getGrantsFor(Grants::DIST_EDUCATION) != 1)
                    throw new CHttpException(404, 'Invalid request. You don\'t have access to the service.');
            }
        }

        $filterChain->run();
    }

    /**
     *
     */
	public function actionIndex()
	{
	    $model = new DistEducationFilterForm(Yii::app()->user);
        $model->unsetAttributes();

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
        }

	    if(isset($_REQUEST['DistEducationFilterForm'])){
            $model->attributes = $_REQUEST['DistEducationFilterForm'];
        }

	    if($model->isAdminDistEducation){
            $chairId = Yii::app()->request->getParam('chairId', null);

            $model->setChairId($chairId);
        }

		$this->render('index', array(
            'model' => $model
        ));
	}

    /**
     * Рендер формы для привязки дисциплины к дист образованию
     * @param $uo1
     */
	public function actionAddLink($uo1){
        $model = new DistEducationFilterForm(Yii::app()->user);
    }
}