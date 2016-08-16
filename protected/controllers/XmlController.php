<?php

class XmlController extends Controller
{
    const FORMAT_DATE = 'd.m.Y'; //09.08.2016- формат дат

    const ERROR_NOT_POST = 101; //ошибка если не пост запрос
    const ERROR_EMPTY_POST = 102; //ошибка если не пост параментры пусты
    const ERROR_XML = 103; //ошибка если в потс параметре передаеться не хмл
    const ERROR_XML_STRUCTURE = 104; //ошибка если отсутсвют парамерты обязательные хмл
    const ERROR_PARAM = 105; //ошибка если парамтрры не валидные
    const ERROR_EMPTY_TIMETABLE = 106; //ошибка расписание пустое

    public $layout = '/xml/layout';


    const VIEW_STUDENT = 1;
    const VIEW_TEACHER = 2;
    const VIEW_GROUP = 3;

    public function filters() {

        return array(
            'accessControl',
            'checkQueryType'
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'GetTimetableForStudent',
                    'GetTimetableForGroup',
                    'GetTimetableForTeacher',
                    'UploadStudentsId'
                ),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
    /*очищение скриптов итд*/
    private function clearScriptFiles(){
        Yii::app()->clientscript->reset();
        //Yii::app()->clientscript->scriptFiles=array();
    }
    /*возврат ошибка*/
    private function errorXml($code, $message){

        $this->render('error',array(
            'code'=>$code,
            'message'=>$message
        ),false);
        Yii::app()->end();
    }
    /*Возврщает хмл из пост запроса*/
    private function getXmlFromPost(){
        $params = trim(file_get_contents('php://input'));

        libxml_use_internal_errors(true);
        $xmlData = simplexml_load_string($params);


        if($xmlData !== false)
        {
            return $xmlData;
        }
        else
        {
            $message = '';
            foreach(libxml_get_errors() as $error)
            {
                $message.='Error parsing XML : ' . $error->message.PHP_EOL;
            }

            $message = htmlspecialchars($message, ENT_XML1, 'UTF-8');
            $this->errorXml(self::ERROR_XML,$message);
            return '';
        }

    }
    public function filterCheckQueryType($filter)
    {
        $this->clearScriptFiles();

        if (! Yii::app()->request->isPostRequest){
            $this->errorXml(self::ERROR_NOT_POST,'Поддерживаються только Post запросы');
        }else {
            //$params = Yii::app()->request->getPost();
            $params = trim(file_get_contents('php://input'));
            //$params = $_POST;
            if(empty($params)){
                $this->errorXml(self::ERROR_EMPTY_POST,'Пустой Post запрос');
            }else
                $filter->run();
        }
    }

    public function actionGetTimetableForGroup(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег TimetableForStudent*/
            if($xml->getName()!='Request'||!isset($xml->TimetableForGroup))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $xmlAction = $xml->TimetableForGroup;
                /*Проверка есть ли теги нужные параметры*/
                if (
                    !isset($xmlAction->Group) ||
                    !isset($xmlAction->PeriodStart) ||
                    !isset($xmlAction->PeriodFinish)
                )
                    $this->errorXml(self::ERROR_XML_STRUCTURE, 'Ошибка струтуры(параметры) xml');
                else {
                    /*загрузка параментров*/

                    $Group = $xmlAction->Group->__ToString();
                    //print_r($StudentID);
                    $PeriodStart = $xmlAction->PeriodStart->__ToString();
                    $PeriodFinish = $xmlAction->PeriodFinish->__ToString();

                    $dateStart = date_create($PeriodStart);
                    if($dateStart===false)
                        $this->errorXml(self::ERROR_PARAM, 'PeriodStart не являеться датой');

                    $dateFinish = date_create($PeriodFinish);
                    if($dateFinish===false)
                        $this->errorXml(self::ERROR_PARAM, 'PeriodFinish не являеться датой');

                    $group = Gr::model()->findByAttributes(array('gr1'=>$Group));
                    if($group==null)
                        $this->errorXml(self::ERROR_PARAM, 'Group '.$Group.' не являеться валидным');


                    $timeTable=$this->getTimeTable($group->gr1, $dateStart->format(self::FORMAT_DATE), $dateFinish->format(self::FORMAT_DATE), 0);

                    if(empty($timeTable))
                        $this->errorXml(self::ERROR_EMPTY_TIMETABLE, 'Расписание не найдено');

                    $this->render('timeTableGroup',array(
                        'timeTable'=>$timeTable,
                        'type' => self::VIEW_GROUP
                    ));
                }
            }
        }
    }

    public function actionGetTimetableForTeacher(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег TimetableForTeacher*/
            if($xml->getName()!='Request'||!isset($xml->TimetableForTeacher))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $xmlAction = $xml->TimetableForTeacher;
                /*Проверка есть ли теги нужные параметры*/
                if (
                    !isset($xmlAction->TeacherID) ||
                    !isset($xmlAction->PeriodStart) ||
                    !isset($xmlAction->PeriodFinish)
                )
                    $this->errorXml(self::ERROR_XML_STRUCTURE, 'Ошибка струтуры(параметры) xml');
                else {
                    /*загрузка параментров*/

                    $TeacherID = $xmlAction->TeacherID->__ToString();
                    //print_r($StudentID);
                    $PeriodStart = $xmlAction->PeriodStart->__ToString();
                    $PeriodFinish = $xmlAction->PeriodFinish->__ToString();

                    $dateStart = date_create($PeriodStart);
                    if($dateStart===false)
                        $this->errorXml(self::ERROR_PARAM, 'PeriodStart не являеться датой');

                    $dateFinish = date_create($PeriodFinish);
                    if($dateFinish===false)
                        $this->errorXml(self::ERROR_PARAM, 'PeriodFinish не являеться датой');

                    $teacher = P::model()->findByAttributes(array('p1'=>$TeacherID));
                    if($teacher==null)
                        $this->errorXml(self::ERROR_PARAM, 'TeacherID '.$TeacherID.' не являеться валидным');


                    $timeTable=$this->getTimeTable($teacher->p1, $dateStart->format(self::FORMAT_DATE), $dateFinish->format(self::FORMAT_DATE), 2);

                    if(empty($timeTable))
                        $this->errorXml(self::ERROR_EMPTY_TIMETABLE, 'Расписание не найдено');

                    $this->render('timeTableTeacher',array(
                        'timeTable'=>$timeTable,
                        'type' => self::VIEW_TEACHER
                    ));
                }
            }
        }
    }

    public function actionGetTimetableForStudent(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег TimetableForStudent*/
            if($xml->getName()!='Request'||!isset($xml->TimetableForStudent))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $xmlAction = $xml->TimetableForStudent;
                /*Проверка есть ли теги нужные параметры*/
                if (
                    !isset($xmlAction->StudentID) ||
                    !isset($xmlAction->PeriodStart) ||
                    !isset($xmlAction->PeriodFinish)
                )
                    $this->errorXml(self::ERROR_XML_STRUCTURE, 'Ошибка струтуры(параметры) xml');
                else {
                    /*загрузка параментров*/

                    $StudentID = $xmlAction->StudentID->__ToString();
                    //print_r($StudentID);
                    $PeriodStart = $xmlAction->PeriodStart->__ToString();
                    $PeriodFinish = $xmlAction->PeriodFinish->__ToString();

                    $dateStart = date_create($PeriodStart);
                    if($dateStart===false)
                        $this->errorXml(self::ERROR_PARAM, 'PeriodStart не являеться датой');

                    $dateFinish = date_create($PeriodFinish);
                    if($dateFinish===false)
                        $this->errorXml(self::ERROR_PARAM, 'PeriodFinish не являеться датой');

                    $student = St::model()->findByAttributes(array('st1'=>$StudentID));
                    if($student==null)
                        $this->errorXml(self::ERROR_PARAM, 'StudentID '.$StudentID.' не являеться валидным');


                    $timeTable=$this->getTimeTable($student->st1, $dateStart->format(self::FORMAT_DATE), $dateFinish->format(self::FORMAT_DATE), 1);

                    if(empty($timeTable))
                        $this->errorXml(self::ERROR_EMPTY_TIMETABLE, 'Расписание не найдено');

                    $this->render('timeTableStudent',array(
                        'timeTable'=>$timeTable,
                        'type' => self::VIEW_STUDENT
                    ));
                }
            }
        }
    }

    /**
     * Загрузка внешних id для студентов
     */
    public function actionUploadStudentsId(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег TimetableForStudent*/
            if($xml->getName()!='Request'||!isset($xml->UploadStudentsID))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $uploads = $xml->UploadStudentsID;
                if(!isset($uploads->Students))
                    $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
                else{
                    $errors = array();
                    $students = $uploads->Students;

                    foreach($students->children() as $student){

                        /* @var $student SimpleXMLElement */

                        /*проверяем являеться ли дочерний тег тегом Students*/
                        if($student->getName()=='Student'){
                            /*берем айди из контента тега*/
                            $id = $student->__ToString();
                            /*если пустой айди добавляем ошибку*/
                            if(empty($id)){
                                array_push($errors,
                                    array(
                                        'id'=>$id,
                                        'message'=>'Пустой id'
                                    )
                                );
                            }else{
                                /*название атрибута фамилия*/
                                $attrLName = 'LastName';
                                /*название атрибута имя*/
                                $attrFName = 'FirstName';
                                /*название атрибута отчество*/
                                $attrSName = 'SecondName';
                                /*название атрибута дата рождения*/
                                $attrBDay = 'BirthDay';

                                $lName = (string)$student->attributes()->$attrLName;
                                $fName = (string)$student->attributes()->$attrFName;
                                $sName = (string)$student->attributes()->$attrSName;
                                $bDay = date_create((string)$student->attributes()->$attrBDay);
                                if($bDay===false)
                                    $this->errorXml(self::ERROR_PARAM, 'BirthDay не являеться датой');

                                $arr = St::model()->findAllByAttributes(array(
                                    'st2'=>$lName,
                                    'st3'=>$fName,
                                    'st4'=>$sName,
                                    'st7'=>$bDay->format(self::FORMAT_DATE),
                                ));

                                //проверяем есть по нашему запросы студенты
                                if(empty($arr))
                                    array_push($errors,
                                        array(
                                            'id'=>$id,
                                            'message' => sprintf(
                                                'Не найден студент для id=%s с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                $id,
                                                $attrLName,$lName,
                                                $attrFName,$fName,
                                                $attrSName,$sName,
                                                $attrBDay,$bDay->format(self::FORMAT_DATE)
                                            )
                                        )
                                    );
                                else{
                                    /*если мы нашли больше одного стеднта*/
                                    if(count($arr)>1){
                                        array_push($errors,
                                            array(
                                                'id'=>$id,
                                                'message' => sprintf(
                                                    'Найдено несколько студентов для id=%s с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                    $id,
                                                    $attrLName,$lName,
                                                    $attrFName,$fName,
                                                    $attrSName,$sName,
                                                    $attrBDay,$bDay->format(self::FORMAT_DATE)
                                                )
                                            )
                                        );
                                    }else{
                                        $save = $arr[0]->saveAttributes(array('st108'=>$id));
                                        if(!$save){
                                            array_push($errors,
                                                array(
                                                    'id'=>$id,
                                                    'message' => sprintf(
                                                        'Не сохранен id=%s для студента с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                        $id,
                                                        $attrLName,$lName,
                                                        $attrFName,$fName,
                                                        $attrSName,$sName,
                                                        $attrBDay,$bDay->format(self::FORMAT_DATE)
                                                    )
                                                )
                                            );
                                            //print_r( $arr[0]->getErrors());
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $this->render('uploadStudents',array(
                    'errors'=>$errors
                ));
            }
        }
    }
    /*Получить расписание*/
    /*
     * $id -> индефикатор st1, gr1, p1
     * $dateStart -> дата "c"
     * $dateFinish -> дата "по"
     * $type - 1 расписание студента, 0 - расписание группы, 2-преподователя
     * */
    private function getTimeTable($id, $dateStart, $dateFinish, $type){
        switch($type)
        {
            case 0:
                $sql ='SELECT * FROM RAGR(:LANG, :ID, :DATE_1, :DATE_2) ORDER BY ned, r2, r3';
                break;
            case 1:
                $sql ='SELECT * FROM TTST(:ID, :DATE_1, :DATE_2) ORDER BY ned, r2, r3';
                break;
            case 2:
                $sql ='SELECT * FROM RAPR(:ID, :DATE_1, :DATE_2) ORDER BY ned, r2, r3';
                break;
            case 3:
                $sql ='SELECT * FROM RAPR(:ID, :DATE_1, :DATE_2) ORDER BY ned, r2, r3';
                break;
        }
        $command = Yii::app()->db->createCommand($sql);
        //if($type!=2)
        $command->bindValue(':LANG', 1);
        $command->bindValue(':ID', $id);
        $command->bindValue(':DATE_1', $dateStart);
        $command->bindValue(':DATE_2', $dateFinish);
        $timeTable = $command->queryAll();

        if (empty($timeTable))
            return array();

        return $timeTable;
    }

}