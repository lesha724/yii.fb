<?php

/**
 * This is the model class for table "ustem".
 *
 * The followings are the available columns in table 'ustem':
 * @property integer $ustem1
 * @property integer $ustem2
 * @property integer $ustem3
 * @property string $ustem4
 * @property integer $ustem5
 * @property integer $ustem6
 * @property integer $ustem7
 */
class Ustem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ustem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ustem1', 'required'),
			array('ustem1, ustem2, ustem3, ustem5, ustem6, ustem7', 'numerical', 'integerOnly'=>true),
			array('ustem4', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ustem1, ustem2, ustem3, ustem4, ustem5, ustem6, ustem7', 'safe', 'on'=>'search'),
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
			'ustem1' => 'Ustem1',
			'ustem2' => 'Ustem2',
			'ustem3' => 'Ustem3',
			'ustem4' => 'Ustem4',
			'ustem5' => 'Ustem5',
			'ustem6' => 'Ustem6',
			'ustem7' => 'Ustem7',
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

		$criteria->compare('ustem1',$this->ustem1);
		$criteria->compare('ustem2',$this->ustem2);
		$criteria->compare('ustem3',$this->ustem3);
		$criteria->compare('ustem4',$this->ustem4,true);
		$criteria->compare('ustem5',$this->ustem5);
		$criteria->compare('ustem6',$this->ustem6);
		$criteria->compare('ustem7',$this->ustem7);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ustem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
