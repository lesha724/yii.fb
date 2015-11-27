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

    public $st2,$st3,$st4,$us4,$count_elgotr,$tema,$status,$group_st,$uo1,$r2,$nom,$elgp2,$elgp3,$type_lesson;
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
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
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
			'elgzst0' => 'Elgzst0',
			'elgzst1' => 'Elgzst1',
			'elgzst2' => 'Elgzst2',
			'elgzst3' => tt('Тип'),
			'elgzst4' => 'Elgzst4',
			'elgzst5' => 'Elgzst5',
			'elgzst6' => 'Elgzst6',
			'elgzst7' => 'Elgzst7',
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

		$criteria->compare('elgzst0',$this->elgzst0);
		$criteria->compare('elgzst1',$this->elgzst1);
		$criteria->compare('elgzst2',$this->elgzst2);
		$criteria->compare('elgzst3',$this->elgzst3);
		$criteria->compare('elgzst4',$this->elgzst4);
		$criteria->compare('elgzst5',$this->elgzst5);
		$criteria->compare('elgzst6',$this->elgzst6,true);
		$criteria->compare('elgzst7',$this->elgzst7);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function searchRetake()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $table = St::model()->tableName();
        $table2 = Ustem::model()->tableName();
        $table3 = Elgz::model()->tableName();
        $table4 = Gr::model()->tableName();
        //$criteria->select = 't.*,gr.gr3 as group_st,elgp2,elgp3,USTEM5 as tema,r2,'.$table.'.st2,elgz.elgz3 as nom,'.$table.'.st3,'.$table.'.st4,(SELECT COUNT(*) FROM elgotr WHERE elgotr.elgotr1=t.elgzst0) as count_elgotr';
        $criteria->select = 't.*,gr.gr3 as group_st,elgp2,elgp3,USTEM5 as tema,r2,st2,elgz.elgz3 as nom,st3,st4';
        $criteria->join = 'JOIN st ON (t.elgzst1=st.st1) ';
        $criteria->join .= 'LEFT JOIN elgp ON (t.elgzst0=elgp.elgp1) ';
        $criteria->join .= 'JOIN std ON (st.st1=std.std2) ';
        $criteria->join .= 'JOIN '.$table4.' ON (std.std3='.$table4.'.gr1) ';
        $criteria->join .= 'JOIN elgz ON (t.elgzst2=elgz.elgz1) ';
        $criteria->join .= 'JOIN elg ON (elgz.elgz2=elg.elg1 and elg.elg2='.$this->uo1.') ';
        $criteria->join .= 'JOIN sem ON (elg.elg3=sem.sem1 AND sem3='.Yii::app()->session['year'].' and sem5='.Yii::app()->session['sem'].') ';
        $criteria->join .= 'JOIN r ON (elgz.elgz1=r.r8) ';
        if(empty($this->type_lesson)||$this->type_lesson==1)
            $criteria->compare('elg4',0);
        else
            $criteria->compare('elg4',1);
        //$criteria->join .= 'JOIN us ON (nr.nr2=us.us1) ';
        $criteria->join .= 'LEFT JOIN '.$table2.' ON ('.$table2.'.USTEM1=elgz.elgz7 AND '.$table2.'.USTEM4= elgz.elgz3) ';
        $criteria->addCondition("std7 is null and std11 in(0,5,6,8)");
        $criteria->addCondition("st2 CONTAINING '".$this->st2."'");
        $criteria->compare('elgzst1',$this->elgzst1);
        $criteria->compare('elgzst2',$this->elgzst2);
        $criteria->compare('elgzst3',$this->elgzst3);
        $criteria->compare('elgzst4',$this->elgzst4);
        $criteria->compare('elgzst5',$this->elgzst5);
        $criteria->compare('elgp2',$this->elgp2);
        $criteria->compare('elgp3',$this->elgp3);
        if(!empty($this->r2))
            $criteria->compare('r.r2',date_format(date_create_from_format("d.m.Y", $this->r2), "Y-m-d"));
        if(!empty($this->tema))
            $criteria->addCondition("ustem5 CONTAINING '".$this->tema."'");
        if(!empty($this->group_st))
            $criteria->addCondition("gr3 CONTAINING '".$this->group_st."'");
        if(!empty($this->status))
            if($this->status==1)
                $criteria->addCondition("elgzst5>'".$this->getMin()."' or elgzst5=-1");
            else
                $criteria->addCondition("(elgzst5<'".$this->getMin()."' and elgzst5!=-1)");
        $criteria->addCondition("(elgzst3 > 0) OR (elgzst4<=".Stegn::model()->getMin()." and elgzst4>0)");

        $sort = new CSort();
        $sort->sortVar = 'sort';
        $sort->defaultOrder = 'st2 ASC';
        $sort->attributes = array(
            'st2'=>array(
                'asc'=>$table.'.st2 ASC',
                'desc'=>$table.'.st2 DESC',
                'default'=>'ASC',
            ),
            'r2'=>array(
                'asc'=>'r.r2 ASC',
                'desc'=>'r.r2 DESC',
                'default'=>'ASC',
            ),
            'elgzst3'=>array(
                'asc'=>'t.elgzst3 ASC',
                'desc'=>'t.elgzst3 DESC',
                'default'=>'ASC',
            ),
            /*'count_elgotr'=>array(
                'asc'=>'count_elgotr asc',
                'desc'=>'count_elgotr DESC',
                'default'=>'ASC',
            ),*/
            'tema'=>array(
                'asc'=>'tema asc',
                'desc'=>'tema DESC',
                'default'=>'ASC',
            ),
            'group_st'=>array(
                'asc'=>'group_st asc',
                'desc'=>'group_st DESC',
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

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
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

        $sql=<<<SQL
                SELECT elgz1
                FROM elgzst
                    LEFT JOIN elgp on (elgzst.elgzst0 = elgp.elgp1)
                    INNER JOIN elgz on (elgzst.elgzst2 = elgz.elgz1)
                    INNER JOIN elg on (elgz.elgz2 = elg.elg1)
                    INNER JOIN uo on (elg.elg2 = uo.uo1)
                    INNER JOIN d on (d.d1 = uo.uo3)
                    INNER JOIN r on (elgz.elgz1 = r.r8)
                    INNER JOIN nr on (r.r1 = nr.nr1)
                    INNER JOIN us on (nr.nr2 = us.us1)
                WHERE elgzst1=:ST1 and r2 >= :DATE1 and r2 <= :DATE2 and elgzst3!=0 and d1 in (select d1 FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,3,0))
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE1', $date1);
        $command->bindValue(':DATE2', $date2);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
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
        $bal = PortalSettings::model()->findByPk(37)->ps2;
        if($bal>0)
            return $bal;
        else
            return 2;
    }

    public function checkMinRetakeForGrid()
    {
        //return $this->count_elgotr==0||($this->elgzst5<=$this->getMin()&&$this->elgzst5!=-1);
        return ($this->elgzst5<=$this->getMin()&&$this->elgzst5!=-1);
        //return $this->stegn6<=$this->getMin()||$this->stegn6!=-1;
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

    public function getStatusArray()
    {
        return array(1=>tt('Отработано'),2=>tt('Не отработано'));
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
        return array(1=>tt('без відробок (п.)'),2=>tt('по хворобі (п.)'),3=>tt('чергування (п.)'),4=>tt('інше (п.)'),5=>tt('по оплаті (н.)'));
    }

    public function getTypesByGroup()
    {
        //return array(0=>tt('без відробок'),1=>tt('по хворобі'),2=>tt('чергування'),3=>tt('інше'),4=>tt('по оплаті'));
        return array(
            array('id'=>5,'text'=>tt('по оплаті'),'group'=>tt('не поважні')),
            array('id'=>1,'text'=>tt('без відробок'),'group'=>tt('поважні')),
            array('id'=>2,'text'=>tt('по хворобі'),'group'=>tt('поважні')),
            array('id'=>3,'text'=>tt('чергування'),'group'=>tt('поважні')),
            array('id'=>4,'text'=>tt('інше'),'group'=>tt('поважні')),
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

    public function getInfoByElgzst0()
    {
        $sql=<<<SQL
             SELECT d2,d3,st2,st3,st4,r2
                FROM elgzst
                    LEFT JOIN elgp on (elgzst.elgzst0 = elgp.elgp1)
                    INNER JOIN elgz on (elgzst.elgzst2 = elgz.elgz1)
                    INNER JOIN elg on (elgz.elgz2 = elg.elg1)
                    INNER JOIN uo on (elg.elg2 = uo.uo1)
                    INNER JOIN d on (d.d1 = uo.uo3)
                    INNER JOIN r on (elgz.elgz1 = r.r8)
                    INNER JOIN nr on (r.r1 = nr.nr1)
                    INNER JOIN us on (nr.nr2 = us.us1)
                    INNER JOIN st on (elgzst.elgzst1 = st.st1)
                WHERE elgzst0=:ELGZST0 and d1 in (select d1 FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,2,0))
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ELGZST0', $this->elgzst0);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $res = $command->queryRow();
        return $res;
    }

    public function getAttendanceStatisticFor($st1, $start, $end, $monthStatistic)
    {
        if (empty($st1) || empty($start) || empty($end))
            return array();

        $sql=<<<SQL
                SELECT elgzst.*,r2,elgz3
                FROM elgzst
                inner join elgz on (elgzst2 = elgz1)
                inner join r on (elgz1 = r8)
                WHERE elgzst1=:ST1 and r2 >= :DATE1 and r2 <= :DATE2
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE1', $start);
        $command->bindValue(':DATE2', $end);
        $rows = $command->queryAll();

        $statistic = array();

        $statistic['summary'] = array(
            'td1' => 0,
            'td2' => 0,
            'td3' => 0,
        );

        $start = strtotime($start);
        $end   = strtotime($end);

        while($start <= $end) {

            $td1 = $td2 = $td3 = 0;
            foreach ($rows as $row) {

                $r2 = $row['r2'];
                $elgzst3 = $row['elgzst3'];

                $condition = $monthStatistic
                    ? date('Y-m-d', $start) == date('Y-m-d', strtotime($r2))
                    : date('Y-m', $start) == date('Y-m', strtotime($r2));

                if ($condition) {
                    $td1++;                  // whole
                    if ($elgzst3 == 1) $td2++; // with reason
                    if ($elgzst3 == 2) $td3++; // without reason
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
}
