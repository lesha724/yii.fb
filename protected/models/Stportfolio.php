<?php

/**
 * This is the model class for table "stportfolio".
 *
 * The followings are the available columns in table 'stportfolio':
 * @property integer $stportfolio1
 * @property integer $stportfolio2
 * @property string $stportfolio3
 * @property integer $stportfolio4
 * @property string $stportfolio5
 * @property integer $stportfolio6
 *
 * The followings are the available model relations:
 * @property St $stportfolio20
 * @property Users $stportfolio40
 * @property Stpfile $stportfolio60
 */
class Stportfolio extends CActiveRecord
{

    const FIELD_EXTRA_EDUCATION = 1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stportfolio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stportfolio1, stportfolio2, stportfolio4, stportfolio6', 'numerical', 'integerOnly'=>true),
			array('stportfolio3', 'length', 'max'=>1400),
			array('stportfolio5', 'length', 'max'=>20)
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
			'stportfolio20' => array(self::BELONGS_TO, 'St', 'stportfolio2'),
			'stportfolio40' => array(self::BELONGS_TO, 'Users', 'stportfolio4'),
			'stportfolio60' => array(self::BELONGS_TO, 'Stpfile', 'stportfolio6'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stportfolio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $this->stportfolio4 = Yii::app()->user->id;
        $this->stportfolio5 = date('Y-m-d H:i:s');

        return parent::beforeSave();
    }
}
