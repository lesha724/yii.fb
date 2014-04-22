<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class TimeTableForm extends CFormModel
{
	public $filial = 0;
	public $chair = 0;
	public $teacher;

    public $date1;
    public $date2;
    public $r11 = 5;

    const r11Color = '#EFBCEF';

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
            array('filial', 'required'),
            array('date1, date2, r11', 'safe'),
            array('chair, teacher', 'numerical', 'allowEmpty' => false, 'on' => 'teacher'),
			array('chair, teacher', 'required', 'on' => 'teacher'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'filial'=> tt('Филиал'),
			'chair'=> tt('Кафедра'),
			'teacher'=> tt('Преподаватель'),
            'r11' => tt('Индикация изменений в расписании')
		);
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

    public function joinGroups($timeTable)
    {
        $res = array();
        foreach($timeTable as $day) {

            $r2 = strtotime($day['r2']); // date
            $r3 = $day['r3'];            // lesson

            if (! isset($res[$r2][$r3])) {

                $res[$r2]['timeTable'][$r3] = $day;

                $res[$r2]['timeTable'][$r3]['shortText'] = $this->cellShortTextForTeach($day);
                $res[$r2]['timeTable'][$r3]['fullText']  = $this->cellFullTextForTeach($day);

            } else
                $res[$r2]['timeTable'][$r3]['gr3'] .= ','.$day['gr3'];


        }

        return $res;
    }

    public function fillTameTableForTeacher($timeTable)
    {
        $timeTable = $this->joinGroups($timeTable);

        list($firstMonday,) = $this->getWeekBoundary($this->date1);

        list(,$lastSunday)  = $this->getWeekBoundary($this->date2);

        while($firstMonday <= $lastSunday) {

            if (! isset($timeTable[$firstMonday]))
                $timeTable[$firstMonday] = array('timeTable' => array());

            $timeTable[$firstMonday]['date'] = date('d.m.Y', $firstMonday);

            $firstMonday += 86400;
        }

        ksort($timeTable);
        //die(var_dump($timeTable));
        return $timeTable;
    }

    public function getWeekBoundary($date)
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

    public function cellShortTextForTeach($day)
    {
        $d3  = $day['d3'];
        $tip = $day['tip'];
        $gr3 = mb_strimwidth($day['gr3'], 0, 10, '...');
        $a2  = $day['a2'];

        $pattern = <<<HTML
            {$d3}[{$tip}]<br>
            {$gr3}<br>
            ауд. {$a2}
HTML;

        return sprintf(trim($pattern));
    }

    public function cellFullTextForTeach($day)
    {
        $d2  = $day['d2'];
        $tip = $day['tip'];
        $gr3 = $day['gr3'];
        $a2  = $day['a2'];
        $class = tt('ауд');
        $text  = tt('Добавлено');
        $added = date('d.m.Y H:i', strtotime($day['r11']));

        $pattern = <<<HTML
            {$d2}[{$tip}]<br>
            {$gr3}<br>
            {$class}. {$a2}<br>
            {$text}: {$added}
HTML;

        return sprintf(trim($pattern));
    }
}