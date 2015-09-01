<?php

/**
 * This is the model class for table "stegr".
 *
 * The followings are the available columns in table 'stegr':
 * @property integer $stegr1
 * @property integer $stegr2
 * @property string $stegr3
 * @property string $stegr4
 *
 * The followings are the available model relations:
 * @property Gr $stegr10
 */
class Stegr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stegr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stegr1, stegr2', 'numerical', 'integerOnly'=>true),
			array('stegr3, stegr4', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stegr1, stegr2, stegr3, stegr4', 'safe', 'on'=>'search'),
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
			'stegr10' => array(self::BELONGS_TO, 'Gr', 'stegr1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stegr1' => 'Stegr1',
			'stegr2' => 'Stegr2',
			'stegr3' => 'Stegr3',
			'stegr4' => 'Stegr4',
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

		$criteria->compare('stegr1',$this->stegr1);
		$criteria->compare('stegr2',$this->stegr2);
		$criteria->compare('stegr3',$this->stegr3,true);
		$criteria->compare('stegr4',$this->stegr4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stegr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
