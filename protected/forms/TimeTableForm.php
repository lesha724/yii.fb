<?php

class TimeTableForm extends CFormModel
{
	public $filial  = 0;
	public $chair   = 0;
	public $faculty;
	public $course;
	public $teacher;
	public $group;
	public $student;
	public $classroom;
	public $housing = 0;

	public $speciality;

	public $lessonStart = 1;
	public $lessonEnd   = 1;

    public $printAttr = 1;//печать расписание с абривиатурой или полным названием дисциплин

    public $date1;
    public $date2;
    public $dateLesson;
    public $r11 = 5;

    const r11Color = '#EFBCEF';

    private  $_universityId = 0;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
            array('filial, date1, date2, r11', 'required'),
            array('printAttr', 'numerical'),
            array('chair, teacher', 'numerical', 'allowEmpty' => false, 'on' => 'teacher'),
            array('chair', 'numerical', 'allowEmpty' => false, 'on' => 'chair'),
            array('chair, teacher', 'required', 'on' => 'teacher'),
            array('chair', 'required', 'on' => 'chair'),
            array('faculty, course, group', 'numerical', 'allowEmpty' => false, 'on' => 'group, student,omissions'),
            array('faculty, course, group', 'required', 'on' => 'group, student,omissions'),
            array('student', 'required', 'on' => 'student,omissions'),

            array('housing', 'numerical', 'on' => 'classroom, free-classroom'),
            array('classroom', 'required', 'on' => 'classroom'),

            array('lessonStart, lessonEnd', 'required', 'on' => 'free-classroom'),
            array('housing', 'safe', 'on' => 'free-classroom'),

            array('filial, faculty, course, group', 'required', 'on' => 'list-group'),
            array('filial, chair', 'required', 'on' => 'list-chair'),

