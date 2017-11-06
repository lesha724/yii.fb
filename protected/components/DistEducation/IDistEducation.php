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
     * @param $value
     * @return mixed
     */
    public function setHost($value);

    /**
     * Регистрация в системе дистанционого обучения
     * @param $name string Имя
     * @param $username string Логин
     * @param $password string Пароль
     * @param $email string Email
     * @return mixed
     */
    public function signUp($name, $username, $password, $email);

    /**
     * Авторизация в системе дистанционого обучения
     * @param $username string Логин
     * @return mixed
     */
    public function login($username);
}