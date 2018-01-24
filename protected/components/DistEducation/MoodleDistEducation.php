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
     * @param Users $user
     * @return array
     * @throws CHttpException
     */
    protected function getParamsForSignUp($user)
    {
        $model = St::model()->findByPk($user->u6);
        if($model==null)
            throw new CHttpException(400, tt('Студент не найден'));

        return array(
            'username'=>$user->u2,
            'firstname'=>CHtml::encode($model->st3),
            'lastname'=>CHtml::encode($model->st2),
            'email'=>$user->u4,
            'idnumber'=>'student'.$user->u6,
            'password'=>'St_password'.$user->u6,
        );
    }

    /**
     * отправка запроса для регистрации
     * @param Users $user
     * @return array
     */
    protected function sendSignUp($user, $params)
    {
        $body = $this->_sendQuery('core_user_create_users','GET', array(
            'users'=>array(
                $params
            )
        ));

        $array = json_decode($body);

        if(isset($array->errorcode)){
            return array(false, 'Ошибка '.$array->message);
        }else {

            if (count($array) != 1) {
                return array(false, 'Ошибка');
            } else {
                return array($array[0]->username == $user->u2, '', $array[0]->id);
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
            'shortname'=>array(
                'header'=>tt('Сокр. название'),
                'name'=>'shortname'
            ),
            'displayname'=>array(
                'header'=>tt('Название'),
                'name'=>'displayname'
            ),
            'startdate'=>array(
                'header'=>tt('Дата начала'),
                'name'=>'startdate',
                'value'=>'date("d.m.Y",$course->startdate)'
            ),
            'enddate'=>array(
                'header'=>tt('Дата окончания'),
                'name'=>'enddate',
                'value'=>'date("d.m.Y",$course->enddate)'
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

    /**
     * Записать студента на курс
     * @param St $st
     * @param string $courseId
     * @return array
     */
    protected function _unsubscribeToCourse($st, $courseId){

    }

    /**
     * Записать студента на курс
     * @param St $st
     * @param string $courseId
     * @return array
     */
    protected function _subscribeToCourse($st, $courseId){

    }

    /**
     * Записать студента на курс по дисциплине
     * @param St $st
     * @param int $uo1
     * @return array
     */
    public function unsubscribeToCourse($st, $uo1)
    {
        $globalResult = true;
        $log = '';

        $model = DispDist::model()->findByPk($uo1['uo1']);

        if($model==null)
        {
            $log .= '<br>' . $uo1['d2']. ' : Дисциплина не привязана ';
            $globalResult = false;
            return array($globalResult, $log);
        }

        $id = $model->dispdist3;

        return $this->_unsubscribeToCourse($st, $id);
    }

    /**
     * Записать студента на курс
     * @param St $st
     * @param int $uo1
     * @return array
     */
    public function subscribeToCourse($st, $uo1)
    {
        $globalResult = true;
        $log = '';

        $model = DispDist::model()->findByPk($uo1['uo1']);

        if($model==null)
        {
            $log .= '<br>' . $uo1['d2']. ' : Дисциплина не привязана ';
            $globalResult = false;
            return array($globalResult, $log);
        }

        $id = $model->dispdist3;

        return $this->_subscribeToCourse($st, $id);
    }

    /**
     * Записать студентов на курс по дсициплине
     * @param St[] $students
     * @param int $uo1
     * @return array
     */
    public function subscribeStudentsToCourse($students, $uo1)
    {
        $globalResult = true;
        $log = '';

        $model = DispDist::model()->findByPk($uo1['uo1']);

        if($model==null)
        {
            $log .= '<br>' . $uo1['d2']. ' : Дисциплина не привязана ';
            $globalResult = false;
            return array($globalResult, $log);
        }

        $id = $model->dispdist3;

        foreach ($students as $student) {
            list($result, $message) = $this->_subscribeToCourse($student, $id);

            if(!$result) {
                $globalResult = false;
                $log .= $student->getShortName(). ' Ошибка записи: '. $message;
            }else{
                $log .= $student->getShortName(). ' Запись удачна. '. $message;
            }

        }

        return array($globalResult, $log);
    }
}