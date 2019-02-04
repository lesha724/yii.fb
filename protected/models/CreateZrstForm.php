<?php

/**
 * Class CreateZrstForm
 */
class CreateZrstForm extends CFormModel
{
    /**
     * сценарий для первой таблицы (студент)
     * @see Zrst::$zrst4 = 0
     * @see Zrst::$zrst6 = 0
     */
    const TYPE_TABLE1 = 'table1';
    /**
     * сценарий для второй таблицы (студент)
     * @see Zrst::$zrst4 = 1
     */
    const TYPE_TABLE2 = 'table2';
    /**
     * сценарий для третьей таблицы (студент)
     * @see Zrst::$zrst4 = 2
     */
    const TYPE_TABLE3 = 'table3';
    /**
     * сценарий для третьей таблицы (студент)
     * @see Zrst::$zrst4 = 0
     * @see Zrst::$zrst6 = 1
     */
    const TYPE_TEACHER = 'teacher';

	public $st1;
    public $us1;
    public $file;

    public $zrst5;

	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('st1, file', 'required'),
            array('note', 'string'),
            array('note', 'length', 'max'=>100),
            array('us1', 'required', 'on' => array(self::TYPE_TABLE1, self::TYPE_TEACHER)),
            array('zrst5', 'int'),
            array('zrst5', 'required', 'on' => self::TYPE_TABLE2),
            array('file', 'file',
                'types'=> 'pdf',
                'maxSize' => 1024 * 1024 * 10,
            ),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
		    'file' => tt('Файл'),
            'zrst5' => tt('Вид'),
			'verifyCode'=>tt('Проверочный код'),
		);
	}

    /**
     * @return array
     */
	public static function getZrst5Types(){
	    return array(
	        1=>  tt('олимпиады'),
            2=> tt('конференции, конкурсы, проекты'),
            3=> tt('публикации')
        );
    }
}