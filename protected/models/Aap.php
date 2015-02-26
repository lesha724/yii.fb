<?php

/**
 * This is the model class for table "aap".
 *
 * The followings are the available columns in table 'aap':
 * @property integer $aap1
 * @property string $aap2
 * @property string $aap3
 * @property string $aap4
 * @property string $aap5
 * @property string $aap6
 * @property integer $aap7
 * @property integer $aap8
 * @property integer $aap9
 * @property integer $aap10
 * @property string $aap11
 * @property string $aap12
 * @property string $aap13
 * @property integer $aap14
 * @property integer $aap15
 * @property integer $aap16
 * @property string $aap17
 * @property integer $aap18
 * @property string $aap19
 * @property string $aap20
 * @property string $aap21
 * @property string $aap22
 * @property integer $aap23
 * @property string $aap24
 * @property string $aap25
 * @property string $aap26
 * @property string $aap27
 * @property integer $aap28
 * @property string $aap29
 * @property string $aap30
 * @property string $aap31
 * @property string $aap32
 * @property integer $aap33
 * @property integer $aap34
 * @property integer $aap35
 * @property string $aap36
 * @property string $aap37
 * @property string $aap38
 * @property string $aap39
 * @property string $aap40
 * @property integer $aap41
 * @property string $aap42
 * @property integer $aap43
 * @property integer $aap44
 * @property integer $aap45
 * @property string $aap46
 * @property integer $aap47
 * @property string $aap48
 * @property string $aap49
 * @property integer $aap50
 * @property integer $aap51
 * @property integer $aap52
 * @property string $aap53
 * @property integer $aap54
 * @property integer $aap55
 * @property double $aap56
 * @property integer $aap57
 * @property integer $aap58
 * @property integer $aap59
 * @property string $aap60
 * @property string $aap61
 * @property integer $aap62
 * @property string $aap63
 * @property string $aap64
 * @property integer $aap65
 * @property integer $aap66
 * @property string $aap67
 * @property string $aap68
 * @property string $aap69
 * @property string $aap70
 * @property string $aap71
 * @property string $aap72
 * @property string $aap73
 * @property integer $aap74
 * @property string $aap75
 * @property integer $aap76
 * @property string $aap77
 * @property integer $aap78
 * @property string $aap79
 * @property string $aap80
 * @property string $aap81
 * @property string $aap82
 * @property integer $aap83
 * @property string $aap84
 * @property string $aap85
 * @property string $aap86
 * @property string $aap87
 * @property string $aap88
 * @property string $aap89
 * @property string $aap90
 * @property string $aap91
 * @property string $aap92
 * @property string $aap93
 * @property string $aap94
 * @property string $aap95
 * @property string $aap96
 * @property string $aap97
 * @property string $aap98
 * @property string $aap99
 * @property string $aap100
 * @property string $aap101
 * @property string $aap102
 * @property string $aap103
 * @property string $aap104
 * @property string $aap105
 * @property string $aap106
 * @property string $aap107
 * @property integer $aap108
 * @property string $aap109
 * @property string $aap110
 * @property string $aap111
 * @property integer $aap113
 */
