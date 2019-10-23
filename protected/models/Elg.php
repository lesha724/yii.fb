<?php

/**
 * This is the model class for table "elg".
 *
 * The followings are the available columns in table 'elg':
 * @property integer $elg1
 * @property integer $elg2
 * @property integer $elg3
 * @property integer $elg4
 *
 * The followings are the available model relations:
 * @property Uo $elg20
 * @property Sem $elg30
 * @property Elgz[] $elgzs
 */
class Elg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elg1', 'required'),
			array('elg1, elg2, elg3, elg4', 'numerical', 'integerOnly'=>true)
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
			'elg20' => array(self::BELONGS_TO, 'Uo', 'elg2'),
			'elg30' => array(self::BELONGS_TO, 'Sem', 'elg3'),
			'elgzs' => array(self::HAS_MANY, 'Elgz', 'elgz2'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getMarksForStudent($st1)
    {
        $sql=<<<SQL
                SELECT elgzst3,elgzst4,elgzst5,elgz3, (select first 1 elgotr0 from elgotr where elgotr1=ELGZST0) as elgotr0
                FROM elgzst
                    INNER JOIN elgz on (elgzst2 = elgz1)
                WHERE elgz2=:ELG1 and elgzst1= :ST1
                ORDER BY elgz3
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ELG1', $this->elg1);
        $command->bindValue(':ST1', $st1);
        $raws = $command->queryAll();

        $res = array();
        foreach($raws as $raw) {
            $key = $raw['elgz3'];
            $res[$key] = $raw;
        }

        return $res;
    }

	public function addRowMark($st1, $elgz1, $type)
	{
	    $id = $type==1?119:120;

	    $ps = PortalSettings::model()->getSettingFor($id);

	    $elgzst = new Elgzst();
		$elgzst->elgzst0 = new CDbExpression('GEN_ID(GEN_ELGZST, 1)');
		$elgzst->elgzst1 = $st1;
		$elgzst->elgzst2 = $elgz1;
		$elgzst->elgzst7 = Yii::app()->user->isTch?Yii::app()->user->dbModel->p1:0;
		$elgzst->elgzst6 = date('Y-m-d H:i:s');
		$elgzst->elgzst3 = $ps==1?1:0;
		$elgzst->elgzst4 = 0;
		$elgzst->elgzst5 = 0;
		$error = !$elgzst->save();

		return $elgzst;
	}

    public static function getElg1($uo1,$type_lesson,$sem1)
    {
        $sql=<<<SQL
                SELECT elg1 FROM elg
                INNER JOIN sem on (elg3 = sem1)
              WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4 = :TYPE_LESSON
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':UO1', $uo1);
        $command->bindValue(':TYPE_LESSON', $type_lesson);
		$command->bindValue(':SEM1', $sem1);
        $res = $command->queryRow();

        if(!empty($res))
            return  $res['elg1'];
        else
            return -1;
    }

	public function getDispByStSemUoType($st1,$uo1,$sem1,$type){

		$type_str="";
		if($type==0)
			$type_str=" and LISTST.us4=1";
		if($type==1)
			$type_str=" and LISTST.us4 in (2,3,4)";

		$sql = <<<SQL
        SELECT d2,LISTST.us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,LISTST.uo1,LISTST.sem1
            from LISTST(current_timestamp,0,0,3,0,:ST1,:SEM1,0,0)
               inner join us on (LISTST.us1 = us.us1)
               inner join uo on (us.us2 = uo.uo1)
               inner join u on (uo.uo22 = u.u1)
               inner join d on (uo.uo3 = d.d1)
               inner join k on (uo.uo4 = k.k1)
            WHERE LISTST.uo1=:UO1 and us6<>0 {$type_str}
            group by d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1,LISTST.sem1
            ORDER BY d2,us4,uo3
SQL;


		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':UO1',	$uo1);
		$command->bindValue(':SEM1', $sem1);
		$res = $command->queryRow();
		return $res;
	}

	public function getDispBySt($st1){
<<<<<<< HEAD
=======

>>>>>>> master
		$sql = <<<SQL
            SELECT d2,
                    (CASE us.us4
                      WHEN 1 THEN 0
                      ELSE 1
                    END) as type_journal,
                    k2,k15,uo3,u16,u1,d1,d27,d32,d34,d36,uo.uo1,sem.sem1, sem7,ucgn2
                from LISTST(current_timestamp,:YEAR,:SEM,3,0,:ST1,0,0,0)
                   inner join us on (LISTST.us1 = us.us1)
                   inner join uo on (us.us2 = uo.uo1)
                   inner join u on (uo.uo22 = u.u1)
                   inner join d on (uo.uo3 = d.d1)
                   inner join k on (uo.uo4 = k.k1)
                   inner join sem on (LISTST.sem1 = sem.sem1)
                   inner join ucgn on (LISTST.ucgn1 = ucgn.ucgn1)
                WHERE us6<>0 and LISTST.us4 in (1,2,3,4) and uo26<2
                group by d2,type_journal,k2, k15,uo3,u16,u1,d1,d27,d32,d34,d36,uo1,sem1, sem7,ucgn2
                ORDER BY d2,type_journal,uo3
SQL;

		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':YEAR', Yii::app()->session['year']);
		$command->bindValue(':SEM', Yii::app()->session['sem']);
		$res = $command->queryAll();
		return $res;
	}

	public function getOmissions($st1,$uo1,$sem1,$type,$gr1){
		$ps57 = PortalSettings::model()->getSettingFor(57);
		$elgz4_str = '';
		if($ps57==1)
			$elgz4_str = ' AND elgz4<2 ';

		$sql=<<<SQL
              SELECT r2,us4,elgz3,ustem5, elgzst3,elgzst4,elgzst5, elgp.*,rz8, rz2, rz3,elgz1 from elgzst
              	inner join elgz on (elgzst.elgzst2 = elgz.elgz1)
              	left join elgp on (elgzst.elgzst0 = elgp.elgp1)
              	inner join elg on (elgz.elgz2 = elg.elg1 and elg2=:UO1 and elg4=:TYPE_LESSON and elg3={$sem1})
				inner join ustem on (elgz.elgz7 = ustem.ustem1)
				inner join EL_GURNAL_ZAN({$uo1},:GR1,:SEM1, {$type}) on (elgz.elgz3 = EL_GURNAL_ZAN.nom)
				inner join rz on (EL_GURNAL_ZAN.r4 = rz1)
			  WHERE elgzst1=:ST1 AND elgzst3 > 0 {$elgz4_str}
SQL;

		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':GR1', $gr1);
		$command->bindValue(':TYPE_LESSON', $type);
		$res = $command->queryAll();

		foreach($res as $key => $date) {
			$row = Elgzu::model()->getUstemFromElgzuByElgz1AndGroup($date['elgz1'],$gr1);
			if(!empty($row))
			{
				$res[$key]['ustem5']=$row['ustem5'];
			}
		}
		return $res;
	}

	public function getF($st1,$uo1,$sem1,$type,$gr1,$ps55){

		$elgzst4_str = " elgzst4>0 ";
		if($ps55==1){
			$elgzst4_str = " elgzst4>=0 ";
		}
		$ps57 = PortalSettings::model()->getSettingFor(57);
		$elgz4_str = '';
		if($ps57==1)
			$elgz4_str = ' AND elgz4<2 ';
		$min = Elgzst::model()->getMin();

		$sql=<<<SQL
              SELECT r2,us4,elgz3,ustem5, elgzst3,elgzst4,elgzst5,rz8, rz2, rz3 from elgzst
              	inner join elgz on (elgzst.elgzst2 = elgz.elgz1)
              	inner join elg on (elgz.elgz2 = elg.elg1 and elg2={$uo1} and elg4=:TYPE_LESSON and elg3={$sem1})
				inner join ustem on (elgz.elgz7 = ustem.ustem1)
				inner join EL_GURNAL_ZAN({$uo1},:GR1,:SEM1, {$type}) on (elgz.elgz3 = EL_GURNAL_ZAN.nom)
				inner join rz on (EL_GURNAL_ZAN.r4 = rz1)
			  WHERE elgzst1=:ST1 AND elg4!=0 AND elgzst3=0 AND {$elgzst4_str} AND elgzst4<=:MIN {$elgz4_str}

SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':GR1', $gr1);
		$command->bindValue(':TYPE_LESSON', $type);
		$command->bindValue(':MIN', $min);
		$res = $command->queryAll();
		return $res;
	}

	/**
	 * Карточка тудента Итоговая успеваемость
	 * @param $uo1
	 * @param $sem1
	 * @param $elg4
	 * @param $st1
     * @param $gr1
     * @return array
     * @throws
	 */
	public function getItogProgressInfo($uo1,$sem1,$elg4,$st1, $gr1)
	{
		$elgz4Filter = '';
		/*обьединять ли с модулями*/
		$ps57 = PortalSettings::model()->getSettingFor(57);
		if($ps57){
			$elgz4Filter = 'AND elgz4 in (0,1)';
		}
		$sql = <<<SQL
			SELECT elgzst3,elgzst4,elgzst5,elgz5, elgz6,r2 FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1 and elg2={$uo1} and elg4=:TYPE_LESSON and elg3={$sem1})
				inner join EL_GURNAL_ZAN({$uo1},:GR1,:SEM1, {$elg4}) on (elgz.elgz3 = EL_GURNAL_ZAN.nom)
			WHERE elg2=:UO1 AND elg4=:ELG4 AND elgzst1=:ST1 AND r2<=:DATE $elgz4Filter
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':GR1', $gr1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':TYPE_LESSON', $elg4);
		$command->bindValue(':DATE', date('Y-m-d H:i:s'));
		$command->bindValue(':ELG4', $elg4);
		$marks = $command->queryAll();

		$min = $max = $bal = $countLesson = $countOmissions = $countOmissions1 =0;// $countOmissions1 по уваж причине

		foreach($marks as $mark){

			$min+=$mark['elgz5'];
			$max+=$mark['elgz6'];

			if(!empty($mark['elgzst5'])&&$mark['elgzst5']!=0){
				$bal+=$mark['elgzst5'];
			}else{
				$bal+=$mark['elgzst4'];
			}

			if($mark['elgzst3']>0){
				$countOmissions++;
				if($mark['elgzst3']==2)
					$countOmissions1++;
			}
		}

		$sql=<<<SQL
              SELECT count(*) from elgz
              	inner join elg on (elgz.elgz2 = elg.elg1 and elg2={$uo1} and elg4=:TYPE_LESSON and elg3={$sem1})
				inner join EL_GURNAL_ZAN({$uo1},:GR1,:SEM1, {$elg4}) on (elgz.elgz3 = EL_GURNAL_ZAN.nom)
			  WHERE elg4={$elg4} AND r2<=:DATE $elgz4Filter

SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':GR1', $gr1);
		$command->bindValue(':DATE', date('Y-m-d H:i:s'));
		$command->bindValue(':TYPE_LESSON', $elg4);
		$countLesson = $command->queryScalar();

		return array(
				'min'=>$min,
				'max'=>$max,
				'bal'=>$bal,
				'countLesson'=>$countLesson,
				'countOmissions'=>$countOmissions,
				'countOmissions1'=>$countOmissions1
		);
	}
    /**
     * Статистика посещаемости по студенту с и по
     * @param $date1
     * @param $date2
     * @param $st1
     * @param $isCount bool По количеству или по часам
     * @throws
     * @return array
     */
    public function getAttendanceStatisticInfoByDate($date1,$date2,$st1, $isCount = true)
    {
        $sql=<<<SQL
                SELECT proc.*, rz8 FROM el_gurnal_info(0,0, :DATE1, :DATE2, 0, 0, :ST1,0,0) proc
                  INNER JOIN rz on (proc.r4 = rz1)
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE1', $date1);
        $command->bindValue(':DATE2', $date2);
        $rows = $command->queryAll();

        $respectful = 0;
        $disrespectful = 0;
        $count = 0;

        foreach ($rows as $row){
            if($isCount) {
                $elgzst3 = $row['propusk'];
                if ($elgzst3 == 1) $disrespectful++;
                if ($elgzst3 == 2) $respectful++;
                $count++;
            }else{
                $elgzst3 = $row['propusk'];
                $hours = $row['rz8'];

                if ($elgzst3 == 1) $disrespectful+=$hours;
                if ($elgzst3 == 2) $respectful+=$hours;
                $count+=$hours;
            }
        }

        return array($respectful,$disrespectful,$count);
    }

    /**
     * Статистика посещаемости по студенту с и по c часами
     * @param $date1
     * @param $date2
     * @param $st1
     * @param $isCount bool По количеству или по часам
     * @throws
     * @return array
     */
    public function getAttendanceStatisticInfoByDateWithHours($date1,$date2,$st1)
    {
        $sql=<<<SQL
                SELECT proc.*, rz8 FROM el_gurnal_info(0,0, :DATE1, :DATE2, 0, 0, :ST1,0,0) proc
                  INNER JOIN rz on (proc.r4 = rz1) WHERE r2<=:DATE2_1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE1', $date1);
        $command->bindValue(':DATE2', $date2);
        $command->bindValue(':DATE2_1', date('Y-m-d'));
        $rows = $command->queryAll();

        $respectful = 0;
        $disrespectful = 0;
        $count = 0;

        $respectfulHours = 0;
        $disrespectfulHours = 0;
        $countHours = 0;

        foreach ($rows as $row){

            $elgzst3 = $row['propusk'];
            $hours = $row['rz8'];

            if ($elgzst3 == 1) {
                $disrespectful++;
                $disrespectfulHours+=$hours;
            } else if ($elgzst3 == 2) {
                $respectful++;
                $respectfulHours+=$hours;
            };

            $countHours+=$hours;
            $count++;

        }

        return array($respectful,$disrespectful,$count, $respectfulHours,$disrespectfulHours,$countHours);
    }
    /**
     * Статистика посещаемости по студенту за семестр
     * @param $year
     * @param $sem
     * @param $st1
     * @return array
     */
    public function getAttendanceStatisticInfo($year,$sem,$st1)
    {
        $ps57 = PortalSettings::model()->getSettingFor(57);
        $elgz4_str='';
        if($ps57==1)
            $elgz4_str = ' AND elgz4<2 ';

        $sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
				INNER JOIN sem on (elg3 = sem1)
			WHERE sem3=:YEAR AND sem5=:SEM AND elgzst1=:ST1 AND elgzst3=2 {$elgz4_str}
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $respectful = $command->queryScalar();

        $sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
				INNER JOIN sem on (elg3 = sem1)
			WHERE sem3=:YEAR AND sem5=:SEM AND elgzst1=:ST1 AND elgzst3=1 {$elgz4_str}
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $disrespectful = $command->queryScalar();

        $sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
			  INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
				INNER JOIN sem on (elg3 = sem1)
			WHERE  sem3=:YEAR AND sem5=:SEM  AND elgzst1=:ST1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $count = $command->queryScalar();

        return array($respectful,$disrespectful,$count);
    }

	/**
	 * Карточка тудента текущая задолженость
	 * @param $uo1
	 * @param $sem1
	 * @param $elg4
	 * @param $st1
	 * @param $ps55
	 * @return array
	 */
	public function getRetakeInfo($uo1,$sem1,$elg4,$st1,$ps55)
	{
		$ps57 = PortalSettings::model()->getSettingFor(57);
		$elgz4_str='';
		if($ps57==1)
			$elgz4_str = ' AND elgz4<2 ';
		$elgzst4_str = " elgzst4>0 ";
		if($ps55==1){
			$elgzst4_str = " elgzst4>=0 ";
		}
		$sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elgzst1=:ST1 AND elgzst3=2 {$elgz4_str}
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':ELG4', $elg4);
		$respectful = $command->queryScalar();

		$sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elgzst1=:ST1 AND elgzst3=1 {$elgz4_str}
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':ELG4', $elg4);
		$disrespectful = $command->queryScalar();

		$sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elg4!=0 AND elgzst1=:ST1 AND elgzst3=0 AND {$elgzst4_str} AND elgzst4<=:MIN {$elgz4_str}
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':ELG4', $elg4);
		$command->bindValue(':MIN', Elgzst::model()->getMin());
		$f = $command->queryScalar();

		$sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elgzst1=:ST1 AND elgzst3>0 AND (elgzst5>:MIN OR elgzst5=-1) {$elgz4_str}
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':ELG4', $elg4);
		$command->bindValue(':MIN', Elgzst::model()->getMin());
		$nbretake = $command->queryScalar();

		$sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elg4!=0 AND elgzst1=:ST1 AND elgzst3=0 AND {$elgzst4_str} AND elgzst4<=:MIN1 AND (elgzst5>:MIN2  OR elgzst5=-1) {$elgz4_str}
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':ELG4', $elg4);
		$command->bindValue(':MIN1', Elgzst::model()->getMin());
		$command->bindValue(':MIN2', Elgzst::model()->getMin());
		$fretake = $command->queryScalar();

		$sql = <<<SQL
			SELECT COUNT(*) FROM elgz
				INNER JOIN elg on (elgz2 = elg1)
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':ELG4', $elg4);
		$count = $command->queryScalar();
		
		return array($respectful,$disrespectful,$f,$nbretake,$fretake,$count);
	}

	public function getElgByElgzst0($elgzst0)
	{
		$sql=<<<SQL
            SELECT elg.*
                FROM elgzst
                  INNER JOIN elgz on (elgzst2 = elgz1)
                  INNER JOIN elg on (elgz2 = elg1)
                WHERE elgzst0=:ELGZST0
SQL;
		$command= Yii::app()->db->createCommand($sql);
		$command->bindValue(':ELGZST0', $elgzst0);
		$elg = $command->queryRow();
		return $elg;
	}
}
