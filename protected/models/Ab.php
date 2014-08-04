<?php

/**
 * This is the model class for table "ab".
 *
 * The followings are the available columns in table 'ab':
 * @property integer $ab1
 * @property string $ab2
 * @property string $ab3
 * @property string $ab4
 * @property integer $ab5
 * @property integer $ab6
 * @property string $ab7
 * @property string $ab8
 * @property integer $ab9
 * @property integer $ab10
 * @property integer $ab11
 * @property integer $ab12
 * @property string $ab20
 * @property integer $ab21
 * @property string $ab22
 * @property string $ab23
 * @property string $ab24
 * @property string $ab25
 * @property string $ab26
 * @property string $ab27
 * @property string $ab28
 * @property string $ab35
 * @property integer $ab36
 * @property string $ab37
 * @property string $ab38
 * @property string $ab39
 * @property string $ab40
 * @property string $ab45
 * @property string $ab46
 * @property string $ab47
 * @property string $ab48
 * @property string $ab49
 * @property string $ab50
 * @property string $ab51
 * @property string $ab52
 * @property integer $ab60
 * @property integer $ab61
 * @property integer $ab63
 * @property string $ab64
 * @property string $ab65
 * @property string $ab66
 * @property double $ab68
 * @property integer $ab69
 * @property integer $ab70
 * @property integer $ab71
 * @property double $ab72
 * @property double $ab74
 * @property integer $ab90
 * @property string $ab91
 * @property string $ab92
 * @property double $ab110
 * @property integer $ab111
 * @property integer $ab112
 * @property integer $ab113
 * @property integer $ab114
 * @property integer $ab115
 * @property string $ab116
 * @property integer $ab117
 * @property integer $ab130
 * @property integer $ab140
 * @property integer $ab141
 * @property integer $ab142
 * @property integer $ab143
 * @property integer $ab144
 * @property integer $ab145
 * @property integer $ab146
 * @property integer $ab147
 * @property integer $ab148
 * @property string $ab149
 * @property string $ab150
 * @property string $ab151
 * @property string $ab152
 * @property string $ab153
 * @property string $ab154
 * @property integer $ab155
 * @property integer $ab160
 * @property integer $ab62
 * @property integer $ab157
 * @property integer $ab95
 * @property integer $ab136
 * @property integer $ab158
 * @property integer $ab161
 * @property integer $ab162
 * @property integer $ab131
 * @property integer $ab163
 * @property integer $ab164
 * @property integer $ab165
 * @property integer $ab166
 * @property string $ab167
 * @property string $ab168
 * @property string $ab169
 * @property string $ab170
 * @property string $ab171
 * @property integer $ab172
 * @property string $ab173
 * @property string $ab174
 * @property string $ab175
 * @property string $ab176
 * @property string $ab177
 */
