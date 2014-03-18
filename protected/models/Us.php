<?php

/**
 * This is the model class for table "us".
 *
 * The followings are the available columns in table 'us':
 * @property integer $us1
 * @property integer $us2
 * @property integer $us3
 * @property integer $us4
 * @property double $us5
 * @property double $us6
 * @property integer $us10
 * @property integer $us11
 * @property integer $us12
 * @property integer $us13
 * @property double $us14
 * @property integer $us15
 */
class Us extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'us';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('us1, us2, us3, us4, us10, us11, us12, us13, us15', 'numerical', 'integerOnly'=>true),
			array('us5, us6, us14', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('us1, us2, us3, us4, us5, us6, us10, us11, us12, us13, us14, us15', 'safe', 'on'=>'search'),
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
			'us1' => 'Us1',
			'us2' => 'Us2',
			'us3' => 'Us3',
			'us4' => 'Us4',
			'us5' => 'Us5',
			'us6' => 'Us6',
			'us10' => 'Us10',
			'us11' => 'Us11',
			'us12' => 'Us12',
			'us13' => 'Us13',
			'us14' => 'Us14',
			'us15' => 'Us15',
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

		$criteria->compare('us1',$this->us1);
		$criteria->compare('us2',$this->us2);
		$criteria->compare('us3',$this->us3);
		$criteria->compare('us4',$this->us4);
		$criteria->compare('us5',$this->us5);
		$criteria->compare('us6',$this->us6);
		$criteria->compare('us10',$this->us10);
		$criteria->compare('us11',$this->us11);
		$criteria->compare('us12',$this->us12);
		$criteria->compare('us13',$this->us13);
		$criteria->compare('us14',$this->us14);
		$criteria->compare('us15',$this->us15);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Us the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
