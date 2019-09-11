<?php

/**
 * This is the model class for table "stpwork".
 *
 * The followings are the available columns in table 'stpwork':
 * @property integer $stpwork1
 * @property integer $stpwork2
 * @property string $stpwork3
 * @property string $stpwork4
 * @property string $stpwork5
 * @property string $stpwork6
 * @property integer $stpwork7
 * @property string $stpwork8
 *
 * The followings are the available model relations:
 * @property St $stpwork20
 * @property Users $stpwork70
 */
class Stpwork extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stpwork';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
		    array('stpwork3, stpwork4, stpwork5, stpwork6', 'required'),
			array('stpwork2, stpwork7', 'numerical', 'integerOnly'=>true),
			array('stpwork3, stpwork4, stpwork5, stpwork6', 'length', 'max'=>200),
			array('stpwork8', 'length', 'max'=>20),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'stpwork20' => array(self::BELONGS_TO, 'St', 'stpwork2'),
			'stpwork70' => array(self::BELONGS_TO, 'Users', 'stpwork7'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stpwork1' => '#',
			'stpwork2' => tt('Студент'),
			'stpwork3' => 'Назва професійних модулів',
			'stpwork4' => 'Місце проходження практики, терміни проходження практики',
			'stpwork5' => 'Посада',
			'stpwork6' => 'Оцінка',
			'stpwork7' => 'Пользователь',
			'stpwork8' => 'Дата',
		);
	}

	/**
	 * @param $st1 int
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($st1)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('stpwork2',$st1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => false,
            'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stpwork the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
