<?php

class RegistrationInternationalForm extends CFormModel
{
	public $serial;
    public $number;
	public $email;
	public $username;
	public $password;
	public $password2;


	public $emptySerial;
    //public $verifyCode;

    private $_u5;
    private $_u6;
    private $_fio;

	public function rules()
	{
		return array(
            array('number', 'required'),
            //array('serial', 'required','on'=>'step-2'),
			array('serial, email, username, password, password2, number', 'required','on'=>'step-3'),
            //array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'step-3'),
            array('serial', 'length', 'max'=>10),
            array('email', 'filter', 'filter'=>'trim'),
            array('serial, emptySerial', 'checkSerial'),
            array('number', 'checkNumber'),
            array('email', 'email'),
            array('email', 'unique', 'className'=>'Users', 'attributeName'=>'u4'),
            array('username', 'unique', 'className'=>'Users', 'attributeName'=>'u2'),
            array('password', 'compare', 'compareAttribute'=>'password2'),
            //array('username', 'match', 'pattern'=>'/^[A-z][\w]+$/','message'=>tt('В Логине могут быть только латинские символы')),
            array('username', 'match', 'pattern'=>'/^[a-zA-Z][a-zA-Z0-9]{7,30}$/','message'=>tt('В Логине могут быть только латинские символы и цифры, длиной от 8 до 30 символов. Первый символ обязательно буква')),
            array('password', 'match', 'pattern'=>'/^[a-zA-Z0-9-_\.,$|]{7,}$/','message'=>tt('В password могут быть только строчные и прописные латинские буквы, цифры, спецсимволы. Минимум 8 символов')),
            //array('password', 'match', 'pattern'=>'/^[A-z][\w]+$/','message'=>tt('В password могут быть только латинские символы')),
            array('password2', 'length', 'min' => 8),
            array('email', 'length', 'max'=>100),

		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'number' => tt('Номер паспорта'),
            'serial' => tt('Серия паспорта'),
            'email' => tt('Эл. почта'),
            //'username' => tt('Имя пользователя'),
            'username' => tt('Логин (регистрозависимый)'),
            'password' => tt('Пароль'),
            'password2' => tt('Повторите пароль'),
            'emptySerial' => tt('Паспорт без серии'),
		);
	}

    public function checkNumber($attribute)
    {
        $count = St::model()->with('person')->count(new CDbCriteria(array
        (
            'condition' => 'pe23 = :NUMBER and st63 > 0',
            'params' => array(':NUMBER'=>$this->number)
        )));

        if($count==0)
            $this->addError($attribute, tt('Не найдены иност. граждане с таким номером паспорта'));
    }

    public function checkSerial($attribute)
    {
        if (empty($this->number))
            $this->addError($attribute, tt('Пустой номер паспорта'));

        $students = St::model()->with('person')->findAll(new CDbCriteria(array
        (
            'condition' => 'pe23 = :NUMBER AND  pe22 =:SERIAL and st63 > 0',
            'params' => array(
                ':NUMBER'=>$this->number,
                ':SERIAL'=>!empty($this->emptySerial)? '' :$this->serial
            ),
            'order'=>'st1 DESC'
        )));

        if(count($students)==0)
            $this->addError($attribute, tt('Не найдены иност. граждане с таким номером и серией паспорта'));
        else{
            $student = $students[0];

            $this->_u5 = 0;
            $this->_u6 = $student->st1;

            $this->_fio = $student->fullName;

            $alreadyRegistered = 1 <= Users::model()->countByAttributes(
                    array('u5'=>$this->_u5,'u6'=>$this->_u6),
                    array(
                        'condition'=>'u2 != :U2',
                        'params'=>array(':U2'=>'')
                    ));
            if ($alreadyRegistered)
                $this->addError($attribute, tt('Иност. гражданин с таким номером и серией паспорта уже зарегистрирован!'));
        }
    }

    public function register()
    {
        $user = Users::model()->findByAttributes(array('u5'=>$this->_u5,'u6'=>$this->_u6,'u2'=>""));
        if(empty($user)) {
            $user = new Users;
            $user->u1 = new CDbExpression('GEN_ID(GEN_USERS, 1)');
        }
        $user->u2 = $this->username;
        $user->u3 = $this->password;
        $user->u4 = $this->email;
        $user->u5 = $this->_u5;
        $user->u6 = $this->_u6;
        $user->u10 = '';
        $user->save(false);

        return true;
    }

    public function getFio(){
        return $this->_fio;
    }
}
