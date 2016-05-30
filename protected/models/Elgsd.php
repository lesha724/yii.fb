<?php

/**
 * This is the model class for table "elgsd".
 *
 * The followings are the available columns in table 'elgsd':
 * @property integer $elgsd1
 * @property string $elgsd2
 * @property integer $elgsd3
 * @property integer $elgsd4
 * @property integer $elgsd5
 *
 * The followings are the available model relations:
 * @property Elgd[] $elgds
 */
class Elgsd extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elgsd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elgsd1', 'required'),
			array('elgsd1, elgsd3, elgsd4, elgsd5', 'numerical', 'integerOnly'=>true),
			array('elgsd2', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('elgsd1, elgsd2, elgsd3, elgsd4, elgsd5', 'safe', 'on'=>'search'),
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
			'elgds' => array(self::HAS_MANY, 'Elgd', 'elgd2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'elgsd1' => 'Elgsd1',
			'elgsd2' => 'Elgsd2',
			'elgsd3' => 'Elgsd3',
			'elgsd4' => 'Elgsd4',
			'elgsd5' => 'Elgsd5',
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

		$criteria->compare('elgsd1',$this->elgsd1);
		$criteria->compare('elgsd2',$this->elgsd2,true);
		$criteria->compare('elgsd3',$this->elgsd3);
		$criteria->compare('elgsd4',$this->elgsd4);
		$criteria->compare('elgsd5',$this->elgsd5);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elgsd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
