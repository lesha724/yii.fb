<?php

class RegistrationForm extends CFormModel
{
	public $identityCode;
	public $email;
	public $username;
	public $password;
	public $password2;

    private $_u5;
    private $_u6;

	public function rules()
	{
		return array(
			array('identityCode, email, username, password, password2', 'required'),
            array('identityCode', 'checkExistence'),
            array('email', 'email'),
            array('email', 'unique', 'className'=>'Users', 'attributeName'=>'u4'),
            array('username', 'unique', 'className'=>'Users', 'attributeName'=>'u2'),
            array('username, password', 'length', 'max'=>50),
            array('email', 'length', 'max'=>100),
            array('password', 'compare', 'compareAttribute'=>'password2'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'identityCode' => tt('Идентификационный код'),
            'email' => tt('Эл. почта'),
            'username' => tt('Имя пользователя'),
            'password' => tt('Пароль'),
            'password2' => tt('Повторите пароль'),
		);
	}

    public function checkExistence($attribute,$params)
    {
        $st = St::model()->findAll('st15=:ID', array(':ID'=>$this->$attribute));
        $p  = P::model()->findAll('p13=:ID', array(':ID'=>$this->$attribute));

        $thereIsNotSuchId = count($st) + count($p) == 0;
        if ($thereIsNotSuchId)
            $this->addError($attribute, tt('Идентификационный код не зарегистрирован!'));

        $thereIsDuplicate = count($st) + count($p) > 1;
        if ($thereIsDuplicate)
            $this->addError($attribute, tt('Идентификационный код зарегистрирован несколько раз!'));

        if (! $this->hasErrors($attribute)) {

            $this->_u5 = $st ? 0 : 1;
            $this->_u6 = $st ? $st[0]->st1 : $p[0]->p1;

            $alreadyRegistered = 1 <= Users::model()->countByAttributes(array('u5'=>$this->_u5,'u6'=>$this->_u6));
            if ($alreadyRegistered)
                $this->addError($attribute, tt('Пользователь с таким идентификационным кодом уже зарегистрирован!'));
        }
    }

    public function register()
    {
        $user = new Users;
        $user->u1 = new CDbExpression('GEN_ID(GEN_USERS, 1)');
        $user->u2 = $this->username;
        $user->u3 = $this->password;
        $user->u4 = $this->email;
        $user->u5 = $this->_u5;
        $user->u6 = $this->_u6;
        $user->save(false);

        return true;
    }
}
