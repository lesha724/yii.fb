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
	public $analytics;
	public $titleuk;
	public $titleen;
	public $titleru;
	public $logo;
	public $logo_right;
	
    public function rules()
    {
        return array(
            //array('attendanceStatistic,timeTable,fixedCountLesson,titleua,titleen,titleru','required'),
			array('attendanceStatistic,timeTable,fixedCountLesson,countLesson', 'numerical', 'integerOnly'=>true),
			array('titleuk,titleen,titleru,logo,logo_right','length', 'max'=>150),
			array('analytics', 'length', 'max'=>10000),		
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
			'titleuk'=>tt('Название Укр.'),
			'titleen'=>tt('Название Анг.'),
			'titleru'=>tt('Название Рус.'),
			'logo'=>tt('Логотип'),
			'logo_right'=>tt('Логотип пр.'),
        );
    }
}
?>