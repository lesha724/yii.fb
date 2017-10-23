<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.09.14
 * Time: 9:12
 */
class ConfigForm extends CFormModel
{
    public $attendanceStatistic;
	public $timeTable;
	public $fixedCountLesson;
	public $countLesson;
	public $analytics, $analyticsYandex;
    public $top1;
    public $top2;
    public $banner;
    public $month;
    public $loginKey;
    public $favicon;
	
    public function rules()
    {
        return array(
            //array('attendanceStatistic,timeTable,fixedCountLesson,titleua,titleen,titleru','required'),
			array('attendanceStatistic,timeTable,fixedCountLesson,countLesson,month', 'numerical', 'integerOnly'=>true),
			array('analytics,analyticsYandex,banner,top1,top2', 'length', 'max'=>100000),
            array('loginKey', 'length', 'max'=>30),
            array('favicon', 'file', 'types'=>'ico','allowEmpty'=>true),
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
            'analytics'=>tt('Скрипт для подключения Аналитики(google analytics)'),
            'analyticsYandex'=>tt('Скрипт для подключения Аналитики(yandex metrika)'),
            'banner'=>tt('Баннер'),
            'top1'=>tt('Топ1'),
            'top2'=>tt('Топ2'),
            'month'=>tt('Месяц перевода на следующий курс')
        );
    }
}
?>