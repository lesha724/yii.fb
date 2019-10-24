<?php

/**
 * This is the model class for table "elgzst".
 *
 * The followings are the available columns in table 'elgzst':
 * @property integer $elgzst0
 * @property integer $elgzst1
 * @property integer $elgzst2
 * @property integer $elgzst3
 * @property double $elgzst4
 * @property double $elgzst5
 * @property string $elgzst6
 * @property integer $elgzst7
 *
 * The followings are the available model relations:
 * @property St $elgzst10
 * @property Elgz $elgzst20
 * @property P $elgzst70
 */
class Elgzst extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elgzst';
	}

    public $r1,$st2,$st3,$st4,$us4,$count_elgotr,$tema,$status,$group_st,$uo1,$r2,$nom,$elgp2,$elgp3,$type_lesson,$elg4,$gr1,$elg3,$elg2;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elgzst0', 'required'),
			array('elgzst1, elgzst2, elgzst3, elgzst7', 'numerical', 'integerOnly'=>true),
			array('elgzst4, elgzst5', 'numerical'),
			array('elgzst6', 'length', 'max'=>25),
			array('st2,group_st,status,nom,r2,elgp2,type_lesson,elgp3,count_elgotr,tema,elgzst0, elgzst1, elgzst2, elgzst3, elgzst4, elgzst5, elgzst6, elgzst7', 'safe', 'on'=>'search'),
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
			'elgzst10' => array(self::BELONGS_TO, 'St', 'elgzst1'),
			'elgzst20' => array(self::BELONGS_TO, 'Elgz', 'elgzst2'),
			'elgzst70' => array(self::BELONGS_TO, 'P', 'elgzst7'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'elgzst3' => tt('Тип'),
            'elgp2' => tt('Тип пропуска'),
            'elgp3' => tt('Номер справки'),
            'r2'=>tt('Дата занятия'),
            'nom'=>tt('Номер занятия'),
            'count_elgotr'=>tt('Количество отработок'),
            'tema'=>tt('Тема'),
            'group_st'=>tt('Группа'),
            'status'=>tt('Статус'),
		);
	}

    public function searchRetake()
    {
        if(empty($this->type_lesson)||$this->type_lesson==1)
            $type_lesson=0;
        else
            $type_lesson=1;

        $fields = ' EL_GURNAL_INFO.*, elg4, ustem5, elg2, elg3 as sem1, elgp2, elgp3, elgzst3, elgzst4, elgzst5,(select count(*) from elgotr where elgotr1=EL_GURNAL_INFO.ELGZST0) as count_elgotr ';

        $from = 'FROM EL_GURNAL_INFO(%s,%s, dateadd(-2 year to current_timestamp), current_timestamp, 0,(select first 1 u2 from uo join u on (uo22 = u1) where uo1=%s), 0, 0, 0, 1)';
        $from = sprintf($from,Yii::app()->session['year'], Yii::app()->session['sem'], $this->uo1);

        $from.= ' INNER JOIN elgz on (elgz.elgz1 = EL_GURNAL_INFO.elgz1)';
        $from.= ' INNER JOIN elg on (elgz.elgz2 = elg.elg1)';
        $from.= ' INNER JOIN elgzst on (elgzst.elgzst0 = EL_GURNAL_INFO.elgzst0)';
        $from.= ' LEFT JOIN elgp on (elgp.elgp1 = EL_GURNAL_INFO.elgzst0)';
        $from.= ' LEFT JOIN ustem on (ustem.ustem1 = EL_GURNAL_INFO.ustem1)';

        $ps55 = PortalSettings::model()->findByPk(55)->ps2;
        if($ps55==0)
            $operation = '>';
        else
            $operation = '>=';

        $dopCondition = ' OR (elgzst4<='.Elgzst::model()->getMin().' and elgzst4 '.$operation.' 0)';
        if($type_lesson==0)
            $dopCondition = '';

        $where = '
                WHERE   elg4='.$type_lesson.' AND
                        ((elgzst3 > 0) '.$dopCondition.' )
        ';

        $params = array(
        );


        if(!empty($this->st2)) {
            $where .= ' AND st2 CONTAINING :ST2 ';
            $params[':ST2'] = $this->st2;
        }

        if(!empty($this->tema)) {
            $where .= ' AND ustem5 CONTAINING :TEMA ';
            $params[':TEMA'] = $this->tema;
        }
        if(!empty($this->nom)) {
            $where .= ' AND nom=:NOM';
            $params[':NOM'] = $this->nom;
        }
        if(!empty($this->elgp3)) {
            $where .= ' AND elgp3 CONTAINING :ELGP3 ';
            $params[':ELGP3'] = $this->elgp3;
        }
        if(!empty($this->elgp2)) {
            $where .= ' AND elgp2=:ELGP2';
            $params[':ELGP2'] = $this->elgp2;
        }
        if($this->elgzst3!=null) {
            $where .= ' AND elgzst3=:ELGZST3';
            $params[':ELGZST3'] = $this->elgzst3;
        }
        if(!empty($this->group_st)) {
            $where .= ' AND (gr3 CONTAINING :GR3 or virt_grup CONTAINING :GR3_)';
            $params[':GR3'] = $this->group_st;
            $params[':GR3_'] = $this->group_st;
        }
        if(!empty($this->status)) {
            if ($this->status == 1)
                $where .= " AND (elgzst5>'" . $this->getMin() . "' or elgzst5=-1) ";
            else
                $where .= " AND (elgzst5<'" . $this->getMin() . "' and elgzst5>-1) ";
        }

        $where.= ' AND uo1='.$this->uo1;

        $countSQL =
            'SELECT COUNT(*) ' .
            $from .
            $where;

        $selectSQL =
            'SELECT ' .
            $fields .
            $from .
            $where;

        $command=Yii::app()->db->createCommand($countSQL);
        $command->params = $params;

        $count = $command->queryScalar();

        $sort = new CSort();
        $sort->sortVar = 'sort';
        $sort->defaultOrder = 'st2 ASC';
        $sort->attributes = array(
            'st2'=>array(
                'asc'=>'st2 ASC',
                'desc'=>'st2 DESC',
                'default'=>'ASC',
            ),
            'r2'=>array(
                'asc'=>'r2 ASC',
                'desc'=>'r2 DESC',
                'default'=>'ASC',
            ),
            'elgzst3'=>array(
                'asc'=>'elgzst3 ASC',
                'desc'=>'elgzst3 DESC',
                'default'=>'ASC',
            ),
            'tema'=>array(
                'asc'=>'ustem5 asc',
                'desc'=>'ustem5 DESC',
                'default'=>'ASC',
            ),
            'group_st'=>array(
                'asc'=>'gr3 asc',
                'desc'=>'gr3 DESC',
                'default'=>'ASC',
            ),
            'nom'=>array(
                'asc'=>'nom asc',
                'desc'=>'nom DESC',
                'default'=>'ASC',
            ),
            'elgp2'=>array(
                'asc'=>'elgp2 asc',
                'desc'=>'elgp2 DESC',
                'default'=>'ASC',
            ),
            'elgp3'=>array(
                'asc'=>'elgp3 asc',
                'desc'=>'elgp3 DESC',
                'default'=>'ASC',
            )
        );

        $pageSize=Yii::app()->user->getState('pageSize',10);
        if($pageSize==0)
            $pageSize=10;

        return new CSqlDataProvider($selectSQL, array(
            'keyField' => 'elgzst0',
            'totalItemCount'=>$count,
            'params'=>$params,
            'sort'=>$sort,
            'pagination'=>array(
                'pageSize'=> $pageSize,
            ),
        ));

    }


    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elgzst the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getElgz1ArrForOmissions($st1,$date1,$date2)
    {
        if (empty($st1) || empty($date1) || empty($date2))
            return array();

        $sql = <<<SQL
        SELECT elgz1 FROM EL_GURNAL_INFO(:YEAR, :SEM, :DATE1, :DATE2, 0, 0, :ST1, 0, 0) 
            where d1 in (select d1 FROM  EL_GURNAL(:P1,:YEAR1,:SEM1,0,0,0,0,3,0)) and elgzst0 is not null and propusk>0
SQL;


        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE1', $date1);
        $command->bindValue(':DATE2', $date2);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $command->bindValue(':YEAR1', Yii::app()->session['year']);
        $command->bindValue(':SEM1', Yii::app()->session['sem']);
        $rows = $command->queryAll();

        $res=array();
        foreach($rows as $row)
        {
            array_push($res,$row['elgz1']);
        }
        return $res;
    }

    public function getMin()
    {
        $bal = PortalSettings::model()->getSettingFor(37);
        if($bal>0)
            return $bal;
        else {
            if(PortalSettings::model()->getSettingFor(55)==1&&$bal==0){
                return 0;
            }else
                return 2;
        }
    }

    /**
     * @return bool
     */
    public function checkMinRetakeForGrid()
    {
        return ($this->elgzst5<=$this->getMin()&&$this->elgzst5!=-1);
    }

    public function getType()
    {
        $arr=self::model()->getTypes();
        if($this->elgzst3<1)
            return '-';
        else
            if(isset($arr[$this->elgp2]))
                return $arr[$this->elgp2];
            else
                return '-';
    }

    public static function checkMinRetakeForGridRetake($elgzst5)
    {
        return ($elgzst5<=self::model()->getMin()&&$elgzst5!=-1);
    }

    public static function getTypeRetake($elgzst3,$elgp2)
    {
        $arr=self::model()->getTypes();
        if($elgzst3<1)
            return '-';
        else
            if(isset($arr[$elgp2]))
                return $arr[$elgp2];
            else
                return '-';
    }

    public function getStatusArray()
    {
        return array(1=>tt('Отработано'),2=>tt('Не отработано'));
    }

    public static function getStatusRetake($elgzst5)
    {
        if(!self::checkMinRetakeForGridRetake($elgzst5))
            return tt('Отработано');
        else
            return tt('Не отработано');
    }

    public function getStatus()
    {
        if(!$this->checkMinRetakeForGrid())
            return tt('Отработано');
        else
            return tt('Не отработано');
    }

    public function getTypes()
    {
        return array(1=>tt('без отработок (уваж.)'),2=>tt('по болезни (уваж.)'),3=>tt('дежурство (уваж.)'),4=>tt('другое (уваж.)'),5=>tt('по оплате (неув.)'),6=>tt('неизвестная причина (неув.)'));
    }

    public function getTypesByGroup()
    {
        //return array(0=>tt('без відробок'),1=>tt('по хворобі'),2=>tt('чергування'),3=>tt('інше'),4=>tt('по оплаті'));
        return array(
            array('id'=>6,'text'=>tt('неизвестная причина'),'group'=>tt('Не уважительные')),
            array('id'=>5,'text'=>tt('по оплате'),'group'=>tt('Не уважительные')),
            array('id'=>1,'text'=>tt('без отработок'),'group'=>tt('Уважительные')),
            array('id'=>2,'text'=>tt('по болезни'),'group'=>tt('Уважительные')),
            array('id'=>3,'text'=>tt('дежурство'),'group'=>tt('Уважительные')),
            array('id'=>4,'text'=>tt('другое'),'group'=>tt('Уважительные')),
        );
    }

    public function getElgzst3()
    {
        $arr=self::model()->getElgzst3s();
        return $arr[$this->elgzst3];
    }

    public function getElgzst3s()
    {
        return array(0=>tt('Двойка'),1=>tt('Неув'),2=>tt('Уваж'));
    }

    public function getInfoByElgzst0($uo1,$sem1,$gr1,$elg4)
    {
        $sql=<<<SQL
             SELECT d2,d3,pe2,pe3,pe4,elgz3
                FROM elgzst
                    LEFT JOIN elgp on (elgzst.elgzst0 = elgp.elgp1)
                    INNER JOIN elgz on (elgzst.elgzst2 = elgz.elgz1)
                    INNER JOIN elg on (elgz.elgz2 = elg.elg1)
                    INNER JOIN uo on (elg.elg2 = uo.uo1)
                    INNER JOIN d on (d.d1 = uo.uo3)
                    INNER JOIN st on (elgzst.elgzst1 = st.st1)
                    INNER JOIN pe on (st200 = pe1)
                WHERE elgzst0=:ELGZST0 and d1 in (select d1 FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,2,0))
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ELGZST0', $this->elgzst0);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $res = $command->queryRow();

        $sql=<<<SQL
             SELECT r2 FROM EL_GURNAL_ZAN(:UO1,:GR1,:SEM1, :ELG4) WHERE EL_GURNAL_ZAN.nom=:NOM
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':UO1', $uo1);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':SEM1', $sem1);
        $command->bindValue(':ELG4', $elg4);
        $command->bindValue(':NOM', $res['elgz3']);

        $r2 = $command->queryScalar();

        $res['r2']=$r2;

        return $res;
    }

    public function getAttendanceStatisticFor($st1, $start, $end, $monthStatistic, $d2='')
    {
        if (empty($st1) || empty($start) || empty($end))
            return array();

        if(empty($d2))
            $sql=<<<SQL
                SELECT *
                FROM el_gurnal_info(0,0, :DATE1, :DATE2, 0, 0, :ST1,0,0) 
SQL;
        else
            $sql=<<<SQL
                SELECT *
                FROM el_gurnal_info(0,0, :DATE1, :DATE2, 0, 0, :ST1,0,0)  WHERE d2 = :D2
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE1', $start);
        $command->bindValue(':DATE2', $end);
        if(!empty($d2)){
            $command->bindValue(':D2', $d2);
        }
        $rows = $command->queryAll();

        $statistic = array();

        $statistic['summary'] = array(
            'td1' => 0,
            'td2' => 0,
            'td3' => 0,
        );

        $start = strtotime($start);
        $end   = strtotime($end);

        $now = strtotime('now');

        while($start <= $end) {

            $td1 = $td2 = $td3 = 0;
            foreach ($rows as $row) {

                $r2 = $row['r2'];
                $timeR2 = strtotime($r2);
                $elgzst3 = $row['propusk'];

                $condition = $monthStatistic
                    ? date('Y-m-d', $start) == date('Y-m-d', $timeR2)
                    : date('Y-m', $start) == date('Y-m', $timeR2);
                if($timeR2<=$now) {
                    if ($condition) {
                        $td1++;

                        if ($elgzst3 == 1) $td2++; // with reason
                        else
                            if ($elgzst3 == 2) $td3++; // without reason
                            else
                                if ($elgzst3 == null) $td2++; // without reason
                    }
                }
            }

            $statistic[$start] = array(
                'td1' => $td1,
                'td2' => $td2,
                'td3' => $td3,
            );

            $statistic['summary']['td1'] += $td1;
            $statistic['summary']['td2'] += $td2;
            $statistic['summary']['td3'] += $td3;

            $condition = $monthStatistic
                ? 'next day'
                : 'first day of next month';
            $start = strtotime($condition, $start);
        }

        return $statistic;
    }

    public static function getElgzst3Reatake($elgzst3)
    {
        $arr=self::model()->getElgzst3s();
        return $arr[$elgzst3];
    }

    public function nbSt45($st,$elgz1){
        if($st['st45']==1){
            $elgzst = new Elgzst();
            $elgzst->elgzst0 = new CDbExpression('GEN_ID(GEN_ELGZST, 1)');
            $elgzst->elgzst1 = $st['st1'];
            $elgzst->elgzst2 = $elgz1;
            $elgzst->elgzst7 = Yii::app()->user->dbModel->p1;
            $elgzst->elgzst6 = date('Y-m-d H:i:s');
            $elgzst->elgzst3 = 1;
            $elgzst->elgzst4 = 0;
            $elgzst->elgzst5 = 0;
            $elgzst->save();
        }
    }

    /**
     * Проверка можно ли редатированить пропуск (для фарма)
     *
     * @return bool
     * @throws
     */
    public function checkAccessForFarmPass(){
        if($this->elgzst3 == 0)
            return true;

        //проверка на участие в заявке на оплату
        $sql = <<<SQL
          SELECT count(*) from elgp 
            INNER JOIN pptz on (pptz2=elgp0)
            INNER JOIN ppt on (PPTZ1=ppt1)
          WHERE elgp1=:ELGZST0 and ppt5 is null
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ELGZST0', $this->elgzst0);
        $count = $command->queryScalar();

        if(!empty($count))
            return false;

        if($this->checkIssetAdmit())
            return false;

        return true;
    }

    /***
     * Проверка есть допуск для данного проруска
     * @return bool
     * @throws CException
     */
    public function checkIssetAdmit(){
        if($this->elgzst3 == 0)
            return true;

        //проверка на участие в допуске
        $sql = <<<SQL
          SELECT count(*) from elgp 
            INNER JOIN admitz on (admitz2=elgp0)
            INNER JOIN admit on (admitz1=admit1)
          WHERE elgp1=:ELGZST0 and admit5 is null
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ELGZST0', $this->elgzst0);
        $count = $command->queryScalar();

        if(!empty($count))
            return true;

        return false;
    }
}
