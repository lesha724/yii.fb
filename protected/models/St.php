<?php

/**
 * This is the model class for table "st".
 *
 * The followings are the available columns in table 'st':
 * @property integer $st1
 * @property string $st2
 * @property string $st3
 * @property string $st4
 * @property string $st5
 * @property string $st6
 * @property string $st7
 * @property string $st8
 * @property integer $st9
 * @property string $st10
 * @property string $st11
 * @property string $st12
 * @property string $st13
 * @property string $st14
 * @property string $st15
 * @property string $st16
 * @property string $st17
 * @property string $st18
 * @property string $st19
 * @property string $st20
 * @property string $st21
 * @property string $st22
 * @property string $st23
 * @property string $st24
 * @property string $st25
 * @property string $st28
 * @property integer $st29
 * @property string $st30
 * @property string $st31
 * @property integer $st32
 * @property integer $st33
 * @property integer $st34
 * @property integer $st35
 * @property string $st38
 * @property string $st39
 * @property string $st40
 * @property string $st41
 * @property string $st42
 * @property string $st43
 * @property string $st44
 * @property integer $st45
 * @property integer $st56
 * @property integer $st57
 * @property integer $st63
 * @property integer $st64
 * @property integer $st65
 * @property string $st66
 * @property string $st67
 * @property string $st68
 * @property string $st69
 * @property string $st70
 * @property integer $st71
 * @property string $st72
 * @property string $st73
 * @property string $st74
 * @property string $st75
 * @property string $st76
 * @property string $st77
 * @property integer $st78
 * @property integer $st101
 * @property string $st102
 * @property integer $st103
 * @property integer $st104
 * @property string $st105
 * @property string $st106
 * @property string $st107
 * @property string $st108
 * @property string $st109
 * @property string $st110
 * @property string $st111
 * @property string $st112
 * @property string $st113
 * @property integer $st114
 * @property integer $st115
 * @property integer $st116
 * @property string $st117
 * @property string $st118
 * @property string $st119
 * @property string $st120
 * @property string $st121
 * @property string $st122
 * @property string $st123
 * @property string $st124
 * @property string $st125
 * @property integer $st100
 * @property integer $st99
 * @property string $st126
 * @property string $st127
 * @property string $st128
 * @property string $st129
 * @property string $st130
 * @property string $st131
 * @property string $st132
 * @property integer $st133
 * @property string $st134
 * @property string $st135
 * @property string $st136
 * @property string $st137
 * @property string $st138
 * @property integer $st139
 * @property string $st140
 * @property string $st141
 * @property string $st142
 * @property string $st143
 * @property integer $st144
 * @property string $st145
 * @property string $st146
 * @property string $st147
 * @property string $st148
 *
 * From ShortNameBehaviour:
 * @method string getShortName() Returns default truncated name.
 *
 */
