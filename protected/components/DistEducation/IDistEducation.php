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
     * Регистрация в системе дистанционого обучения
     * @param string $name  Имя
     * @param string $username  Логин
     * @param string $password  Пароль
     * @param string $email  Email
     * @return mixed
     */
    public function signUp($name, $username, $password, $email);

    /**
     * Привязать к уже существующей
     * @param $user Users
     * @param $params array
     * @return mixed
     */
    public function signUpOld($user, $params);

    /**
     * Список курсов
     * @return mixed
     */
    public function getCoursesList();

    /**
     * Инфо по курсу по id
     * @param string|int id
     * @return object|null|array
     */
    public function getCourse($id);

    /**
     * Авторизация в системе дистанционого обучения
     * @param $user Users
     * @return mixed
     */
    public function login($user);

    /**
     * IDistEducation constructor.
     * @param string $host Хост
     * @param string $appKey Апкей
     */
    public function __construct($host, $appKey);

    /**
     * Список курсов для combobox @see CHtml::listData()
     * @return mixed
     */
    public function getCoursesListForLisData();

    /**
     * Сохранения привязки
     * @param $uo1 int
     * @param $course object|array
     * @return bool
     */
    public function saveLinkCourse($uo1, $course);
}