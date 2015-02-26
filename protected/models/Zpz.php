<?php

/**
 * This is the model class for table "zpz".
 *
 * The followings are the available columns in table 'zpz':
 * @property integer $zpz1
 * @property string $zpz2
 * @property integer $zpz3
 * @property integer $zpz4
 * @property integer $zpz5
 * @property string $zpz6
 * @property integer $zpz7
 * @property integer $zpz8
 * @property integer $zpz9
 * @property string $zpz10
 */
class Zpz extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'zpz';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('zpz1', 'required'),
			array('zpz3, zpz4, zpz5, zpz7, zpz8, zpz9', 'numerical', 'integerOnly'=>true),
            array('zpz6', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('zpz1, zpz2, zpz3, zpz4, zpz5, zpz6, zpz7, zpz8, zpz9, zpz10', 'safe', 'on'=>'search'),
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
			'zpz1' => 'Zpz1',
			'zpz2' => 'Zpz2',
			'zpz3' => 'Zpz3',
			'zpz4' => 'Zpz4',
			'zpz5' => 'Zpz5',
			'zpz6' => 'Zpz6',
			'zpz7' => 'Zpz7',
			'zpz8' => 'Zpz8',
			'zpz9' => 'Zpz9',
			'zpz10' => 'Zpz10',
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

		$criteria->compare('zpz1',$this->zpz1);
		$criteria->compare('zpz2',$this->zpz2,true);
		$criteria->compare('zpz3',$this->zpz3);
		$criteria->compare('zpz4',$this->zpz4);
		$criteria->compare('zpz5',$this->zpz5);
		$criteria->compare('zpz6',$this->zpz6,true);
		$criteria->compare('zpz7',$this->zpz7);
		$criteria->compare('zpz8',$this->zpz8);
		$criteria->compare('zpz9',$this->zpz9);
		$criteria->compare('zpz10',$this->zpz10,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zpz the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
