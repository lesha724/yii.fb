<?php

/**
 * This is the model class for table "spab".
 *
 * The followings are the available columns in table 'spab':
 * @property integer $spab1
 * @property integer $spab2
 * @property string $spab3
 * @property integer $spab4
 * @property integer $spab5
 * @property integer $spab6
 * @property integer $spab7
 * @property string $spab8
 * @property string $spab9
 * @property string $spab10
 * @property integer $spab11
 * @property integer $spab12
 * @property integer $spab13
 * @property string $spab14
 * @property integer $spab15
 * @property integer $spab16
 * @property integer $spab17
 * @property integer $spab18
 * @property integer $spab19
 * @property double $spab20
 * @property double $spab21
 * @property double $spab22
 * @property double $spab23
 * @property integer $spab24
 * @property integer $spab25
 * @property string $spab26
 * @property string $spab27
 * @property string $spab28
 * @property string $spab29
 * @property integer $spab31
 * @property integer $spab32
 * @property integer $spab33
 * @property integer $spab34
 * @property integer $spab35
 * @property integer $spab36
 */
class Spab extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spab';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spab1, spab2, spab4, spab5, spab6, spab7, spab11, spab12, spab13, spab15, spab16, spab17, spab18, spab19, spab24, spab25, spab31, spab32, spab33, spab34, spab35, spab36', 'numerical', 'integerOnly'=>true),
			array('spab20, spab21, spab22, spab23', 'numerical'),
			array('spab3, spab29', 'length', 'max'=>400),
			array('spab8, spab9, spab10', 'length', 'max'=>60),
			array('spab14, spab27', 'length', 'max'=>1000),
			array('spab26, spab28', 'length', 'max'=>180),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('spab1, spab2, spab3, spab4, spab5, spab6, spab7, spab8, spab9, spab10, spab11, spab12, spab13, spab14, spab15, spab16, spab17, spab18, spab19, spab20, spab21, spab22, spab23, spab24, spab25, spab26, spab27, spab28, spab29, spab31, spab32, spab33, spab34, spab35, spab36', 'safe', 'on'=>'search'),
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
			'spab1' => 'Spab1',
			'spab2' => 'Spab2',
			'spab3' => 'Spab3',
			'spab4' => 'Spab4',
			'spab5' => 'Spab5',
			'spab6' => 'Spab6',
			'spab7' => 'Spab7',
			'spab8' => 'Spab8',
			'spab9' => 'Spab9',
			'spab10' => 'Spab10',
			'spab11' => 'Spab11',
			'spab12' => 'Spab12',
			'spab13' => 'Spab13',
			'spab14' => 'Spab14',
			'spab15' => 'Spab15',
			'spab16' => 'Spab16',
			'spab17' => 'Spab17',
			'spab18' => 'Spab18',
			'spab19' => 'Spab19',
			'spab20' => 'Spab20',
			'spab21' => 'Spab21',
			'spab22' => 'Spab22',
			'spab23' => 'Spab23',
			'spab24' => 'Spab24',
			'spab25' => 'Spab25',
			'spab26' => 'Spab26',
			'spab27' => 'Spab27',
			'spab28' => 'Spab28',
			'spab29' => 'Spab29',
			'spab31' => 'Spab31',
			'spab32' => 'Spab32',
			'spab33' => 'Spab33',
			'spab34' => 'Spab34',
			'spab35' => 'Spab35',
			'spab36' => 'Spab36',
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

		$criteria->compare('spab1',$this->spab1);
		$criteria->compare('spab2',$this->spab2);
		$criteria->compare('spab3',$this->spab3,true);
		$criteria->compare('spab4',$this->spab4);
		$criteria->compare('spab5',$this->spab5);
		$criteria->compare('spab6',$this->spab6);
		$criteria->compare('spab7',$this->spab7);
		$criteria->compare('spab8',$this->spab8,true);
		$criteria->compare('spab9',$this->spab9,true);
		$criteria->compare('spab10',$this->spab10,true);
		$criteria->compare('spab11',$this->spab11);
		$criteria->compare('spab12',$this->spab12);
		$criteria->compare('spab13',$this->spab13);
		$criteria->compare('spab14',$this->spab14,true);
		$criteria->compare('spab15',$this->spab15);
		$criteria->compare('spab16',$this->spab16);
		$criteria->compare('spab17',$this->spab17);
		$criteria->compare('spab18',$this->spab18);
		$criteria->compare('spab19',$this->spab19);
		$criteria->compare('spab20',$this->spab20);
		$criteria->compare('spab21',$this->spab21);
		$criteria->compare('spab22',$this->spab22);
		$criteria->compare('spab23',$this->spab23);
		$criteria->compare('spab24',$this->spab24);
		$criteria->compare('spab25',$this->spab25);
		$criteria->compare('spab26',$this->spab26,true);
		$criteria->compare('spab27',$this->spab27,true);
		$criteria->compare('spab28',$this->spab28,true);
		$criteria->compare('spab29',$this->spab29,true);
		$criteria->compare('spab31',$this->spab31);
		$criteria->compare('spab32',$this->spab32);
		$criteria->compare('spab33',$this->spab33);
		$criteria->compare('spab34',$this->spab34);
		$criteria->compare('spab35',$this->spab35);
		$criteria->compare('spab36',$this->spab36);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Spab the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param sel_1 Направление подготовки
     * @param sel_2 Форма обучения
     */
    public function getCoursesForEntrance($model)
    {
        $selectsAreEmpty = is_null($model->sel_1) ||
                           is_null($model->sel_2) ||
                           $model->sel_1 == '' ||
                           $model->sel_2 == '';

        if ($selectsAreEmpty)
            return array();

        $criteria = new CDbCriteria();
        $criteria->select = 'spab6';
        $criteria->compare('spab4', $model->sel_1);
        $criteria->compare('spab5', $model->sel_2);
        $criteria->compare('spab2', $model->currentYear);
        $criteria->compare('spab15', $model->filial);
        $criteria->group = 'spab6';

        $courses = Spab::model()->findAll($criteria);

        return $courses;
    }

    public function getSpecialitiesForEntrance(FilterForm $model)
    {
        $selectsAreEmpty = is_null($model->sel_1) ||
                           is_null($model->sel_2) ||
                           is_null($model->course) ||
                           $model->sel_1 == '' ||
                           $model->sel_2 == '' ||
                           $model->course == '';

        if ($selectsAreEmpty)
            return array();

        $sql = <<<SQL
          SELECT *
          FROM spab
          WHERE spab4 = :SEL_1 AND spab5 = :SEL_2 AND spab2 = :YEAR AND spab6 = :SEL_3 and spab15 = :FILIAL
          ORDER BY spab7
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SEL_1', $model->sel_1);
        $command->bindValue(':SEL_2', $model->sel_2);
        $command->bindValue(':YEAR',  $model->currentYear);
        $command->bindValue(':SEL_3', $model->course);
        $command->bindValue(':FILIAL',$model->filial);

        $specialities = $command->queryAll();

        foreach($specialities as $k => $speciality)
        {
            $specialities[$k]['v'] = (($d = ($speciality['spab11'] + $speciality['spab12'])) == 0) ? '' : $d;
            $specialities[$k]['b'] = ($speciality['spab11'] != 0) ? $speciality['spab11'] : '';
            $specialities[$k]['k'] = ($speciality['spab12'] != 0) ? $speciality['spab12'] : '';
        }

        return $specialities;
    }

    public function countFor($model, $spab1, $b_or_k, $extra_sign = '', $flag = 0, $showFacilities = false)
    {
        $extra_sign = ! empty($extra_sign)
                            ? 'and '.$extra_sign
                            : '';


        $tmp = ($flag == 0) ? ' and (abd12 is null or abd12>\''.date('d.m.Y', strtotime(date('d.m.'.$model->currentYear))).'\')' : '';

        $joins = $showFacilities
                    ? 'from ab
                           inner join abd on (ab.ab1 = abd.abd2)
                           inner join spab on (abd.abd3 = spab.spab1)
                           inner join stal on (abd.abd1 = stal.stal2)'
                    : 'from ab
                           inner join abd on (ab.ab1 = abd.abd2)
                           inner join spab on (abd.abd3 = spab.spab1)';

        $sql = <<<SQL
            SELECT count(AB1)
            {$joins}
            WHERE SPAB4 = :SEL_1 and
                  SPAB5 = :SEL_2 and
                  SPAB1 = :SPAB1 and
                  SPAB6 = :SEL_3 and
                  ABD7 in ($b_or_k) and
                  SPAB2 = :YEAR_1 and
                  ab1>0 and
                  abd13>0
                  $extra_sign
                  $tmp
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SEL_1',  $model->sel_1);
        $command->bindValue(':SEL_2',  $model->sel_2);
        $command->bindValue(':SPAB1',  $spab1);
        $command->bindValue(':SEL_3',  $model->course);
        //$command->bindValue(':B_OR_K', $b_or_k);
        $command->bindValue(':YEAR_1', $model->currentYear);

        $count = $command->queryScalar();

        if ($count == 0)
            $count = '';

        return $count;

    }

    public function getDataForSchedule($model)
    {
        $dateStart = PortalSettings::model()->findByPk(23)->getAttribute('ps2');
        $dateEnd   = PortalSettings::model()->findByPk(24)->getAttribute('ps2');

        if (empty($dateStart) || empty($dateEnd))
            return array('', '');

        $sql= <<<SQL
            SELECT abd11
            FROM spab
               INNER JOIN abd ON (spab.spab1 = abd.abd3)
               INNER JOIN ab ON (abd.abd2 = ab.ab1)
			WHERE spab4 = :SEL_1 and spab5 = :SEL_2 and spab6 = :SEL_3 and spab15 = :FILIAL
			and ABD11  >= :DATE_START and ABD11 <= :DATE_END
			group by ABD11
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SEL_1', $model->sel_1);
        $command->bindValue(':SEL_2', $model->sel_2);
        $command->bindValue(':SEL_3', $model->course);
        $command->bindValue(':FILIAL',  $model->filial);
        $command->bindValue(':DATE_START',  $dateStart);
        $command->bindValue(':DATE_END',  $dateEnd);
        $dates = $command->queryAll();

        $line_1 = array("['$dateStart',0]");
        $line_2 = array("['$dateEnd',0]");

        foreach($dates as $date)
        {
            $count_1 = $this->countEntrantForDate($model, $dateStart, $date['abd11']);
            $count_2 = $this->countEntrantForDate($model, $dateStart, $date['abd11'], 2);

            $currentDate = SH::formatDate('Y-m-d H:i:s', 'd.m.Y', $date['abd11']);

            $line_1[] = "['$currentDate',$count_1]";
            $line_2[] = "['$currentDate',$count_2]";
        }

        $line_1 = implode(',', $line_1);
        $line_2 = implode(',', $line_2);

        return array($line_1, $line_2);
    }

    public function countEntrantForDate($model, $date1, $date2, $flag = 1)
    {
        $tmp = ($flag == 2) ? "and ABD33 = 1" : '';

        $sql = <<<SQL
            SELECT count(AB1)
            FROM spab
               INNER JOIN abd ON (spab.spab1 = abd.abd3)
               INNER JOIN ab ON (abd.abd2 = ab.ab1)
			WHERE spab4 = :SEL_1 and spab5 = :SEL_2 and spab6 = :SEL_3 and spab15 = :FILIAL and
			      ABD11  >= :DATE_1 and ABD11 <= :DATE_2
			      $tmp
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SEL_1',  $model->sel_1);
        $command->bindValue(':SEL_2',  $model->sel_2);
        $command->bindValue(':SEL_3',  $model->course);
        $command->bindValue(':FILIAL', $model->filial);
        $command->bindValue(':DATE_1', $date1);
        $command->bindValue(':DATE_2', $date2);
        $count = $command->queryScalar();

        if (! $count)
            return 0;

        return $count;
    }

    public function getSpecialitiesForRegistration($spab4, $spab5)
    {
        $dateEntranceBegin  = PortalSettings::model()->findByPk(23)->getAttribute('ps2');
        $spab2 = date('Y', strtotime($dateEntranceBegin));

        $criteria = new CDbCriteria();
        $criteria->compare('spab4', $spab4);
        $criteria->compare('spab5', $spab5);
        $criteria->compare('spab2', $spab2);
        $criteria->order = 'spab7';

        $specialities = Spab::model()->findAll($criteria);

        return $specialities;
    }
}
