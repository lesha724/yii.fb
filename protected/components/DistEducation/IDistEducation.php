<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 06.11.2017
 * Time: 16:01
 */

/**
 * Interface IDistEducation
 * Коннектор для дистанционого обучения
 */
interface IDistEducation
{
    /**
     * Геттер для хоста
     * @return mixed
     */
    public function getHost();

    /**
     * Сеттер для хоста
     * @param string $value
     * @return mixed
     */
    //public function setHost($value);

    /**
     * Регистрация в системе дистанционого обучения
     * @param string $name  Имя
     * @param string $username  Логин
     * @param string $password  Пароль
     * @param string $email  Email
     * @return mixed
     */
    public function signUp($name, $username, $password, $email);

    /**
     * Авторизация в системе дистанционого обучения
     * @param $username string Логин
     * @return mixed
     */
    public function login($username);

    /**
     * IDistEducation constructor.
     * @param string $host Хост
     */
    public function __construct($host);
}