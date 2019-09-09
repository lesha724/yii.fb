<?php

/**
 * This is the model class for table "stpfieldfile".
 *
 * The followings are the available columns in table 'stpfieldfile':
 * @property integer $stpfieldfile1
 * @property integer $stpfieldfile2
 *
 * The followings are the available model relations:
 * @property Stpfile $stpfieldfile20
 */
class Stpfieldfile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stpfieldfile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stpfieldfile1, stpfieldfile2', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'stpfieldfile20' => array(self::BELONGS_TO, 'Stpfile', 'stpfieldfile2'),
		);
	}

    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stpfieldfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
