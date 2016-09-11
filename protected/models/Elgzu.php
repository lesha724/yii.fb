<?php

/**
 * This is the model class for table "elgzu".
 *
 * The followings are the available columns in table 'elgzu':
 * @property integer $elgzu1
 * @property integer $elgzu2
 * @property integer $elgzu3
 * @property integer $elgzu4
 * @property string $elgzu5
 * @property integer $elgzu6
 *
 * The followings are the available model relations:
 * @property Gr $elgzu20
 * @property Elgz $elgzu30
 * @property Ustem $elgzu40
 */
class Elgzu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elgzu';
	}

	public $r1;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elgzu1', 'required'),
			array('elgzu1, elgzu2, elgzu3, elgzu4, elgzu6', 'numerical', 'integerOnly'=>true),
			array('elgzu5', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('elgzu1, elgzu2, elgzu3, elgzu4, elgzu5, elgzu6', 'safe', 'on'=>'search'),
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
			'elgzu20' => array(self::BELONGS_TO, 'Gr', 'elgzu2'),
			'elgzu30' => array(self::BELONGS_TO, 'Elgz', 'elgzu3'),
			'elgzu40' => array(self::BELONGS_TO, 'Ustem', 'elgzu4'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'elgzu1' => 'Elgzu1',
			'elgzu2' => 'Elgzu2',
			'elgzu3' => 'Elgzu3',
			'elgzu4' => 'Elgzu4',
			'elgzu5' => 'Elgzu5',
			'elgzu6' => 'Elgzu6',
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

		$criteria->compare('elgzu1',$this->elgzu1);
		$criteria->compare('elgzu2',$this->elgzu2);
		$criteria->compare('elgzu3',$this->elgzu3);
		$criteria->compare('elgzu4',$this->elgzu4);
		$criteria->compare('elgzu5',$this->elgzu5,true);
		$criteria->compare('elgzu6',$this->elgzu6);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elgzu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
