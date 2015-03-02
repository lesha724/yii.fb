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
	
    public function rules()
    {
        return array(
            array('attendanceStatistic','required'),
			array('attendanceStatistic', 'numerical', 'integerOnly'=>true),			
		);
    }

    public function attributeLabels()
    {
        return array(
            //'adminEmail' => 'Email адміністратора',
            'attendanceStatistic' => tt('Статистика посещаемости'),
        );
    }
}
?>