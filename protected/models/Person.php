<?php

/**
 * This is the model class for table "pe".
 *
 * The followings are the available columns in table 'pe':
 * @property integer $pe1
 * @property string $pe2
 * @property string $pe3
 * @property string $pe4
 * @property string $pe5
 * @property string $pe6
 * @property string $pe7
 * @property integer $pe8
 * @property string $pe9
 * @property string $pe10
 * @property string $pe11
 * @property integer $pe12
 * @property string $pe20
 * @property integer $pe21
 * @property string $pe22
 * @property string $pe23
 * @property string $pe24
 * @property string $pe25
 * @property integer $pe30
 * @property string $pe31
 * @property integer $pe32
 * @property integer $pe33
 * @property string $pe34
 * @property string $pe35
 * @property string $pe36
 * @property string $pe37
 * @property integer $pe50
 * @property string $pe51
 * @property string $pe52
 * @property string $pe53
 * @property integer $pe54
 * @property integer $pe59
 * @property string $pe60
 * @property string $pe61
 * @property string $pe62
 * @property string $pe63
 * @property integer $pe64
 *
 * @property string $pe65
 * @property string $pe66
 * @property string $pe67
 *
 * @property string $fullName
 * @property string $shortName
 *
 *
 * The followings are the available model relations:
 * @property St[] $sts
 * @property Pefio[] $pefios
 * @property Peadr[] $peadrs
 * @property Pesem[] $pesems
 * @property Voen $pe540
 * @property Sgr $pe300
 * @property I $pe320
 *
 *  * From ShortNameBehaviour:
 * @method string getShortName() Returns default truncated name.
 * @method string getFullName() Returns name.
 */
class Person extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pe';
	}

    /**
     * @return array
     */
    public function behaviors()
    {
        return array(
            'shortNameBehaviour' => array(
                'class'      => 'ShortNameBehaviour',
                'surname'    => 'pe2',
                'name'       => 'pe3',
                'patronymic' => 'pe4',
            )
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pe1, pe8, pe12, pe21, pe30, pe32, pe33, pe50, pe54, pe59, pe64', 'numerical', 'integerOnly'=>true),
			array('pe2, pe4, pe5', 'length', 'max'=>140),
            array('pe67', 'length', 'max'=>150),
            array('pe66', 'length', 'max'=>15),
            array('pe65', 'length', 'max'=>20),
			array('pe3, pe34, pe35, pe36, pe37', 'length', 'max'=>200),
			array('pe6, pe7', 'length', 'max'=>80),
			array('pe9, pe25, pe31, pe51, pe52, pe60, pe61', 'length', 'max'=>20),
			array('pe10, pe11', 'length', 'max'=>300),
			array('pe20, pe63', 'length', 'max'=>60),
			array('pe22', 'length', 'max'=>40),
			array('pe23', 'length', 'max'=>100),
			array('pe24', 'length', 'max'=>600),
			array('pe53', 'length', 'max'=>400),
			array('pe62', 'length', 'max'=>4)
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
			'sts' => array(self::HAS_MANY, 'St', 'st200'),
			'pefios' => array(self::HAS_MANY, 'Pefio', 'pefio1'),
			'peadrs' => array(self::HAS_MANY, 'Peadr', 'peadr1'),
			'pesems' => array(self::HAS_MANY, 'Pesem', 'pesem1'),
			'pe540' => array(self::BELONGS_TO, 'Voen', 'pe54'),
			'pe300' => array(self::BELONGS_TO, 'Sgr', 'pe30'),
			'pe320' => array(self::BELONGS_TO, 'I', 'pe32'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pe65' => tt('Дата флюрографии'),
			'pe66' => tt('№ флюрографии'),
			'pe67' => tt('Место прохождения флюрографии'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Person the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
