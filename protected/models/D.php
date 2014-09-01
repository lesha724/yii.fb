<?php

/**
 * This is the model class for table "d".
 *
 * The followings are the available columns in table 'd':
 * @property integer $d1
 * @property string $d2
 * @property string $d3
 * @property string $d4
 * @property integer $d5
 * @property integer $d6
 * @property string $d7
 * @property string $d8
 * @property string $d9
 * @property integer $d10
 * @property string $d11
 * @property string $d12
 * @property integer $d13
 * @property integer $d14
 * @property integer $d15
 * @property integer $d16
 * @property integer $d17
 * @property integer $d18
 * @property integer $d19
 * @property integer $d20
 * @property integer $d21
 * @property integer $d22
 * @property integer $d23
 * @property integer $d24
 * @property integer $d25
 * @property string $d26
 * @property string $d27
 * @property string $d28
 * @property string $d29
 * @property integer $d30
 * @property integer $d31
 * @property string $d32
 * @property string $d33
 * @property string $d34
 * @property string $d35
 * @property string $d36
 * @property string $d37
 */
class D extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('d1, d5, d6, d10, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d30, d31', 'numerical', 'integerOnly'=>true),
			array('d2, d27, d32, d34, d36', 'length', 'max'=>1000),
			array('d3, d37', 'length', 'max'=>60),
			array('d4, d29', 'length', 'max'=>400),
			array('d7, d8, d9, d26', 'length', 'max'=>4),
			array('d11, d12', 'length', 'max'=>8),
			array('d28, d33, d35', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37', 'safe', 'on'=>'search'),
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
			'd1' => 'D1',
			'd2' => 'D2',
			'd3' => 'D3',
			'd4' => 'D4',
			'd5' => 'D5',
			'd6' => 'D6',
			'd7' => 'D7',
			'd8' => 'D8',
			'd9' => 'D9',
			'd10' => 'D10',
			'd11' => 'D11',
			'd12' => 'D12',
			'd13' => 'D13',
			'd14' => 'D14',
			'd15' => 'D15',
			'd16' => 'D16',
			'd17' => 'D17',
			'd18' => 'D18',
			'd19' => 'D19',
			'd20' => 'D20',
			'd21' => 'D21',
			'd22' => 'D22',
			'd23' => 'D23',
			'd24' => 'D24',
			'd25' => 'D25',
			'd26' => 'D26',
			'd27' => 'D27',
			'd28' => 'D28',
			'd29' => 'D29',
			'd30' => 'D30',
			'd31' => 'D31',
			'd32' => 'D32',
			'd33' => 'D33',
			'd34' => 'D34',
			'd35' => 'D35',
			'd36' => 'D36',
			'd37' => 'D37',
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

		$criteria->compare('d1',$this->d1);
		$criteria->compare('d2',$this->d2,true);
		$criteria->compare('d3',$this->d3,true);
		$criteria->compare('d4',$this->d4,true);
		$criteria->compare('d5',$this->d5);
		$criteria->compare('d6',$this->d6);
		$criteria->compare('d7',$this->d7,true);
		$criteria->compare('d8',$this->d8,true);
		$criteria->compare('d9',$this->d9,true);
		$criteria->compare('d10',$this->d10);
		$criteria->compare('d11',$this->d11,true);
		$criteria->compare('d12',$this->d12,true);
		$criteria->compare('d13',$this->d13);
		$criteria->compare('d14',$this->d14);
		$criteria->compare('d15',$this->d15);
		$criteria->compare('d16',$this->d16);
		$criteria->compare('d17',$this->d17);
		$criteria->compare('d18',$this->d18);
		$criteria->compare('d19',$this->d19);
		$criteria->compare('d20',$this->d20);
		$criteria->compare('d21',$this->d21);
		$criteria->compare('d22',$this->d22);
		$criteria->compare('d23',$this->d23);
		$criteria->compare('d24',$this->d24);
		$criteria->compare('d25',$this->d25);
		$criteria->compare('d26',$this->d26,true);
		$criteria->compare('d27',$this->d27,true);
		$criteria->compare('d28',$this->d28,true);
		$criteria->compare('d29',$this->d29,true);
		$criteria->compare('d30',$this->d30);
		$criteria->compare('d31',$this->d31);
		$criteria->compare('d32',$this->d32,true);
		$criteria->compare('d33',$this->d33,true);
		$criteria->compare('d34',$this->d34,true);
		$criteria->compare('d35',$this->d35,true);
		$criteria->compare('d36',$this->d36,true);
		$criteria->compare('d37',$this->d37,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return D the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getDisciplines($type = null)
    {
        $sql = <<<SQL
            select d1,d2
            from u
               inner join uo on (u.u1 = uo.uo22)
               inner join d on (uo.uo3 = d.d1)
               inner join us on (uo.uo1 = us.us2)
               inner join
                (select nr1,nr2
                          from pd
                             inner join nr on (pd1 = nr6) or (pd1 = nr7) or (pd1 = nr8) or (pd1 = nr9)
                             inner join us on (nr2 = us1)
                          where pd1>0 and pd2=:P1
                          group by nr1,nr2)
                on (us1 = nr2)
               inner join sem on (us.us12 = sem.sem1)
               inner join sg on (u.u2 = sg.sg1)
            where sg4=0 and sem3=:YEAR and sem5=:SEM
            group by d1,d2;
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();

        return $disciplines;
    }

    public function getDisciplineBySg1($sg1)
    {
        if (empty($sg1))
            return array(array(), array());

        $sql=<<<SQL
           SELECT d2,d1,uo1,uo4
           FROM d
           INNER JOIN uo on (d.d1 = uo.uo3)
           INNER JOIN u on (uo.uo22 = u.u1)
           WHERE u2=:SG1
           GROUP BY d2,d1,uo1,uo4
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1', $sg1);
        $disciplines = $command->queryAll();

        $dataAttrs = array();
        foreach ($disciplines as $discipline) {
            $dataAttrs[$discipline['uo1']] = array('data-uo4' => $discipline['uo4']);
        }

        return array($disciplines, $dataAttrs);
    }

    public function getExamsOf($d1)
    {
        if (empty($d1))
            return array();

        $sql=<<<SQL
           SELECT d1,d2
           FROM d
           INNER JOIN seka on (d.d1 = seka.seka2)
           WHERE seka1=:D1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':D1', $d1);
        $disciplines = $command->queryAll();

        return $disciplines;
    }

    public function getDisciplinesForWorkLoad(FilterForm $model)
    {
        $sql = <<<SQL
            SELECT d1, d2, us4, uo1, ug2, nr3, sem4,ug3,gr2,gr1,d27,d32,d34,d36,
                   gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr28
			FROM sem
		    INNER JOIN us ON (sem.sem1 = us.us12)
		    INNER JOIN nr ON (us.us1 = nr.nr2)
		    INNER JOIN pd ON (nr.nr6 = pd.pd1) or (nr.nr7 = pd.pd1) or (nr.nr8 = pd.pd1) or (nr.nr9 = pd.pd1)
	        INNER JOIN ug ON (nr.nr1 = ug.ug3)
            INNER JOIN uo ON (us.us2 = uo.uo1)
            INNER JOIN d ON (uo.uo3 = d.d1)
            INNER JOIN gr ON (ug.ug2 = gr.gr1)
            WHERE pd2=:P1 and sem3=:SEM3 and sem5=:SEM5
			ORDER BY d1,d2,us4,ug3,uo1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $model->teacher);
        $command->bindValue(':SEM3', $model->year);
        $command->bindValue(':SEM5', $model->semester);
        $disciplines = $command->queryAll();

        $i = 0;
        $_us4 = $_ug3 = $_uo1 = 0; // previous row values
        $data = array();

        foreach ($disciplines as $discipline) {

            // this row values
            $us4 = $discipline['us4'];
            $ug3 = $discipline['ug3'];
            $uo1 = $discipline['uo1'];

            $changeRow = ($us4 != $_us4) ||
                         ($ug3 != $_ug3 && in_array($us4, array(1,2,3,4,9,10,11,12,16))) ||
                         ($uo1 != $_uo1 && in_array($us4, array(5,6,7,8,14,17)));

            if ($changeRow) {
                $i++;
                $_us4 = $us4;
                $_ug3 = $ug3;
                $_uo1 = $uo1;
            }


            if (! isset($data[$i]))
                $data[$i] = $discipline;

            // takes hours only for one row from the query
            $data[$i]['hours']    = array($discipline['nr3']);
            $data[$i]['groups'][] = Gr::model()->getGroupName($discipline['sem4'], $discipline);
            $data[$i]['ids'][]    = $discipline['gr1'];
        }

        $prak = $this->getPrakForWorkLoad($model);
        $dipl = $this->getDiplForWorkLoad($model);
        $gek  = $this->getGekForWorkLoad($model);
        $asp  = $this->getAspForWorkLoad($model);
        $dop  = $this->getDopForWorkLoad($model);

        $data = array_merge($data, $prak, $dipl, $gek, $asp, $dop);

        return $data;
    }


    public function getPrakForWorkLoad(FilterForm $model)
    {
        $sql= <<<SQL
                SELECT prun3 as NR3, sg1
				FROM spr
				INNER JOIN pru on (spr.spr1 = pru.pru3)
				INNER JOIN prun on (pru.pru1 = prun.prun1)
				INNER JOIN pd on (prun.prun2 = pd.pd1)
				INNER JOIN sg on (pru.pru2 = sg.sg1)
				INNER JOIN sem on (sg.sg1 = sem.sem2)
				WHERE pru4 = sem7 and pd2=:P1 and sem3=:SEM3 and sem5=:SEM5
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $model->teacher);
        $command->bindValue(':SEM3', $model->year);
        $command->bindValue(':SEM5', $model->semester);
        $disciplines = $command->queryAll();

        foreach ($disciplines as $key => $discipline) {
            $us4 = 'Prak';
            $disciplines[$key]['d2']  = tt('Практика');
            $disciplines[$key]['us4'] = $us4;
            $disciplines[$key]['hours'][$us4] = round($discipline['nr3']);

            list($gr1, $names) = Gr::model()->getGroupsBySg1ForWorkPlan($discipline['sg1'], $model->year, $model->semester);

            $disciplines[$key]['groups'][] = $names;
            $disciplines[$key]['ids']      = $gr1;

            $disciplines[$key]['studentsAmount'] = null;
        }

        return $disciplines;
    }

    public function getDiplForWorkLoad(FilterForm $model)
    {
        $sql= <<<SQL
                SELECT dipn3 as NR3,dipn6
				FROM sem
				INNER JOIN dnk on (sem.sem1 = dnk.dnk2)
				INNER JOIN dipn on (dnk.dnk1 = dipn.dipn1)
				INNER JOIN pd on (dipn.dipn2 = pd.pd1)
				WHERE pd2 = :P1 and sem3 = :SEM3 and sem5 = :SEM5
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $model->teacher);
        $command->bindValue(':SEM3', $model->year);
        $command->bindValue(':SEM5', $model->semester);
        $disciplines = $command->queryAll();

        foreach ($disciplines as $key => $discipline) {
            $us4 = 'Dipl';
            $disciplines[$key]['d2']  = $this->getDiplName($discipline['dipn6']);
            $disciplines[$key]['us4'] = $us4;
            $disciplines[$key]['hours'][$us4] = round($discipline['nr3']);
            $disciplines[$key]['groups'][]    = null;
            $disciplines[$key]['ids'][]       = null;
            $disciplines[$key]['studentsAmount'] = null;
        }

        return $disciplines;
    }

    public function getDiplName($dipn6)
    {
        switch($dipn6){
            case 0:	$name = tt('Руководство дипломом'); break;
            case 1: $name = tt('Норма контроль'); break;
            case 2: $name = tt('Проверка зав. кафедрой'); break;
            case 3: $name = tt('Рецензирование дипломов'); break;
            case 4: $name = tt('ГЭК'); break;
            case 5: $name = tt('Консультирование дипломов'); break;
            default: $name='';
        }

        return $name;
    }

    public function getGekForWorkLoad(FilterForm $model)
    {
        $sql= <<<SQL
                SELECT gosn3 as NR3,sem2 as SG1, d1, d2
                FROM d
                INNER JOIN gnk on (d.d1 = gnk.gnk2)
                INNER JOIN gosn on (gnk.gnk1 = gosn.gosn1)
                INNER JOIN pd on (gosn.gosn2 = pd.pd1)
                INNER JOIN sem on (gnk.gnk3 = sem.sem1)
				WHERE pd2 = :P1 and sem3 = :SEM3 and sem5 = :SEM5
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $model->teacher);
        $command->bindValue(':SEM3', $model->year);
        $command->bindValue(':SEM5', $model->semester);
        $disciplines = $command->queryAll();

        foreach ($disciplines as $key => $discipline) {
            $us4 = 'Gek';
            $disciplines[$key]['us4'] = $us4;
            $disciplines[$key]['hours'][$us4] = round($discipline['nr3']);

            list($gr1, $names) = Gr::model()->getGroupsBySg1ForWorkPlan($discipline['sg1'], $model->year, $model->semester);

            $disciplines[$key]['groups'][] = $names;
            $disciplines[$key]['ids']      = $gr1;
            $disciplines[$key]['studentsAmount'] = null;
        }

        return $disciplines;
    }

    public function getAspForWorkLoad(FilterForm $model)
    {
        $sql= <<<SQL
                SELECT nakn6 as NR3, nakn4
                FROM nakn
                INNER JOIN pd on (nakn.nakn5 = pd.pd1)
				WHERE pd2 = :P1 and NAKN2 = :SEM3 and NAKN3 = :SEM5
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $model->teacher);
        $command->bindValue(':SEM3', $model->year);
        $command->bindValue(':SEM5', $model->semester);
        $disciplines = $command->queryAll();

        foreach ($disciplines as $key => $discipline) {
            $us4 = 'Asp';
            $disciplines[$key]['d2']  = $this->getAspName($discipline['nakn4']);
            $disciplines[$key]['us4'] = $us4;
            $disciplines[$key]['hours'][$us4] = round($discipline['nr3']);
            $disciplines[$key]['groups'][]    = null;
            $disciplines[$key]['ids'][]       = null;
            $disciplines[$key]['studentsAmount'] = null;
        }

        return $disciplines;
    }

    public function getAspName($nakn4)
    {
        switch($nakn4){
            case 0:	$name = tt('Нагрузка по аспирантуре'); break;
            case 1: $name = tt('Руководство докторантами'); break;
            case 2: $name = tt('Руководство аспирантами'); break;
            case 3: $name = tt('Руководство аспирантами иностранцами'); break;
            case 4: $name = tt('Руководство соискателями'); break;
            case 5: $name = tt('Руководство магистрами'); break;
            default: $name='';
        }

        return $name;
    }

    public function getDopForWorkLoad(FilterForm $model)
    {
        $sql = <<<SQL
                SELECT nrdn4 as nr3, d1,d2
                FROM d
                INNER JOIN dn on (d.d1 = dn.dn2)
                INNER JOIN nrdn on (dn.dn1 = nrdn.nrdn1)
                INNER JOIN pd on (nrdn.nrdn2 = pd.pd1)
                WHERE pd2 = :P1 and DN4 = :SEM3 and NRDN3 = :SEM5
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $model->teacher);
        $command->bindValue(':SEM3', $model->year);
        $command->bindValue(':SEM5', $model->semester);
        $disciplines = $command->queryAll();

        foreach ($disciplines as $key => $discipline) {
            $us4 = 'Dop';
            $disciplines[$key]['us4']         = $us4;
            $disciplines[$key]['hours'][$us4] = round($discipline['nr3']);
            $disciplines[$key]['groups'][]    = null;
            $disciplines[$key]['ids'][]       = null;
            $disciplines[$key]['studentsAmount'] = null;
        }

        return $disciplines;
    }


    public function getDisciplinesForWorkLoadAmount(FilterForm $model)
    {
        $extraFields = null;
        if ($model->extendedForm == 1)
            $extraFields = ',uo22,ug3,us4';

        $sql = <<<SQL
            SELECT  d1,d2,d27,d32,d34,d36 {$extraFields}
            FROM sem
            INNER JOIN us ON (sem.sem1 = us.us12)
            INNER JOIN nr ON (us.us1 = nr.nr2)
            INNER JOIN pd ON (nr.nr6 = pd.pd1) or (nr.nr7 = pd.pd1) or (nr.nr8 = pd.pd1) or (nr.nr9 = pd.pd1)
            INNER JOIN ug ON (nr.nr1 = ug.ug3)
            INNER JOIN uo ON (us.us2 = uo.uo1)
            INNER JOIN d ON (uo.uo3 = d.d1)
            INNER JOIN gr ON (ug.ug2 = gr.gr1)
            WHERE pd2=:P1 and sem3=:SEM3 and sem5=:SEM5
            GROUP BY  d1,d2,d27,d32,d34,d36 {$extraFields}
            ORDER BY d1,d2 {$extraFields}
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $model->teacher);
        $command->bindValue(':SEM3', $model->year);
        $command->bindValue(':SEM5', $model->semester);
        $disciplines = $command->queryAll();

        foreach ($disciplines as $key => $discipline) {

            list($groupNames, $studentsAmount)   = Gr::model()->getGroupsAndStudentsForWorkLoadAmount($model, $discipline);
            $disciplines[$key]['groups']         = $groupNames;
            $disciplines[$key]['studentsAmount'] = $studentsAmount;

            $disciplines[$key]['hours'] = Us::model()->getHoursForWorkLoadAmount($model, $discipline);
        }

        $prak = $this->getPrakForWorkLoad($model);
        $dipl = $this->getDiplForWorkLoad($model);
        $gek  = $this->getGekForWorkLoad($model);
        $asp  = $this->getAspForWorkLoad($model);
        $dop  = $this->getDopForWorkLoad($model);

        $disciplines = array_merge($disciplines, $prak, $dipl, $gek, $asp, $dop);


        return $disciplines;
    }

    public function getDisciplinesForWorkPlan(FilterForm $model, $type)
    {
        $disciplines = $this->getWorkPlanDisciplinesFor($model, $type);

        $i = 0;
        $_uo3 = 0; // previous row values
        $data = array();

        $map = array(
            9  => 1, // УЛк
            10 => 2, // УПз
            11 => 3, // УСем
            12 => 4, // УЛб
        );

        foreach ($disciplines as $discipline) {

            // this row values
            $uo3 = $discipline['uo3'];
            $us4 = $discipline['us4'];
            if (in_array($us4, array(9, 10, 11, 12)))
                $us4 = $map[$us4];


            $changeRow = $uo3 != $_uo3;
            if ($changeRow) {
                $i++;
                $_uo3 = $uo3;
            }

            if (! isset($data[$i]))
                $data[$i] = $discipline + array('hours' => array());


            if (! isset($data[$i]['hours'][$us4]))
                $data[$i]['hours'][$us4] = null;

            $data[$i]['hours'][$us4] += $discipline['us6'];
            $data[$i]['d2'] = $this->getNameFor($discipline);

        }

        return $data;
    }

    private function getWorkPlanDisciplinesFor($model, $type)
    {
        if ($type == WorkPlanController::SPECIALITY) {
            $sql = <<<SQL
                SELECT d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1
                FROM us
                INNER JOIN uo ON (US.US2 = UO.UO1)
                INNER JOIN u ON (UO.uo22 = U.U1)
                INNER JOIN d ON (UO.uo3 = D.D1)
                INNER JOIN k ON (UO.uo4 = K.K1)
                INNER JOIN ucx ON (UO.UO19 = UCX.UCX1)
                INNER JOIN ucg ON (UCX.UCX1 = UCG.UCG2)
                WHERE us4<>13 and u2=:ID and us3=:SEM1
                ORDER BY d2,us4,uo3
SQL;
            $id  = $model->group;
        } elseif ($type == WorkPlanController::GROUP) {
            $sql = <<<SQL
                SELECT d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1
                FROM us
                INNER JOIN uo ON (us.us2 = uo.uo1)
                INNER JOIN u ON (uo.uo22 = u.u1)
                INNER JOIN d ON (uo.uo3 = d.d1)
                INNER JOIN k ON (uo.uo4 = k.k1)
                INNER JOIN ucx ON (uo.uo19 = ucx.ucx1)
                INNER JOIN ucg ON (ucx.ucx1 = ucg.ucg2)
                WHERE us4<>13 and ucg3=:ID and us3=:SEM1
                ORDER BY d2,us4,uo3
SQL;
            $id  = $model->group;
        } elseif ($type == WorkPlanController::STUDENT) {
            $sql = <<<SQL
                SELECT d2,us4,us6,k2,uo3,u16,u1,d27,d32,d34,d36
                FROM us
                INNER JOIN uo ON (us.us2 = uo.uo1)
                INNER JOIN u ON (uo.uo22 = u.u1)
                INNER JOIN d ON (uo.uo3 = d.d1)
                INNER JOIN k ON (uo.uo4 = k.k1)
                INNER JOIN ucx ON (uo.uo19 = ucx.ucx1)
                INNER JOIN ucg ON (ucx.ucx1 = ucg.ucg2)
                INNER JOIN ucs ON (ucg.ucg1 = ucs.ucs2)
                WHERE us4<>13 and ucg4=0 and ucs3=:ID and us3=:SEM1
                ORDER BY d2,us4,uo3
SQL;
            $id  = $model->student;
        }

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ID', $id);
        $command->bindValue(':SEM1', $model->semester);
        $disciplines = $command->queryAll();

        return $disciplines;
    }

    private function getNameFor($discipline)
    {
        $u16 = $discipline['u16'];

        $pos = strpos($u16, '@');
        if ($pos === false) {
            $name = $u16 . $discipline['d2'];
        } elseif(is_integer($pos)) {

            $parts = explode('@', $u16);

            if ($pos === 0)
                $name = $discipline['d2'] . $parts[1];
            else
                $name = $parts[0] . $discipline['d2'] . $parts[1];

        }

        return $name;
    }

}
