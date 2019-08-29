<?php

/**
 * This is the model class for table "opr".
 *
 * The followings are the available columns in table 'opr':
 * @property integer $opr1
 * @property string $opr2
 * @property string $opr3
 * @property string $opr4
 * @property string $opr5
 *
 * The followings are the available model relations:
 * @property Oprrez[] $oprrezs
 */
class Opr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'opr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('opr1', 'numerical', 'integerOnly'=>true),
			array('opr2', 'length', 'max'=>400),
            array('opr3, opr4, opr5', 'length', 'max'=>50),
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
			'oprrezs' => array(self::HAS_MANY, 'Oprrez', 'oprrez3'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'opr1' => 'Opr1',
			'opr2' => tt('Вопрос'),
            'opr3' => tt('От'),
            'opr4' => tt('Среднее'),
            'opr5' => tt('До'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Opr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
