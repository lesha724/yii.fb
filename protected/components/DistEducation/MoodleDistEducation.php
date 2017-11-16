<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 06.11.2017
 * Time: 16:24
 */

/**
 * Class MoodleDistEducation
 * Конектор для мудла
 */
class MoodleDistEducation extends DistEducation
{
    /**
     * отправка запроса для регистрации
     * @return array
     */
    protected function sendSignUp($name, $username, $password, $email)
    {
        return array(false, 'Ошибка');
    }

    /**
     * Авторизация в ситием дистанционого обучения
     * @param Users $user
     * @return bool
     */
    protected function runLogin($user)
    {
        Yii::app()->request->redirect($this->host);
        return true;
    }

    /**
     * Привязать пользователя к существующей учетке
     * @param Users $user
     * @param array $params
     * @return array
     * @throws CHttpException
     */
    protected function saveSignUpOld($user, $params)
    {
        throw  new CHttpException(400,'Not implimented!');
    }
}