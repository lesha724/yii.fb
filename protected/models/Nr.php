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
