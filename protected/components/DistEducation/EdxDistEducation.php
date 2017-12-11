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
    /*
     *
     */
    const ID_FIELD_NAME = 'course_id';

    /**
     * отправка запроса для регистрации
     * @param $user Users
     * @return array
     * @throws Exception empty apikey
     */
    protected function sendSignUp($user)
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
    /*protected function saveSignUpOld($user, $params)
    {

    }*/

    /**
     * @return mixed
     * @throws CHttpException
     */
    protected function _getCoursesList()
    {
        $body = $this->_sendQuery('/api/courses/v1/courses/?page_size=999');

        $array = json_decode($body);

        //var_dump($array);

        if(!isset($array->results))
            throw new CHttpException(500, 'EdxDistEducation: Ошибка загрузки курсов. Неверный формат ответа');
        else
            return $array->results;
    }

    /**
     * Инфо по курсу по id
     * Сейчас береться из @see getCoursesList
     * @param string $id
     * @return object|null|array
     * @throws CHttpException
     */
    protected function _getCourse($id)
    {
        $course = array_filter(
            $this->getCoursesList(),
            function ($e) use (&$id) {
                return $e->course_id == $id;
            }
        );

        if(empty($course))
            return null;

        if(count($course)>1)
            throw  new CHttpException(500, 'EdxDistEducation:Несколько курсов с id');

        return current($course);
    }

    /**
     * Список курсов для combobox @see CHtml::listData()
     * @return mixed
     */
    /*protected function _getCoursesListForLisData()
    {
        $list = $this->getCoursesList();

        return CHtml::listData($list,'course_id', function ($data){
            return $data->name. ' / '. $data->course_id;
        });
    }*/

    protected function _getColumnsForGridView()
    {
        return array(
            'image' => array(
                'header'=>tt('Изображение'),
                'name'=>'image',
                'value'=>function($course){
                    /*if(!isset($course->media))
                        return '';*/

                    /*if(empty($course->media))
                        return '';*/

                    if(!isset($course->media->course_image))
                        return '';

                    if(empty($course->media->course_image))
                        return '';

                    if(!isset($course->media->course_image->uri))
                        return '';

                    return CHtml::image($this->host. $course->media->course_image->uri);
                },
            ),
            'course_id' => array(
                'header'=>tt('Course_id'),
                'name'=>'course_id',
            ),
            'name'=>array(
                'header'=>tt('Название'),
                'name'=>'name',
            ),
            'short_description'=>array(
                'header'=>tt('Описание'),
                'name'=>'short_description',
            ),

            'start'=>array(
                'header'=>tt('Дата начала'),
                'name'=>'start',
            ),
            'end'=>array(
                'header'=>tt('Дата окончания'),
                'name'=>'end',
            )

        );
    }

    /**
     * Массив параметров для привязки
     * @param $course object|array
     * @return array
     */
    protected function _getParamsLink($course)
    {
        return array(
            'dispdist3'=> $course->course_id,
            'dispdist2' => $course->name
        );
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

    /**
     * Валидация email
     * @param string $email
     * @return bool
     */
    protected function _validateEmail($email)
    {
        return true;
    }

    /**
     * @param $method
     * @param null|string $type @see EHttpClient::POST
     * @param null|array $params парметры для запроса зависит отметода $type
     * @return string
     * @throws CHttpException
     */
    private function _sendQuery($method, $type = null, $params = null){
        Yii::import('ext.EHttpClient.*');

        $client = new EHttpClient( $this->host.$method, array(
            'maxredirects' => 0,
            'timeout'      => 30));

        $response = $client->request($type);

        if($type = EHttpClient::GET){
            if(!empty($params)) {
                $client->setParameterGet($params);
            }
        }else{
            if(!empty($params)) {
                $client->setParameterPost($params);
            }
        }


        if($response->isSuccessful())
        {
            return $response->getBody();
        }
        else
            throw new CHttpException(500, 'EdxDistEducation: Ошибка отправки запроса. '.$response->getRawBody());
    }

    public function getNameIdFiled()
    {
        return self::ID_FIELD_NAME;
    }
}