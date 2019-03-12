<?php

/**
 * Class CreateMessageForm
 */
class CreateMessageForm extends CFormModel
{
    const TYPE_TEACHER = '4';

    const TYPE_STREAM = '3';

    const TYPE_GROUP = '2';

    const TYPE_STUDENT = '1';

    public $type;

    public $to;

    public $faculty;

	public $body;

	public $notification = false;

	public $searchField;

	public $sendMail = false;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
            array('type', 'in', 'range' => array(self::TYPE_STUDENT, self::TYPE_GROUP ,self::TYPE_STREAM, self::TYPE_TEACHER)),
            array('notification, sendMail', 'boolean'),
            array('searchField', 'validationSearchField'),
            array('body, type, to', 'required'),
            array('faculty', 'safe'),
            array('body','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
		);
	}


    public function validationSearchField($attribute,$params)
    {
        if(empty($this->to) || !is_numeric($this->to)){
            $this->addError('searchField', tt('Заполните получателя'));
        }
    }

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
        return array(
            'body'=> tt('Текст сообщения'),
            'notification' => tt('Отправить с уведомлением'),
            'type' =>  tt('Кому'),
            'to' => tt('Получатель'),
            'searchField' => tt('Введите фамилию/группу (от 4-х букв)'),
            'faculty' => tt('Факультет'),
            'sendMail' => tt('Отправлять сообщение на почту')
        );
	}

    /**
     * Список типов
     * @return array
     */
	public function getTypes(){
	    return array(
	        self::TYPE_STUDENT => tt('Студенту'),
            self::TYPE_GROUP => tt('Группе'),
            self::TYPE_STREAM => tt('Потоку'),
            self::TYPE_TEACHER => tt('Преподователю')
        );
    }

    /**
     * @return bool
     * @throws CException
     */
    public function save(){

	    $model = new Um();
	    $model->um2 = Yii::app()->user->model->u1;
	    $model->um3 = date('Y-m-d H:i:s');
	    $model->um4 = $this->notification ? 1 : 0;
	    $model->um5 = $this->body;
        if($this->type == self::TYPE_STUDENT || $this->type == self::TYPE_TEACHER){
            //$model->um6 = 0;
            $model->um7 = $this->to;
        }else if($this->type == self::TYPE_GROUP){
            $model->um8 = $this->to;
        }else if($this->type == self::TYPE_STREAM){
            $model->um9 = $this->to;
        }
        $model->um1 = Yii::app()->db->createCommand('select gen_id(GEN_UM, 1) from rdb$database')->queryScalar();
        $model->um10 = null;

        return $model->save();
    }

    /**
     * Отправка сообщений на почту
     * @return bool
     * @throws phpmailerException
     */
    public function sendMails(){
        if(!$this->sendMail)
            return true;

        if($this->type == self::TYPE_STUDENT || $this->type == self::TYPE_TEACHER){
            $user = Users::model()->findByPk($this->to);
            if($user == null){
                throw new Exception('Ошибка индентификации пользователя');
            }

            list($result, $message) = Controller::mail(
                array(
                    $user->u4 => $user->name
                ),
                tt('Сообщение от {name}', array(
                    '{name}' => Yii::app()->user->name
                )),
                $this->body
            );

            if(!$result)
                throw new Exception($message);

            return true;
        }
    }
}