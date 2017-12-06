<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 06.11.2017
 * Time: 16:27
 */

/**
 * Class DistEducation
 * Класс для дистанционого обучения
 * @property string $host
 * @property string $apiKey
 */
abstract class DistEducation implements IDistEducation
{
    const KEY_CACHE_COURS_LIST = 'de_courses_list';
    /**
     * @var string АпиКей
     */
    private $_apiKey;

    /**
     * apiKey
     * @return string
     */
    public function getApiKey()
    {
        return $this->_apiKey;
    }

    /**
     * @var string Хост
     */
    private $_host;

    /**
     * Host
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * Отправка запроса для регистрации
     * @param Users $user
     * @return array
     */
    abstract protected function sendSignUp($user);

    /**
     * Привязка к уже существующей учетек
     * @param $user Users
     * @param $params array
     * @return array
     */
    protected function saveSignUpOld($user, $params){
        if(!$user->isStudent)
            return array(false, 'EdxDistEducation:'.tt('Пользователь не студент'));

        if(!isset($params['email']))
            return array(false, 'EdxDistEducation: params don`t contains email');

        $transaction = Yii::app()->db->beginTransaction();
        try {
            //Сохраняем приязку студента к акунту дистанционого образлвания
            $stDist = Stdist::model()->findByPk($user->u6);
            if($stDist==null) {
                $stDist = new Stdist();
                $stDist->stdist1 = $user->u6;
            }
            $stDist->stdist2 = $params['email'];

            if(!$stDist->save()){
                $transaction->rollback();

                $text = 'Ошибка сохранения!';

                $errors = $stDist->getErrors('stdist2');
                if(is_array($errors))
                    $text = implode('; ',$errors);

                if(is_string($errors))
                    $text = $errors;

                return array(false, $text);
            }
            //ставим метку студенту что он имеет привязку
            if(!$this->_setStudentSignUp($user->u6))
                $transaction->rollback();

            $transaction->commit();

            return array(true, '');

        } catch (Exception $e) {
            $transaction->rollback();
            return array(false, $e->getMessage());
        }
    }

    /**
     * @param $user Users
     * @return mixed
     */
    abstract protected function runLogin($user);

    /**
     * DistEducation constructor.
     * @param string $host
     * @throws Exception empty host
     */
    public function __construct($host, $apiKey)
    {
        if(empty($host))
            throw  new CHttpException(500,'DistEducation: Host empty');
        if(empty($apiKey))
            throw  new CHttpException(500,'DistEducation: ApiKey empty');

        $this->host = $host;
        $this->apiKey = $apiKey;
        //parent::__construct($host);
    }

    /**
     * Регистрация в системе дистанционого обучения
     * @param $user Users
     * @return array
     */
    public function signUp($user)
    {
        $res = $this->sendSignUp($user);

        if($res[0])
        {
            $this->saveSignUpOld($user, array(
                'email'=>$user->u4
            ));
        }

        return $res;
    }

    /**
     * Регистрация в системе дистанционого обучения
     * @param $user Users
     * @param $params array
     * @return array
     */
    public function signUpOld($user, $params)
    {
        return $this->saveSignUpOld($user, $params);
    }

    /**
     * Сохранить метку по студенту что регистрация в дист образовании прошла
     * @param $st1 int
     * @return bool
     */
    protected function _setStudentSignUp($st1){
        $st = St::model()->findByPk($st1);

        if($st == null)
            return false;

        if(!$st->saveAttributes(array('st168'=>1)))
            return false;

        return true;
    }

    /**
     * Авторизация в системе дистанционого обучения
     * @param $user Users Логин
     * @return bool
     */
    public function login($user)
    {
        return $this->runLogin($user);
    }

    /**
     * Список курсов
     * @return mixed
     */
    public function getCoursesList()
    {
        $id = self::KEY_CACHE_COURS_LIST;

        $value=Yii::app()->cache->get($id);
        if($value===false)
        {
            // устанавливаем значение $value заново, т.к. оно не найдено в кэше,
            // и сохраняем его в кэше для дальнейшего использования:
            $list = $this->_getCoursesList();
            Yii::app()->cache->set($id,$list,600);
            return $list;
        }

        return $value;
    }

    /**
     * Список курсов
     * @return mixed
     */
    abstract protected function _getCoursesList();

    /**
     * Инфо по курсу по $id
     * @param string|int $id
     * @return mixed
     */
    public function getCourse($id)
    {
        if(empty($id))
            return null;

        return $this->_getCourse($id);
    }

    /**
     * Список курсов
     * @return mixed
     */
    abstract protected function _getCourse($id);

    /**
     * Список курсов для combobox @see CHtml::listData()
     * @return mixed
     */
    public function getCoursesListForLisData()
    {
        return $this->_getCoursesListForLisData();
    }

    /**
     * Список курсов для combobox @see CHtml::listData()
     * @return mixed
     */
    abstract protected function _getCoursesListForLisData();

    /**
     * Сохранения привязки
     * @param $uo1 int
     * @param $course object|array
     * @return bool
     */
    public function saveLinkCourse($uo1, $course)
    {
        $model = DispDist::model()->findByPk($uo1);

        if($model==null)
        {
            $model = new DispDist();
            $model->dispdist1 = $uo1;
        }

        $model->setAttributes($this->_getParamsLink($course));

        $model->dispdist4 = Yii::app()->user->dbModel->p1;
        $model->dispdist5 = date('Y-m-d H:i:s');

        return $model->save();

    }

    /**
     * Сохранения привязки
     * @param $course object|array
     * @return array
     */
    abstract protected function _getParamsLink($course);

    /**
     * Валидировать email (есть ли пользователь стаким email)
     * @param string $email
     * @return bool
     */
    public function validateEmail($email)
    {
        return $this->_validateEmail($email);
    }

    /**
     * Валидировать email
     * @param string $email
     * @return bool
     */
    abstract protected function _validateEmail($email);
}