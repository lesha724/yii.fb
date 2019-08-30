<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 16.11.2018
 * Time: 14:27
 */

/**
 * Опросы
 * Class QuizController
 */
class QuizController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
            'checkPermission +index,create',
            'postOnly +save,cancel'
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'index',
                    'create'
                ),
                'expression' => 'Yii::app()->user->isDoctor || Yii::app()->user->isTch ',
            ),
            array('allow',
                'actions' => array(
                    'index2',
                    'save',
                    'cancel'
                ),
                'expression' => 'Yii::app()->user->isStd ',
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
        if(Yii::app()->core->universityCode!=U_XNMU)
            throw new CHttpException(403, 'Invalid request. You don\'t have access to the service.');
        
        if(!Yii::app()->user->isAdmin) {
            $grants = Yii::app()->user->dbModel->grants;

            if (empty($grants))
                throw new CHttpException(403, 'Invalid request. You don\'t have access to the service.');

            if ($grants->getGrantsFor(Grants::QUIZ) != 1)
                throw new CHttpException(403, 'Invalid request. You don\'t have access to the service.');
        }
        $filterChain->run();
    }

    /**
     * Опросник
     */
    public function actionIndex()
    {
        $model = new TimeTableForm;
        $model->scenario = 'group';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $this->render('index', array(
            'model'      => $model
        ));
    }

    /**
     * Опросник
     * @throws CHttpException
     */
    public function actionCreate()
    {
        $model = new CreateOprrezForm();

        $model->st1 = Yii::app()->request->getParam('st1', null);
        $model->opr1 = Yii::app()->request->getParam('opr1', null);

        if($model->opr1 == -1){
            if($model->deleteOprrez())
                Yii::app()->end('ok');
            else
                throw new CHttpException(500, 'Ошибка удаления');
        }

        if(!$model->validate())
            throw new CHttpException(400, 'Ошибка вводимых данных');

        if($model->saveOprrez())
            Yii::app()->end('ok');
        else
            throw new CHttpException(500, 'Ошибка создания');
    }

    /**
     *
     */
    public function actionIndex2()
    {
        $this->render('index2', array(
            'st'  => Yii::app()->user->dbModel
        ));
    }

    /**
     * сохранение опроса
     * @throws CException
     * @throws CHttpException
     */
    public function actionSave(){

        if(count(Oprrez::model()->getByStudent(Yii::app()->user->dbModel->st1)))
            throw new CHttpException(400, tt('Ошибка сохранения результатов опроса. Отмените сначала предедущие результаты'));

        $oprList = Opr::model()->findAll();
        if(empty($oprList))
            throw new CHttpException(400, tt('Ошибка сохранения результатов опроса. Не найдены вопросы'));

        if (!isset($_POST['answers']))
            throw new CHttpException(400, tt('Ошибка сохранения результатов опроса. Не отправлены ответы'));

        $oprrez = $_POST['answers'];

        $trans = Yii::app()->db->beginTransaction();

        try{
            foreach ($oprList as $opr)
            {
                if(!isset($oprrez[$opr->opr1]))
                    throw  new Exception(tt('Не задан ответ для вопроса {opr}', array(
                        '{opr}' => $opr->opr2
                    )));

                $model = new Oprrez();
                $model->oprrez1 = new CDbExpression('GEN_ID(GEN_OPRREZ, 1)');
                $model->oprrez2 = Yii::app()->user->dbModel->st1;
                $model->oprrez3 = $opr->opr1;
                $model->oprrez4 =  date('Y-m-d H:i:s');
                $model->oprrez5 = Yii::app()->user->id;
                $model->oprrez7 = Yii::app()->request->userHostAddress;
                $model->oprrez6 = $oprrez[$opr->opr1];

                if(!$model->save())
                    throw new Exception(tt('Ошибка сохранения ответ на вопрос {opr}', array(
                        '{opr}' => $opr->opr2
                    )));
            }

            $trans->commit();

            Yii::app()->user->setFlash('success', tt('Результаты успешно сохранены!'));

        }catch (Exception $error){
            $trans->rollback();
            throw new CHttpException(400, tt('Ошибка сохранения результатов опроса.').$error->getMessage());
        }

        $this->redirect('/quiz/index2');
    }

    /**
     * Отмена опроса
     * @throws CHttpException
     */
    public function actionCancel(){
        if(!Oprrez::model()->deleteAllByAttributes(array(
            'oprrez2' => Yii::app()->user->dbModel->st1
        )))
            throw new CHttpException(400, tt('Ошибка удаления результатов опроса.'));

        $this->redirect('/quiz/index2');
    }
}