<?php

/**
 * This is the model class for table "modgr".
 *
 * The followings are the available columns in table 'modgr':
 * @property integer $modgr1
 * @property integer $modgr2
 * @property integer $modgr3
 * @property integer $modgr4
 * @property integer $modgr5
 *
 * The followings are the available model relations:
 * @property Mod $modgr20
 * @property Gr $modgr30
 * @property Pd $modgr40
 * @property Pd $modgr50
 * @property St[] $sts
 */
class Modgr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'modgr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modgr1, modgr2, modgr3, modgr4, modgr5', 'numerical', 'integerOnly'=>true),
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
			'modgr20' => array(self::BELONGS_TO, 'Mod', 'modgr2'),
			'modgr30' => array(self::BELONGS_TO, 'Gr', 'modgr3'),
			'modgr40' => array(self::BELONGS_TO, 'Pd', 'modgr4'),
			'modgr50' => array(self::BELONGS_TO, 'Pd', 'modgr5'),
			'sts' => array(self::MANY_MANY, 'St', 'mods(mods1, mods2)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'modgr1' => 'Modgr1',
			'modgr2' => 'Modgr2',
			'modgr3' => 'Modgr3',
			'modgr4' => 'Modgr4',
			'modgr5' => 'Modgr5',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Modgr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
