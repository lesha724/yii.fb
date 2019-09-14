<?php

/**
 * This is the model class for table "stppart".
 *
 * The followings are the available columns in table 'stppart':
 * @property integer $stppart1
 * @property integer $stppart2
 * @property integer $stppart3
 * @property string $stppart4
 * @property integer $stppart5
 * @property integer $stppart6
 * @property integer $stppart7
 * @property integer $stppart8
 * @property integer $stppart9
 * @property integer $stppart10
 * @property string $stppart11
 * @property integer $stppart12
 * @property string $stppart13
 *
 * The followings are the available model relations:
 * @property St $stppart20
 * @property Stpfile $stppart90
 * @property Users $stppart100
 * @property Users $stppart120
 */
class Stppart extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stppart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('stppart2, stppart3, stppart5, stppart6, stppart7, stppart8, stppart9, stppart10, stppart12', 'numerical', 'integerOnly'=>true),
			array('stppart4', 'length', 'max'=>200),
			array('stppart11, stppart13', 'length', 'max'=>20),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'stppart20' => array(self::BELONGS_TO, 'St', 'stppart2'),
			'stppart90' => array(self::BELONGS_TO, 'Stpfile', 'stppart9'),
			'stppart100' => array(self::BELONGS_TO, 'Users', 'stppart10'),
			'stppart120' => array(self::BELONGS_TO, 'Users', 'stppart12'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stppart1' => 'Stppart1',
			'stppart2' => tt('Студент'),
			'stppart3' => 'Вид заходу',
			'stppart4' => 'Назва заходу',
			'stppart5' => 'Навчальний рік',
			'stppart6' => 'Рівень',
			'stppart7' => 'Форма участі',
			'stppart8' => 'Результат',
			'stppart9' => 'Файл',
			'stppart10' => 'Stppart10',
			'stppart11' => 'Stppart11',
			'stppart12' => 'Stppart12',
			'stppart13' => 'Stppart13',
		);
	}


	public function search($st1)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('stppart2',$st1);

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
	 * @return Stppart the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
