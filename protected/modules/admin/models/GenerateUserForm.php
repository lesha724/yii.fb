<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.09.14
 * Time: 9:12
 */
class GenerateUserForm extends CFormModel
{
    public $attendanceStatistic;
	public $timeTable;
	public $fixedCountLesson;
	public $countLesson;
	public $analytics;
        public $top1;
        public $top2;
        public $banner;
        public $month;
	
    public function rules()
    {
        return array(
            //array('attendanceStatistic,timeTable,fixedCountLesson,titleua,titleen,titleru','required'),
			array('attendanceStatistic,timeTable,fixedCountLesson,countLesson,month', 'numerical', 'integerOnly'=>true),
			array('analytics,banner,top1,top2', 'length', 'max'=>100000),		
		);
    }

    public function attributeLabels()
    {
        return array(
            //'adminEmail' => 'Email адміністратора',
            'attendanceStatistic' => tt('Статистика посещаемости'),
            'timeTable'=>tt('Расписание'),
            'fixedCountLesson'=>tt('Фиксированное количество пар'),
            'countLesson'=>tt('Количество пар'),
            'analytics'=>tt('Скрипт для подключения Аналитики(google analytics,yandex metrika и т.д.)'),
            'banner'=>tt('Баннер'),
            'top1'=>tt('Топ1'),
            'top2'=>tt('Топ2'),
            'month'=>tt('Месяц перевода на следующий курс')
        );
    }
}
?>