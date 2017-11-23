<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 06.11.2017
 * Time: 16:23
 */

/**
 * Class EdxDistEducation
 * Конектор для edx
 * @property string $apiKey
 */
class EdxDistEducation extends DistEducation implements IEdxDistEducation
{
    /**
     * отправка запроса для регистрации
     * @param $name string
     * @param $username string
     * @param $password string
     * @param $email string
     * @return array
     * @throws Exception empty apikey
     */
    protected function sendSignUp($name, $username, $password, $email)
    {
        throw  new CHttpException(400,'Not implimented!');

        /*$body = json_encode(array(
            'username'=>$username,
            'name'=> $name,
            'password'=> $password,
            'email'=> $email
        ));

        $headers = $this->_getHeaders();

        try{
            list($code, $result) = $this->_sendQuery($body, $headers);

            if($code!=200) {
                return array(false, $result);
            }

            return array(true, null);

        }catch (Exception $error){

            return array(false, $error->getMessage());
        }*/
        //return array(false, '');
    }

    /**
     * @param Users $user
     * @return bool
     */
    protected function runLogin($user)
    {
        Yii::app()->request->redirect($this->host);
        return true;
    }

    /**
     * @param Users $user
     * @param array $params
     * @return array
     */
    protected function saveSignUpOld($user, $params)
    {
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
     * Заголовки
     * @return array
     * @throws Exception empty apikey
     */
    /*private function _getHeaders(){

        if(empty($this->apiKey))
            throw new Exception('EdxDistEducation: apikey empty');

        return array(
            'Content-Type' => 'application/json',
            'X-Edx-Api-Key' => $this->apiKey
        );
    }*/
}