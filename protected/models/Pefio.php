<?php

/**
 * This is the model class for table "pefio".
 *
 * The followings are the available columns in table 'pefio':
 * @property integer $pefio1
 * @property integer $pefio2
 * @property integer $pefio3
 * @property string $pefio4
 * @property string $pefio5
 * @property string $pefio6
 * @property string $pefio7
 *
 * The followings are the available model relations:
 * @property Person $person
 */
class Pefio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pefio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pefio1, pefio2, pefio3', 'numerical', 'integerOnly'=>true),
			array('pefio4', 'length', 'max'=>8),
			array('pefio5', 'length', 'max'=>140),
			array('pefio6', 'length', 'max'=>200),
			array('pefio7', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pefio1, pefio2, pefio3, pefio4, pefio5, pefio6, pefio7', 'safe', 'on'=>'search'),
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
			'person' => array(self::BELONGS_TO, 'Person', 'pefio1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pefio1' => 'Pefio1',
			'pefio2' => 'Pefio2',
			'pefio3' => 'Pefio3',
			'pefio4' => 'Pefio4',
			'pefio5' => 'Pefio5',
			'pefio6' => 'Pefio6',
			'pefio7' => 'Pefio7',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pefio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
