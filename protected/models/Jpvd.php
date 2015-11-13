<?php

/**
 * This is the model class for table "jpvd".
 *
 * The followings are the available columns in table 'jpvd':
 * @property integer $jpvd0
 * @property integer $jpvd1
 * @property integer $jpvd2
 * @property integer $jpvd3
 * @property string $jpvd4
 * @property integer $jpvd5
 * @property integer $jpvd6
 *
 * The followings are the available model relations:
 * @property Jpv $jpvd10
 * @property St $jpvd20
 * @property I $jpvd50
 * @property P $jpvd60
 */
class Jpvd extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jpvd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jpvd0', 'required'),
			array('jpvd1, jpvd2, jpvd3, jpvd5, jpvd6', 'numerical', 'integerOnly'=>true),
			array('jpvd4', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('jpvd0, jpvd1, jpvd2, jpvd3, jpvd4, jpvd5, jpvd6', 'safe', 'on'=>'search'),
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
			'jpvd10' => array(self::BELONGS_TO, 'Jpv', 'jpvd1'),
			'jpvd20' => array(self::BELONGS_TO, 'St', 'jpvd2'),
			'jpvd50' => array(self::BELONGS_TO, 'I', 'jpvd5'),
			'jpvd60' => array(self::BELONGS_TO, 'P', 'jpvd6'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'jpvd0' => 'Jpvd0',
			'jpvd1' => 'Jpvd1',
			'jpvd2' => 'Jpvd2',
			'jpvd3' => 'Jpvd3',
			'jpvd4' => 'Jpvd4',
			'jpvd5' => 'Jpvd5',
			'jpvd6' => 'Jpvd6',
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

		$criteria->compare('jpvd0',$this->jpvd0);
		$criteria->compare('jpvd1',$this->jpvd1);
		$criteria->compare('jpvd2',$this->jpvd2);
		$criteria->compare('jpvd3',$this->jpvd3);
		$criteria->compare('jpvd4',$this->jpvd4,true);
		$criteria->compare('jpvd5',$this->jpvd5);
		$criteria->compare('jpvd6',$this->jpvd6);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jpvd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
