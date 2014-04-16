<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class TimeTableForm extends CFormModel
{
	public $filial = 0;
	public $chair = 0;
	public $teacher;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
            array('filial', 'required'),
            array('chair, teacher', 'numerical', 'allowEmpty' => false, 'on' => 'teacher'),
			array('chair, teacher', 'required', 'on' => 'teacher'),
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
			'filial'=> tt('Филиал'),
			'chair'=> tt('Кафедра'),
			'teacher'=> tt('Преподаватель'),
		);
	}
}