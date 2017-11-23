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
     * задать apiKey
     * @param string $apiKey
     * @return void
     */
    /*public function setApiKey($apiKey)
    {
        $this->_apiKey = $apiKey;
    }*/

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
     * задать host
     * @param string $host
     * @return void
     */
    /*public function setHost($host)
    {
        $this->_host = $host;
    }*/

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
     * Отправка запроса
     * @param $body
     * @param array|null $headers
     * @return mixed
     */
    /*protected function _sendQuery($body, $headers = null)
    {
        $myCurl = curl_init();

        curl_setopt_array($myCurl, array(
            CURLOPT_URL => $this->host,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($body),
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($myCurl);

        $http_code = null;
        // Проверяем наличие ошибок
        if (!curl_errno($myCurl)) {

            $http_code = curl_getinfo($myCurl, CURLINFO_HTTP_CODE);
        }

        curl_close($myCurl);

        return array($http_code, $response);
    }*/
}