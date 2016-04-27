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
            array('password', 'compare', 'compareAttribute'=>'password2'),
            //array('username', 'match', 'pattern'=>'/^[A-z][\w]+$/','message'=>tt('В Логине могут быть только латинские символы')),
            array('username', 'match', 'pattern'=>'/^[a-zA-Z][a-zA-Z0-9]{7,30}$/','message'=>tt('В Логине могут быть только латинские символы и цифры, длиной от 8 до 30 символов. Первый символ обязательно буква')),
            array('password', 'match', 'pattern'=>'/^[a-zA-Z0-9-_\.,]{7,}$/','message'=>tt('В password могут быть только строчные и прописные латинские буквы, цифры, спецсимволы. Минимум 8 символов')),
            //array('password', 'match', 'pattern'=>'/^[A-z][\w]+$/','message'=>tt('В password могут быть только латинские символы')),
            //array('username, password', 'length', 'min' => 6,'max'=>50),
            array('email', 'length', 'max'=>100),

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
            //'username' => tt('Имя пользователя'),
            'username' => tt('Логин (регистрозависимый)'),
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

            //$this->_u5 = $st ? 0 : 1;
            //$this->_u6 = $st ? $st[0]->st1 : $p[0]->p1;
            $this->_u5 = $p ? 1 : 0;
            $this->_u6 = $p ? $p[0]->p1 : $st[0]->st1;
            //$alreadyRegistered = 1 <= Users::model()->count('u5=:U5 AND u6=:U6 AND u2!=""',array(':U5'=>$this->_u5,':U6'=>$this->_u6));
            $alreadyRegistered = 1 <= Users::model()->countByAttributes(
                array('u5'=>$this->_u5,'u6'=>$this->_u6),
                array(
                    'condition'=>'u2 != :U2',
                    'params'=>array(':U2'=>"")
                ));
            if ($alreadyRegistered)
                $this->addError($attribute, tt('Пользователь с таким идентификационным кодом уже зарегистрирован!'));
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
        $user->save(false);

        return true;
    }
}