class Aap extends CActiveRecord
{
    public $country1;
    public $region1;
    public $country2;
    public $region2;
    public $country3;
    public $region3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aap';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aap1', 'required'),
            array('aap2', 'length', 'max'=>35),
            array('aap3, aap4', 'length', 'max'=>20),
            array('aap5, aap19, aap22, aap29, aap24, aap13', 'length', 'max'=>10),
            array('aap6, aap21, aap30, aap25, aap38', 'length', 'max'=>100),
            array('aap7, aap43, aap15, aap57, aap16, aap34, aap44, aap45,
                   aap47, aap62, aap35, aap33, aap50, aap8, aap20, aap28,
                   aap23,aap9, aap55, aap54, aap10, aap58
                   country1, region1,
                   country2, region2,
                   country3, region3,
                   ', 'numerical'),
            array('aap49, aap14', 'length', 'max'=>4),
            array('aap20, aap31, aap26, aap12', 'length', 'max'=>15),
            array('aap37, aap32, aap36, aap27, aap61', 'length', 'max'=>50),
            array('aap11', 'length', 'max'=>5),

			array('aap8, aap17, aap18, aap22, aap39, aap40, aap41, aap42,  aap46, aap48, aap51, aap52, aap53, aap56, aap59, aap60, aap63, aap64, aap65, aap66, aap67, aap68, aap69, aap70, aap71, aap72, aap73, aap74, aap75, aap76, aap77, aap78, aap79, aap80, aap81, aap82, aap83, aap84, aap85, aap86, aap87, aap88, aap89, aap90, aap91, aap92, aap93, aap94, aap95, aap96, aap97, aap98, aap99, aap100, aap101, aap102, aap103, aap104, aap105, aap106, aap107, aap108, aap109, aap110, aap111, aap113', 'safe'),
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
			'aap1' => 'Aap1',
			'aap2' => tt('Фамилия'),
			'aap3' => tt('Имя'),
			'aap4' => tt('Отчество'),
			'aap5' => tt('Дата рождения'),
			'aap6' => tt('Место жительства'),
			'aap7' => tt('Пол'),
			'aap8' => tt('Гражданство'),
			'aap9' => tt('Документ об образовании'),
			'aap10' => tt('Отличие в учебе'),
			'aap11' => tt('Серия'),
			'aap12' => tt('Номер'),
			'aap13' => tt('Дата выдачи'),
			'aap14' => tt('Год окончания учебного заведения'),
			'aap15' => tt('Форма обучения'),
			'aap16' => tt('Специальность'),
			'aap17' => 'Aap17',
			'aap18' => tt('Документ, подтверждающий личность'),
			'aap19' => tt('Серия'),
			'aap20' => tt('Номер'),
			'aap21' => tt('Кем выдан'),
			'aap22' => tt('Дата выдачи'),
			'aap23' => tt('Город/поселок/село/хутор/другое'),
			'aap24' => tt('Индекс'),
			'aap25' => tt('Улица'),
			'aap26' => tt('Дом/кв'),
			'aap27' => tt('Телефон(дом./мобильн.)'),
			'aap28' => tt('Город/поселок/село/хутор/другое'),
			'aap29' => tt('Индекс'),
			'aap30' => tt('Улица'),
			'aap31' => tt('Дом/кв'),
			'aap32' => tt('Телефон(дом./мобильн.)'),
			'aap33' => tt('Общежитие'),
			'aap34' => tt('Тип обучения'),
			'aap35' => tt('Иностранный язык'),
			'aap36' => tt('Название города'),
			'aap37' => tt('Название города'),
			'aap38' => tt('Название учебного заведения'),
			'aap39' => 'Aap39',
			'aap40' => 'Aap40',
			'aap41' => 'Aap41',
			'aap42' => 'Aap42',
			'aap43' => tt('Семейное положение'),
			'aap44' => tt('Целевик'),
			'aap45' => tt('Олимпиада'),
			'aap46' => 'Aap46',
			'aap47' => tt('Льготы'),
			'aap48' => 'Aap48',
			'aap49' => tt('Год обучения в агроклассах'),
			'aap50' => tt('Это Ваше первое ВПО'),
			'aap51' => 'Aap51',
			'aap52' => 'Aap52',
			'aap53' => 'Aap53',
			'aap54' => tt('Тип образовательного учебного заведения'),
			'aap55' => tt('Местонахождение учебного заведения'),
			'aap56' => 'Aap56',
			'aap57' => tt('Направление подготовки'),
			'aap58' => tt('Государственная аккредитация учебного заведения'),
			'aap59' => 'Aap59',
			'aap60' => 'Aap60',
			'aap61' => tt('Название города'),
			'aap62' => tt('Признак СПО'),
			'aap63' => 'Aap63',
			'aap64' => 'Aap64',
			'aap65' => 'Aap65',
			'aap66' => 'Aap66',
			'aap67' => 'Aap67',
			'aap68' => 'Aap68',
			'aap69' => 'Aap69',
			'aap70' => 'Aap70',
			'aap71' => 'Aap71',
			'aap72' => 'Aap72',
			'aap73' => 'Aap73',
			'aap74' => 'Aap74',
			'aap75' => 'Aap75',
			'aap76' => 'Aap76',
			'aap77' => 'Aap77',
			'aap78' => 'Aap78',
			'aap79' => 'Aap79',
			'aap80' => 'Aap80',
			'aap81' => 'Aap81',
			'aap82' => 'Aap82',
			'aap83' => 'Aap83',
			'aap84' => 'Aap84',
			'aap85' => 'Aap85',
			'aap86' => 'Aap86',
			'aap87' => 'Aap87',
			'aap88' => 'Aap88',
			'aap89' => 'Aap89',
			'aap90' => 'Aap90',
			'aap91' => 'Aap91',
			'aap92' => 'Aap92',
			'aap93' => 'Aap93',
			'aap94' => 'Aap94',
			'aap95' => 'Aap95',
			'aap96' => 'Aap96',
			'aap97' => 'Aap97',
			'aap98' => 'Aap98',
			'aap99' => 'Aap99',
			'aap100' => 'Aap100',
			'aap101' => 'Aap101',
			'aap102' => 'Aap102',
			'aap103' => 'Aap103',
			'aap104' => 'Aap104',
			'aap105' => 'Aap105',
			'aap106' => 'Aap106',
			'aap107' => 'Aap107',
			'aap108' => 'Aap108',
			'aap109' => 'Aap109',
			'aap110' => 'Aap110',
			'aap111' => 'Aap111',
			'aap113' => 'Aap113',
            'country1'=> tt('Страна'),
            'country2'=> tt('Страна'),
            'country3'=> tt('Страна'),
            'region1' => tt('Область/край/республика/другое'),
            'region2' => tt('Область/край/республика/другое'),
            'region3' => tt('Область/край/республика/другое'),
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

		$criteria->compare('aap1',$this->aap1);
		$criteria->compare('aap2',$this->aap2,true);
		$criteria->compare('aap3',$this->aap3,true);
		$criteria->compare('aap4',$this->aap4,true);
		$criteria->compare('aap5',$this->aap5,true);
		$criteria->compare('aap6',$this->aap6,true);
		$criteria->compare('aap7',$this->aap7);
		$criteria->compare('aap8',$this->aap8);
		$criteria->compare('aap9',$this->aap9);
		$criteria->compare('aap10',$this->aap10);
		$criteria->compare('aap11',$this->aap11,true);
		$criteria->compare('aap12',$this->aap12,true);
		$criteria->compare('aap13',$this->aap13,true);
		$criteria->compare('aap14',$this->aap14);
		$criteria->compare('aap15',$this->aap15);
		$criteria->compare('aap16',$this->aap16);
		$criteria->compare('aap17',$this->aap17,true);
		$criteria->compare('aap18',$this->aap18);
		$criteria->compare('aap19',$this->aap19,true);
		$criteria->compare('aap20',$this->aap20,true);
		$criteria->compare('aap21',$this->aap21,true);
		$criteria->compare('aap22',$this->aap22,true);
		$criteria->compare('aap23',$this->aap23);
		$criteria->compare('aap24',$this->aap24,true);
		$criteria->compare('aap25',$this->aap25,true);
		$criteria->compare('aap26',$this->aap26,true);
		$criteria->compare('aap27',$this->aap27,true);
		$criteria->compare('aap28',$this->aap28);
		$criteria->compare('aap29',$this->aap29,true);
		$criteria->compare('aap30',$this->aap30,true);
		$criteria->compare('aap31',$this->aap31,true);
		$criteria->compare('aap32',$this->aap32,true);
		$criteria->compare('aap33',$this->aap33);
		$criteria->compare('aap34',$this->aap34);
		$criteria->compare('aap35',$this->aap35);
		$criteria->compare('aap36',$this->aap36,true);
		$criteria->compare('aap37',$this->aap37,true);
		$criteria->compare('aap38',$this->aap38,true);
		$criteria->compare('aap39',$this->aap39,true);
		$criteria->compare('aap40',$this->aap40,true);
		$criteria->compare('aap41',$this->aap41);
		$criteria->compare('aap42',$this->aap42,true);
		$criteria->compare('aap43',$this->aap43);
		$criteria->compare('aap44',$this->aap44);
		$criteria->compare('aap45',$this->aap45);
		$criteria->compare('aap46',$this->aap46,true);
		$criteria->compare('aap47',$this->aap47);
		$criteria->compare('aap48',$this->aap48,true);
		$criteria->compare('aap49',$this->aap49,true);
		$criteria->compare('aap50',$this->aap50);
		$criteria->compare('aap51',$this->aap51);
		$criteria->compare('aap52',$this->aap52);
		$criteria->compare('aap53',$this->aap53,true);
		$criteria->compare('aap54',$this->aap54);
		$criteria->compare('aap55',$this->aap55);
		$criteria->compare('aap56',$this->aap56);
		$criteria->compare('aap57',$this->aap57);
		$criteria->compare('aap58',$this->aap58);
		$criteria->compare('aap59',$this->aap59);
		$criteria->compare('aap60',$this->aap60,true);
		$criteria->compare('aap61',$this->aap61,true);
		$criteria->compare('aap62',$this->aap62);
		$criteria->compare('aap63',$this->aap63,true);
		$criteria->compare('aap64',$this->aap64,true);
		$criteria->compare('aap65',$this->aap65);
		$criteria->compare('aap66',$this->aap66);
		$criteria->compare('aap67',$this->aap67,true);
		$criteria->compare('aap68',$this->aap68,true);
		$criteria->compare('aap69',$this->aap69,true);
		$criteria->compare('aap70',$this->aap70,true);
		$criteria->compare('aap71',$this->aap71,true);
		$criteria->compare('aap72',$this->aap72,true);
		$criteria->compare('aap73',$this->aap73,true);
		$criteria->compare('aap74',$this->aap74);
		$criteria->compare('aap75',$this->aap75,true);
		$criteria->compare('aap76',$this->aap76);
		$criteria->compare('aap77',$this->aap77,true);
		$criteria->compare('aap78',$this->aap78);
		$criteria->compare('aap79',$this->aap79,true);
		$criteria->compare('aap80',$this->aap80,true);
		$criteria->compare('aap81',$this->aap81,true);
		$criteria->compare('aap82',$this->aap82,true);
		$criteria->compare('aap83',$this->aap83);
		$criteria->compare('aap84',$this->aap84,true);
		$criteria->compare('aap85',$this->aap85,true);
		$criteria->compare('aap86',$this->aap86,true);
		$criteria->compare('aap87',$this->aap87,true);
		$criteria->compare('aap88',$this->aap88,true);
		$criteria->compare('aap89',$this->aap89,true);
		$criteria->compare('aap90',$this->aap90,true);
		$criteria->compare('aap91',$this->aap91,true);
		$criteria->compare('aap92',$this->aap92,true);
		$criteria->compare('aap93',$this->aap93,true);
		$criteria->compare('aap94',$this->aap94,true);
		$criteria->compare('aap95',$this->aap95,true);
		$criteria->compare('aap96',$this->aap96,true);
		$criteria->compare('aap97',$this->aap97,true);
		$criteria->compare('aap98',$this->aap98,true);
		$criteria->compare('aap99',$this->aap99,true);
		$criteria->compare('aap100',$this->aap100,true);
		$criteria->compare('aap101',$this->aap101,true);
		$criteria->compare('aap102',$this->aap102,true);
		$criteria->compare('aap103',$this->aap103,true);
		$criteria->compare('aap104',$this->aap104,true);
		$criteria->compare('aap105',$this->aap105,true);
		$criteria->compare('aap106',$this->aap106,true);
		$criteria->compare('aap107',$this->aap107,true);
		$criteria->compare('aap108',$this->aap108);
		$criteria->compare('aap109',$this->aap109,true);
		$criteria->compare('aap110',$this->aap110,true);
		$criteria->compare('aap111',$this->aap111,true);
		$criteria->compare('aap113',$this->aap113);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Aap the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getLastInsertId()
    {
        $sql = <<<'SQL'
          SELECT gen_ID(GEN_AAP, 0)
          FROM RDB$DATABASE
SQL;
        $id = Yii::app()->db->createCommand($sql)->queryScalar();

        return $id;
    }
}
