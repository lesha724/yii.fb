<?php

/**
 * This is the model class for table "st".
 *
 * The followings are the available columns in table 'st':
 * @property integer $st1
 * @property string $st5
 * @property integer $st29
 * @property integer $st34
 * @property string $st38
 * @property integer $st63
 * @property string $st66
 * @property integer $st99
 * @property integer $st101
 * @property integer $st103
 * @property integer $st104
 * @property string $st107
 * @property integer $st114
 * @property string $st126
 * @property string $st131
 * @property string $st132
 * @property integer $st139
 * @property integer $st144
 * @property string $st145
 * @property string $st146
 * @property string $st147
 * @property string $st148
 * @property integer $st149
 * @property string $st167
 * @property string $st168
 * @property integer $st169
 * @property integer $st200
 *
 * @property string $fullName
 * @property string $shortName
 *
 * @property Person $person
 * @property Elgvst $elgvst
 * @property Stbl $stbl
 * @property Stusv[] $stusvs
 * @property Stdist $stdist
 * @property Dispdist[] $dispdists
 * @property Zrst[] $zrsts
 * @property Ants[] $ants
 * @property Antio[] $antios
 *
 */
class St extends CActiveRecord implements IPerson
{
    /**
     * for @see getStudentsForAdmin
     * @var int
     */
    public $st_status;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'st';
	}

    /**
     * сокращенное имя
     * @return null|string
     */
    public function getShortName(){
        if($this->person == null)
            return null;
        return $this->person->shortName;
    }

    /**
     * полное имя
     * @return null|string
     */
	public function getFullName(){
	    if($this->person == null)
	        return null;
	    return $this->person->fullName;
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
			array('st_status, st1, st29, st34, st63, st101, st103, st104, st114, st115, st99, st139, st144, st167, 168', 'numerical', 'integerOnly'=>true),
			array('st131, st132', 'length', 'max'=>80),
			array('st5, st148', 'length', 'max'=>60),
			array('st66', 'length', 'max'=>4),
			array('st145, st146, st147', 'length', 'max'=>8),
			array('st126', 'length', 'max'=>24),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('st1,st5, st29, st34, st38, st63, st66, st101, st103, st104, st107,st99, st126, st131, st132, st139, st144, st145, st146, st147, st148', 'safe', 'on'=>'search'),
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
            'person' => array(self::BELONGS_TO, 'Person', 'st200'),
            'elgvst' => array(self::HAS_ONE, 'Elgvst', 'elgvst1'),
            'stbl' => array(self::HAS_ONE, 'Stbl', 'stbl2'),
            'stusvs' => array(self::MANY_MANY, 'Stusv', 'stusvst(stusvst3, stusvst1)'),
            'stdist' => array(self::HAS_ONE, 'Stdist', 'stdist1'),
            'dispdists' => array(self::MANY_MANY, 'Dispdist', 'stdistsub(stdistsub1, stdistsub2)'),
            'ants' => array(self::HAS_MANY, 'Ants', 'ants1'),
            'antios' => array(self::HAS_MANY, 'Antio', 'antio1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'st1' => 'St1'
		);
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

    public function checkPassport($id,$type)
    {
        return Passport::model()->countByAttributes(array(
            'passport2' => $id,
            'passport3' => $type
        )) > 0;
    }

    public function getInfoForStudentInfoExcel($st1)
    {
        if (empty($st1))
            return array();
        list($sg40, $sg41) =D::model()->getSg40Sg41($st1);

        $sql = /** @lang text */
        <<<SQL
        SELECT gr1,gr3,sem4,sg4,gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26,f2,f3 FROM std
			inner join gr on (std.std3 = gr.gr1)
			inner join sg on (gr.gr2 = sg.sg1)
			inner join sp on (sg.sg2 = sp.sp1)
			inner join f on (sp.sp5= f.f1)
			inner join sem on (sg.sg1 = sem.sem2)
		where std7 is null and std11 in (0, 5, 6, 8) and sem3=:YEAR1 and sem5=:SEM1 and std2=:st1
		GROUP BY gr1,gr3,sem4,sg4,gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26,f2,f3
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':st1', $st1);
        $command->bindValue(':YEAR1', $sg40);
        $command->bindValue(':SEM1', $sg41);
        $res= $command->queryRow();
        $res['name']=Gr::model()->getGroupName($res['sem4'], $res);
        return $res;
    }

    /**
     * поиск студентов по имени
     * @param $name
     * @return array
     * @throws CException
     */
    public function getSearchStudents($name)
    {
        if (empty($name))
            return array();
			
		list($year, $sem) = SH::getCurrentYearAndSem();

		$where="";
		if(Yii::app()->core->universityCode==U_NULAU)
            $where = "AND f1!=5";

		$sql = /** @lang text */
            <<<SQL
        SELECT st1,pe1,pe2,pe3,pe4,gr1,gr3,f1,f2,ks1,ks3,sem4,sg1,sp1,pnsp1, gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26 FROM ks
			inner join f on (ks.ks1 = f.f14)
			inner join sp on (f.f1 = sp.sp5)
            inner join pnsp on (sp.sp11 = pnsp.pnsp1)
			inner join sg on (sp.sp1 = sg.sg2)
			inner join gr on (sg.sg1 = gr.gr2)
			inner join std on (gr.gr1 = std.std3)
			inner join st on (std.std2 = st.st1)
			inner join pe on (st.st200 = pe.pe1)
			inner join sem on (sg.sg1 = sem.sem2)
		where std7 is null and std11 in (0, 5, 6, 8) and pe2 CONTAINING :name and sem3=:YEAR1 and sem5=:SEM1 and st101!=7 {$where}
		GROUP BY st1,pe1,pe2,pe3,pe4,gr1,gr3,f1,f2,ks1,ks3,sem4,sg1,sp1,pnsp1, gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26
        ORDER BY st2 collate UNICODE,ks3,gr3,f2
SQL;
		$command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':name', $name);
		$command->bindValue(':YEAR1', $year);
        $command->bindValue(':SEM1', $sem);
        $students= $command->queryAll();
		foreach($students as $key => $student) {
            $students[$key]['group_name'] = Gr::model()->getGroupName($students[$key]['sem4'], $student);
        }
        return $students;
    }
	
    public function getStudentsForAdmin()
    {
        $criteria=new CDbCriteria;

        $criteria->join = 'INNER JOIN std ON st1=std2 and std7 is null';

        $criteria->select = array( 't.st2', 't.st3', 't.st4', 't.st15','std11 as st_status');
        $with = array(
            'account' => array(
                'select' => 'u2, u3, u4'
            ),
        );

        $criteria->addCondition("st1 > 0");
        $criteria->addCondition("st2 <> ''");
		$criteria->addCondition("st101 != 7");

		$criteria->addCondition("std11 != 1"); //std11 = 4,2 закончил
        if(!empty($this->st2))
		    $criteria->addCondition('st2 CONTAINING :ST2');
        if(!empty($this->st3))
		    $criteria->addCondition('st3 CONTAINING :ST3');
        if(!empty($this->st4))
		    $criteria->addCondition('st4 CONTAINING :ST4');
        if(!empty($this->st15))
            $criteria->addCondition('st15 = :ST15');

        if($this->st_status>0) {
            if($this->st_status==1)
                $criteria->addCondition('std11!=4 and std11!=2');
            if($this->st_status==2)
                $criteria->addCondition(' ( std11=4 or std11=2)');
        }
		
        $login = Yii::app()->request->getParam('login');
        $email = Yii::app()->request->getParam('email');

        if(!empty($login))
            $criteria->addCondition('account.u2 CONTAINING :LOGIN');
        if(!empty($email))
            $criteria->addCondition('account.u4 CONTAINING :EMAIL');
        //$criteria->addSearchCondition('account.u2', );
        //$criteria->addSearchCondition('account.u4', );

        $criteria->with = $with;

        $criteria->params = array(
            ':ST2'=>$this->st2,
            ':ST3'=>$this->st3,
            ':ST4'=>$this->st4,
            ':ST15'=>$this->st15,
            ':LOGIN' => $login,
            ':EMAIL' => $email
        );

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',10),
				'currentPage'=> Yii::app()->user->getState('CurrentPageSt',null),
            ),
            'sort' => array(
                'defaultOrder' => 'st2 collate UNICODE,st3 collate UNICODE,st4 collate UNICODE',
                'attributes' => array(
                    'st2',
                    'st3',
                    'st4',
                    'st15',
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

        $criteria->select = 't.st1, t.st2, t.st3, t.st4';

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
                'defaultOrder' => 'st2 collate UNICODE',
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

    /**
     * получить данные по студенту для карточки
     * @return mixed
     * @throws CException
     */
    public function getStudentInfoForCard(){

	    $sql = /** @lang text */
	    <<<SQL
		 select sg1,sg2,sg4,gr1,gr3,sp1,sp2,sem4,f2,f3,gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26,gr28,sgr2
		   from sem
			   inner join sg on (sem.sem2 = sg.sg1)
			   inner join gr on (sg.sg1 = gr.gr2)
			   inner join std on (gr.gr1 = std.std3)
			   inner join st on (std.std2 = st.st1)
			   inner join pe on (st.st200 = pe.pe1)
			   inner join sgr on (pe.pe30 = sgr.sgr1)
			   inner join sp on (sg.sg2 = sp.sp1)
			   INNER JOIN f on (sp.sp5 = f.f1)
		   where st1=:ST1 AND sem3=:YEAR and sem5=:SEM and std11 in (0,5,6,8) and std7 is null
SQL;

		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $this->st1);
		$command->bindValue(':YEAR', Yii::app()->session['year']);
		$command->bindValue(':SEM', Yii::app()->session['sem']);
		$info = $command->queryRow();

		return $info;
	}

    /**
     * Поулчить ланніе по стуленту дял портфолио
     * @return mixed
     * @throws CException
     */
    public function getStudentInfoForPortfolio(){
        $sql = /** @lang text */
            <<<SQL
		 select first 1 sg1,sg2,sg4,gr1,gr3,sp1,sp2,sem4,f2,f3,gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26,gr28,sgr2,spc4,sp4
		   from sem
			   inner join sg on (sem.sem2 = sg.sg1)
			   inner join gr on (sg.sg1 = gr.gr2)
			   inner join std on (gr.gr1 = std.std3)
			   inner join st on (std.std2 = st.st1)
			   inner join pe on (st.st200 = pe.pe1)
			   inner join sgr on (pe.pe30 = sgr.sgr1)
			   inner join sp on (sg.sg2 = sp.sp1)
			   INNER JOIN spc on (gr.gr8=spc.spc1)
			   INNER JOIN f on (sp.sp5 = f.f1)
		   where st1=:ST1 and std11 in (0,5,6,8) and std7 is null
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $this->st1);
        $info = $command->queryRow();

        return $info;
    }

	/**
	 * Список студентов по группе дял журнала
	 * @param $gr1
	 * @param $uo1
	 * @return mixed
	 */
    public function getStudentsForJournal($gr1, $uo1)
    {
        $year = Yii::app()->session['year'];
        $sem = Yii::app()->session['sem'];
        $date = $sem == 1 ? '31.05.'.($year+1) : '20.01.'.($year+1);

        $sql = <<<SQL
       select t.st1,st.st2,st.st3,st.st4,st.st45,st.st71,st.st163,st.st167, elgvst2, elgvst3
        from (select listst.st1,listst.gr1,listst.std11,ucx1 from listst(:DATE_1,:YEAR,:SEM,0,0,0,0,0,0) where (listst.gr1=:GR1 or listst.gr1_virt=:GR1_VIRT) and listst.std11 in (0,6,8) ) t
            inner join st on (t.st1 = st.st1)
            inner join ucx on (t.ucx1 = ucx.ucx1)
            inner join uo on (ucx.ucx1 = uo19)
            left join elgvst on (st.st1 = elgvst1)
        where uo1=:UO1 and st101!=7
        group by st1,st2,st3,st4,st45,st71,st163,st167, elgvst2, elgvst3
        order by st2 collate UNICODE
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':GR1_VIRT', $gr1);
        $command->bindValue(':UO1', $uo1);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $command->bindValue(':DATE_1', $date);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * статистика посещаемость, просомтр пропусков по студенту
     * @param $st1
     * @param $sem1
     * @return array
     * @throws CException
     */
	public function getStatisticForStudent($st1, $sem1)
    {
		list($firstDay, $lastDay) = Sem::model()->getSemesterStartAndEnd($sem1);

		$sql= /** @lang text */
            <<<SQL
                SELECT proc.*, rz8
                FROM el_gurnal_info(0,0, :DATE1, :DATE2, 0, 0, :ST1,0,0) proc
                 INNER JOIN rz on (r4 = rz1)
                 WHERE propusk in (1,2) ORDER by r2 DESC
SQL;

		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':DATE1', $firstDay);
		$command->bindValue(':DATE2', $lastDay);
        return $command->queryAll();
    }

    /**
     * Получить старосту группы
     * @param $gr1
     * @return null|static
     */
    public function getStarostaFromGr1($gr1)
    {
        $sql = <<<SQL
            select st.*
            from st
               inner join sst on (st1 = sst2)
            where sst3=:GR1
SQL;
        return $this->findBySql($sql, array(':GR1' => $gr1));
    }

    public function getStudentsOfGroupForPortfolio($gr1)
    {
        if (empty($gr1))
            return array();

        $sql=<<<SQL
            SELECT ST1,st200
            FROM st
            inner join pe on (st.st200 = pe.pe1)
            INNER JOIN std on (st.st1 = std.std2)
            WHERE st101<>7 and STD3=:GR1 and STD11 in (0,4,5,6,8) and (STD7 is null)
            ORDER BY ST2 collate UNICODE
SQL;

        return St::findAllBySql($sql, array(
            ':GR1' => $gr1
        ));
    }

    /**
     * Список студентов группы
     * @param $gr1
     * @return array|static[]
     */
    public function getStudentsOfGroup($gr1)
    {
        if (empty($gr1))
            return array();

        $sql= /** @lang text */
            <<<SQL
            SELECT st1, st200
			 FROM ST
			   LEFT JOIN SK ON (SK.SK2 = ST.ST1)
			   LEFT JOIN STD ON (ST.ST1 = STD.STD2)
			 WHERE std7 is null and sk5 is null and std11 in (0,5,6,8) and std3=:gr1 and st101!=7
			 ORDER BY st2 collate UNICODE
SQL;
        return static::findAllBySql($sql, array(':gr1'=>$gr1));
    }

    /**
     * @param $gr1
     * @return array|St[]
     */
    public function getStudentsOfGroupForDistEducation($gr1)
    {
        if (empty($gr1))
            return array();

        $sql=<<<SQL
            SELECT ST1,St200
            FROM st
            INNER JOIN std on (st.st1 = std.std2)
            LEFT JOIN stdist on (st1 = STDIST1)
            WHERE st101<>7 and STD3=:GR1 and STD11 in (0,5,6,8) and (STD7 is null)
            ORDER BY ST2 collate UNICODE
SQL;

        $students = self::findAllBySql($sql, array(
           ':GR1' => $gr1
        ));

        return $students;
    }

    /**
     * СТуденты записаные на курс
     * @param $gr1
     * @return array|St[]
     */
    public function getStudentsForDistEducationCourse($courseId)
    {
        if (empty($courseId))
            return array();

        $sql=<<<SQL
            SELECT ST1,pe2,pe3,pe4,gr1, gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26,sem4,stdist2
            FROM st
            inner join pe on (st.st200 = pe.pe1)
            INNER JOIN std on (st.st1 = std.std2)
            INNER JOIN STDISTSUB on (st1 = STDISTSUB1)
            INNER JOIN STDIST on (st1 = STDIST1)
            INNER JOIN GR ON (STD.STD3 = GR.GR1)
            INNER JOIN SEM on (SEM.SEM3 = :YEAR and SEM.SEM5 = :SEM and sem.SEM2 = gr.gr2)
            WHERE st101<>7 and STDISTSUB2=:COURSE and STD11 in (0,5,6,8) and (STD7 is null)
            ORDER BY ST2 collate UNICODE
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':COURSE', $courseId);
        $command->bindValue(':YEAR',  Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * @param $gr1
     * @param $type
     * @return array
     * @throws CException
     */
	public function getStudentsOfGroupForPayment($gr1, $type)
	{
		if (empty($gr1))
			return array();
		if($type==0) { //общежите
			$sql = <<<SQL
            SELECT ST1,pe2,pe3,pe4
				FROM st
				inner join pe on (st.st200 = pe.pe1)
				INNER JOIN std on (st.st1 = std.std2)
				WHERE st101<>7 and STD3=:GR1 and STD11 in (0,5,6,8) and (STD7 is null) and st66=1
				ORDER BY ST2 collate UNICODE
SQL;
		}else{//оючучение
			$sql = <<<SQL
				SELECT ST1,pe2,pe3,pe4
				FROM st
				inner join pe on (st.st200 = pe.pe1)
				INNER JOIN std on (st.st1 = std.std2)
				LEFT JOIN SK ON (SK.SK2 = ST.ST1)
				WHERE st101<>7 and STD3=:GR1 and STD11 in (0,5,6,8) and (STD7 is null) and sk5 is null and sk3=1
				ORDER BY ST2 collate UNICODE
SQL;

		}

		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':GR1', $gr1);
		$students = $command->queryAll();

		foreach($students as $key => $student) {
			$students[$key]['name'] = SH::getShortName($student['pe2'], $student['pe3'], $student['pe4']);
		}

		return $students;
	}

    /**
     * Список студентов по курсу
     * @param $sg1
     * @return array
     * @throws CException
     */
    public function getListStream($sg1){
        $sql=<<<SQL
            SELECT st1,pe2,pe3,pe4,st5,sk3 gr1, gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26
			 FROM ST
			  INNER JOIN pe on (st200 = pe1)
			   INNER JOIN SK ON (SK.SK2 = ST.ST1)
			   INNER JOIN STD ON (ST.ST1 = STD.STD2)
			   INNER JOIN GR ON (STD.STD3 = GR.GR1)
			 WHERE std7 is null and sk5 is null and std11 in (0,5,6,8) and gr2=:SG1 and st101!=7
			 ORDER BY pe2 collate UNICODE
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1', $sg1);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * список группы
     * @param $gr1
     * @return array
     * @throws CException
     */
	public function getListGroup($gr1)
    {
        $sql=<<<SQL
            SELECT st1,pe2,pe3,pe4,st5,sk3
			 FROM ST
			   INNER JOIN pe on (st200 = pe1)
			   LEFT JOIN SK ON (SK.SK2 = ST.ST1)
			   LEFT JOIN STD ON (ST.ST1 = STD.STD2)
			 WHERE std7 is null and sk5 is null and std11 in (0,5,6,8) and std3=:gr1 and st101!=7
			 ORDER BY pe2 collate UNICODE
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':gr1', $gr1);
        $students = $command->queryAll();
        return $students;
    }

    /**
     * @param $gr1
     * @return array
     * @throws CException
     */
    public function getOpprezByGroup($gr1)
    {
        $students = $this->getListGroup($gr1);

        foreach ($students as $key => $student){
            $students[$key]['oprrez'] = Oprrez::model()->findBySql(/** @lang text */
                <<<SQL
              SELECT * FROM oprrez WHERE oprrez2=:ST1 ORDER BY oprrez4 DESC
SQL
            , array(
                ':ST1' => $student['st1']
            ));
        }

        return $students;
    }

    /**
     * Список виртуальной группы
     * @param $gr1
     * @return array
     * @throws CException
     */
	public function getListVirtualGroup($gr1)
	{
		$sql=<<<SQL
            SELECT st1,pe1,pe2,pe3,pe4,st5,sk3,gr3, gr19,gr20,gr21,gr22,gr23,gr24,gr28
            from ucxg
               inner join ucgn on (ucxg.ucxg2 = ucgn.ucgn1)
               inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
               inner join ucsn on (ucgns.ucgns1 = ucsn.ucsn1)
               inner join st on (ucsn.ucsn2 = st.st1)
               INNER JOIN pe on (st200 = pe1)
               inner join std on (st.st1 = std.std2)
               inner join gr on (std.std3 = gr.gr1)
               inner JOIN SK ON (SK.SK2 = ST.ST1 and sk5 is null)
            where ucgns5=:YEAR and ucgns6=:SEM and ucgn2=:GR1 and UCXG3=0 and std11<>1 and std4<=current_timestamp and (std7 is null or std7>=current_timestamp)
            group by st1,pe1,pe2,pe3,pe4,st5,sk3,gr3, gr19,gr20,gr21,gr22,gr23,gr24,gr28
            order by pe2 collate UNICODE
SQL;

		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':GR1', $gr1);
		$command->bindValue(':YEAR', Yii::app()->session['year']);
		$command->bindValue(':SEM', Yii::app()->session['sem']);
		$students = $command->queryAll();

		return $students;
	}

	public function getStudentsOfUo($uo1,$year,$sem)
	{
		if (empty($uo1))
			return array();

		$sql = <<<SQL
          select gr.gr1,gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr28,pe2||' '||pe3||' '||pe4||' ' as stud,sem4,gr7, st.st1
            from LISTST(current_timestamp,:sem3,:sem5,5,0,0,0,:uo1,0)
               inner join st on (LISTST.st1 = st.st1)
               INNER JOIN pe on (st200 = pe1)
               inner join gr on (LISTST.gr1 = gr.gr1)
            where st101!=7
            GROUP BY gr.gr1,gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr28,pe2,pe3,pe4,sem4,gr7, st.st1
            ORDER BY gr7,gr3,pe2 collate UNICODE
SQL;


		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':uo1', $uo1);
		$command->bindValue(':sem3', $year);
		$command->bindValue(':sem5', $sem);
		$students = $command->queryAll();

		return $students;
	}

	public function getStudentsOfNr($nr1)
    {
        if (empty($nr1))
            return array();

        $sql = <<<SQL
            select LISTST.gr1,gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr28,pe2||' '||pe3||' '||pe4||' ' as stud,sem4, st.st1
            from LISTST(current_timestamp,0,0,6,0,0,0,0,:nr1)
               inner join st on (LISTST.st1 = st.st1)
               INNER JOIN pe on (st200 = pe1)
               inner join gr on (LISTST.gr1 = gr.gr1)
            where std11 in (0,5,6,8) and st101!=7
            ORDER BY gr7,gr3,st2 collate UNICODE
SQL;


        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':nr1', $nr1);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * Расписание студента
     * @param $st1
     * @param $date1
     * @param $date2
     * @return array
     * @throws CException
     */
    public static function getTimeTable($st1, $date1, $date2)
    {
        if (empty($st1))
            return array();

        $sql = /** @lang text */
            <<<SQL
        SELECT *
        FROM RASP(:LANG, 0, :ST1, 0, 0, 0, :DATE_1, :DATE_2, 1)
        ORDER BY r2,r3,rz2, d3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':LANG', TimeTableForm::getLangCode());
        $command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE_1', $date1);
        $command->bindValue(':DATE_2', $date2);
        $timeTable = $command->queryAll();

        if (empty($timeTable))
            return array();

        return $timeTable;
    }

    public function getStudentsAmountFor($gr1, $nr1)
    {
        $sql = <<<SQL
          SELECT count(distinct st1)
            from LISTST(current_timestamp,0,0,6,0,0,0,0,:NR1)
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':NR1', $nr1);
        $amount = $command->queryScalar();

        return $amount;
    }

    /**
     * Получение кода группы(возможно вирутальной) по студенту по году сметсру и дисциплине
     * @param $st1 {int} код студента
     * @param $uo19 {int}
     * @param $year {int} год
     * @param $sem {int} семестр
     * @return int
     * @throws CException
     */
	public function getGroupByStudent($st1,$uo19,$year,$sem){
        $date = $sem == 1 ? '31.05.'.($year+1) : '20.01.'.($year+1);

		$sql = /** @lang text */
            <<<SQL
		select first 1 LISTST.gr1, gr3, listst.GR1_VIRT
        from LISTST(:DATE_1,0,0,7,0,:ST1,0,0,0)
           inner join gr on (LISTST.gr1_virt = gr.gr1)
           inner join ug on (gr.gr1 = ug.ug2)
           inner join nr on (ug.ug1 = nr.nr1)
           inner join us on (nr.nr2 = us.us1)
           inner join uo on (us.us2 = uo.uo1)
           inner join sem on (us.us3 = sem.sem1)
        where uo19=:UO19 and sem3=:YEAR and sem5=:SEM
SQL;

		$command= Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
        $command->bindValue(':DATE_1', $date);
		$command->bindValue(':UO19', $uo19);
		$command->bindValue(':YEAR', $year);
		$command->bindValue(':SEM', $sem);
		$row = $command->queryRow();


		return empty($row['gr1_virt']) ? $row['gr1'] : $row['gr1_virt'];
	}

	public function getGr1BySt1($st1)
	{
		$sql=<<<SQL
            SELECT first 1 gr1
                FROM gr
                  INNER JOIN std on (gr.gr1 = std.std3)
                  INNER JOIN st on (std.std2 = st.st1)
                WHERE st1=:ST1 and (std7 is null or (std7>current_timestamp) ) and std11 in (0,5,6,8)
SQL;
		$command= Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$gr1 = $command->queryScalar();
		return $gr1;
	}

    public function getSubscriptionParams()
    {
        $sql = <<<SQL
            SELECT sg1 as SG1_KOD, gr1 as GR1_KOD, sg40 as UCH_GOD, sg41 as SEMESTER, sg38 as DATA_NACHALA
            FROM gr
            INNER JOIN std on (gr.gr1 = std.std3)
            INNER JOIN st on (std.std2 = st.st1)
            INNER JOIN sg on (gr2 = sg1)
            WHERE st1=:ST1 and std7 is null and std11 in (0,5,6,8) and sg38<=current_timestamp and sg39>=current_timestamp
SQL;
        $command  = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $this->st1);
        $params = $command->queryRow();
		//$params['SEMESTER']=0;
        return $params;
    }

    private function sortByAvg($a, $b)
    {
        if ($a['avg'] == $b['avg']) {
            return 0;
        }
        return ($a['avg'] > $b['avg']) ? -1 : 1;
    }

    /**
     * получить код потока по студенту
     * @param $st1
     * @return int
     */
    public function getSg1BySt1($st1){
        if (empty($st1))
            return null;
        list($sg40, $sg41) =D::model()->getSg40Sg41($st1);

        $sql = <<<SQL
        SELECT sg1 FROM std
			inner join gr on (std.std3 = gr.gr1)
			inner join sg on (gr.gr2 = sg.sg1)
			inner join sem on (sg.sg1 = sem.sem2)
		where std7 is null and std11 in (0, 5, 6, 8) and sem3=:YEAR1 and sem5=:SEM1 and std2=:st1
		GROUP BY sg1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':st1', $st1);
        $command->bindValue(':YEAR1', $sg40);
        $command->bindValue(':SEM1', $sg41);
        $res= $command->queryScalar();
        return $res;
    }

	public function enableSubcription($st1){
		$sql = <<<SQL
		select count(sg1)
			from gr
			   inner join std on (gr.gr1 = std.std3)
			   inner join st on (std.std2 = st.st1)
			   inner join sg on (gr2 = sg1)
			where st1=:ST1 and std7 is null and std11 in (0,5,6,8) and sg38<=current_timestamp and sg39>=current_timestamp
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$count = $command->queryScalar();

		return $count>0;
	}
	/*
	 * являеться ли текущий студент старостой
	 * возращает группу
	 * */
	public function isSst(){
		$sql = <<<SQL
		select *
			from sst
		where SST2=:ST1 and sst6 is null
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $this->st1);
		$row = $command->queryRow();

		return $row;
	}


    /**
     * являеться ли текущий студент старостой для группы(возможн овиртуальной)
     * @param $gr1 int код группы
     * @return bool
     */
    public function isSstByGroup($gr1){
        $sql = <<<SQL
            select st1
                from LISTST(current_timestamp,0,0,7,0,:ST1,0,0,0)
                   inner join sst on (LISTST.gr1 = sst.sst3)
                where sst.sst2 = :ST1 and sst6 is null and LISTST.gr1_virt=:GR1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $this->st1);
        $command->bindValue(':GR1', $gr1);
        $row = $command->queryRow();

        return !empty($row);
    }

    /**
     * статистика посещаемости по потокм (поулчить всех студентов по потоку)
     * @param $sp1
     * @param $course
     * @param $year
     * @param $sem
     * @return mixed
     */
    public function getStudentsBySpeciality($sp1,$course,$year, $sem){
        $sql=<<<SQL
            SELECT st1,st2,st3,st4,gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr28
			 FROM ST
			   INNER JOIN STD ON (ST.ST1 = STD.STD2)
			   INNER JOIN gr on (std.std3 = gr.gr1)
			   INNER JOIN sg on (gr.gr2 = sg.sg1)  
               inner join sem on (sg.sg1 = sem.sem2)
			 WHERE gr13=0 and sg2=:sp1 and sem4=:sem4 and sem3=:YEAR and sem5=:SEM and std7 is null and std11 in (0,5,6,8) and st101!=7
			 ORDER BY gr3 ASC,st2 collate UNICODE
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':sp1', $sp1);
        $command->bindValue(':sem4', $course);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * Историй записи на курсовые
     * @return mixed
     */
    public function getNkrsList(){
        $sql=<<<SQL
            select 
                nkrs1,
                nkrs6,
                sem4,
                p3,
                p4,
                p5,
                spkr2,
                k2,sp14
            from (
                  select first 1 sp14,sp1
                  from sp
                     inner join sg on (sp.sp1 = sg.sg2)
                     inner join gr on (sg.sg1 = gr.gr2)
                     inner join std on (gr.gr1 = std.std3)
                  where std2=:ST1 and std7 is null and std11 in (0,5,6,8)
                  )
               inner join sg on (sp1 = sg.sg2)
               inner join sem on (sg.sg1 = sem.sem2)
               inner join us on (sem.sem1 = us.us3)
               inner join uo on (us.us2 = uo.uo1)
               inner join k on (uo.uo4 = k.k1)
               inner join nkrs on (us.us1 = nkrs.nkrs3)
               inner join spkr on (nkrs.nkrs7 = spkr.spkr1)
               inner join p on (nkrs.nkrs6 = p.p1)
            where nkrs2=:ST1_1
            order by sem3,sem5
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $this->st1);
        $command->bindValue(':ST1_1', $this->st1);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * Проверка заблокирован ли преподаватель
     * @return bool
     */
    public function checkBlocked()
    {
        if($this->isNewRecord)
            return true;

        $sql = <<<SQL
              SELECT COUNT(*) FROM STD 
              WHERE std11 in (0,3,5,6,8) and std7 is null and STD2=:ST1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ST1', $this->st1);
        $count = $command->queryScalar();

        return empty($count) || $count==0;
    }

    /**
     * Проверка может ли студент отправить работу в аптиплагиат
     * @param $year int
     * @return bool
     */
    public function checkAntiplagiatAccess($year){
        if(empty($this->st1))
            return false;

        return $this->_checkAntioCount( $this->getAntio($year)->getAttribute('antio3'), $year);
    }

    /**
     * @param $year
     * @return int
     */
    public function getLimitCountAntiplagiat($year){
        $stModel = Ants::model()->findByAttributes(array('ants1'=>$this->st1, 'ants2'=>$year));

        if($stModel!=null){
            return $stModel->ants3;
        }

        $sg1 = self::model()->getSg1BySt1($this->st1);
        if(empty($sg1))
            return 2;

        $sgModel = Antsg::model()->findByAttributes(array('antsg1'=>$sg1, 'antsg2'=>$year));

        if($sgModel==null){
            $sgModel = new Antsg();
            $sgModel->antsg1 = $sg1;
            $sgModel->antsg2 = $year;
            $sgModel->antsg3 = 2;

            $sgModel->save();
        }

        return $sgModel->antsg3;
    }

    /**
     * Проверка доступа к антиплагиату
     * @param $currentCount int текущее количество
     * @param $year int Год
     * @return bool
     */
    private function _checkAntioCount($currentCount, $year)
    {
        return $this->getLimitCountAntiplagiat($year) > $currentCount ;
    }

    /**
     * Получить модельку с текущим количетсвом
     * @param $year
     * @return Antio|static
     */
    public function getAntio($year){
        $model = Antio::model()->findByAttributes(array(
            'antio1' => $this->st1,
            'antio2' => $year
        ));

        if($model!=null)
            return $model;

        $model = new Antio();
        $model->antio1 = $this->st1;
        $model->antio2 = $year;
        $model->antio3 = 0;

        return $model;
    }

    /**
     * Пропуски студента (для расширеной регитсрации пропусков / карточка студента)
     * @return array
     * @throws CHttpException
     */
    public function getPass(){
        if(empty($this->st1))
            return array();

        $sql=<<<SQL
            SELECT * from EL_GURNAL_STUD_PROP(:st1, :year, :sem) 
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':st1', $this->st1);
        $command->bindValue(':year', Yii::app()->session['year']);
        $command->bindValue(':sem', Yii::app()->session['sem']);
        $passes = $command->queryAll();

        return $passes;
    }

    /**
     * Справки студента (для расширеной регитсрации пропусков / карточка студента)
     * @return Rpspr[]
     * @throws CHttpException
     */
    public function getReferences(){
        if(empty($this->st1))
            return null;

        $sql=<<<SQL
            SELECT rpspr.* from elgp 
            inner join elgzst on ( elgp.elgp1 = elgzst.elgzst0)
            inner join elgz on (elgzst.elgzst2 = elgz.elgz1)
            inner join elg on (elgz.elgz2 = elg.elg1)
            inner JOIN sem on (elg3 = sem1)
            inner join rpspr on (elgp.ELGP8 = rpspr.RPSPR0)
            LEFT JOIN rpsprd on (rpspr.RPSPR0 = rpsprd.rpsprd0 and rpsprd.rpsprd1 = elgp0)
          WHERE  elgzst1 = :ST1 and sem3 = :YEAR and sem5=:SEM and rpsprd2 is null and rpspr0>0
SQL;


        $references = Rpspr::model()->findAllBySql($sql, array(
            ':ST1' => $this->st1,
            ':YEAR' => Yii::app()->session['year'],
            ':SEM' => Yii::app()->session['sem']
        ));

        return $references;
    }

    /**
     * Справки студента (для расширеной регитсрации пропусков / карточка студента)
     * @return Zsno[]
     * @throws CHttpException
     */
    public function getRequestPayment(){
        if(empty($this->st1))
            return null;

        $sql=<<<SQL
            SELECT zsno0, zsno1, zsno2 from zsno 
            inner join zsnop on ( zsnop.zsnop0 = zsno.zsno0)
            inner join elgp on ( elgp.elgp0 = zsnop.zsnop1)
            inner join elgzst on ( elgp.elgp1 = elgzst.elgzst0)
            inner join elgz on (elgzst.elgzst2 = elgz.elgz1)
            inner join elg on (elgz.elgz2 = elg.elg1)
            inner JOIN sem on (elg3 = sem1)
          WHERE  zsno.zsno1=:ST1_ and elgzst1 = :ST1 and sem3 = :YEAR and sem5=:SEM
          GROUP BY zsno0, zsno1, zsno2
          ORDER BY zsno2 desc 
SQL;


        $result = Zsno::model()->findAllBySql($sql, array(
            ':ST1_' => $this->st1,
            ':ST1' => $this->st1,
            ':YEAR' => Yii::app()->session['year'],
            ':SEM' => Yii::app()->session['sem']
        ));

        return $result;
    }

    public function findUsersByStudentName($query, $faculty)
    {
        $sql = <<<SQL
            select u1, st1,st2,st3,st4,st20, std3, gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr28
			FROM st
			    INNER JOIN users on (u6 = st1 and u5 =0)
				INNER JOIN std ON(st1=std2)
				INNER JOIN gr ON(std3=gr1)
				INNER JOIN sg ON(sg1=gr2)
				INNER JOIN sp ON(sp1=sg2)
				INNER JOIN f ON(sp5=f1)
				where st2<>'' and sp5=:f1 and std11 in (0,5,6,8) and std7 is null and f32=0
				and
				(
					st2 CONTAINING :QUERY1
					or st74 CONTAINING :QUERY2
					or st117 CONTAINING :QUERY3
					or st120 CONTAINING :QUERY4
					or st123 CONTAINING :QUERY5
				)
            group by u1,st1,st2,st3,st4,st20, std3, gr3,gr19,gr20,gr21,gr22,gr23,gr24,gr28
			order by st2 collate UNICODE,st3,st4
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':QUERY1', $query);
        $command->bindValue(':QUERY2', $query);
        $command->bindValue(':QUERY3', $query);
        $command->bindValue(':QUERY4', $query);
        $command->bindValue(':QUERY5', $query);
        $command->bindValue(':f1', $faculty);
        return $command->queryAll();
    }

    public function getGostem(){
        $sql = <<<SQL
            select stusvst1, d2, STUSVST6, sem3, sem4, sem5, sem7
                from sem
                   inner join us on (sem.sem1 = us.us3)
                   inner join stusv on (us.us1 = stusv.stusv1)
                   inner join stusvst on (stusv.stusv0 = stusvst.stusvst1)
                   inner join uo on (us.us2 = uo.uo1)
                   inner join d on (uo.uo3 = d.d1)
                WHERE d8=2 and STUSVST3=:st1
                ORDER BY sem7, d2
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':st1',  $this->st1);
        return $command->queryAll();
    }

    /**
     * @return array
     * @throws CException
     */
    public function getSredniyBall(){
        $sql = <<<SQL
            select AVG(BAL_5)
                from DISC_VKL_ST_IT(
                   (
                      select first 1 sg1 from sg 
                      inner join gr on (sg.sg1 = gr.gr2)
                      inner join std on (gr.gr1 = std.std3)
                      where std2=:st1_ and std7 is null and std11 in (0,5,6,8)
                   )
                )
                WHERE st1=:st1 and BAL_5>=0
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':st1',  $this->st1);
        $command->bindValue(':st1_',  $this->st1);
        return $command->queryScalar();
    }
}
