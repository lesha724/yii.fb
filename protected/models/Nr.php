<?php

/**
 * This is the model class for table "nr".
 *
 * The followings are the available columns in table 'nr':
 * @property integer $nr1
 * @property integer $nr2
 * @property double $nr3
 * @property integer $nr4
 * @property integer $nr5
 * @property integer $nr6
 * @property integer $nr7
 * @property integer $nr8
 * @property integer $nr9
 * @property integer $nr10
 * @property integer $nr11
 * @property integer $nr12
 * @property integer $nr13
 * @property integer $nr15
 * @property integer $nr16
 * @property integer $nr17
 * @property integer $nr18
 * @property integer $nr19
 * @property integer $nr20
 * @property string $nr21
 * @property integer $nr22
 * @property integer $nr23
 * @property string $nr24
 * @property integer $nr25
 * @property integer $nr26
 * @property integer $nr27
 * @property integer $nr28
 * @property integer $nr29
 * @property integer $nr31
 * @property integer $nr32
 * @property string $nr33
 * @property integer $nr34
 */
class Nr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nr1, nr2, nr4, nr5, nr6, nr7, nr8, nr9, nr10, nr11, nr12, nr13, nr15, nr16, nr17, nr18, nr19, nr20, nr21, nr22, nr23, nr25, nr26, nr27, nr28, nr29, nr31, nr32, nr34', 'numerical', 'integerOnly'=>true),
			array('nr3', 'numerical'),
			array('nr33', 'length', 'max'=>1000),
            array('nr24', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nr1, nr2, nr3, nr4, nr5, nr6, nr7, nr8, nr9, nr10, nr11, nr12, nr13, nr15, nr16, nr17, nr18, nr19, nr20, nr21, nr22, nr23, nr24, nr25, nr26, nr27, nr28, nr29, nr31, nr32, nr33, nr34', 'safe', 'on'=>'search'),
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
			'nr1' => 'Nr1',
			'nr2' => 'Nr2',
			'nr3' => 'Nr3',
			'nr4' => 'Nr4',
			'nr5' => 'Nr5',
			'nr6' => tt('Преподаватель'),
			'nr7' => 'Nr7',
			'nr8' => 'Nr8',
			'nr9' => 'Nr9',
			'nr10' => 'Nr10',
			'nr11' => 'Nr11',
			'nr12' => 'Nr12',
			'nr13' => 'Nr13',
			'nr15' => 'Nr15',
			'nr16' => 'Nr16',
			'nr17' => 'Nr17',
			'nr18' => 'Nr18',
			'nr19' => 'Nr19',
			'nr20' => 'Nr20',
			'nr21' => 'Nr21',
			'nr22' => 'Nr22',
			'nr23' => 'Nr23',
			'nr24' => 'Nr24',
			'nr25' => 'Nr25',
			'nr26' => 'Nr26',
			'nr27' => 'Nr27',
			'nr28' => 'Nr28',
			'nr29' => 'Nr29',
			'nr31' => tt('№ темы'),
			'nr32' => tt('№ занятия'),
			'nr33' => tt('Тема'),
			'nr34' => tt('Тип'),
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

		$criteria->compare('nr1',$this->nr1);
		$criteria->compare('nr2',$this->nr2);
		$criteria->compare('nr3',$this->nr3);
		$criteria->compare('nr4',$this->nr4);
		$criteria->compare('nr5',$this->nr5);
		$criteria->compare('nr6',$this->nr6);
		$criteria->compare('nr7',$this->nr7);
		$criteria->compare('nr8',$this->nr8);
		$criteria->compare('nr9',$this->nr9);
		$criteria->compare('nr10',$this->nr10);
		$criteria->compare('nr11',$this->nr11);
		$criteria->compare('nr12',$this->nr12);
		$criteria->compare('nr13',$this->nr13);
		$criteria->compare('nr15',$this->nr15);
		$criteria->compare('nr16',$this->nr16);
		$criteria->compare('nr17',$this->nr17);
		$criteria->compare('nr18',$this->nr18);
		$criteria->compare('nr19',$this->nr19);
		$criteria->compare('nr20',$this->nr20);
		$criteria->compare('nr21',$this->nr21,true);
		$criteria->compare('nr22',$this->nr22);
		$criteria->compare('nr23',$this->nr23);
		$criteria->compare('nr24',$this->nr24,true);
		$criteria->compare('nr25',$this->nr25);
		$criteria->compare('nr26',$this->nr26);
		$criteria->compare('nr27',$this->nr27);
		$criteria->compare('nr28',$this->nr28);
		$criteria->compare('nr29',$this->nr29);
		$criteria->compare('nr31',$this->nr31);
		$criteria->compare('nr32',$this->nr32);
		$criteria->compare('nr33',$this->nr33,true);
		$criteria->compare('nr34',$this->nr34);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Nr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
