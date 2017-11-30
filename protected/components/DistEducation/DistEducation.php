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
     * @return array
     */
    abstract protected function sendSignUp($name, $username, $password, $email);

    /**
     * Привязка к уже существующей учетек
     * @param $user Users
     * @param $params array
     * @return array
     */
    abstract protected function saveSignUpOld($user, $params);

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
     * @param $name string Имя
     * @param $username string Логин
     * @param $password string Пароль
     * @param $email string Email
     * @return array
     */
    public function signUp($name, $username, $password, $email)
    {
        return $this->sendSignUp($name, $username, $password, $email);
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
}