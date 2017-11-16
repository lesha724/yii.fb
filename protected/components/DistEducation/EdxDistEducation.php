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