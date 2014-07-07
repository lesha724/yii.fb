<?php

/**
 * This is the model class for table "aapes".
 *
 * The followings are the available columns in table 'aapes':
 * @property integer $aapes1
 * @property integer $aapes2
 * @property integer $aapes3
 * @property string $aapes4
 * @property double $aapes5
 * @property integer $aapes6
 * @property integer $aapes7
 */
class Aapes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aapes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aapes1, aapes2, aapes3, aapes6, aapes7', 'numerical', 'integerOnly'=>true),
			array('aapes5', 'numerical'),
			array('aapes4', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('aapes1, aapes2, aapes3, aapes4, aapes5, aapes6, aapes7', 'safe', 'on'=>'search'),
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
			'aapes1' => 'Aapes1',
			'aapes2' => 'Aapes2',
			'aapes3' => 'Aapes3',
			'aapes4' => 'Aapes4',
			'aapes5' => 'Aapes5',
			'aapes6' => 'Aapes6',
			'aapes7' => 'Aapes7',
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

		$criteria->compare('aapes1',$this->aapes1);
		$criteria->compare('aapes2',$this->aapes2);
		$criteria->compare('aapes3',$this->aapes3);
		$criteria->compare('aapes4',$this->aapes4,true);
		$criteria->compare('aapes5',$this->aapes5);
		$criteria->compare('aapes6',$this->aapes6);
		$criteria->compare('aapes7',$this->aapes7);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Aapes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
