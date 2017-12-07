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
     * @param Users $user
     * @return array
     */
    protected function sendSignUp($user)
    {
        if($this->validateEmail($user->u4)){
            return array(false, tt('Уже есть пользователь в дистанционом образовании с таким email!'));
        }

        $model = St::model()->findByPk($user->u6);
        if($model==null)
            return array(false, tt('Не найден студент!'));

        $body = $this->_sendQuery('core_user_create_users','GET', array(
            'users'=>array(
                array(
                    'username'=>$user->u2,
                    'firstname'=>CHtml::encode($model->st3),
                    'lastname'=>CHtml::encode($model->st2),
                    'email'=>$user->u4,
                    'idnumber'=>'student'.$user->u6,
                    'password'=>'St_password'.$user->u6,
                )
            )
        ));

        $array = json_decode($body);

        if(isset($array->errorcode)){
            return array(false, 'Ошибка '.$array->message);
        }else {

            if (count($array) != 1) {
                return array(false, 'Ошибка');
            } else {
                return array($array[0]->username == $user->u2, '');
            }
        }

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
     * Проверка email
     * @param string $email
     * @return bool
     */
    protected function _validateEmail($email)
    {
        $body = $this->_sendQuery('core_user_get_users','GET', array(
            'criteria'=>array(
                '0'=>array(
                    'key'=>'email',
                    'value'=>$email
                )
            )
        ));

        $array = json_decode($body);

        if(!isset($array->users))
            return false;
        else {
            if(count($array->users)!=1){
                return false;
            }else{
                return $array->users[0]->email == $email;
            }
        }
    }

    /**
     * @return mixed
     * @throws CHttpException
     */
    protected function _getCoursesList()
    {
        $body = $this->_sendQuery('core_course_get_courses','GET');

        $array = json_decode($body);

        if(!is_array($array))
            throw new CHttpException(500, 'EdxDistEducation: Ошибка загрузки курсов. Неверный формат ответа');
        else
            return $array;
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
                return $e->id == $id;
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

        return CHtml::listData($list,'id', function ($data){
            return $data->displayname. ' / '. $data->id;
        });
    }*/

    protected function _getColumnsForGridView()
    {
        return array(
            'id'=>array(
                'header'=>tt('Id'),
                'name'=>'id'/*,
                'value'=>'$data->id',*/
            ),
            'displayname'=>array(
                'header'=>tt('Название'),
                'name'=>'displayname'/*,
                'value'=>'$data->displayname',*/

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
            'dispdist3'=> $course->id,
            'dispdist2' => $course->displayname
        );
    }

    /**
     * Отправка запроса по мудлу
     * @param string $method метод
     * @param array $params параметрі
     * @return string
     * @throws CHttpException
     */
    private function _sendQuery($method, $type = null, $params=null){

        $uri = sprintf('%s/webservice/rest/server.php',$this->host);

        $params['wstoken']=$this->apiKey;
        $params['wsfunction']=$method;
        $params['moodlewsrestformat']='json';

        $curl = new MoodleCurl();

        $resp = $curl->get($uri,$params);

        if($resp)
        {
            return $resp;
        }
        else
            throw new CHttpException(500, 'MOODLEDistEducation: Ошибка отправки запроса. '.$resp);
    }
}