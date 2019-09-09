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
 * @property integer $stportfolio7
 * @property string $stportfolio8
 *
 * The followings are the available model relations:
 * @property St $stportfolio20
 * @property Users $stportfolio40
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
			array('stportfolio1, stportfolio2, stportfolio4, stportfolio6, stportfolio7', 'numerical', 'integerOnly'=>true),
			array('stportfolio3', 'length', 'max'=>1400),
			array('stportfolio5, stportfolio8', 'length', 'max'=>20)
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
            'stportfolio70' => array(self::BELONGS_TO, 'Users', 'stportfolio7'),
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
        return parent::beforeSave();
    }

    /**
     * Список id полей
     * @return array
     */
    public function getFieldsIdList(){
        return array(
            self::FIELD_EXTRA_EDUCATION,
            self::FIELD_WORK_EXPERIENCE,
            self::FIELD_PHONE,
            self::FIELD_EMAIL,
            self::FIELD_EXTRA_COURSES,
            self::FIELD_OLIMPIADS,
            self::FIELD_SPORTS,
            self::FIELD_SCIENCES,
            self::FIELD_STUD_ORGS,
            self::FIELD_VOLONTER,
            self::FIELD_GROMADSKE
        );
    }

    /**
     * Список полей для заполнения
     * @return array
     */
    public function getFieldsList($st1){
        $values = $this->getFieldsByStudent($st1);
        return array(
            self::FIELD_EXTRA_EDUCATION => array(
                'code' => self::FIELD_EXTRA_EDUCATION,
                'text' => 'Дані про додаткову отриману освіту (музичну, мистецьку, спортивну школу, школу іноземних мов тощо)',
                'needFile' => false,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_EXTRA_EDUCATION]) ? $values[self::FIELD_EXTRA_EDUCATION]->stportfolio3 : ''
            ),
            self::FIELD_WORK_EXPERIENCE => array(
                'code' => self::FIELD_WORK_EXPERIENCE,
                'text' => 'Досвід роботи за спеціальністю (де і на якій посаді)',
                'needFile' => false,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_WORK_EXPERIENCE]) ? $values[self::FIELD_WORK_EXPERIENCE]->stportfolio3 : ''
            ),
            self::FIELD_PHONE => array(
                'code' => self::FIELD_PHONE,
                'text' => 'Контактний телефон',
                'needFile' => false,
                'inputType' => 'textField',
                'value' => isset($values[self::FIELD_PHONE]) ? $values[self::FIELD_PHONE]->stportfolio3 : ''
            ),
            self::FIELD_EMAIL => array(
                'code' => self::FIELD_EMAIL,
                'text' => 'Е-mail',
                'needFile' => false,
                'inputType' => 'textField',
                'value' => isset($values[self::FIELD_EMAIL]) ? $values[self::FIELD_EMAIL]->stportfolio3 : ''
            ),
            self::FIELD_EXTRA_COURSES => array(
                'code' => self::FIELD_EXTRA_COURSES,
                'text' => 'Курси, додаткова освіта: назва курсів, отриманий документ – назва (сертифікат, посвідчення тощо), дата, рівень',
                'needFile' => true,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_EXTRA_COURSES]) ? $values[self::FIELD_EXTRA_COURSES]->stportfolio3 : ''
            ),
            self::FIELD_OLIMPIADS => array(
                'code' => self::FIELD_OLIMPIADS,
                'text' => 'Олімпіади, конкурси за навчальними дисциплінами (навчальний рік, назва дисципліни, результат',
                'needFile' => true,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_OLIMPIADS]) ? $values[self::FIELD_OLIMPIADS]->stportfolio3 : ''
            ),
            self::FIELD_SPORTS => array(
                'code' => self::FIELD_SPORTS,
                'text' => 'Спортивні досягнення (навчальний рік, рівень змагань, вид спорту, результат)',
                'needFile' => true,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_SPORTS]) ? $values[self::FIELD_SPORTS]->stportfolio3 : ''
            ),
            self::FIELD_SCIENCES => array(
                'code' => self::FIELD_SCIENCES,
                'text' => 'Наукова діяльність (участь у науково-практичних конференціях, рівень, теми досліджень, статті чи тези, результат)',
                'needFile' => true,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_SCIENCES]) ? $values[self::FIELD_SCIENCES]->stportfolio3 : ''
            ),
            self::FIELD_STUD_ORGS => array(
                'code' => self::FIELD_STUD_ORGS,
                'text' => 'Участь у органах студентського самоврядування (назва, форма участі, доручення, які виконувалися)',
                'needFile' => false,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_STUD_ORGS]) ? $values[self::FIELD_STUD_ORGS]->stportfolio3 : ''
            ),
            self::FIELD_VOLONTER => array(
                'code' => self::FIELD_VOLONTER,
                'text' => 'Участь у волонтерській діяльності (назва заходу, форма участі)',
                'needFile' => true,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_VOLONTER]) ? $values[self::FIELD_VOLONTER]->stportfolio3 : ''
            ),
            self::FIELD_GROMADSKE => array(
                'code' => self::FIELD_GROMADSKE,
                'text' => 'Досягнення у творчій та громадській діяльності (назва заходу, форма участі)',
                'needFile' => false,
                'inputType' => 'textArea',
                'value' => isset($values[self::FIELD_GROMADSKE]) ? $values[self::FIELD_GROMADSKE]->stportfolio3 : ''
            )
        );
    }

    /**
     * Список значчений полей
     * @param $st1
     * @return Stportfolio[]
     */
    public function getFieldsByStudent($st1){
        $list = self::model()->findAllByAttributes(array(
            'stportfolio2' => $st1
        ));

        $result = array();
        foreach ($list as $item){
            $result[$item->stportfolio1] = $item;
        }

        return $result;
    }
}