            array('filial, faculty, speciality, course', 'required', 'on' => 'attendanceStatisticPrint'),
		);
	}

    public function __construct($scenario='')
    {
        $this->r11 = PortalSettings::model()->getSettingFor(108);

        $this->_universityId = Yii::app()->core->universityCode;

        parent::__construct($scenario='');
    }

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		$arr= array(
			'filial'=> tt('Учебн. заведение'),
			'faculty'=> tt('Факультет'),
		);

		$universityCode = Yii::app()->controller->universityCode;

        if($universityCode==7)
            $arr = array(
                'filial' => tt('Факультет'),
                'faculty' => tt('Вид подготовки'),
            );
        elseif($universityCode==15)
            $arr = array(
                'filial' => tt('Факультет'),
                'faculty' => tt('Направление подготовки'),
            );
        elseif ($universityCode==42)
            $arr = array(
                'filial' => tt('Факультет'),
                'faculty' => tt('Направление'),
            );


		return array(
                    //'filial'=> tt('Филиал'),
                    'chair'=> tt('Кафедра'),
                    //'faculty'=> tt('Факультет'),
                    'speciality'=> tt('Специальность'),
                    'course'=> tt('Курс'),
                    'printAttr'=>tt('Печать расписания с аббревиатурой дисциплин'),
                    'group'=> tt('Группа'),
                    'teacher'=> tt('Преподаватель'),
                    'student'=> tt('Студент'),
                    'classroom'=> tt('Аудитория'),
                    'housing'=> tt('Корпус'),
                    'r11' => tt('Индикация изменений в расписании'),
                    'date1' => tt('Дата'),
                    'date2' => tt('Дата 2'),
                    'lessonStart' => tt('Начало'),
                    'lessonEnd' => tt('Окончание'),
                        )+$arr;
	}

    public function getMinMaxLessons($timeTable)
    {
        $min = $max = array();

        foreach ($timeTable as $v) {

            $day = $v['nday'];
            $r3  = (int)$v['r3'];

            if (! isset($min[$day]))
                $min[$day] = $r3;

            if (! isset($max[$day]))
                $max[$day] = $r3;

            if ($min[$day] > $r3)
                $min[$day] = $r3;

            if ($max[$day] < $r3)
                $max[$day] = $r3;
        }

        for($i = 1; $i <= 7; $i++) {

            if (! isset($min[$i]))
                $min[$i] = 1;

            if (! isset($max[$i]))
                $max[$i] = 1;
        }

        $names = array(
            '1' => tt('Пн'),
            '2' => tt('Вт'),
            '3' => tt('Ср'),
            '4' => tt('Чт'),
            '5' => tt('Пт'),
            '6' => tt('Сб'),
            '7' => tt('Вс')
        );

        ksort($min);
        ksort($max);

        $data = array(
            'names' => $names,
            'min'   => $min,
            'max'   => $max
        );

        return $data;
    }




    private function fillMissingCells($timeTable)
    {
        list($firstMonday,) = $this->getWeekBoundary($this->date1);

        list(,$lastSunday)  = $this->getWeekBoundary($this->date2);

        while($firstMonday <= $lastSunday) {

            if (! isset($timeTable[$firstMonday]))
                $timeTable[$firstMonday] = array('timeTable' => array());

            $timeTable[$firstMonday]['date'] = date('d.m.Y', $firstMonday);

            $firstMonday += 86400;
        }

        ksort($timeTable);

        return $timeTable;
    }

    private function getWeekBoundary($date)
    {
        $num = date('w', strtotime($date));
        if ($num == 0)
            $num = 7;

        $ts = strtotime($date);

        $monday = $ts;
        if ($num > 1)
            $monday = $ts - (($num-1)*86400);

        $sunday = $ts;
        if ($num > 1 || $num != 7)
            $sunday = $ts + ((7-$num)*86400);

        //$monday = date('d.m.Y', $monday);
        //$sunday = date('d.m.Y', $sunday);

        return array($monday, $sunday);
    }

    private function cellColorFor($day)
    {
        $color = SH::getLessonColor($day['tip']);
        // индикация изменений
        $indicated = !empty($r11) &&
            strtotime('today -'.$this->r11.' days') <= strtotime($r11);
        if ($indicated)
            $color = TimeTableForm::r11Color;

        return $color;
    }
    private function cellShortTextFor($day, $type)
    {
        $d3  = CHtml::encode($day['d3']);
        $tip   = $day['tip'];
        $a2    = $day['a2'];
        $r11   = $day['r11'];
        $class = tt('ауд');

        $rowDisc = $d3.'['.$tip.']';
        $pos=stripos($d3,"(!)");
        $rowClass = $class.'. '.$a2;
        if($pos!==false) {
            $rowClass = $day['rz2'] . '-' . $day['rz3']. ' | '. $rowClass;
        }
        $gr3 = CHtml::encode($day['grup']);

        $fio = '';
        if (isset($day['fio']))
            $fio = $day['fio'];


        $color = SH::getLessonColor($day['tip']);
        // индикация изменений
        $indicated = !empty($r11) &&
                     strtotime('today -'.$this->r11.' days') <= strtotime($r11);
        if ($indicated)
            $color = TimeTableForm::r11Color;


        if ($type == 1) // teacher
            $pattern = <<<HTML
<div style="background:{$color}">
    <span>{$rowDisc}</span><br>
    {$gr3}<br>
    {$rowClass}
</div>
HTML;
        elseif($type == 0) // group
        {
            $groupName = $day['gr13'] == 1 && $day['tip']!='Лк' ? '<br>'.$gr3 : '';
            $pattern = <<<HTML
<div style="background:{$color}">
    <span>{$rowDisc}</span><br>
    {$rowClass}<br>
    {$fio}
    {$groupName}
</div>
HTML;
        }
        elseif($type == 2) // student
            $pattern = <<<HTML
<div style="background:{$color}">
    <span>{$rowDisc}</span><br>
    {$rowClass}<br>
    {$fio}
</div>
HTML;
        elseif($type == 3) // classroom
            $pattern = <<<HTML
<div style="background:{$color}">
    <span>{$rowDisc}</span><br>
    {$gr3}<br>
    {$fio}
</div>
HTML;

        return trim($pattern);
    }

    public function getTem($r1,$r2)
    {
        $arr=array(U_ZSMU, U_NMU, U_XNMU,43,44,45);

        if(!empty($this->_universityId)&&in_array($this->_universityId, $arr))
        {
            $sql ='SELECT * FROM TEMA_NAME(:r1, :r2)';
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':r1', $r1);
            $command->bindValue(':r2', $r2);
            $tem = $command->queryRow();
            return $tem;
        }  else {
            return null;
        }
    }

    private function cellPrintTextFor($day, $type)
    {
        $printAttr=0;
        if(isset(Yii::app()->session['printAttr']))
            $printAttr = Yii::app()->session['printAttr'];
        if($printAttr==0) {
            $d2 = $day['d2'];
        }else
        {
            $d2 = $day['d3'];
        }
        $d2  = CHtml::encode($d2);
        $tip = $day['tip'];
        $gr3 = CHtml::encode($day['grupfull']);
        $a2  = $day['a2'];

        $class = tt('ауд');
        $fio = CHtml::encode($day['fio_full']);
        $time='';
        $pos=stripos($day['d3'],"(!)");
        if($pos!==false)
            $time=$day['rz2'].'-'.$day['rz3'];
        if ($type == 1) // teacher
            $pattern = <<<TEXT
{$time}
{$d2}[{$tip}]
{$gr3}
{$class}. {$a2}
TEXT;
        elseif($type == 2 || $type == 0) // group / student
            $pattern = <<<TEXT
{$time}
{$d2}[{$tip}] {$gr3}
{$class}. {$a2}
{$fio}
TEXT;
        elseif($type == 3) // classroom
            $pattern = <<<TEXT
{$time}
{$d2}[{$tip}]
{$gr3}
{$fio}
TEXT;
        return trim($pattern);
    }

    private function cellFullTextFor($day, $type)
    {
        $d2  = CHtml::encode($day['d2']);
        $d3  = CHtml::encode($day['d3']);
        $tip = $day['tip'];
        $gr3 = CHtml::encode($day['grupfull']);
        $a2  = $day['a2'];
        $tem_name='';
        $class = tt('ауд');
        $text  = tt('Добавлено');
        $added = date('d.m.Y H:i', strtotime($day['r11']));
        $fio = '';
        if (isset($day['fio_full']))
            $fio = CHtml::encode($day['fio_full']);
        else if($type == 3 && isset($day['fio']))
            $fio = CHtml::encode($day['fio']);
        $time='';
        $pos=stripos($d3,"(!)");
        if($pos!==false)
            $time='<br>'.$day['rz2'].'-'.$day['rz3'].'<br>';
        if ($type == 1) // teacher
            $pattern = <<<HTML
{$time}<br>
{$d2}[{$tip}]<br>
{$gr3}<br>
{$class}. {$a2}<br>
{$text}: {$added}
HTML;
        elseif($type == 2|| $type == 0) // group / student
            $pattern = <<<HTML
{$time}
 {$tem_name}
 <br>{$d2}[{$tip}]<br>
 {$gr3}<br>
{$class}. {$a2}<br>
{$fio}<br>
{$text}: {$added}<br>
HTML;
        elseif($type == 3) // classroom
            $pattern = <<<HTML
{$time}
<br>{$d2}[{$tip}]<br>
{$gr3}<br>
{$fio}<br>
{$text}: {$added}<br>
HTML;

        return trim($pattern);
    }

    public function fillTameTable($timeTable, $type)
    {
        $timeTable = $this->joinLessons($timeTable, $type);

        $timeTable = $this->fillMissingCells($timeTable);

        $maxLessons = $this->countMaxSubjects($timeTable);

        return array($timeTable, $maxLessons);
    }

    public function fillTameTableForGroup($timeTable)
    {
        $timeTable = $this->joinLessons($timeTable, 0);

        $timeTable = $this->fillMissingCells($timeTable);

        $maxLessons = $this->countMaxSubjects($timeTable);

        return array($timeTable, $maxLessons);
    }

    public function fillTameTableForClassroom($timeTable)
    {
        $timeTable = $this->joinLessons($timeTable, 3);

        $timeTable = $this->fillMissingCells($timeTable);

        $maxLessons = $this->countMaxSubjects($timeTable);

        return array($timeTable, $maxLessons);
    }

    public function fillTameTableForStudent($timeTable)
    {
        $timeTable = $this->joinLessons($timeTable, 2);

        $timeTable = $this->fillMissingCells($timeTable);

        $maxLessons = $this->countMaxSubjects($timeTable);

        return array($timeTable, $maxLessons);
    }


    private function joinLessons($timeTable, $type = 0)
    {
        $res  = array();

        foreach($timeTable as $day) {

            $r2 = strtotime($day['r2']); // date
            $r3 = $day['r3'];            // lesson

            if (! isset($res[$r2]['timeTable'][$r3])) {

                $res[$r2]['timeTable'][$r3]['shortText'] = $this->cellShortTextFor($day, $type);
                $res[$r2]['timeTable'][$r3]['fullText']  = $this->cellFullTextFor($day, $type);

                $res[$r2]['timeTable'][$r3]['color'] = $this->cellColorFor($day);
                $res[$r2]['timeTable'][$r3]['printText']  = $this->cellPrintTextFor($day, $type);

                $res[$r2]['timeTable'][$r3][] = $day;
                $res[$r2]['timeTable'][$r3]['day'] = $day;

            } else {

                $res[$r2]['timeTable'][$r3]['shortText'] .= $this->cellShortTextFor($day, $type);
                $res[$r2]['timeTable'][$r3]['fullText'] .= "<br>".$this->cellFullTextFor($day, $type);
                $res[$r2]['timeTable'][$r3]['printText'] .= "\n".$this->cellPrintTextFor($day, $type);

                $res[$r2]['timeTable'][$r3][] = $day;
                $res[$r2]['timeTable'][$r3]['day'] = $day;
            }

        }

        return $res;
    }

    private function countMaxSubjects($timeTable)
    {
        $res = array();

        foreach ($timeTable as $date => $params) {

            foreach ($params['timeTable'] as $lessonNum => $data) {

                unset($data['day'],$data['shortText'], $data['fullText'], $data['printText'],$data['color']);

                $lessonAmount = count($data);

                $dayOfWeek = date('N', $date);// 1- понедельник

                if (! isset($res[$dayOfWeek][$lessonNum]))
                    $res[$dayOfWeek][$lessonNum] = 0;

                if ($res[$dayOfWeek][$lessonNum] < $lessonAmount)
                    $res[$dayOfWeek][$lessonNum] = $lessonAmount;
            }

        }

        return $res;
    }

    public function generateGroupTimeTable()
    {
        $timeTable = Gr::getTimeTable($this->group, $this->date1, $this->date2,0);
        $minMax    = $this->getMinMaxLessons($timeTable);

        list($fullTimeTable, $maxLessons) = $this->fillTameTableForGroup($timeTable);

        return array($minMax, $fullTimeTable, $maxLessons);
    }

    public function generateStudentTimeTable()
    {
        $timeTable = St::getTimeTable($this->student, $this->date1, $this->date2);
        $minMax    = $this->getMinMaxLessons($timeTable);

        //$fullTimeTable = $this->fillTameTable($timeTable, 2);
        list($fullTimeTable, $maxLessons) = $this->fillTameTableForStudent($timeTable);

        return array($minMax, $fullTimeTable,$maxLessons);
    }

    public function generateClassroomTimeTable()
    {
        $timeTable = A::getTimeTable($this->classroom, $this->date1, $this->date2);
        $minMax    = $this->getMinMaxLessons($timeTable);

        //$fullTimeTable = $this->fillTameTable($timeTable, 3);
        list($fullTimeTable, $maxLessons) = $this->fillTameTableForClassroom($timeTable);
        //$maxLessons = $this->countMaxSubjects($timeTable);

        return array($minMax, $fullTimeTable,$maxLessons);
    }

    public function generateTeacherTimeTable()
    {
        $timeTable = P::getTimeTable($this->teacher, $this->date1, $this->date2);
        $minMax    = $this->getMinMaxLessons($timeTable);

        list($fullTimeTable, $maxLessons)  = $this->fillTameTable($timeTable, 1);

        return array($minMax, $fullTimeTable, $maxLessons);
    }

    /**
     * загрузка пареметров преподавателя для прямой ссылки
     * @param $p1 int
     */
    public function loadByP1($p1){

        if($this->scenario!='teacher'&&$this->scenario!="mobile-teacher")
            return;

        if(empty($p1))
            return;

        $teacherParams = P::model()->getTeacherParamsByP1(intval($p1));
        if(empty($teacherParams))
            return;

        $this->filial = $teacherParams['ks1'];
        $this->faculty = $teacherParams['f1'];
        $this->chair = $teacherParams['k1'];
        $this->teacher = $teacherParams['p1'];
    }

    /**
     * Код язіка для процедур
     * @return int
     */
    public static function getLangCode(){
        if(Yii::app()->language == 'en')
            return 3;

        return 1;
    }
}