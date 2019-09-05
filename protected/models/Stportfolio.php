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

    const FIELD_WORK_EXPERIENCE = 2;

    const FIELD_PHONE = 3;

    const FIELD_EMAIL = 4;

    const FIELD_EXTRA_COURSES = 5;

    const FIELD_OLIMPIADS = 6;

    const FIELD_SPORTS = 7;

    const FIELD_SCIENCES = 8;

    const FIELD_STUD_ORGS = 9;

    const FIELD_VOLONTER = 10;

    const FIELD_GROMADSKE = 11;

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

    /**
     * Список полей для заполнения
     * @return array
     */
    public function getFieldsList(){
        return array(
            self::FIELD_EXTRA_EDUCATION => array(
                'text' => 'Дані про додаткову отриману освіту (музичну, мистецьку, спортивну школу, школу іноземних мов тощо)',
                'needFile' => false
            ),
            self::FIELD_WORK_EXPERIENCE => array(
                'text' => 'Досвід роботи за спеціальністю (де і на якій посаді)',
                'needFile' => false
            ),
            self::FIELD_PHONE => array(
                'text' => 'Контактний телефон',
                'needFile' => false
            ),
            self::FIELD_EMAIL => array(
                'text' => 'Е-mail',
                'needFile' => false
            ),
            self::FIELD_EXTRA_COURSES => array(
                'text' => 'Курси, додаткова освіта: назва курсів, отриманий документ – назва (сертифікат, посвідчення тощо), дата, рівень',
                'needFile' => true
            )
        );
    }
}
