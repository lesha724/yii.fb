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
    public function __construct($host, $apiKey)
    {
        Yii::import('ext.EHttpClient.*');
        parent::__construct($host, $apiKey);
    }

    /**
     * @param Users $user
     * @return array
     */
    protected function getParamsForSignUp($user)
    {
        // TODO: Implement getParamsForSignUp() method.
        return array();
    }

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
    protected function sendSignUp($user, $params)
    {
        throw  new CHttpException(400,'Not implimented!');
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
     * @return mixed
     * @throws CHttpException
     */
    protected function _getCoursesList()
    {
        $body = $this->_sendQuery('/api/courses/v1/courses/?page_size=999');

        $array = json_decode($body);

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

    protected function _getColumnsForGridView()
    {
        $url = $this->host;

        return array(
            'image' => array(
                'header'=>tt('Изображение'),
                'name'=>'image',
                'value'=>function($course) use (&$url){
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

                    return CHtml::image($url. $course->media->course_image->uri);
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
                'value' => function($course){
                    if(empty($course->start))
                        return '';

                    return date('d.m.Y', strtotime($course->start));
                },
            ),
            'end'=>array(
                'header'=>tt('Дата окончания'),
                'name'=>'end',
                'value' => function($course){
                    if(empty($course->end))
                        return '';

                    return date('d.m.Y', strtotime($course->end));
                },
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
    private function _sendQuery($method, $type = null, $params = null, $token = null, $rawData = null){
        $config = array(
            'maxredirects' => 0,
            'timeout'      => 30,
        );

        $header = array(
            'Content-Type'=>'application/json'
        );

        if($token!=null)
        {
            $header['X-Edx-Api-Key'] = $token;
        }

        $client = new EHttpClient( $this->host.$method, array());

        var_dump($this->host.$method);

        $client->setHeaders($header);

        var_dump($header);

        if($rawData!=null)
            $client->setRawData($rawData);

        var_dump($rawData);

        var_dump($type);

        if($type = EHttpClient::GET){
            if(!empty($params)) {
                $client->setParameterGet($params);
            }
        }else{
            if(!empty($params)) {
                $client->setParameterPost($params);
            }
        }

        $response = $client->request($type);

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

    /**
     * Записать студента на курс
     * @param Stdist $st
     * @param string $courseId
     * @return array
     */
    protected function _unsubscribeToCourse($st, $courseId){
        try {
            $this->_sendQuery(
                '/api/enrollment/v1/extension/enrollment/',
                EHttpClient::DELETE,
                null,
                $this->apiKey,
                json_encode(
                    array(
                        'email'=> $st->stdist2,
                        'course_details'=>array(
                            'course_id'=>$courseId
                        )
                    )
                )
            );

            return array(true, '');
        }catch (Exception $error){
            return array(false, $error->getMessage());
        }
    }

    /**
     * Записать студента на курс
     * @param Stdist $st
     * @param string $courseId
     * @return array
     */
    protected function _subscribeToCourse($st, $courseId){
        try {
            $this->_sendQuery(
                '/api/enrollment/v1/extension/enrollment/',
                EHttpClient::POST,
                null,
                $this->apiKey,
                json_encode(
                    array(
                        'email'=> $st->stdist2,
                        'course_details'=>array(
                            'course_id'=>$courseId
                        )
                    )
                )
            );

            return array(true, '');
        }catch (Exception $error){
            return array(false, $error->getMessage());
        }
    }
}