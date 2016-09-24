<?php

class XmlController extends Controller
{
    const FORMAT_DATE = 'd.m.Y'; //09.08.2016- формат дат

    const ERROR_NOT_POST = 101; //ошибка если не пост запрос
    const ERROR_EMPTY_POST = 102; //ошибка если пост параментры пусты
    const ERROR_XML = 103; //ошибка если в потс параметре передаеться не хмл
    const ERROR_XML_STRUCTURE = 104; //ошибка если отсутсвют парамерты обязательные хмл
    const ERROR_PARAM = 105; //ошибка если парамтрры не валидные
    const ERROR_EMPTY_TIMETABLE = 106; //ошибка расписание пустое

    public $layout = '/xml/layout';


    const VIEW_STUDENT = 1;
    const VIEW_TEACHER = 2;
    const VIEW_GROUP = 3;
    const VIEW_AUDIENCE = 4;

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
                    'GetTimetableForAudience',
                    'UploadStudentsId',
                    'UploadTeachersId',
                    'GetChairs',
                    'GetFaculties',
                    'GetGroups',
                    'GetAudiences',
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
            /*Проверка есть ли тег TimetableForGroup*/
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

                    $timeTable = $this->fillTimeTableByXml($timeTable,self::VIEW_GROUP);

                    $this->render('timeTableGroup',array(
                        'timeTable'=>$timeTable,
                        'type' => self::VIEW_GROUP
                    ));
                }
            }
        }
    }

    /**
     * расписание аудитории
     */
    public function actionGetTimetableForAudience(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег TimetableForAudience*/
            if($xml->getName()!='Request'||!isset($xml->TimetableForAudience))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $xmlAction = $xml->TimetableForAudience;
                /*Проверка есть ли теги нужные параметры*/
                if (
                    !isset($xmlAction->Audience) ||
                    !isset($xmlAction->PeriodStart) ||
                    !isset($xmlAction->PeriodFinish)
                )
                    $this->errorXml(self::ERROR_XML_STRUCTURE, 'Ошибка струтуры(параметры) xml');
                else {
                    /*загрузка параментров*/

                    $audienceID = $xmlAction->Audience->__ToString();
                    //print_r($audience);
                    $PeriodStart = $xmlAction->PeriodStart->__ToString();
                    $PeriodFinish = $xmlAction->PeriodFinish->__ToString();

                    $dateStart = date_create($PeriodStart);
                    if($dateStart===false)
                        $this->errorXml(self::ERROR_PARAM, 'PeriodStart не являеться датой');

                    $dateFinish = date_create($PeriodFinish);
                    if($dateFinish===false)
                        $this->errorXml(self::ERROR_PARAM, 'PeriodFinish не являеться датой');

                    $audience = A::model()->findByAttributes(array('a1'=>$audienceID));
                    if($audience==null)
                        $this->errorXml(self::ERROR_PARAM, 'audienceID '.$audienceID.' не являеться валидным');


                    $timeTable=$this->getTimeTable($audience->a1, $dateStart->format(self::FORMAT_DATE), $dateFinish->format(self::FORMAT_DATE), 3);

                    if(empty($timeTable))
                        $this->errorXml(self::ERROR_EMPTY_TIMETABLE, 'Расписание не найдено');

                    $timeTable = $this->fillTimeTableByXml($timeTable,self::VIEW_AUDIENCE);

                    $this->render('timeTableAudience',array(
                        'timeTable'=>$timeTable,
                        'type' => self::VIEW_AUDIENCE
                    ));
                }
            }
        }
    }
    /**
     * расписание преодователя
     */
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

                    $teacher = P::model()->findByAttributes(array('p132'=>$TeacherID));
                    if($teacher==null)
                        $this->errorXml(self::ERROR_PARAM, 'TeacherID '.$TeacherID.' не являеться валидным');


                    $timeTable=$this->getTimeTable($teacher->p1, $dateStart->format(self::FORMAT_DATE), $dateFinish->format(self::FORMAT_DATE), 2);

                    if(empty($timeTable))
                        $this->errorXml(self::ERROR_EMPTY_TIMETABLE, 'Расписание не найдено');

                    $timeTable = $this->fillTimeTableByXml($timeTable,self::VIEW_TEACHER);

                    $this->render('timeTableTeacher',array(
                        'timeTable'=>$timeTable,
                        'type' => self::VIEW_TEACHER
                    ));
                }
            }
        }
    }

    /**
     * Расписание студента
     */
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

                    //$student = St::model()->findByAttributes(array('st1'=>$StudentID));
                    $student = St::model()->findByAttributes(array('st108'=>$StudentID));
                    if($student==null)
                        $this->errorXml(self::ERROR_PARAM, 'StudentID '.$StudentID.' не являеться валидным');


                    $timeTable=$this->getTimeTable($student->st1, $dateStart->format(self::FORMAT_DATE), $dateFinish->format(self::FORMAT_DATE), 1);

                    if(empty($timeTable))
                        $this->errorXml(self::ERROR_EMPTY_TIMETABLE, 'Расписание не найдено');

                    $timeTable = $this->fillTimeTableByXml($timeTable,self::VIEW_STUDENT);

                    $this->render('timeTableStudent',array(
                        'timeTable'=>$timeTable,
                        'type' => self::VIEW_STUDENT
                    ));
                }
            }
        }
    }
    /**
     * Список Аудитории
     * возможно через необязательные теги фильтрация по филиалу, адимтории
     */
    public function actionGetAudiences(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег GetAudiences*/
            if($xml->getName()!='Request'||!isset($xml->GetAudiences))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $xmlAction = $xml->GetAudiences;
                /*фильтры*/
                $audience = null;
                $filial = null;
                /*перебираем всех наследников ищем наши фильтрі*/
                foreach($xmlAction->children() as $child){
                    /* @var $child SimpleXMLElement */

                    $tag = $child->getName();

                    switch($tag){
                        case 'Audience':
                            $audience = $child->__ToString();
                            break;
                        case 'Filial':
                            $filial = $child->__ToString();
                            break;
                    }
                }

                $where = '';

                if($filial!=null){
                    $where.=' AND A6=:FILIAL';
                }

                if($audience!=null){
                    $where.=' AND A1=:AUDIENCE';
                }

                $sql= <<<SQL
                  SELECT *
                  FROM A
                  WHERE A5 is null and A1>0 {$where}
                  ORDER BY A8,A9,A2
SQL;
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':AUDIENCE', $audience);
                $command->bindValue(':FILIAL', $filial);
                $audiences = $command->queryAll();

                $this->render('audiences',array(
                    'audiences'=>$audiences
                ));
            }
        }
    }
    /**
     * Список Группы
     * возможно через необязательные теги фильтрация по факультету,курсу,кафедре черз логическое и
     */
    public function actionGetGroups(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег GetGroups*/
            if($xml->getName()!='Request'||!isset($xml->GetGroups))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $xmlAction = $xml->GetGroups;
                /*фильтры*/
                $course = null;
                $faculty = null;
                $filial = null;
                $group = null;
                /*перебираем всех наследников ищем наши фильтрі*/
                foreach($xmlAction->children() as $child){
                    /* @var $child SimpleXMLElement */

                    $tag = $child->getName();

                    switch($tag){
                        case 'Faculty':
                            $faculty = $child->__ToString();
                            break;
                        case 'Filial':
                            $filial = $child->__ToString();
                            break;
                        case 'Course':
                            $course = $child->__ToString();
                            break;
                        case 'Group':
                            $group = $child->__ToString();
                            break;
                    }
                }

                $where = '';

                if($faculty!=null){
                    $where.=' AND sp5=:FACULTY';
                }

                if($filial!=null){
                    $where.=' AND f14=:FILIAL';
                }

                if($course!=null){
                    $where.=' AND sem4=:COURSE';
                }

                if($group!=null){
                    $where.=' AND GR1=:GROUP';
                }

                $sql=<<<SQL
                    SELECT sg4, sem4, gr13,gr7,gr3,gr1, gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26, sp5,f14
                    from sp
                        inner join f on (sp.sp5 = f.f1)
                       inner join sg on (sp.sp1 = sg.sg2)
                       inner join sem on (sg.sg1 = sem.sem2)
                       inner join gr on (sg.sg1 = gr.gr2)
                       inner join ucgn on (gr.gr1 = ucgn.ucgn2)
                       inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
                       inner join ucxg on (ucgn.ucgn1 = ucxg.ucxg2)
                    WHERE ucxg1<30000 and gr13=0 and gr6 is null
                         and sem3=:YEAR1 and sem5=:SEM1 and ucgns5=:YEAR2 and ucgns6=:SEM2 $where
                    GROUP BY sg4, sem4, gr13,gr7,gr3,gr1, gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26,sp5,f14
                    ORDER BY sp5, sem4, gr7,gr3
SQL;
                list($year, $sem) = SH::getCurrentYearAndSem();

                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':GROUP', $group);
                $command->bindValue(':FACULTY', $faculty);
                $command->bindValue(':FILIAL', $filial);
                $command->bindValue(':COURSE', $course);
                $command->bindValue(':YEAR1', $year);
                $command->bindValue(':YEAR2', $year);
                $command->bindValue(':SEM1', $sem);
                $command->bindValue(':SEM2', $sem);
                $chairs = $command->queryAll();

                $this->render('groups',array(
                    'groups'=>$chairs
                ));
            }
        }
    }
    /**
     * Список кафедр
     * возможно через необязательные теги фильтрация по факультету, филиалу,кафедре черз логическое и
     */
    public function actionGetChairs(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег GetChairs*/
            if($xml->getName()!='Request'||!isset($xml->GetChairs))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $xmlAction = $xml->GetChairs;
                /*фильтры*/
                $filial = null;
                $faculty = null;
                $chair = null;
                /*перебираем всех наследников ищем наши фильтрі*/
                foreach($xmlAction->children() as $child){
                    /* @var $child SimpleXMLElement */

                    $tag = $child->getName();

                    switch($tag){
                        case 'Faculty':
                                $faculty = $child->__ToString();
                            break;
                        case 'Chair':
                                $chair = $child->__ToString();
                            break;
                        case 'Filial':
                                $filial = $child->__ToString();
                            break;
                    }
                }

                $where = '';

                if($filial!=null){
                    $where.=' AND k10=:FILIAL';
                }

                if($faculty!=null){
                    $where.=' AND F1=:FACULTY';
                }

                if($chair!=null){
                    $where.=' AND K1=:CHAIR';
                }

                $sql=<<<SQL
                    SELECT K1,K2,K3,K10,K7
                        FROM F
                        inner join k on (f.f1 = k.k7)
                    WHERE f12='1' and f17='0' and k11='1' and (k9 is null) and K1>0 $where
                    ORDER BY K3 collate UNICODE
SQL;

                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':FILIAL', $filial);
                $command->bindValue(':FACULTY', $faculty);
                $command->bindValue(':CHAIR', $chair);
                $chairs = $command->queryAll();

                $this->render('chairs',array(
                    'chairs'=>$chairs
                ));
            }
        }
    }
    /**
     * Список факультетов
     * возможно через необязательные теги фильтрация по факультету, филиалу черз логическое и
     */
    public function actionGetFaculties(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег GetFaculties*/
            if($xml->getName()!='Request'||!isset($xml->GetFaculties))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                /* @var $xmlAction SimpleXMLElement */
                $xmlAction = $xml->GetFaculties;
                /*фильтры*/
                $filial = null;
                $faculty = null;
                /*перебираем всех наследников ищем наши фильтрі*/
                foreach($xmlAction->children() as $child){
                    /* @var $child SimpleXMLElement */

                    $tag = $child->getName();

                    switch($tag){
                        case 'Faculty':
                            $faculty = $child->__ToString();
                            break;
                        case 'Filial':
                            $filial = $child->__ToString();
                            break;
                    }
                }

                $where = '';

                if($filial!=null){
                    $where.=' AND f14=:FILIAL';
                }

                if($faculty!=null){
                    $where.=' AND F1=:FACULTY';
                }

                $sql=<<<SQL
                     SELECT f1,f2, f3, f14
                    FROM f
                    WHERE f1>0 and f12<>0 and f17=0 and (f19 is null) and f32 = 0 $where
                    ORDER BY f15,f3 collate UNICODE
SQL;

                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':FILIAL', $filial);
                $command->bindValue(':FACULTY', $faculty);
                $faculties = $command->queryAll();

                $this->render('faculties',array(
                    'faculties'=>$faculties
                ));
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
            /*Проверка есть ли тег UploadStudentsID*/
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

                        /*проверяем являеться ли дочерний тег тегом Student*/
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
                            }else {
                                $arr = St::model()->findAllByAttributes(array('st108' => $id));
                                if (!empty($arr)) {
                                    array_push($errors,
                                        array(
                                            'id' => $id,
                                            'message' => sprintf(
                                                'Студент с таким id=%s уже существует',
                                                $id
                                            )
                                        )
                                    );
                                } else
                                {
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
                                    if ($bDay === false) {
                                        //$this->errorXml(self::ERROR_PARAM, 'BirthDay не являеться датой');
                                        array_push($errors,
                                            array(
                                                'id' => $id,
                                                'message' => 'BirthDay не являеться датой'
                                            )
                                        );
                                    }

                                    $arr = St::model()->findAllByAttributes(array(
                                        'st2' => $lName,
                                        'st3' => $fName,
                                        'st4' => $sName,
                                        'st7' => $bDay->format(self::FORMAT_DATE),
                                    ));

                                    //проверяем есть по нашему запросы студенты
                                    if (empty($arr))
                                        array_push($errors,
                                            array(
                                                'id' => $id,
                                                'message' => sprintf(
                                                    'Не найден студент для id=%s с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                    $id,
                                                    $attrLName, $lName,
                                                    $attrFName, $fName,
                                                    $attrSName, $sName,
                                                    $attrBDay, $bDay->format(self::FORMAT_DATE)
                                                )
                                            )
                                        );
                                    else {
                                        /*если мы нашли больше одного стеднта*/
                                        if (count($arr) > 1) {
                                            array_push($errors,
                                                array(
                                                    'id' => $id,
                                                    'message' => sprintf(
                                                        'Найдено несколько студентов для id=%s с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                        $id,
                                                        $attrLName, $lName,
                                                        $attrFName, $fName,
                                                        $attrSName, $sName,
                                                        $attrBDay, $bDay->format(self::FORMAT_DATE)
                                                    )
                                                )
                                            );
                                        } else {
                                            $save = $arr[0]->saveAttributes(array('st108' => $id));
                                            if (!$save) {
                                                array_push($errors,
                                                    array(
                                                        'id' => $id,
                                                        'message' => sprintf(
                                                            'Не сохранен id=%s для студента с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                            $id,
                                                            $attrLName, $lName,
                                                            $attrFName, $fName,
                                                            $attrSName, $sName,
                                                            $attrBDay, $bDay->format(self::FORMAT_DATE)
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
                }

                $this->render('uploadStudents',array(
                    'errors'=>$errors
                ));
            }
        }
    }

    /**
     * Загрузка внешних id для преподователей
     */
    public function actionUploadTeachersId(){
        $xml = $this->getXmlFromPost();
        if(empty($xml))
            Yii::app()->end;
        else{
            /*Проверка есть ли тег UploadTeachersID*/
            if($xml->getName()!='Request'||!isset($xml->UploadTeachersID))
                $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
            else {
                $uploads = $xml->UploadTeachersID;
                if(!isset($uploads->Teachers))
                    $this->errorXml(self::ERROR_XML_STRUCTURE,'Ошибка струтуры xml');
                else{
                    $errors = array();
                    $teachers = $uploads->Teachers;

                    foreach($teachers->children() as $teacher){

                        /* @var $teacher SimpleXMLElement */

                        /*проверяем являеться ли дочерний тег тегом Teacher*/
                        if($teacher->getName()=='Teacher'){
                            /*берем айди из контента тега*/
                            $id = $teacher->__ToString();
                            /*если пустой айди добавляем ошибку*/
                            if(empty($id)){
                                array_push($errors,
                                    array(
                                        'id'=>$id,
                                        'message'=>'Пустой id'
                                    )
                                );
                            }else {
                                $arr = P::model()->findAllByAttributes(array('p132' => $id));
                                if (!empty($arr)) {
                                    array_push($errors,
                                        array(
                                            'id' => $id,
                                            'message' => sprintf(
                                                'Преподователь с таким id=%s уже существует',
                                                $id
                                            )
                                        )
                                    );
                                } else
                                {
                                    /*название атрибута фамилия*/
                                    $attrLName = 'LastName';
                                    /*название атрибута имя*/
                                    $attrFName = 'FirstName';
                                    /*название атрибута отчество*/
                                    $attrSName = 'SecondName';
                                    /*название атрибута дата рождения*/
                                    $attrBDay = 'BirthDay';

                                    $lName = (string)$teacher->attributes()->$attrLName;
                                    $fName = (string)$teacher->attributes()->$attrFName;
                                    $sName = (string)$teacher->attributes()->$attrSName;
                                    $bDay = date_create((string)$teacher->attributes()->$attrBDay);
                                    if ($bDay === false) {
                                        //$this->errorXml(self::ERROR_PARAM, 'BirthDay не являеться датой');
                                        array_push($errors,
                                            array(
                                                'id' => $id,
                                                'message' => 'BirthDay не являеться датой'
                                            )
                                        );
                                    }else {

                                        $arr = P::model()->findAllByAttributes(array(
                                            'p3' => $lName,
                                            'p4' => $fName,
                                            'p5' => $sName,
                                            'p9' => $bDay->format(self::FORMAT_DATE),
                                        ));

                                        //проверяем есть по нашему запросы преподы
                                        if (empty($arr))
                                            array_push($errors,
                                                array(
                                                    'id' => $id,
                                                    'message' => sprintf(
                                                        'Не найден преподователь для id=%s с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                        $id,
                                                        $attrLName, $lName,
                                                        $attrFName, $fName,
                                                        $attrSName, $sName,
                                                        $attrBDay, $bDay->format(self::FORMAT_DATE)
                                                    )
                                                )
                                            );
                                        else {
                                            /*если мы нашли больше одного препода*/
                                            if (count($arr) > 1) {
                                                array_push($errors,
                                                    array(
                                                        'id' => $id,
                                                        'message' => sprintf(
                                                            'Найдено несколько преподователей для id=%s с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                            $id,
                                                            $attrLName, $lName,
                                                            $attrFName, $fName,
                                                            $attrSName, $sName,
                                                            $attrBDay, $bDay->format(self::FORMAT_DATE)
                                                        )
                                                    )
                                                );
                                            } else {
                                                $save = $arr[0]->saveAttributes(array('p132' => $id));
                                                if (!$save) {
                                                    array_push($errors,
                                                        array(
                                                            'id' => $id,
                                                            'message' => sprintf(
                                                                'Не сохранен id=%s для преподователя с параментрами %s=%s, %s=%s, %s=%s, %s=%s',
                                                                $id,
                                                                $attrLName, $lName,
                                                                $attrFName, $fName,
                                                                $attrSName, $sName,
                                                                $attrBDay, $bDay->format(self::FORMAT_DATE)
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
                    }
                }

                $this->render('uploadTeachers',array(
                    'errors'=>$errors
                ));
            }
        }
    }

    /*Получить расписание*/
    /*
     * $id -> индефикатор st1, gr1, p1, a1
     * $dateStart -> дата "c"
     * $dateFinish -> дата "по"
     * $type - 1 расписание студента, 0 - расписание группы, 2-преподователя, 3-аудитории
     * */
    private function getTimeTable($id, $dateStart, $dateFinish, $type){
        switch($type)
        {
            case 0:
                $sql ='SELECT * FROM TTGR(:ID, :DATE_1, :DATE_2) ORDER BY ned, r2, r3';
                break;
            case 1:
                $sql ='SELECT * FROM TTST(:ID, :DATE_1, :DATE_2) ORDER BY ned, r2, r3';
                break;
            case 2:
                $sql ='SELECT * FROM TTPR(:ID, :DATE_1, :DATE_2) ORDER BY ned, r2, r3';
                break;
            case 3:
                $sql ='SELECT * FROM TTA(:ID, :DATE_1, :DATE_2) ORDER BY ned, r2,r3';
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

    private function fillTimeTableByXml($timeTable, $type)
    {
        $res = array();

        foreach($timeTable as $key => $day) {

            $r2 = strtotime($day['r2']); // date
            $r3 = $day['r3'];            // lesson
            if($type!=self::VIEW_GROUP) {
                if (!isset($res[$r2]['timeTable'][$r3])) {
                    $res[$r2]['timeTable'][$r3] = $day;
                    $res[$r2]['timeTable'][$r3]['gr'][$day['gr1']] = $day['gr13'];
                } else
                    $res[$r2]['timeTable'][$r3]['gr'][$day['gr1']] = $day['gr13'];
            }
            else{
                $res[$r2]['timeTable'][$r3] = $day;
            }
        }
        //die(var_dump($res));
        return $res;
    }

}