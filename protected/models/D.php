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
		return array(
			array('d1, d5, d6, d10, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d30, d31', 'numerical', 'integerOnly'=>true),
			array('d2, d27, d32, d34, d36', 'length', 'max'=>1000),
			array('d3, d37', 'length', 'max'=>60),
			array('d4, d29', 'length', 'max'=>400),
			array('d7, d8, d9, d26', 'length', 'max'=>4),
			array('d11, d12', 'length', 'max'=>8),
			array('d28, d33, d35', 'length', 'max'=>40),
		);
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

    public function getUоFromDiscipline($d1)
    {
        if (empty($d1))
            return array();

        $sql = <<<SQL
			select uo1,us4,us1,sp2,sg3
			from us
			   inner join sem on (us.us3 = sem.sem1)
			   inner join sg on (sem.sem2 = sg.sg1)
			   inner join sp on (sg.sg2 = sp.sp1)
			   inner join uo on (us.us2 = uo.uo1)
			where uo3=:d1 and sem3=:year AND sem5=:sem AND us4 in (1,2,3,4)
			group by uo1,us4,us1,sp2,sg3
			order by us4
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':d1', $d1);
        $command->bindValue(':year', Yii::app()->session['year']);
        $command->bindValue(':sem', Yii::app()->session['sem']);
        $res = $command->queryAll();

        foreach ($res as $key => $us) {
            $res[$key]['name'] = SH::convertUS4($us['us4']).' '.$us['sp2'].' ('.$us['sg3'].')';
            $res[$key]['key'] = $us['uo1'].'/'.$us['us1'];
        }
        return $res;
    }

    public function getDisciplineForThematicPlan($sg1,$sem1)
    {
        if (empty($sg1)||empty($sem1))
            return array();
		$sql = <<<SQL
			select d2,uo1
			from d
			   inner join uo on (d.d1 = uo.uo3)
			   inner join us on (uo.uo1 = us.us2)
			   inner join sem on (us.us3 = sem.sem1)
			   inner join u on (uo.uo22 = u.u1)
			where u2=:sg1 and sem1=:sem1 
			group by d2,uo1
			order by d2 collate UNICODE
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':sg1', $sg1);
		$command->bindValue(':sem1', $sem1);
        $discipline = $command->queryAll();
        return $discipline;
    }

    public function getDisciplineForUo1($uo1)
    {
        $discipline = D::model()->findBySql('SELECT d.* FROM uo INNER JOIN d ON (uo3=d1) WHERE uo1=:UO1',array(':UO1'=>$uo1));
        return $discipline;
    }

	public function getDisciplinesByStream($sg1,$k1)
	{
		if (empty($sg1)||empty($k1))
            return array();
	 $sql = <<<SQL
	 select d2, d1, uo1, uo4, c2
                from us
					inner join uo on (us.us2 = uo.uo1 and uo.uo34=1)
                    inner join u on (uo.uo22 = u.u1)
					inner join d on (uo.uo3 = d.d1)
					inner join sg on (u2=sg1)
					inner join sem on (us12 = sem1)
					inner join c on (u15 = c1)
				where sg1=:sg1 AND us4 in (1,2,3,4) and sem3=:year AND uo4=:k1 and sem5=:sem
                GROUP BY d2, d1, uo1, uo4, c2 ORDER BY d2 collate UNICODE
SQL;
		$command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':sg1',$sg1);
		$command->bindValue(':k1', $k1);
        $command->bindValue(':year', Yii::app()->session['year']);
        $command->bindValue(':sem', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();

        return $disciplines;
	
	}

    public function getDisciplinesForJournalPermition()
    {
        $sql = <<<SQL
            SELECT * FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,0,0) ORDER BY d2 COLLATE UNICODE ASC;
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();
        /*foreach ($disciplines as $key => $d) {
            $disciplines[$key]['name'] = $d['d2'];
        }*/
        return $disciplines;
    }

    /**
     * списоу дисциплин для журнала для старосты по гурппе
     * @param $group int группа возможно виртуальная
     * @return array
     */
    public function getDisciplinesForSstPermition($group)
    {
        if(empty($group))
            return array();

        $sql = <<<SQL
            select * from (select d2,d1,LISTST.uo1,LISTST.sem1,LISTST.us4,
              iif(LISTST.us4=1,
              (select elgno4 from elgno where elgno2=LISTST.uo1 and elgno3=LISTST.sem1 and elgno4=0),
              (select elgno4 from elgno where elgno2=LISTST.uo1 and elgno3=LISTST.sem1 and elgno4=1)) as vivodit
                        from LISTST(current_timestamp,:YEAR,:SEM,2,:GR1,0,0,0,0)
                           inner join uo on (LISTST.uo1 = uo.uo1)
                           inner join d on (uo.uo3 = d.d1)
                        where us4 in (1,2,3,4)
                        group by d2,d1,LISTST.uo1,LISTST.sem1,LISTST.us4,vivodit
                        order by d2 collate UNICODE
            ) where vivodit is null
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $group);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();

        foreach($disciplines as $key => $discipline) {
            $disciplines[$key]['discipline'] = $discipline['uo1'].'/'.$discipline['d1'];
        }

        return $disciplines;
    }

    public function getDisciplinesForModulesPermition()
    {
        $sql = <<<SQL
            SELECT * FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,5,0) ORDER BY d2 COLLATE UNICODE ASC;
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();

        return $disciplines;
    }

    public function getDisciplinesForTPlanPermition()
    {

        $sql = <<<SQL
            SELECT * FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,1,0) ORDER BY d2 COLLATE UNICODE ASC;
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();
        /*foreach ($disciplines as $key => $d) {
            $disciplines[$key]['name'] = $d['d2'];
        }*/
        return $disciplines;
    }

    public function getDisciplinesForRetakePermition()
    {

        $sql = <<<SQL
            SELECT * FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,2,0) ORDER BY d2 COLLATE UNICODE ASC;
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();
        /*foreach ($disciplines as $key => $d) {
            $disciplines[$key]['name'] = $d['d2'];
        }*/
        return $disciplines;
    }
    
    public function getDisciplines($type = null)
    {
        $today = date('Y-m-d 00:00');
        if ($type == 0)
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
               inner join ug on (ug3 = nr1)
               inner join r on (nr1 = r1)
            where sg4=0 and sem3=:YEAR and sem5=:SEM
            group by d1,d2
            order by d2 collate UNICODE
SQL;
        elseif ($type == 1)
            $sql = <<<SQL
            select d1,d2
            from u
               inner join uo on (u.u1 = uo.uo22)
               inner join d on (uo.uo3 = d.d1)
               inner join us on (uo.uo1 = us.us2)
               inner join nr on (us1 = nr2)
               inner join sem on (us.us12 = sem.sem1)
               inner join sg on (u.u2 = sg.sg1)
               inner join ug on (ug3 = nr1)
               inner join r on (nr1 = r1)
            where sg4=0 and sem3=:YEAR and sem5=:SEM and uo4 in (
                  select pd4
                  from pd
                  WHERE PD2 = :P1 and PD28 in (0, 2, 5, 9) and (PD13 IS NULL or PD13>'{$today}')
                  group by pd4)
            group by d1,d2
            order by d2 collate UNICODE
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
                   gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr28,nr1
			FROM sem
		    INNER JOIN us ON (sem.sem1 = us.us12)
		    INNER JOIN nr ON (us.us1 = nr.nr2)
		    INNER JOIN pd ON (nr.nr6 = pd.pd1) or (nr.nr7 = pd.pd1) or (nr.nr8 = pd.pd1) or (nr.nr9 = pd.pd1)
	        INNER JOIN ug ON (nr.nr1 = ug.ug3)
            INNER JOIN uo ON (us.us2 = uo.uo1)
            INNER JOIN d ON (uo.uo3 = d.d1)
            INNER JOIN gr ON (ug.ug2 = gr.gr1)
            WHERE pd1=:PD1 and sem3=:SEM3 and sem5=:SEM5
			ORDER BY d1,d2,us4,ug3,uo1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':PD1', $model->teacher);
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


            if (! isset($data[$i])) {
                $data[$i] = $discipline;
                $data[$i]['hours'] = array();
            }

            // takes hours only for one row from the query
            if($_ug3 != $ug3) {
                array_push($data[$i]['hours'], $discipline['nr3']);
            }else{
                $data[$i]['hours'] = array($discipline['nr3']);
            }
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
    
     public function getAd($d1)
    {
        $sql= <<<SQL
                SELECT ad4,d2 FROM AD
					JOIN d ON d1=ad2
				WHERE ad2=:d1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':d1', $d1);
        $ad = $command->queryRow();

        if($ad==null)
            return '';
        else {
            if(mb_detect_encoding($ad['ad4'], 'UTF-8', true))
                $str = $ad['ad4'];
            else
                $str = mb_convert_encoding($ad['ad4'], "UTF-8", "CP1251");
			return CHtml::link('<i class="icon-file"></i>','#', array('data-disp'=>$ad['d2'],'data-content'=> nl2br($str),'class'=>'disp-ad','style'=>'margin-left:10px'));
            //return '<a class="disp-ad" data-toggle="popover" data-placement="bottom" data-content="'.$ad['ad4'].'"><i class="icon-file"></i></a>';
        }
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
            SELECT nr3, sg1, d1, d2, sem5, us4
            FROM d
            INNER JOIN uo on (d.d1 = uo.uo3)
            INNER JOIN us on (uo.uo1 = us.us2)
            INNER JOIN sem on (us.us12 = sem.sem1)
            INNER JOIN nr on (us.us1 = nr.nr2)
            INNER JOIN u on (uo.uo22 = u.u1)
            INNER JOIN c on (u.u15 = c.c1)
            INNER JOIN sg on (u.u2 = sg.sg1)
            INNER JOIN pd ON (nr.nr6 = pd.pd1) OR (nr.nr7 = pd.pd1) OR (nr.nr8 = pd.pd1) OR (nr.nr9 = pd.pd1)
            WHERE c8=3 and pd1 = :PD1 and sem3 = :SEM3 and sem5 = :SEM5
            GROUP BY nr3, sg1, d1, d2, sem5, us4
            ORDER BY sem5, us4
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':PD1', $model->teacher);
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
            SELECT vrn2 as d2, vrnar4 as NR3
            FROM vrn
            INNER JOIN vrna on (vrn.vrn1 = vrna.vrna3)
            INNER JOIN vrnar on (vrna.vrna1 = vrnar.vrnar2)
            WHERE vrnar3 = :PD1 and vrna4 = :SEM3 and vrna6 = :SEM5
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':PD1', $model->teacher);
        $command->bindValue(':SEM3', $model->year);
        $command->bindValue(':SEM5', $model->semester);
        $disciplines = $command->queryAll();

        foreach ($disciplines as $key => $discipline) {
            $us4 = 'Asp';
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
            SELECT d1, d2, DNAR4 as nr3
            FROM dna
            INNER JOIN dnar on (dna.dna1 = dnar.dnar2)
            INNER JOIN d on (dna.dna2 = d.d1)
            WHERE DNAR3=:PD1 and DNA4=:SEM3 and DNA7=:SEM5
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':PD1', $model->teacher);
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
            WHERE pd1=:PD1 and sem3=:SEM3 and sem5=:SEM5
            GROUP BY  d1,d2,d27,d32,d34,d36 {$extraFields}
            ORDER BY d1,d2 {$extraFields}
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':PD1', $model->teacher);
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
	
	public function getLinkDisciplinesForWorkPlan($model, $uo1)
	{
		if(empty($uo1))
			return '';
		$sql = <<<SQL
            select mtmo11, mtv2
			from mtz
			   inner join mtmo on (mtz1 = mtmo1)
			   inner join mtv on (mtv1 = mtmo4)
			where mtz2 = :sem1 and mtz3 = :uo1
SQL;
		$command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':uo1', $uo1);
        $command->bindValue(':sem1', $model->semester);
        $links = $command->queryAll();
		if(empty($links))
			return '';

		$result = '';

		foreach ($links as $link) {
            if (empty($link['mtmo11']))
                continue;

            $result.=CHtml::link('<i class="icon-file"></i>', $link['mtmo11'], array('data-toggle' => "tooltip", 'data-placement' => "right", 'data-original-title' => $link['mtv2'], 'class' => 'link-disp', 'style' => 'margin-left:10px', 'target' => '_blank'));
        }

        return $result;
	}
	
    private function getWorkPlanDisciplinesFor($model, $type)
    {
        if ($type == WorkPlanController::SPECIALITY) {
            $sql = <<<SQL
                SELECT d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1, k19
                FROM us
                INNER JOIN uo ON (US.US2 = UO.UO1)
                INNER JOIN u ON (UO.uo22 = U.U1)
                INNER JOIN d ON (UO.uo3 = D.D1)
                INNER JOIN k ON (UO.uo4 = K.K1)
                WHERE us4<>13 and u2=:ID and us3=:SEM1 and us6<>0 and us4<>17 and us4<>18
                ORDER BY d2,us4,uo3,d27
SQL;
            $id  = $model->group;
        } elseif ($type == WorkPlanController::GROUP) {
            $sql = <<<SQL
                SELECT d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1, k19
				from ucxg
				   inner join ucgn on (ucxg.ucxg2 = ucgn.ucgn1)
				   inner join ucx on (ucxg.ucxg1 = ucx.ucx1)
				   inner join uo on (ucx.ucx1 = uo.uo19)
				   inner join us on (uo.uo1 = us.us2)
				   inner join u on (uo.uo22 = u.u1)
				   inner join d on (uo.uo3 = d.d1)
				   inner join k on (uo.uo4 = k.k1)
				WHERE us4<>13 and ucgn2=:ID and us3=:SEM1 and us6<>0 and us4<>17 and us4<>18
				group by d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1, k19
				ORDER BY d2,us4,uo3,d27
SQL;
            $id  = $model->group;
        } elseif ($type == WorkPlanController::STUDENT) {
            $sql = <<<SQL
            SELECT d2,LISTST.us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,LISTST.uo1, k19
                from LISTST(current_timestamp,0,0,3,0,:ID,:SEM1,0,0)
                   inner join us on (LISTST.us1 = us.us1)
                   inner join uo on (us.us2 = uo.uo1)
                   inner join u on (uo.uo22 = u.u1)
                   inner join d on (uo.uo3 = d.d1)
                   inner join k on (uo.uo4 = k.k1)
                WHERE LISTST.us4<>13 and us6<>0 and LISTST.us4<>17 and LISTST.us4<>18
                group by d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1, k19
                ORDER BY d2,us4,uo3,d27
SQL;
            $id  = $model->student;
        }

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ID', $id);
        $command->bindValue(':SEM1', $model->semester);
        $disciplines = $command->queryAll();

        $result  = array();

        if(Yii::app()->language=='en') {
            foreach ($disciplines as $key => $value) {
                $result[$key] = $value;

                $chairName = $value['k19'];
                if ((isset($chairName) && !empty($chairName) && $chairName != ""))
                    $result[$key]['k2'] = $chairName;

                $dispName = $value['d27'];
                if ((isset($dispName) && !empty($dispName) && $dispName != ""))
                    $result[$key]['d2'] = $dispName;
            }
        }else
            return $disciplines;

        return $result;
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
    /*
     * группы по факультеты курсу и семестру для фильтра в списки виртуальных групп
     */
    public  function getDisciplinesByFacultySemectrCourse($f1, $course){
        if(empty($f1)||empty($course))
            return array();

        $sql = <<<SQL
			select d2,d1
                from sp
                   inner join sg on (sp.sp1 = sg.sg2)
                   inner join u on (sg.sg1 = u.u2)
                   inner join uo on (u.u1 = uo.uo22)
                   inner join d on (uo.uo3 = d.d1)
                   inner join us on (uo.uo1 = us.us2)
                   inner join sem on (us.us3 = sem.sem1)
                   inner join ucx on (uo.uo19 = ucx.ucx1)
                where ucx5=3 and sem3=:YEAR and sem5=:SEM and sp5=:F1 and sem4=:COURSE
                group by d2,d1
                order by d2 collate UNICODE
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':F1', $f1);
        $command->bindValue(':COURSE', $course);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();

        return $disciplines;
    }

    public function getDisciplineForCourseWork($st1)
    {
        if (! $st1)
            return;

        list($sg40, $sg41) = $this->getSg40Sg41($st1);
        //$sg40=2014;
        //$sg41=1;
        /*$sql = <<<SQL
			select us1,d2
			   from u
				  inner join uo on (u.u1 = uo.uo22)
				  inner join us on (uo.uo1 = us.us2)
				  inner join nr on (us.us1 = nr.nr2)
				  inner join ug on (nr.nr1 = ug.ug3)
				  inner join sem on (us.us3 = sem.sem1)
				  inner join ucgn on (ug.ug4 = ucgn.ucgn1)
				  inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
				  inner join ucsn on (ucgns.ucgns1 = ucsn.ucsn1)
				  inner join d on (uo.uo3 = d.d1)
			   where us4 = 8 and ucsn2=:ST1 and u38<=current_timestamp and u39>=current_timestamp and sem3=:SG40
			   group by us1,d2
SQL;*/

        $sql = <<<SQL
        select LISTST.us1,d2
            from LISTST(current_timestamp,:SG40,0,4,0,:ST1,0,0,0)
               inner join uo on (LISTST.uo1 = uo.uo1)
               inner join u on (uo.uo22 = u.u1)
               inner join d on (uo.uo3 = d.d1)
               inner join sem on (LISTST.sem1 = sem.sem1)
            where us4 = 8 and u38<=current_timestamp and u39>=current_timestamp and sem3=:SG40_
            group by us1,d2
SQL;


        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
		$command->bindValue(':SG40', $sg40);
        $command->bindValue(':SG40_', $sg40);
        $discipline = $command->queryRow();

        return $discipline;
    }

    public function getFirstCourseWork($st1, $us1)
    {
        $sql = <<<SQL
           SELECT nkrs1,nkrs6,nkrs7,nkrs4,nkrs5
           FROM nkrs
           WHERE nkrs2 = :ST1 and nkrs3 = :US1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':US1', $us1);
        $discipline = $command->queryRow();

        if (empty($discipline)) {
            $sql = <<<SQL
                insert into NKRS(NKRS1,NKRS2,NKRS3)
                values (GEN_ID(GEN_NKRS, 1), :ST1, :US1)
SQL;
            Yii::app()->db->createCommand($sql)->execute(array(
                ':ST1' => $st1,
                ':US1' => $us1
            ));

            $sql = <<<SQL
                select nkrs1,nkrs6,nkrs7,nkrs4,nkrs5 FIRST
                from NKRS
                order by NKRS1 DESC
SQL;
            $discipline = Yii::app()->db->createCommand($sql)->queryRow();
        }

        return $discipline;
    }

    public function updateNkrs($nkrs1, $field, $value)
    {
        $sql = <<<SQL
           UPDATE nkrs SET {$field} = :VALUE
           WHERE nkrs1 = :NKRS1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':VALUE', $value);
        $command->bindValue(':NKRS1', $nkrs1);
        $res = $command->execute();

        return $res;
    }

    public function getSg40Sg41($st1)
    {
        if (! $st1)
            return;

        $sql = <<<SQL
		   select first 1 sg40, sg41
            from sg
               inner join gr on (sg.sg1 = gr.gr2)
               inner join std on (gr.gr1 = std.std3)
            where std2=:ST1 and std7 is null and std11 in (0,5,6,8)
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $params = $command->queryRow();

        list($year, $sem) = ShortCodes::getCurrentYearAndSem();

        if(!empty($params)) {
            if (empty($params['sg40']))
                $params['sg40'] = $year;

            if ($params['sg41'] == null)
                $params['sg41'] = $sem;
        }else
            return array($year, $sem);

        return array($params['sg40'], $params['sg41']);
    }

    /**
     * список дисциплин для статистики посещаемости погруппе
     * @param $gr1 int
     * @param $sem1 int
     * @return mixed
     */
    public function getDisciplinesForAttendanceStatistic($gr1, $sem1){
        /*$sql = <<<SQL
        SELECT d1,d2 from ucsn
            inner join ucgns on (ucsn.ucsn1 = ucgns.ucgns1)
            inner join ucgn on (ucgns.ucgns2 = ucgn.ucgn1)
            inner join st on (ucsn.ucsn2 = st.st1)
            INNER JOIN std on (st.st1 = std.std2)
            inner join ucxg on (ucgn.ucgn1 = ucxg.ucxg2)
            inner join ucx on (ucxg.ucxg1 = ucx.ucx1)
            inner join uo on (ucx.ucx1 = uo.uo19)
            inner join elg on (uo.uo1 = elg.elg2)
            inner join d on (uo.uo3 = d.d1)
        WHERE std3 = :GR1 and elg3 = :SEM1 and STD11 in (0,5,6,8) and (STD7 is null)
        GROUP BY d1,d2 order by d2 collate UNICODE
SQL;*/

        $sql = <<<SQL
        SELECT d1,d2
            from LISTST(current_timestamp,0,0,2,:GR1,0,:SEM1,0,0)
               inner join uo on (LISTST.uo1 = uo.uo1)
               inner join elg on (uo.uo1 = elg.elg2)
               inner join d on (uo.uo3 = d.d1)
            WHERE elg3 = LISTST.SEM1
            GROUP BY d1,d2 order by d2 collate UNICODE
SQL;


        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':SEM1', $sem1);
        $disciplines = $command->queryAll();

        return $disciplines;
    }

    /**
     * для типов uc4 us6
     * @param $table
     * @param $us6
     * @return string
     */
    public function getConvertByUs6($table, $us6){
        $sql = <<<SQL
            select {$table}2 from {$table}
              where {$table}1 = $us6
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $str = $command->queryScalar();

        return $str;
    }
}
