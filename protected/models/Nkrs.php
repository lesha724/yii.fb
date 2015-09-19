<?php

/**
 * This is the model class for table "nkrs".
 *
 * The followings are the available columns in table 'nkrs':
 * @property integer $nkrs1
 * @property integer $nkrs2
 * @property integer $nkrs3
 * @property string $nkrs4
 * @property string $nkrs5
 * @property integer $nkrs6
 * @property integer $nkrs7
 * @property string $nkrs8
 *
 * The followings are the available model relations:
 * @property St $nkrs20
 * @property Us $nkrs30
 * @property P $nkrs60
 * @property Spkr $nkrs70
 */
class Nkrs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nkrs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nkrs2, nkrs3, nkrs6, nkrs7', 'numerical', 'integerOnly'=>true),
			array('nkrs4, nkrs5', 'length', 'max'=>1000),
			array('nkrs8', 'length', 'max'=>1400),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nkrs1, nkrs2, nkrs3, nkrs4, nkrs5, nkrs6, nkrs7, nkrs8', 'safe', 'on'=>'search'),
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
			'nkrs20' => array(self::BELONGS_TO, 'St', 'nkrs2'),
			'nkrs30' => array(self::BELONGS_TO, 'Us', 'nkrs3'),
			'nkrs60' => array(self::BELONGS_TO, 'P', 'nkrs6'),
			'nkrs70' => array(self::BELONGS_TO, 'Spkr', 'nkrs7'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nkrs1' => 'Nkrs1',
			'nkrs2' => 'Nkrs2',
			'nkrs3' => 'Nkrs3',
			'nkrs4' => 'Nkrs4',
			'nkrs5' => 'Nkrs5',
			'nkrs6' => 'Nkrs6',
			'nkrs7' => 'Nkrs7',
			'nkrs8' => 'Nkrs8',
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

		$criteria->compare('nkrs1',$this->nkrs1);
		$criteria->compare('nkrs2',$this->nkrs2);
		$criteria->compare('nkrs3',$this->nkrs3);
		$criteria->compare('nkrs4',$this->nkrs4,true);
		$criteria->compare('nkrs5',$this->nkrs5,true);
		$criteria->compare('nkrs6',$this->nkrs6);
		$criteria->compare('nkrs7',$this->nkrs7);
		$criteria->compare('nkrs8',$this->nkrs8,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Nkrs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
