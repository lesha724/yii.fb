<?php

/**
 * Class CreateStpfileForm
 */
class CreateStpfileForm extends CFormModel
{
    /**
     */
    const TYPE_FIELD = 'field';
    /**
     */
    const TYPE_TABLE1 = 'table1';

	public $st1;
    public $file;
    public $id;
    public $type;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('st1, file, type, id', 'required'),
            array('type', 'in', 'range' => array(self::TYPE_FIELD, self::TYPE_TABLE1)),
            array('st1, id', 'numerical', 'integerOnly'=>true),
            array('file', 'file',
                'types'=> 'doc, docx, xls, xlsx, ppt, pptx, pdf, jpeg, jpg, png, zip',
                'maxSize' => 1024 * 1024 * 128,
            ),
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
		);
	}

    /**
     * @return bool
     */
    public function save(){

    }
}