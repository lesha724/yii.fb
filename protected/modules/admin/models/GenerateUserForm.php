<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.09.14
 * Time: 9:12
 */
class GenerateUserForm extends CFormModel
{
    public $lastName;
    public $firstName;
    public $secondName;
    public $type;
    public $bDate;

    public function rules()
    {
        return array(
			array('type', 'numerical', 'integerOnly'=>true),
			array('lastName,firstName,secondName', 'type', 'type'=>'string'),
		);
    }

    public function attributeLabels()
    {
        return array(
            'lastName' => tt('Фамилия'),
            'firstName'=>tt('Имя'),
            'secondName'=>tt('Отчество'),
            'bDate'=>tt('Дата рождения'),
            'type'=>tt('Количество пар'),
        );
    }
}
?>