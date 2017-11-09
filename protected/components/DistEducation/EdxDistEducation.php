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
    public function setApiKey($apiKey)
    {
        $this->_apiKey = $apiKey;
    }

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
        throw  new Exception('Not implimented!');

        $body = json_encode(array(
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
        }
        //return array(false, '');
    }

    /**
     * Заголовки
     * @return array
     * @throws Exception empty apikey
     */
    private function _getHeaders(){

        if(empty($this->apiKey))
            throw new Exception('EdxDistEducation: apikey empty');

        return array(
            'Content-Type' => 'application/json',
            'X-Edx-Api-Key' => $this->apiKey
        );
    }
}