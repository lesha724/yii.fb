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

            if ($grants->getGrantsFor(Grants::DIST_EDUCATION) != 1)
                throw new CHttpException(404, 'Invalid request. You don\'t have access to the service.');
        }

        $filterChain->run();
    }

    /**
     *
     */
	public function actionIndex()
	{
	    $user = Yii::app()->user;

        $chair = $user->dbModel->chair;

	    if($user->isAdmin){
            $chairId = Yii::app()->request->getParam('chairId', null);

            $chair = K::model()->findByPk($chairId);
        }

		$this->render('index', array(
		    'user' => $user,
            'chair' => $chair
        ));
	}
}