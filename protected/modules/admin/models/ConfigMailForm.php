<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.09.14
 * Time: 9:12
 */
class ConfigMailForm extends CFormModel
{
    //public $Class;
    public $Host;
    public $Username;
    public $Password;
	public $Mailer;
	public $Port;
	//public $SMTPAuth;

    public function rules()
    {
        return array(
            array('Host, Username, Password, Mailer, Port','required'),
            array('Port', 'numerical', 'integerOnly'=>true),
        );
    }

    public function attributeLabels()
    {
        return array(
            //'Class' => 'Class',
            'Host' => tt('Host'),
            'Username' => tt('Логин'),
            'Password' => tt('Пароль'),
            'Mailer' => tt('Тип подключения'),
            'Port' => tt('Порт'),
            //'SMTPAuth'=>'SMTPAuth',
        );
    }
}
?>