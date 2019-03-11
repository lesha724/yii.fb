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

	public $notification;

	public $searchField;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
            array('type', 'in', 'range' => array(self::TYPE_STUDENT, self::TYPE_GROUP ,self::TYPE_STREAM, self::TYPE_TEACHER)),
            array('notification', 'boolean'),
            array('searchField', 'validationSearchField'),
            array('body, type, to', 'required'),
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
            'notification' => tt('Уведомление'),
            'type' =>  tt('Кому'),
            'to' => tt('Получатель'),
            'searchField' => tt('Введите фамилию/группу (от 4-х букв)')
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

    public function save(){
	    return true;
    }
}