<?php

/**
 * This is the model class for table "stegnp".
 *
 * The followings are the available columns in table 'stegnp':
 * @property integer $stegnp0
 * @property integer $stegnp1
 * @property integer $stegnp2
 * @property string $stegnp3
 * @property string $stegnp4
 * @property string $stegnp5
 */
class Stegnp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stegnp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stegnp0', 'required'),
			array('stegnp1, stegnp2', 'numerical', 'integerOnly'=>true),
			array('stegnp3, stegnp4', 'length', 'max'=>80),
			array('stegnp5', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stegnp0, stegnp1, stegnp2, stegnp3, stegnp4, stegnp5', 'safe', 'on'=>'search'),
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
			'stegnp0' => 'Stegnp0',
			'stegnp1' => 'Stegnp1',
			'stegnp2' => 'Stegnp2',
			'stegnp3' => 'Stegnp3',
			'stegnp4' => 'Stegnp4',
			'stegnp5' => 'Stegnp5',
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

		$criteria->compare('stegnp0',$this->stegnp0);
		$criteria->compare('stegnp1',$this->stegnp1);
		$criteria->compare('stegnp2',$this->stegnp2);
		$criteria->compare('stegnp3',$this->stegnp3,true);
		$criteria->compare('stegnp4',$this->stegnp4,true);
		$criteria->compare('stegnp5',$this->stegnp5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stegnp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
