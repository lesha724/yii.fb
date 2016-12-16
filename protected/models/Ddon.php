<?php

/**
 * This is the model class for table "ddon".
 *
 * The followings are the available columns in table 'ddon':
 * @property integer $ddon1
 * @property integer $ddon2
 * @property string $ddon3
 * @property string $ddon4
 * @property string $ddon5
 * @property string $ddon6
 * @property string $ddon7
 * @property string $ddon8
 * @property string $ddon9
 * @property string $ddon10
 * @property string $ddon11
 * @property string $ddon12
 * @property string $ddon13
 * @property string $ddon14
 * @property string $ddon15
 *
 * The followings are the available model relations:
 * @property Ddo $ddon20
 */
class Ddon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ddon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ddon1, ddon2', 'numerical', 'integerOnly'=>true),
			array('ddon3, ddon4, ddon5, ddon6, ddon7, ddon8, ddon9, ddon10, ddon11, ddon12, ddon13, ddon14, ddon15', 'length', 'max'=>400),
			array('ddon3', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo3')),
			array('ddon4', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo4')),
			array('ddon5', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo5')),
			array('ddon6', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo6')),
			array('ddon7', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo7')),
			array('ddon8', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo8')),
			array('ddon9', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo9')),
			array('ddon10', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo10')),
			array('ddon11', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo11')),
			array('ddon12', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo12')),
			array('ddon13', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo13')),
			array('ddon14', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo14')),
			array('ddon15', 'default', 'value'=>Ddo::model()->getAttributeLabel('ddo15')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ddon1, ddon2, ddon3, ddon4, ddon5, ddon6, ddon7, ddon8, ddon9, ddon10, ddon11, ddon12, ddon13, ddon14, ddon15', 'safe', 'on'=>'search'),
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
			'ddon20' => array(self::BELONGS_TO, 'Ddo', 'ddon2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ddon1' => 'Ddon1',
			'ddon2' => 'Ddon2',
			'ddon3' => 'Ddon3',
			'ddon4' => 'Ddon4',
			'ddon5' => 'Ddon5',
			'ddon6' => 'Ddon6',
			'ddon7' => 'Ddon7',
			'ddon8' => 'Ddon8',
			'ddon9' => 'Ddon9',
			'ddon10' => 'Ddon10',
			'ddon11' => 'Ddon11',
			'ddon12' => 'Ddon12',
			'ddon13' => 'Ddon13',
			'ddon14' => 'Ddon14',
			'ddon15' => 'Ddon15',
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

		$criteria->compare('ddon1',$this->ddon1);
		$criteria->compare('ddon2',$this->ddon2);
		$criteria->compare('ddon3',$this->ddon3,true);
		$criteria->compare('ddon4',$this->ddon4,true);
		$criteria->compare('ddon5',$this->ddon5,true);
		$criteria->compare('ddon6',$this->ddon6,true);
		$criteria->compare('ddon7',$this->ddon7,true);
		$criteria->compare('ddon8',$this->ddon8,true);
		$criteria->compare('ddon9',$this->ddon9,true);
		$criteria->compare('ddon10',$this->ddon10,true);
		$criteria->compare('ddon11',$this->ddon11,true);
		$criteria->compare('ddon12',$this->ddon12,true);
		$criteria->compare('ddon13',$this->ddon13,true);
		$criteria->compare('ddon14',$this->ddon14,true);
		$criteria->compare('ddon15',$this->ddon15,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ddon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
