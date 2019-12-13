<?php
/**
 * Опросы
 * Class QuizController
 */
class QuizController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
            'checkPermission +index,create, updateFlur',
            'postOnly +save,cancel'
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'index',
                    'create',
                    'updateFlur'
                ),
                'expression' => 'Yii::app()->user->isDoctor || Yii::app()->user->isAdmin',
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

            if (!in_array($grants->getGrantsFor(Grants::QUIZ), array(1, 2)))
                throw new CHttpException(403, 'Invalid request. You don\'t have access to the service.');
        }
        $filterChain->run();
    }

    /**
     * Опросник
     * Отображение результатов и форма измнения
     * ТОлько для докторов ХНМУ
     */
    public function actionIndex()
    {
        $model = new TimeTableForm;
        $model->scenario = 'group';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $this->render('index', array(
            'model'      => $model,
            'readOnly' => Yii::app()->user->dbModel->grants->getGrantsFor(Grants::QUIZ) != 1
        ));
    }

    /**
     * Опросник
     * Сохранения флюрография
     *  ТОлько для докторов ХНМУ
     * @throws CHttpException
     */
    public function actionUpdateFlur()
    {
        if(!Yii::app()->user->isAdmin) {
            $grants = Yii::app()->user->dbModel->grants;
            if ($grants->getGrantsFor(Grants::QUIZ) != 1)
                throw new CHttpException(403, tt('Нет доступа на запись'));
        }

        $pe1 = Yii::app()->request->getParam('pe1', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);

        if(empty($pe1) || empty($field) || empty($value))
            throw new CHttpException(400, 'Ошибка входящих данных');

        if(!in_array($field, array('pe65', 'pe66', 'pe67')))
            throw new CHttpException(400, 'Ошибка входящих данных');

        $person = Person::model()->findByPk($pe1);
        if(empty($person))
            throw new CHttpException(500, 'Ошибка входящих данных');

        if($person->saveAttributes(array(
            $field => $value
        )))
            Yii::app()->end('ok');
        else
            throw new CHttpException(500, 'Ошибка сохранения');
    }

    /**
     * Опросник
     * Сохранения результата
     *  ТОлько для докторов ХНМУ
     * @throws CHttpException
     */
    public function actionCreate()
    {
        if(!Yii::app()->user->isAdmin) {
            $grants = Yii::app()->user->dbModel->grants;
            if ($grants->getGrantsFor(Grants::QUIZ) != 1)
                throw new CHttpException(403, tt('Нет доступа на запись'));
        }
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