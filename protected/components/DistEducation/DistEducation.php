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
 */
abstract class DistEducation implements IDistEducation
{
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
     * DistEducation constructor.
     * @param string $host
     * @throws Exception empty host
     */
    public function __construct($host)
    {
        if(empty($host))
            throw  new Exception('DistEducation: Host empty');

        $this->host = $host;
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
     * Авторизация в системе дистанционого обучения
     * @param $username string Логин
     * @return bool
     */
    public function login($username)
    {
        // TODO: Implement login() method.
    }

    /**
     * Отправка запроса
     * @param $body
     * @param array|null $headers
     * @return mixed
     */
    protected function _sendQuery($body, $headers = null)
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

        /*if($http_code!=200)
            throw new Exception($http_code. ' '. $response);*/

        curl_close($myCurl);

        return array($http_code, $response);
    }
}