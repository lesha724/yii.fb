<?php

/**
 * This is the model class for table "ido".
 *
 * The followings are the available columns in table 'ido':
 * @property integer $ido1
 * @property integer $ido2
 * @property string $ido3
 * @property integer $ido4
 * @property integer $ido5
 */
class Ido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ido1, ido2, ido4, ido5', 'numerical', 'integerOnly'=>true),
			array('ido3', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ido1, ido2, ido3, ido4, ido5', 'safe', 'on'=>'search'),
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
			'ido1' => 'Ido1',
			'ido2' => 'Ido2',
			'ido3' => 'Ido3',
			'ido4' => 'Ido4',
			'ido5' => 'Ido5',
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

		$criteria->compare('ido1',$this->ido1);
		$criteria->compare('ido2',$this->ido2);
		$criteria->compare('ido3',$this->ido3,true);
		$criteria->compare('ido4',$this->ido4);
		$criteria->compare('ido5',$this->ido5);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