class Ab extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ab';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ab1', 'required'),
			array('ab1, ab5, ab6, ab9, ab10, ab11, ab12, ab21, ab36, ab60, ab61, ab63, ab69, ab70, ab71, ab90, ab111, ab112, ab113, ab114, ab115, ab117, ab130, ab140, ab141, ab142, ab143, ab144, ab145, ab146, ab147, ab148, ab155, ab160, ab62, ab157, ab95, ab136, ab158, ab161, ab162, ab131, ab163, ab164, ab165, ab166, ab172', 'numerical', 'integerOnly'=>true),
			array('ab68, ab72, ab74, ab110', 'numerical'),
			array('ab2, ab28', 'length', 'max'=>140),
			array('ab3, ab4, ab65', 'length', 'max'=>80),
			array('ab7, ab40, ab66, ab92, ab116, ab167, ab168, ab169, ab170, ab171', 'length', 'max'=>8),
			array('ab8, ab45, ab49', 'length', 'max'=>200),
			array('ab20, ab173', 'length', 'max'=>24),
			array('ab22', 'length', 'max'=>600),
			array('ab23', 'length', 'max'=>32),
			array('ab24, ab25, ab37, ab64, ab175, ab176, ab177', 'length', 'max'=>20),
			array('ab26, ab27, ab48, ab52', 'length', 'max'=>120),
			array('ab35', 'length', 'max'=>60),
			array('ab38, ab47, ab51', 'length', 'max'=>100),
			array('ab39, ab46, ab50, ab91, ab174', 'length', 'max'=>300),
			array('ab149, ab150, ab151, ab152, ab153, ab154', 'length', 'max'=>400),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ab1, ab2, ab3, ab4, ab5, ab6, ab7, ab8, ab9, ab10, ab11, ab12, ab20, ab21, ab22, ab23, ab24, ab25, ab26, ab27, ab28, ab35, ab36, ab37, ab38, ab39, ab40, ab45, ab46, ab47, ab48, ab49, ab50, ab51, ab52, ab60, ab61, ab63, ab64, ab65, ab66, ab68, ab69, ab70, ab71, ab72, ab74, ab90, ab91, ab92, ab110, ab111, ab112, ab113, ab114, ab115, ab116, ab117, ab130, ab140, ab141, ab142, ab143, ab144, ab145, ab146, ab147, ab148, ab149, ab150, ab151, ab152, ab153, ab154, ab155, ab160, ab62, ab157, ab95, ab136, ab158, ab161, ab162, ab131, ab163, ab164, ab165, ab166, ab167, ab168, ab169, ab170, ab171, ab172, ab173, ab174, ab175, ab176, ab177', 'safe', 'on'=>'search'),
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
			'ab1' => 'Ab1',
			'ab2' => 'Ab2',
			'ab3' => 'Ab3',
			'ab4' => 'Ab4',
			'ab5' => 'Ab5',
			'ab6' => 'Ab6',
			'ab7' => 'Ab7',
			'ab8' => 'Ab8',
			'ab9' => 'Ab9',
			'ab10' => 'Ab10',
			'ab11' => 'Ab11',
			'ab12' => 'Ab12',
			'ab20' => 'Ab20',
			'ab21' => 'Ab21',
			'ab22' => 'Ab22',
			'ab23' => 'Ab23',
			'ab24' => 'Ab24',
			'ab25' => 'Ab25',
			'ab26' => 'Ab26',
			'ab27' => 'Ab27',
			'ab28' => 'Ab28',
			'ab35' => 'Ab35',
			'ab36' => 'Ab36',
			'ab37' => 'Ab37',
			'ab38' => 'Ab38',
			'ab39' => 'Ab39',
			'ab40' => 'Ab40',
			'ab45' => 'Ab45',
			'ab46' => 'Ab46',
			'ab47' => 'Ab47',
			'ab48' => 'Ab48',
			'ab49' => 'Ab49',
			'ab50' => 'Ab50',
			'ab51' => 'Ab51',
			'ab52' => 'Ab52',
			'ab60' => 'Ab60',
			'ab61' => 'Ab61',
			'ab63' => 'Ab63',
			'ab64' => 'Ab64',
			'ab65' => 'Ab65',
			'ab66' => 'Ab66',
			'ab68' => 'Ab68',
			'ab69' => 'Ab69',
			'ab70' => 'Ab70',
			'ab71' => 'Ab71',
			'ab72' => 'Ab72',
			'ab74' => 'Ab74',
			'ab90' => 'Ab90',
			'ab91' => 'Ab91',
			'ab92' => 'Ab92',
			'ab110' => 'Ab110',
			'ab111' => 'Ab111',
			'ab112' => 'Ab112',
			'ab113' => 'Ab113',
			'ab114' => 'Ab114',
			'ab115' => 'Ab115',
			'ab116' => 'Ab116',
			'ab117' => 'Ab117',
			'ab130' => 'Ab130',
			'ab140' => 'Ab140',
			'ab141' => 'Ab141',
			'ab142' => 'Ab142',
			'ab143' => 'Ab143',
			'ab144' => 'Ab144',
			'ab145' => 'Ab145',
			'ab146' => 'Ab146',
			'ab147' => 'Ab147',
			'ab148' => 'Ab148',
			'ab149' => 'Ab149',
			'ab150' => 'Ab150',
			'ab151' => 'Ab151',
			'ab152' => 'Ab152',
			'ab153' => 'Ab153',
			'ab154' => 'Ab154',
			'ab155' => 'Ab155',
			'ab160' => 'Ab160',
			'ab62' => 'Ab62',
			'ab157' => 'Ab157',
			'ab95' => 'Ab95',
			'ab136' => 'Ab136',
			'ab158' => 'Ab158',
			'ab161' => 'Ab161',
			'ab162' => 'Ab162',
			'ab131' => 'Ab131',
			'ab163' => 'Ab163',
			'ab164' => 'Ab164',
			'ab165' => 'Ab165',
			'ab166' => 'Ab166',
			'ab167' => 'Ab167',
			'ab168' => 'Ab168',
			'ab169' => 'Ab169',
			'ab170' => 'Ab170',
			'ab171' => 'Ab171',
			'ab172' => 'Ab172',
			'ab173' => 'Ab173',
			'ab174' => 'Ab174',
			'ab175' => 'Ab175',
			'ab176' => 'Ab176',
			'ab177' => 'Ab177',
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

		$criteria->compare('ab1',$this->ab1);
		$criteria->compare('ab2',$this->ab2,true);
		$criteria->compare('ab3',$this->ab3,true);
		$criteria->compare('ab4',$this->ab4,true);
		$criteria->compare('ab5',$this->ab5);
		$criteria->compare('ab6',$this->ab6);
		$criteria->compare('ab7',$this->ab7,true);
		$criteria->compare('ab8',$this->ab8,true);
		$criteria->compare('ab9',$this->ab9);
		$criteria->compare('ab10',$this->ab10);
		$criteria->compare('ab11',$this->ab11);
		$criteria->compare('ab12',$this->ab12);
		$criteria->compare('ab20',$this->ab20,true);
		$criteria->compare('ab21',$this->ab21);
		$criteria->compare('ab22',$this->ab22,true);
		$criteria->compare('ab23',$this->ab23,true);
		$criteria->compare('ab24',$this->ab24,true);
		$criteria->compare('ab25',$this->ab25,true);
		$criteria->compare('ab26',$this->ab26,true);
		$criteria->compare('ab27',$this->ab27,true);
		$criteria->compare('ab28',$this->ab28,true);
		$criteria->compare('ab35',$this->ab35,true);
		$criteria->compare('ab36',$this->ab36);
		$criteria->compare('ab37',$this->ab37,true);
		$criteria->compare('ab38',$this->ab38,true);
		$criteria->compare('ab39',$this->ab39,true);
		$criteria->compare('ab40',$this->ab40,true);
		$criteria->compare('ab45',$this->ab45,true);
		$criteria->compare('ab46',$this->ab46,true);
		$criteria->compare('ab47',$this->ab47,true);
		$criteria->compare('ab48',$this->ab48,true);
		$criteria->compare('ab49',$this->ab49,true);
		$criteria->compare('ab50',$this->ab50,true);
		$criteria->compare('ab51',$this->ab51,true);
		$criteria->compare('ab52',$this->ab52,true);
		$criteria->compare('ab60',$this->ab60);
		$criteria->compare('ab61',$this->ab61);
		$criteria->compare('ab63',$this->ab63);
		$criteria->compare('ab64',$this->ab64,true);
		$criteria->compare('ab65',$this->ab65,true);
		$criteria->compare('ab66',$this->ab66,true);
		$criteria->compare('ab68',$this->ab68);
		$criteria->compare('ab69',$this->ab69);
		$criteria->compare('ab70',$this->ab70);
		$criteria->compare('ab71',$this->ab71);
		$criteria->compare('ab72',$this->ab72);
		$criteria->compare('ab74',$this->ab74);
		$criteria->compare('ab90',$this->ab90);
		$criteria->compare('ab91',$this->ab91,true);
		$criteria->compare('ab92',$this->ab92,true);
		$criteria->compare('ab110',$this->ab110);
		$criteria->compare('ab111',$this->ab111);
		$criteria->compare('ab112',$this->ab112);
		$criteria->compare('ab113',$this->ab113);
		$criteria->compare('ab114',$this->ab114);
		$criteria->compare('ab115',$this->ab115);
		$criteria->compare('ab116',$this->ab116,true);
		$criteria->compare('ab117',$this->ab117);
		$criteria->compare('ab130',$this->ab130);
		$criteria->compare('ab140',$this->ab140);
		$criteria->compare('ab141',$this->ab141);
		$criteria->compare('ab142',$this->ab142);
		$criteria->compare('ab143',$this->ab143);
		$criteria->compare('ab144',$this->ab144);
		$criteria->compare('ab145',$this->ab145);
		$criteria->compare('ab146',$this->ab146);
		$criteria->compare('ab147',$this->ab147);
		$criteria->compare('ab148',$this->ab148);
		$criteria->compare('ab149',$this->ab149,true);
		$criteria->compare('ab150',$this->ab150,true);
		$criteria->compare('ab151',$this->ab151,true);
		$criteria->compare('ab152',$this->ab152,true);
		$criteria->compare('ab153',$this->ab153,true);
		$criteria->compare('ab154',$this->ab154,true);
		$criteria->compare('ab155',$this->ab155);
		$criteria->compare('ab160',$this->ab160);
		$criteria->compare('ab62',$this->ab62);
		$criteria->compare('ab157',$this->ab157);
		$criteria->compare('ab95',$this->ab95);
		$criteria->compare('ab136',$this->ab136);
		$criteria->compare('ab158',$this->ab158);
		$criteria->compare('ab161',$this->ab161);
		$criteria->compare('ab162',$this->ab162);
		$criteria->compare('ab131',$this->ab131);
		$criteria->compare('ab163',$this->ab163);
		$criteria->compare('ab164',$this->ab164);
		$criteria->compare('ab165',$this->ab165);
		$criteria->compare('ab166',$this->ab166);
		$criteria->compare('ab167',$this->ab167,true);
		$criteria->compare('ab168',$this->ab168,true);
		$criteria->compare('ab169',$this->ab169,true);
		$criteria->compare('ab170',$this->ab170,true);
		$criteria->compare('ab171',$this->ab171,true);
		$criteria->compare('ab172',$this->ab172);
		$criteria->compare('ab173',$this->ab173,true);
		$criteria->compare('ab174',$this->ab174,true);
		$criteria->compare('ab175',$this->ab175,true);
		$criteria->compare('ab176',$this->ab176,true);
		$criteria->compare('ab177',$this->ab177,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ab the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getStudents(FilterForm $model, $study_type, $condition)
    {
        $extra = array();

        $mp33 = Mp::model()->findByPk(33)->getAttribute('mp2');
        $mp32 = Mp::model()->findByPk(32)->getAttribute('mp2');

        if ($mp33 == 0)
            return array();	// don't show
        elseif (in_array($mp33, array(1,2,3,4))){
            // текущий прием + 1-3 заходы рекомендованных
            if ($mp33 != 1)
                $extra[] = 'abd'.(22+$mp33).' = 1';
        } else {
            // зачисленные
            $extra[] = 'ABD52 > 0';
        }

        $extraOrder = null;
        $from = <<<SQL
                FROM spab
                INNER JOIN abd ON (spab.spab1 = abd.abd3)
                INNER JOIN ab ON (abd.abd2 = ab.ab1)
SQL;

        // проверяем наличие профильного предмета
        $profileSubjectExists = Sekap::model()->checkIfProfileSubjectExistsFor($model->speciality);
        if ($profileSubjectExists) {
            $from .= ' INNER JOIN ae ON (abd1=ae2 AND ae3='.$profileSubjectExists.')';
            $extraOrder = 'ae4 DESC, ';
        }

        // чтобы без указания доп признака выводились все в том числе и те у кого он есть
        if ($model->adp1 != 0)
            $extra[] = 'abd4 = '.$model->adp1;

        $extra[] = 'ABD7 = '.$study_type;

        $extra[] = $condition;

        $extras = implode($extra, ' AND ');

        $sql = <<<SQL
              SELECT ab1,ab2,ab3,ab4,abd20,abd33,abd28,abd29,abd23,
                     abd66,abd54,abd1,abd9,abd24,abd25,abd26,abd27,abd52
              {$from}
              WHERE spab4 = :SEL_1 AND spab5 = :SEL_2 AND spab6 = :SEL_3 AND
                    spab1 = :SEL_6 AND spab2 = :YEAR_1 AND
                    ab1>0 AND abd12 is null AND
                    {$extras}
		      ORDER BY abd20 DESC, {$extraOrder} abd28 DESC, ab2
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SEL_1', $model->sel_1);
        $command->bindValue(':SEL_2', $model->sel_2);
        $command->bindValue(':SEL_3', $model->course);
        $command->bindValue(':SEL_6', $model->speciality);
        $command->bindValue(':YEAR_1',  $model->currentYear);


        $students = $command->queryAll();

        foreach ($students as $key => $st) {

            list($notice, $color) = $this->getNotice($st, $mp32);

            $students[$key] = array_merge($st, array('notice' => $notice, 'color' => $color));
        }

        $sortByStatus = Yii::app()->request->getParam('sortByStatus', null);
        if ($sortByStatus)
            usort($students, array($this, 'sortByStatus'));

        return $students;
    }

    private function getNotice($st, $mp2)
    {
        $notice = $color = '';

        if($st['abd52'] > 0 && $st['abd27'] == 1)
        {
            $notice = tt("Зачислен");
            $color = '#b8cbea';
        }
        elseif($st['abd27'] == 1 && $mp2 == 3)
        {
            $notice = tt("Рекомендован");
            $color = '#00ff00';
        }
        elseif($st['abd26'] == 1 && $mp2 == 2)
        {
            $notice = tt("Рекомендован");
            $color = '#00ff00';
        }
        elseif($st['abd25'] == 1 && $mp2 == 1)
        {
            $notice = tt("Рекомендован");
            $color = '#00ff00';
        }
        elseif($st['abd24'] == 1 && $mp2 == 0)
        {
            $notice = tt("Рекомендован");
            $color = '#00ff00';
        }

        else {

            if($st['abd26'] == 0 && $st['abd25'] == 0 && $st['abd24'] == 0 && $st['abd27'] == 0)
            {
                $notice =  tt("Резерв");
                $color = '';
            }
            elseif($st['abd26'] == 1)
            {
                $notice =  tt("Рекомендован в 3 волне");
                $color = '#99ff99';
            }
            elseif($st['abd25'] == 1)
            {
                $notice =  tt("Рекомендован во 2 волне");
                $color = '#99ff99';
            }
            elseif($st['abd24'] == 1)
            {
                $notice =  tt("Рекомендован в 1 волне");
                $color = '#99ff99';
            }
        }


        return array($notice, $color);
    }

    private function sortByStatus($a, $b)
    {
        // students with some status have to be on top of the list
        $a_status = mb_strlen($a['color']);
        $b_status = mb_strlen($b['color']);

        if ($a_status == $b_status) {

            if ($a['abd20'] == $b['abd20']) {

                if (isset($a['ae4'])) {

                    if ($a['ae4'] == $b['ae4']) {

                        if ($a['abd28'] == $b['abd28']) {

                            if (strcmp($a['ab2'], $b['ab2']) == 0)
                                return 0;
                            return strcmp($a['ab2'], $b['ab2']) < 0 ? -1 : 1;

                        }
                        return $a['abd28'] > $b['abd28'] ? -1 : 1;

                    }
                    return $a['ae4'] > $b['ae4'] ? -1 : 1;

                } else {

                    if ($a['abd28'] == $b['abd28']) {

                        if (strcmp($a['ab2'], $b['ab2']) == 0)
                            return 0;
                        return strcmp($a['ab2'], $b['ab2']) < 0 ? -1 : 1;
                    }
                    return $a['abd28'] > $b['abd28'] ? -1 : 1;

                }

            }
            return $a['abd20'] > $b['abd20'] ? -1 : 1;
        }
        return $a_status > $b_status ? -1 : 1;
    }
}
