<?php

/**
 * This is the model class for table "stpblock".
 *
 * The followings are the available columns in table 'stpblock':
 * @property integer $stpblock1
 * @property integer $stpblock2
 * @property string $stpblock3
 *
 * The followings are the available model relations:
 * @property St $stpblock10
 * @property Users $stpblock20
 */
class Stpblock extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stpblock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stpblock1, stpblock2', 'numerical', 'integerOnly'=>true),
			array('stpblock3', 'length', 'max'=>20),
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
			'stpblock10' => array(self::BELONGS_TO, 'St', 'stpblock1'),
			'stpblock20' => array(self::BELONGS_TO, 'Users', 'stpblock2'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stpblock the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
