<?php

/**
 * Форма для отмены регистрации
 * Class CancelRegistrationForm
 */
class CancelRegistrationForm extends CFormModel
{
    public $inn;
	public $lastName;
    public $firstName;
    public $secondName;
	public $passportNumber;
    public $verifyCode;

    /**
     * @return array
     */
	public function rules()
	{
		return array(
			array('inn, lastName, firstName, secondName, passportNumber', 'required'),
            array('inn, lastName, firstName, secondName, passportNumber', 'length', 'max'=>100),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
            array('identityCode', 'checkExistence'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'inn' => tt('Идентификационный код'),
            'passportNumber' => tt('Номер паспорта'),
            'lastName' => tt('Фамилия'),
            'firstName' => tt('Имя'),
            'secondName' => tt('Отчетсво'),
            'verifyCode'=>'Verification Code',
		);
	}

    /**
     * Валидация
     * @param $attribute
     * @param $params
     */
    public function checkExistence($attribute)
    {
        /**
         * @var Users[] $users
         */
        $users = $this->_getUsers();

        $thereIsNotSuchId = count($users) == 0;
        if ($thereIsNotSuchId)
            $this->addError($attribute, tt('Пользователь не найден!'));

        /*$thereIsDuplicate = count($st) + count($p) > 1;
        if ($thereIsDuplicate)
            $this->addError($attribute, tt('Идентификационный код зарегистрирован несколько раз!'));*/
    }

    /**
     * @return Users[]
     */
    private function _getUsers(){
        return Users::model()->findAllBySql(<<<SQL
          SELECT users.* FROM st
            inner join pe on (st200 = pe1)
            inner join std on (st1 = std2)
            inner join users on (u6=st1 and u5=0)
          WHERE std11 in (0,3,5,7,6,8) and (std7 is null) AND pe20=:INN and pe2=:LAST_NAME and pe3=:FIRST_NAME and pe4=:SECOND_NAME and pe23=:NUMBER
          UNION
          SELECT users.* FROM p
            inner join pd on (p1 = pd2)
            inner join users on (u6=p1 and u5=1)
          WHERE PD28 in (0,2,5,9) and (pd13 is null) AND p13=:INN2 and p3=:LAST_NAME2 and p4=:FIRST_NAME2 and p5=:SECOND_NAME2 and p16=:NUMBER2
SQL
            ,  [
                ':INN' => $this->inn,
                ':LAST_NAME' => $this->lastName,
                ':FIRST_NAME' => $this->firstName,
                ':SECOND_NAME' => $this->secondName,
                ':NUMBER' => $this->passportNumber,
                ':INN2' => $this->inn,
                ':LAST_NAME2' => $this->lastName,
                ':FIRST_NAME2' => $this->firstName,
                ':SECOND_NAME2' => $this->secondName,
                ':NUMBER2' => $this->passportNumber
            ]);
    }

    /**
     * Отмена регистарции
     * @return bool
     * @throws CException
     * @throws Exception
     */
    public function cancelRegister(){
        $users = $this->_getUsers();

        $transaction = Yii::app()->db->beginTransaction();
        try {
            foreach ($users as $user) {
                if(!$user->delete())
                    throw new CHttpException(500, tt('Ошибка удаления пользователя'));
            }

            $transaction->commit();
            return true;
        }catch (Exception $error){
            $transaction->rollback();
            throw $error;
        }
    }
}
