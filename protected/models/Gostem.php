<?php

/**
 * This is the model class for table "gostem".
 *
 * The followings are the available columns in table 'gostem':
 * @property integer $gostem1
 * @property integer $gostem2
 * @property integer $gostem3
 * @property string $gostem4
 */
class Gostem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gostem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gostem1', 'required'),
			array('gostem1, gostem2, gostem3', 'numerical', 'integerOnly'=>true),
			array('gostem4', 'length', 'max'=>1400),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('gostem1, gostem2, gostem3, gostem4', 'safe', 'on'=>'search'),
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
			'gostem1' => 'Gostem1',
			'gostem2' => 'Gostem2',
			'gostem3' => 'Gostem3',
			'gostem4' => 'Gostem4',
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

		$criteria->compare('gostem1',$this->gostem1);
		$criteria->compare('gostem2',$this->gostem2);
		$criteria->compare('gostem3',$this->gostem3);
		$criteria->compare('gostem4',$this->gostem4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gostem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
