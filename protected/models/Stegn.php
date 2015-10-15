<?php

/**
 * This is the model class for table "stegn".
 *
 * The followings are the available columns in table 'stegn':
 * @property integer $stegn1
 * @property integer $stegn2
 * @property integer $stegn3
 * @property integer $stegn4
 * @property double $stegn5
 * @property double $stegn6
 * @property string $stegn7
 * @property integer $stegn8
 *
 * The followings are the available model relations:
 * @property St $stegn10
 * @property Us $stegn20
 * @property P $stegn80
 */
class Stegn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stegn';
	}
        public $st2,$st3,$st4,$count_stego,$tema,$status,$stegn10,$stegn11,$stegnp4,$stegnp5,$group_st;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stegn1, stegn2, stegn3, stegn4, stegn8,stegn10', 'numerical', 'integerOnly'=>true),
			array('stegn5, stegn6', 'numerical'),
                        array('stegn9,stegn11,stegn7', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stegn1,st2,tema,group_st,status,count_stego, stegn2, stegn3, stegn4, stegn5, stegn6, stegn7, stegn8,stegn10,stegn9,stegn11', 'safe', 'on'=>'search'),
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
			'stegn10' => array(self::BELONGS_TO, 'St', 'stegn1'),
			'stegn20' => array(self::BELONGS_TO, 'Us', 'stegn2'),
			'stegn80' => array(self::BELONGS_TO, 'P', 'stegn8'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stegn1' => 'Stegn1',
			'stegn2' => 'Stegn2',
			'stegn3' => tt('Номер занятия'),
			'stegn4' => tt('Уваж./Неув.'),
			'stegn5' => 'Stegn5',
			'stegn6' => 'Stegn6',
			'stegn7' => 'Stegn7',
			'stegn8' => 'Stegn8',
            'stegn9' => tt('Дата'),
            'stegn10' => tt('Тип'),
            'stegn11' => tt('Номер справки'),
            'count_stego'=>tt('Количество отработок'),
            'tema'=>tt('Тема'),
            'group_st'=>tt('Группа'),
            'status'=>tt('Статус'),
            'stegnp4'=>tt('№ квитанции'),
            'stegnp5'=>tt('Дата квитанции')
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

		$criteria->compare('stegn1',$this->stegn1);
		$criteria->compare('stegn2',$this->stegn2);
		$criteria->compare('stegn3',$this->stegn3);
		$criteria->compare('stegn4',$this->stegn4);
		$criteria->compare('stegn5',$this->stegn5);
		$criteria->compare('stegn6',$this->stegn6);
		$criteria->compare('stegn7',$this->stegn7,true);
		$criteria->compare('stegn8',$this->stegn8);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
            return $this->count_stego==0||($this->stegn6<=$this->getMin()&&$this->stegn6!=-1);
            //return $this->stegn6<=$this->getMin()||$this->stegn6!=-1;
        }
        
        public function getType()
        {
            $arr=Stegn::model()->getTypes();
            if($this->stegn4<1)
                return '-';
            else
                if(isset($arr[$this->stegn10]))
                    return $arr[$this->stegn10];
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
        
        public function getStegn4()
        {
            $arr=Stegn::model()->getStegn4s();
            return $arr[$this->stegn4];
        }
        
        public function getStegn4s()
        {
            return array(0=>tt('Двойка'),1=>tt('Неув'),2=>tt('Уваж'));
        }
        
        public function searchRetake()
        {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria=new CDbCriteria;
            $table = St::model()->tableName();
            $table2 = Ustem::model()->tableName();
            $table3 = Stegnp::model()->tableName();
            $table4 = Gr::model()->tableName();
            $criteria->select = 't.*,gr.gr3 as group_st,'.$table.'.st2,'.$table.'.st3,'.$table.'.st4,stegnp2 as stegn10,stegnp3 as stegn11, (SELECT COUNT(*) FROM stego WHERE stego.stego1=t.stegn0) as count_stego,'.$table2.'.USTEM5 as tema';
            $criteria->join = 'LEFT JOIN '.$table2.' ON ('.$table2.'.USTEM2=t.stegn2 AND '.$table2.'.USTEM4= t.stegn3) ';
            $criteria->join .= 'LEFT JOIN '.$table3.' ON ('.$table3.'.stegnp1=t.stegn0) ';
            $criteria->join .= 'JOIN '.$table.' ON (t.stegn1='.$table.'.st1) ';
            $criteria->join .= 'JOIN std ON ('.$table.'.st1=std.std2) ';
            $criteria->join .= 'JOIN '.$table4.' ON (std.std3='.$table4.'.gr1) ';
            $criteria->addCondition("std7 is null and std11 in(0,5,6,8)");
            $criteria->compare('stegn1',$this->stegn1);
            $criteria->compare('stegn2',$this->stegn2);
            $criteria->compare('stegn3',$this->stegn3);
            $criteria->compare('stegn4',$this->stegn4);
            $criteria->compare($table3.'.stegnp3',$this->stegn11);
            $criteria->compare($table3.'.stegnp2',$this->stegn10);
            $criteria->addCondition("st2 CONTAINING '".$this->st2."'");
            if(!empty($this->tema))
                $criteria->addCondition("ustem5 CONTAINING '".$this->tema."'");
            if(!empty($this->group_st))
                $criteria->addCondition("gr3 CONTAINING '".$this->group_st."'");
            if(!empty($this->status))
            {
                if($this->status==1)
                    $criteria->addCondition("stegn6>'".$this->getMin()."' or stegn6=-1");
                else
                    $criteria->addCondition("(stegn6<'".$this->getMin()."' and stegn6!=-1)");
            }
            /*if(!empty($this->count_stego))
                $criteria->addCondition("count_stego =".$this->count_stego);*/
            $criteria->addCondition("(stegn4 > 0) OR (stegn5<=".Stegn::model()->getMin()." and stegn5>0)");
            //$criteria->compare('stegn7',$this->stegn7,true);
            //$criteria->compare('stegn9',$this->stegn9,true);
            ///$criteria->compare('stegn11',$this->stegn11,true);
            $sort = new CSort();
            $sort->sortVar = 'sort';
            $sort->defaultOrder = 'st2 ASC';
                    //$sort->route='progress/searchRetake?us1='+$this->stegn2;
                    $sort->attributes = array(
                            'st2'=>array(
                                'asc'=>$table.'.st2 ASC',
                                'desc'=>$table.'.st2 DESC',
                                'default'=>'ASC',
                            ),
                            'tema'=>array(
                                'asc'=>$table2.'.ustem5 ASC',
                                'desc'=>$table2.'.ustem5 DESC',
                                'default'=>'ASC',
                            ),
                            'stegn3'=>array(
                                'asc'=>'t.stegn3 ASC',
                                'desc'=>'t.stegn3 DESC',
                                'default'=>'ASC',
                            ),
                            'stegn4'=>array(
                                            'asc'=>'t.stegn4 ASC',
                                            'desc'=>'t.stegn4 DESC',
                                            'default'=>'ASC',
                            ),
                            'stegn9'=>array(
                                            'asc'=>'t.stegn9 ASC',
                                            'desc'=>'t.stegn9 DESC',
                                            'default'=>'ASC',
                            ),
                            'stegn10'=>array(
                                            'asc'=>$table3.'.stegnp3 ASC',
                                            'desc'=>$table3.'.stegnp3 DESC',
                                            'default'=>'ASC',
                            ),
                            'stegn11'=>array(
                                            'asc'=>$table3.'.stegnp3 ASC',
                                            'desc'=>$table3.'.stegnp3 DESC',
                                            'default'=>'ASC',
                            ),
                            'count_stego'=>array(
                                'asc'=>'count_stego asc',
                                'desc'=>'count_stego DESC',
                                'default'=>'ASC',
                            ),
                            'group_st'=>array(
                                'asc'=>'group_st asc',
                                'desc'=>'group_st DESC',
                                'default'=>'ASC',
                            )
                        );

                    $stegn = Stegn::model()->findAll($criteria);
            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                            'sort'=>$sort,
                            'pagination'=>array(
                                'pageSize'=> Yii::app()->user->getState('pageSize',10),
                            ),
            ));
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stegn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        public function getUs1ForOmissions($st1,$date1,$date2)
        {
            if (empty($st1) || empty($date1) || empty($date2))
                return array();

            $sql=<<<SQL
                    SELECT us1
                    FROM stegn
                        INNER JOIN us on (stegn.stegn2 = us.us1)
                        LEFT JOIN stegnp on (stegn.stegn0 = stegnp.stegnp1)
                        INNER JOIN uo on (us.us2 = uo.uo1)
                        INNER JOIN d on (d.d1 = uo.uo3)
                    WHERE stegn1=:STEG1 and stegn9 >= :DATE1 and stegn9 <= :DATE2 and stegn4!=0 and d1 in (select d1 FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,3,0))
                    group by us1
SQL;

            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':STEG1', $st1);
            $command->bindValue(':DATE1', $date1);
            $command->bindValue(':DATE2', $date2);
            $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
            $command->bindValue(':YEAR', Yii::app()->session['year']);
            $command->bindValue(':SEM', Yii::app()->session['sem']);
            $rows = $command->queryAll();
            $res=array();
            foreach($rows as $row)
            {
                array_push($res,$row['us1']);
            }
            return $res;
        }
         public function getOmissions($st1,$date1,$date2)
        {
            if (empty($st1) || empty($date1) || empty($date2))
            return array();

            $sql=<<<SQL
                SELECT stegn0,stegn1,stegn2,stegn3,stegn4,stegn9,stegnp2 as stegn10,stegnp3 as stegn11,stegnp4,stegnp5,d2,us4
                FROM stegn
                    INNER JOIN us on (stegn.stegn2 = us.us1)
                    LEFT JOIN stegnp on (stegn.stegn0 = stegnp.stegnp1)
                    INNER JOIN uo on (us.us2 = uo.uo1)
                    INNER JOIN d on (d.d1 = uo.uo3)
                WHERE stegn1=:STEG1 and stegn9 >= :DATE1 and stegn9 <= :DATE2 and stegn4!=0 and d1 in (select d1 FROM  EL_GURNAL(:P1,:YEAR,:SEM,0,0,0,0,3,0))
SQL;

            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':STEG1', $st1);
            $command->bindValue(':DATE1', $date1);
            $command->bindValue(':DATE2', $date2);
            $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
            $command->bindValue(':YEAR', Yii::app()->session['year']);
            $command->bindValue(':SEM', Yii::app()->session['sem']);
            $rows = $command->queryAll();
            return $rows;
        }
        
        public function getMarksForStudent($st1, $us1)
        {
            $raws = Yii::app()->db->createCommand()
                ->select('*')
                ->from('stegn')
                ->where(array('in', 'stegn2', $us1))
                ->andWhere('stegn1 = :ST1', array(':ST1' => $st1))
                ->queryAll();

            $res = array();
            foreach($raws as $raw) {
                $key = $raw['stegn2'].'/'.$raw['stegn3'];
                $res[$key] = $raw;
            }

            return $res;
        }
        
        public function insertMark($stegn1,$stegn2,$stegn3,$field,$value,$stegn9){
            $stegn=  Stegn::model()->findByAttributes(array('stegn1'=>$stegn1,'stegn2'=>$stegn2,'stegn3'=>$stegn3));
            if($stegn!=null)
            {
                $attr = array(
                    $field => $value,
                    'stegn8' =>  Yii::app()->user->dbModel->p1,
                    'stegn7' =>  date('Y-m-d H:i:s'),
                );
                $stegn->saveAttributes($attr);
            }else
            {
                
                if ($field == 'stegn4')
                {
                    $sql = <<<SQL
                        INSERT INTO stegn (stegn0,stegn1,stegn2,stegn3,stegn4,stegn7,stegn8,stegn9) VALUES (gen_id(GEN_STEGN,1),:st1,:us1,:nom,:value,current_timestamp,:p1,:stegn9);
SQL;
                    if($value==0)
                    {
                        $value=1;
                    }
                    else {
                        $value=0;
                    } 
                }
                elseif ($field == 'stegn5')
                    $sql = <<<SQL
                        INSERT INTO stegn (stegn0,stegn1,stegn2,stegn3,stegn5,stegn7,stegn8,stegn9) VALUES (gen_id(GEN_STEGN,1),:st1,:us1,:nom,:value,current_timestamp,:p1,:stegn9);
SQL;
                elseif ($field == 'stegn6')
                    $sql = <<<SQL
                        INSERT INTO stegn (stegn0,stegn1,stegn2,stegn3,stegn6,stegn7,stegn8,stegn9) VALUES (gen_id(GEN_STEGN,1),:st1,:us1,:nom,:value,current_timestamp,:p1,:stegn9);
SQL;
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':st1', $stegn1);
                $command->bindValue(':us1', $stegn2);
                $command->bindValue(':nom', $stegn3);
                $command->bindValue(':value', $value);
                $command->bindValue(':stegn9', $stegn9);
                $command->bindValue(':p1', Yii::app()->user->dbModel->p1);
                $command->execute();
            }
        }
        
         public function getAttendanceStatisticFor($st1, $start, $end, $monthStatistic)
        {
            if (empty($st1) || empty($start) || empty($end))
                return array();

            $sql=<<<SQL
                SELECT *
                FROM stegn
                WHERE stegn1=:STEGN1 and stegn9 >= :DATE1 and stegn9 <= :DATE2
SQL;

            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':STEGN1', $st1);
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

                    $stegn9 = $row['stegn9'];
                    $stegn4 = $row['stegn4'];

                    $condition = $monthStatistic
                                    ? date('Y-m-d', $start) == date('Y-m-d', strtotime($stegn9))
                                    : date('Y-m', $start) == date('Y-m', strtotime($stegn9));

                    if ($condition) {
                        $td1++;                  // whole
                        if ($stegn4 == 1) $td2++; // with reason
                        if ($stegn4 == 2) $td3++; // without reason
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
        
        public function getAttendanceStatisticOldFor($st1, $start, $end, $monthStatistic)
        {
            if (empty($st1) || empty($start) || empty($end))
                return array();

            $sql=<<<SQL
                SELECT *
                FROM stpz
                WHERE stpz1=:stpz1 and stpz2 >= :DATE1 and stpz2 <= :DATE2
SQL;

            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':stpz1', $st1);
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

                    $stpz2 = $row['stpz2'];
                    $stpz3 = $row['stpz3'];
                                    $stpz4 = $row['stpz4'];

                    $condition = $monthStatistic
                                    ? date('Y-m-d', $start) == date('Y-m-d', strtotime($stpz2))
                                    : date('Y-m', $start) == date('Y-m', strtotime($stpz2));

                    if ($condition) {
                        //$td1++;                  // whole
                        //if ($steg6 == 1) $td2++; // with reason
                        //if ($steg6 == 2) $td3++; // without reason
                                            $td2+=$stpz3;
                                            $td3+=$stpz4;
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
