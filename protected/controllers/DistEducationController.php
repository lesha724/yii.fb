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
                    'addLink',
                    'saveLink'
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
     */
	public function actionAddLink(){
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $model = new DistEducationFilterForm(Yii::app()->user);

        $uo1 = Yii::app()->request->getParam('uo1', null);
        $k1 = Yii::app()->request->getParam('k1', null);

        $model->setChairId($k1);

        $error=false;
        $html='';
        $title=tt('Закрепление дисциплины');

        if(empty($uo1))
            $error=true;

        $connector = SH::getDistEducationConnector(
            $this->universityCode
        );

        if(empty($connector))
            $error = true;

        if(!$error)
        {
            $disp = $model->getDispInfo($uo1);

            if(empty($disp)) {
                $error = true;
            }
            else{
                $html = $this->renderPartial('_add_link_form', array(
                    'disp' => $disp,
                    'model'=>$model,
                    'coursesList' => $connector->getCoursesListForLisData()
                ), true);
            }
        }

        $res = array(
            'title'=>$title,
            'html' => $html,
            'error' => $error
        );

        Yii::app()->end(CJSON::encode($res));
    }

    /**
     * Сохранение привязки дисциплины к дист образованию
     */
    public function actionSaveLink(){
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $model = new DistEducationFilterForm(Yii::app()->user);

        $uo1 = Yii::app()->request->getParam('uo1', null);
        $k1 = Yii::app()->request->getParam('k1', null);
        $id = Yii::app()->request->getParam('id', null);

        $title = tt('Закрепление дисциплины');
        $message = '';
        $error = false;

        if($uo1==null  || $k1==null || $id==null)
            $error = true;
        else {
            $model->setChairId($k1);

            if (empty($uo1))
                $error = true;

            $connector = SH::getDistEducationConnector(
                $this->universityCode
            );

            if (empty($connector)) {
                $error = true;
                $message = tt('Ошибка создания конектора');
            }

            if (!$error) {
                $disp = $model->getDispInfo($uo1);

                if (empty($disp)) {
                    $error = true;
                    $message = tt('Не найдена дисциплина');
                } else {
                    $course = $connector->getCourse($id);

                    if(empty($course))
                    {
                        $error = true;
                        $message = tt('Не найден курс');
                    }
                    else
                    {
                        if(!$connector->saveLinkCourse($uo1, $course)){
                            $error = true;
                            $message = tt('Ошибка сохранения привязки');
                        }
                    }
                }
            }
        }

        $res = array(
            'title' => $title,
            'message' => $message,
            'error' => $error
        );

        Yii::app()->end(CJSON::encode($res));
    }
}