class St extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'st';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('st1', 'required'),
			array('st1, st9, st29, st32, st33, st34, st35, st45, st56, st57, st63, st64, st65, st71, st78, st101, st103, st104, st114, st115, st116, st100, st99, st133, st139, st144', 'numerical', 'integerOnly'=>true),
			array('st2, st28, st74, st117, st120, st123', 'length', 'max'=>140),
			array('st3, st4, st75, st76, st118, st119, st121, st122, st124, st125, st131, st132', 'length', 'max'=>80),
			array('st5, st12, st15, st38, st108, st135, st148', 'length', 'max'=>60),
			array('st6, st14, st16, st25, st66', 'length', 'max'=>4),
			array('st7, st20, st23, st24, st77, st143, st145, st146, st147', 'length', 'max'=>8),
			array('st8, st11, st31, st39, st42, st67, st107, st109, st110, st111, st112, st113, st127, st130', 'length', 'max'=>200),
			array('st10, st13, st19, st69, st134, st142', 'length', 'max'=>400),
			array('st17, st140', 'length', 'max'=>40),
			array('st18, st41, st44, st72, st73, st102, st105, st129, st141', 'length', 'max'=>100),
			array('st21', 'length', 'max'=>32),
			array('st22, st30, st136, st137, st138', 'length', 'max'=>20),
			array('st40, st43, st70, st128', 'length', 'max'=>300),
			array('st68', 'length', 'max'=>600),
			array('st106', 'length', 'max'=>180),
			array('st126', 'length', 'max'=>24),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('st1, st2, st3, st4, st5, st6, st7, st8, st9, st10, st11, st12, st13, st14, st15, st16, st17, st18, st19, st20, st21, st22, st23, st24, st25, st28, st29, st30, st31, st32, st33, st34, st35, st38, st39, st40, st41, st42, st43, st44, st45, st56, st57, st63, st64, st65, st66, st67, st68, st69, st70, st71, st72, st73, st74, st75, st76, st77, st78, st101, st102, st103, st104, st105, st106, st107, st108, st109, st110, st111, st112, st113, st114, st115, st116, st117, st118, st119, st120, st121, st122, st123, st124, st125, st100, st99, st126, st127, st128, st129, st130, st131, st132, st133, st134, st135, st136, st137, st138, st139, st140, st141, st142, st143, st144, st145, st146, st147, st148', 'safe', 'on'=>'search'),
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
            'account' => array(self::HAS_ONE, 'Users', 'u6', 'on' => 'u6=st1 AND u5=0'),
            'parentsAccount' => array(self::HAS_ONE, 'Users', 'u6', 'on' => 'u6=st1 AND u5=2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'st1' => 'St1',
			'st2' => tt('Фамилия'),
			'st3' => tt('Имя'),
			'st4' => tt('Отчество'),
			'st5' => 'St5',
			'st6' => 'St6',
			'st7' => 'St7',
			'st8' => 'St8',
			'st9' => 'St9',
			'st10' => 'St10',
			'st11' => 'St11',
			'st12' => 'St12',
			'st13' => 'St13',
			'st14' => 'St14',
			'st15' => 'St15',
			'st16' => 'St16',
			'st17' => 'St17',
			'st18' => 'St18',
			'st19' => 'St19',
			'st20' => 'St20',
			'st21' => 'St21',
			'st22' => 'St22',
			'st23' => 'St23',
			'st24' => 'St24',
			'st25' => 'St25',
			'st28' => 'St28',
			'st29' => 'St29',
			'st30' => 'St30',
			'st31' => 'St31',
			'st32' => 'St32',
			'st33' => 'St33',
			'st34' => 'St34',
			'st35' => 'St35',
			'st38' => 'St38',
			'st39' => 'St39',
			'st40' => 'St40',
			'st41' => 'St41',
			'st42' => 'St42',
			'st43' => 'St43',
			'st44' => 'St44',
			'st45' => 'St45',
			'st56' => 'St56',
			'st57' => 'St57',
			'st63' => 'St63',
			'st64' => 'St64',
			'st65' => 'St65',
			'st66' => 'St66',
			'st67' => 'St67',
			'st68' => 'St68',
			'st69' => 'St69',
			'st70' => 'St70',
			'st71' => 'St71',
			'st72' => 'St72',
			'st73' => 'St73',
			'st74' => 'St74',
			'st75' => 'St75',
			'st76' => 'St76',
			'st77' => 'St77',
			'st78' => 'St78',
			'st101' => 'St101',
			'st102' => 'St102',
			'st103' => 'St103',
			'st104' => 'St104',
			'st105' => 'St105',
			'st106' => 'St106',
			'st107' => 'St107',
			'st108' => 'St108',
			'st109' => 'St109',
			'st110' => 'St110',
			'st111' => 'St111',
			'st112' => 'St112',
			'st113' => 'St113',
			'st114' => 'St114',
			'st115' => 'St115',
			'st116' => 'St116',
			'st117' => 'St117',
			'st118' => 'St118',
			'st119' => 'St119',
			'st120' => 'St120',
			'st121' => 'St121',
			'st122' => 'St122',
			'st123' => 'St123',
			'st124' => 'St124',
			'st125' => 'St125',
			'st100' => 'St100',
			'st99' => 'St99',
			'st126' => 'St126',
			'st127' => 'St127',
			'st128' => 'St128',
			'st129' => 'St129',
			'st130' => 'St130',
			'st131' => 'St131',
			'st132' => 'St132',
			'st133' => 'St133',
			'st134' => 'St134',
			'st135' => 'St135',
			'st136' => 'St136',
			'st137' => 'St137',
			'st138' => 'St138',
			'st139' => 'St139',
			'st140' => 'St140',
			'st141' => 'St141',
			'st142' => 'St142',
			'st143' => 'St143',
			'st144' => 'St144',
			'st145' => 'St145',
			'st146' => 'St146',
			'st147' => 'St147',
			'st148' => 'St148',
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

		$criteria->compare('st1',$this->st1);
		$criteria->compare('st2',$this->st2,true);
		$criteria->compare('st3',$this->st3,true);
		$criteria->compare('st4',$this->st4,true);
		$criteria->compare('st5',$this->st5,true);
		$criteria->compare('st6',$this->st6,true);
		$criteria->compare('st7',$this->st7,true);
		$criteria->compare('st8',$this->st8,true);
		$criteria->compare('st9',$this->st9);
		$criteria->compare('st10',$this->st10,true);
		$criteria->compare('st11',$this->st11,true);
		$criteria->compare('st12',$this->st12,true);
		$criteria->compare('st13',$this->st13,true);
		$criteria->compare('st14',$this->st14,true);
		$criteria->compare('st15',$this->st15,true);
		$criteria->compare('st16',$this->st16,true);
		$criteria->compare('st17',$this->st17,true);
		$criteria->compare('st18',$this->st18,true);
		$criteria->compare('st19',$this->st19,true);
		$criteria->compare('st20',$this->st20,true);
		$criteria->compare('st21',$this->st21,true);
		$criteria->compare('st22',$this->st22,true);
		$criteria->compare('st23',$this->st23,true);
		$criteria->compare('st24',$this->st24,true);
		$criteria->compare('st25',$this->st25,true);
		$criteria->compare('st28',$this->st28,true);
		$criteria->compare('st29',$this->st29);
		$criteria->compare('st30',$this->st30,true);
		$criteria->compare('st31',$this->st31,true);
		$criteria->compare('st32',$this->st32);
		$criteria->compare('st33',$this->st33);
		$criteria->compare('st34',$this->st34);
		$criteria->compare('st35',$this->st35);
		$criteria->compare('st38',$this->st38,true);
		$criteria->compare('st39',$this->st39,true);
		$criteria->compare('st40',$this->st40,true);
		$criteria->compare('st41',$this->st41,true);
		$criteria->compare('st42',$this->st42,true);
		$criteria->compare('st43',$this->st43,true);
		$criteria->compare('st44',$this->st44,true);
		$criteria->compare('st45',$this->st45);
		$criteria->compare('st56',$this->st56);
		$criteria->compare('st57',$this->st57);
		$criteria->compare('st63',$this->st63);
		$criteria->compare('st64',$this->st64);
		$criteria->compare('st65',$this->st65);
		$criteria->compare('st66',$this->st66,true);
		$criteria->compare('st67',$this->st67,true);
		$criteria->compare('st68',$this->st68,true);
		$criteria->compare('st69',$this->st69,true);
		$criteria->compare('st70',$this->st70,true);
		$criteria->compare('st71',$this->st71);
		$criteria->compare('st72',$this->st72,true);
		$criteria->compare('st73',$this->st73,true);
		$criteria->compare('st74',$this->st74,true);
		$criteria->compare('st75',$this->st75,true);
		$criteria->compare('st76',$this->st76,true);
		$criteria->compare('st77',$this->st77,true);
		$criteria->compare('st78',$this->st78);
		$criteria->compare('st101',$this->st101);
		$criteria->compare('st102',$this->st102,true);
		$criteria->compare('st103',$this->st103);
		$criteria->compare('st104',$this->st104);
		$criteria->compare('st105',$this->st105,true);
		$criteria->compare('st106',$this->st106,true);
		$criteria->compare('st107',$this->st107,true);
		$criteria->compare('st108',$this->st108,true);
		$criteria->compare('st109',$this->st109,true);
		$criteria->compare('st110',$this->st110,true);
		$criteria->compare('st111',$this->st111,true);
		$criteria->compare('st112',$this->st112,true);
		$criteria->compare('st113',$this->st113,true);
		$criteria->compare('st114',$this->st114);
		$criteria->compare('st115',$this->st115);
		$criteria->compare('st116',$this->st116);
		$criteria->compare('st117',$this->st117,true);
		$criteria->compare('st118',$this->st118,true);
		$criteria->compare('st119',$this->st119,true);
		$criteria->compare('st120',$this->st120,true);
		$criteria->compare('st121',$this->st121,true);
		$criteria->compare('st122',$this->st122,true);
		$criteria->compare('st123',$this->st123,true);
		$criteria->compare('st124',$this->st124,true);
		$criteria->compare('st125',$this->st125,true);
		$criteria->compare('st100',$this->st100);
		$criteria->compare('st99',$this->st99);
		$criteria->compare('st126',$this->st126,true);
		$criteria->compare('st127',$this->st127,true);
		$criteria->compare('st128',$this->st128,true);
		$criteria->compare('st129',$this->st129,true);
		$criteria->compare('st130',$this->st130,true);
		$criteria->compare('st131',$this->st131,true);
		$criteria->compare('st132',$this->st132,true);
		$criteria->compare('st133',$this->st133);
		$criteria->compare('st134',$this->st134,true);
		$criteria->compare('st135',$this->st135,true);
		$criteria->compare('st136',$this->st136,true);
		$criteria->compare('st137',$this->st137,true);
		$criteria->compare('st138',$this->st138,true);
		$criteria->compare('st139',$this->st139);
		$criteria->compare('st140',$this->st140,true);
		$criteria->compare('st141',$this->st141,true);
		$criteria->compare('st142',$this->st142,true);
		$criteria->compare('st143',$this->st143,true);
		$criteria->compare('st144',$this->st144);
		$criteria->compare('st145',$this->st145,true);
		$criteria->compare('st146',$this->st146,true);
		$criteria->compare('st147',$this->st147,true);
		$criteria->compare('st148',$this->st148,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return St the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
            'ShortNameBehaviour' => array(
                'class'      => 'ShortNameBehaviour',
                'surname'    => 'st2',
                'name'       => 'st3',
                'patronymic' => 'st4',
            )
        );
    }

    public function getStudentsForAdmin()
    {
        $criteria=new CDbCriteria;

        $criteria->select = 'st2, st3, st4';

        $with = array(
            'account' => array(
                'select' => 'u2, u3, u4'
            )
        );

        $criteria->addCondition("st1 > 0");
        $criteria->addCondition("st2 <> ''");


        $criteria->addSearchCondition('st2', $this->st2);
        $criteria->addSearchCondition('st3', $this->st3);
        $criteria->addSearchCondition('st4', $this->st4);

        $criteria->addSearchCondition('account.u2', Yii::app()->request->getParam('login'));
        $criteria->addSearchCondition('account.u3', Yii::app()->request->getParam('password'));
        $criteria->addSearchCondition('account.u4', Yii::app()->request->getParam('email'));

        $criteria->with = $with;

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'st2',
                'attributes' => array(
                    'st2',
                    'st3',
                    'st4',
                    'account.u2',
                    'account.u3',
                    'account.u4',
                ),
            )
        ));
    }

    public function getParentsForAdmin()
    {
        $criteria=new CDbCriteria;

        $criteria->select = 'st2, st3, st4';

        $with = array(
            'parentsAccount' => array(
                'select' => 'u2, u3, u4'
            )
        );

        $criteria->addCondition("st1 > 0");
        $criteria->addCondition("st2 <> ''");


        $criteria->addSearchCondition('st2', $this->st2);
        $criteria->addSearchCondition('st3', $this->st3);
        $criteria->addSearchCondition('st4', $this->st4);

        $criteria->addSearchCondition('parentsAccount.u2', Yii::app()->request->getParam('login'));
        $criteria->addSearchCondition('parentsAccount.u3', Yii::app()->request->getParam('password'));
        $criteria->addSearchCondition('parentsAccount.u4', Yii::app()->request->getParam('email'));

        $criteria->with = $with;

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'st2',
                'attributes' => array(
                    'st2',
                    'st3',
                    'st4',
                    'parentsAccount.u2',
                    'parentsAccount.u3',
                    'parentsAccount.u4',
                ),
            )
        ));
    }

    public function getStudentsForJournal($gr1, $uo1)
    {
        $sql = <<<SQL
        select st1,st2,st3,st4
        from st
           inner join ucs on (st.st1 = ucs.ucs3)
           inner join ucg on (ucs.ucs2 = ucg.ucg1)
           inner join ucx on (ucg.ucg2 = ucx.ucx1)
           inner join uo on (ucx.ucx1 = uo.uo19)
        where ucg3=:GR1 and uo1=:UO1 and ucg4=0
        order by st2, st3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':UO1', $uo1);
        $students = $command->queryAll();

        return $students;
    }

    public function getStudentsOfGroup($gr1)
    {
        if (empty($gr1))
            return array();

        $date1 = date("d.m.Y", strtotime("+ 20 days"));
        $date2 = date('d.m.Y 00:00:00');

        $sql=<<<SQL
            SELECT ST1,ST2,ST3,ST4,sgr2, ST117, ST118, ST119, ST120, ST121, ST122, ST123, ST124,ST125,ST139
            FROM st
            INNER JOIN std on (st.st1 = std.std2)
            INNER JOIN sgr on (st.st32 = sgr.sgr1)
            WHERE st101<>7 and STD3=:GR1 and STD11 in (0,6,8) and STD4<='{$date1}' and (STD7 is null or STD7>'{$date2}')
            ORDER BY 2
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $students = $command->queryAll();

        foreach($students as $key => $student) {
            $students[$key]['name'] = SH::getShortName($student['st2'], $student['st3'], $student['st4']);
        }

        return $students;
    }

    public static function getTimeTable($st1, $date1, $date2)
    {
        $sql = <<<SQL
        SELECT *
        FROM RAST(:LANG, :ST1, :DATE_1, :DATE_2)
        ORDER BY r2,r3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':LANG', 1);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE_1', $date1);
        $command->bindValue(':DATE_2', $date2);
        $timeTable = $command->queryAll();

        if (empty($timeTable))
            return array();

        return $timeTable;
    }

    public function getStudentsAmountFor($gr1)
    {
       $sql = <<<SQL
            SELECT count(distinct st1)
            FROM st
            INNER JOIN ucs on (st.st1 = ucs.ucs3)
            INNER JOIN ucg on (ucs.ucs2 = ucg.ucg1)
            INNER JOIN gr on (ucg.ucg3 = gr.gr1)
            WHERE gr1 = :GR1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $amount = $command->queryScalar();

        return $amount;
    }
}
