<?php

/**
 * This is the model class for table "ddoi".
 *
 * The followings are the available columns in table 'ddoi':
 * @property integer $ddoi1
 * @property integer $ddoi2
 * @property integer $ddoi3
 * @property integer $ddoi4
 * @property integer $ddoi5
 * @property integer $ddoi6
 * @property integer $ddoi7
 * @property integer $ddoi8
 * @property integer $ddoi9
 * @property integer $ddoi10
 * @property integer $ddoi11
 * @property integer $ddoi12
 * @property integer $ddoi13
 * @property integer $ddoi14
 * @property integer $ddoi15
 *
 * The followings are the available model relations:
 * @property Ddo $ddoi20
 */
class Ddoi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ddoi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ddoi1, ddoi2, ddoi3, ddoi4, ddoi5, ddoi6, ddoi7, ddoi8, ddoi9, ddoi10, ddoi11, ddoi12, ddoi13, ddoi14, ddoi15', 'numerical', 'integerOnly'=>true),
			array('ddoi3', 'default', 'value'=>1),
			array('ddoi4', 'default', 'value'=>2),
			array('ddoi5', 'default', 'value'=>3),
			array('ddoi6', 'default', 'value'=>4),
			array('ddoi7', 'default', 'value'=>5),
			array('ddoi8', 'default', 'value'=>6),
			array('ddoi9', 'default', 'value'=>7),
			array('ddoi10', 'default', 'value'=>8),
			array('ddoi11', 'default', 'value'=>9),
			array('ddoi12', 'default', 'value'=>10),
			array('ddoi13', 'default', 'value'=>11),
			array('ddoi14', 'default', 'value'=>12),
			array('ddoi15', 'default', 'value'=>13),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ddoi1, ddoi2, ddoi3, ddoi4, ddoi5, ddoi6, ddoi7, ddoi8, ddoi9, ddoi10, ddoi11, ddoi12, ddoi13, ddoi14, ddoi15', 'safe', 'on'=>'search'),
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
			'ddoi20' => array(self::BELONGS_TO, 'Ddo', 'ddoi2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ddoi1' => 'Ddoi1',
			'ddoi2' => 'Ddoi2',
			'ddoi3' => 'Ddoi3',
			'ddoi4' => 'Ddoi4',
			'ddoi5' => 'Ddoi5',
			'ddoi6' => 'Ddoi6',
			'ddoi7' => 'Ddoi7',
			'ddoi8' => 'Ddoi8',
			'ddoi9' => 'Ddoi9',
			'ddoi10' => 'Ddoi10',
			'ddoi11' => 'Ddoi11',
			'ddoi12' => 'Ddoi12',
			'ddoi13' => 'Ddoi13',
			'ddoi14' => 'Ddoi14',
			'ddoi15' => 'Ddoi15',
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

		$criteria->compare('ddoi1',$this->ddoi1);
		$criteria->compare('ddoi2',$this->ddoi2);
		$criteria->compare('ddoi3',$this->ddoi3);
		$criteria->compare('ddoi4',$this->ddoi4);
		$criteria->compare('ddoi5',$this->ddoi5);
		$criteria->compare('ddoi6',$this->ddoi6);
		$criteria->compare('ddoi7',$this->ddoi7);
		$criteria->compare('ddoi8',$this->ddoi8);
		$criteria->compare('ddoi9',$this->ddoi9);
		$criteria->compare('ddoi10',$this->ddoi10);
		$criteria->compare('ddoi11',$this->ddoi11);
		$criteria->compare('ddoi12',$this->ddoi12);
		$criteria->compare('ddoi13',$this->ddoi13);
		$criteria->compare('ddoi14',$this->ddoi14);
		$criteria->compare('ddoi15',$this->ddoi15);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ddoi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
