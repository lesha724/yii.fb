<?php

/**
 * This is the model class for table "stus".
 *
 * The followings are the available columns in table 'stus':
 * @property integer $stus0
 * @property integer $stus1
 * @property integer $stus3
 * @property integer $stus4
 * @property integer $stus5
 * @property string $stus6
 * @property string $stus7
 * @property integer $stus8
 * @property string $stus9
 * @property integer $stus10
 * @property string $stus11
 * @property string $stus12
 * @property string $stus13
 * @property string $stus14
 * @property integer $stus16
 * @property integer $stus17
 * @property integer $stus18
 * @property integer $stus19
 * @property integer $stus20
 * @property integer $stus21
 */
class Stus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stus0, stus1, stus3, stus4, stus5, stus8, stus10, stus16, stus17, stus18, stus19, stus20, stus21', 'numerical', 'integerOnly'=>true),
			array('stus6, stus9, stus11', 'length', 'max'=>8),
			array('stus7', 'length', 'max'=>60),
			array('stus12, stus13, stus14', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stus0, stus1, stus3, stus4, stus5, stus6, stus7, stus8, stus9, stus10, stus11, stus12, stus13, stus14, stus16, stus17, stus18, stus19, stus20, stus21', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stus0' => 'Stus0',
			'stus1' => 'Stus1',
			'stus3' => 'Stus3',
			'stus4' => 'Stus4',
			'stus5' => 'Stus5',
			'stus6' => 'Stus6',
			'stus7' => 'Stus7',
			'stus8' => 'Stus8',
			'stus9' => 'Stus9',
			'stus10' => 'Stus10',
			'stus11' => 'Stus11',
			'stus12' => 'Stus12',
			'stus13' => 'Stus13',
			'stus14' => 'Stus14',
			'stus16' => 'Stus16',
			'stus17' => 'Stus17',
			'stus18' => 'Stus18',
			'stus19' => 'Stus19',
			'stus20' => 'Stus20',
			'stus21' => 'Stus21',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('stus0',$this->stus0);
		$criteria->compare('stus1',$this->stus1);
		$criteria->compare('stus3',$this->stus3);
		$criteria->compare('stus4',$this->stus4);
		$criteria->compare('stus5',$this->stus5);
		$criteria->compare('stus6',$this->stus6,true);
		$criteria->compare('stus7',$this->stus7,true);
		$criteria->compare('stus8',$this->stus8);
		$criteria->compare('stus9',$this->stus9,true);
		$criteria->compare('stus10',$this->stus10);
		$criteria->compare('stus11',$this->stus11,true);
		$criteria->compare('stus12',$this->stus12,true);
		$criteria->compare('stus13',$this->stus13,true);
		$criteria->compare('stus14',$this->stus14,true);
		$criteria->compare('stus16',$this->stus16);
		$criteria->compare('stus17',$this->stus17);
		$criteria->compare('stus18',$this->stus18);
		$criteria->compare('stus19',$this->stus19);
		$criteria->compare('stus20',$this->stus20);
		$criteria->compare('stus21',$this->stus21);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
