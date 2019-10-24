<?php

/**
 * This is the model class for table "zrst".
 *
 * The followings are the available columns in table 'zrst':
 * @property integer $zrst1
 * @property integer $zrst2
 * @property integer $zrst3
 * @property integer $zrst4
 * @property integer $zrst5
 * @property integer $zrst6
 * @property string $zrst7
 * @property string $zrst8
 *
 * The followings are the available model relations:
 * @property St $zrst20
 * @property Us $zrst30
 */
class Zrst extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'zrst';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('zrst2, zrst3, zrst4, zrst5, zrst6', 'numerical', 'integerOnly'=>true),
            array('zrst7', 'length', 'max'=>100),
            array('zrst8', 'length', 'max'=>10),
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
			'zrst20' => array(self::BELONGS_TO, 'St', 'zrst2'),
			'zrst30' => array(self::BELONGS_TO, 'Us', 'zrst3'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'zrst1' => '#',
			'zrst2' => tt('Студент'),
			'zrst3' => 'Us1',
			'zrst4' => tt('Тип1'),
			'zrst5' => tt('Сортировка'),
			'zrst6' => tt('Тип'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zrst the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $st1
     * @return array
     * @throws CException
     */
	public  function getTable1Data($st1){
        $sql=/** @lang text */<<<SQL
            select sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1,iif(d8=6,'отчет по практике',
                   iif(d8=2,'выпускная квалификационная работа',
                   iif(us4=8,'курсовая',
                   iif(us4=7 and (select w8 from w where w1=us.us6)=2,'реферат','контрольная' )))) as vid,
                   (select first 1 stusvst6 from stusv,stusvst where stusv0=stusvst1 and stusv1=us.us1 and stusvst3=st.st1 order by stusv11 DESC) as ocenka,
                   (select first 1 zrst1 from zrst where zrst6=0 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as rabota,
                   (select first 1 zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as recenziya
            from uo
               inner join us on (uo.uo1 = us.us2)
               inner join nr on (us.us1 = nr.nr2)
               inner join ug on (nr.nr1 = ug.ug1)
               inner join gr on (ug.ug2 = gr.gr1)
               inner join std on (gr.gr1 = std.std3)
               inner join st on (std.std2 =st.st1)
               inner join ucx on (uo.uo19 = ucx.ucx1)
               inner join d on (uo.uo3 = d.d1)
               inner join sem on (us.us3 = sem.sem1)
            where std2=:st1_ and std7 is null and std11<>1 and ucx5<2 and (us4 in (7,8))
            group by sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1
            UNION
            select sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1,iif(d8=6,'отчет по практике',
                   iif(d8=2,'выпускная квалификационная работа',
                   iif(us4=8,'курсовая',
                   iif(us4=7 and (select w8 from w where w1=us.us6)=2,'реферат','контрольная' )))) as vid,
                   (select first 1 stusvst6 from stusv,stusvst where stusv0=stusvst1 and stusv1=us.us1 and stusvst3=st.st1 order by stusv11 DESC) as ocenka,
                   (select first 1 zrst1 from zrst where zrst6=0 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as rabota,
                   (select first 1 zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as recenziya
            from ucgn
               inner join ucxg on (ucgn.ucgn1 = ucxg.ucxg2)
               inner join ucx on (ucxg.ucxg1 = ucx.ucx1)
               inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
               inner join ucsn on (ucgns.ucgns1 = ucsn.ucsn1)
               inner join st on (ucsn.ucsn2 =st.st1)
               inner join uo on (ucx.ucx1 = uo.uo19)
               inner join us on (uo.uo1 = us.us2)
               inner join d on (uo.uo3 = d.d1)
               inner join sem on (us.us3 = sem.sem1)
            where st1=:st1 and ucx5>1 and (us4 in (7,8))
            group by sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':st1', $st1);
        $command->bindValue(':st1_', $st1);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * @param $st1
     * @return array
     * @throws CException
     */
    public  function getTable1Data1($st1){
        $sql=/** @lang text */<<<SQL
            select sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1,iif(d8=6,'отчет по практике',
                   iif(d8=2,'выпускная квалификационная работа',
                   iif(us4=8,'курсовая',
                   iif(us4=7 and (select w8 from w where w1=us.us6)=2,'реферат','контрольная' )))) as vid,
                   (select first 1 stusvst6 from stusv,stusvst where stusv0=stusvst1 and stusv1=us.us1 and stusvst3=st.st1 order by stusv11 DESC) as ocenka,
                   (select first 1 zrst1 from zrst where zrst6=0 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as rabota,
                   (select first 1 zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as recenziya
            from uo
               inner join us on (uo.uo1 = us.us2)
               inner join nr on (us.us1 = nr.nr2)
               inner join ug on (nr.nr1 = ug.ug1)
               inner join gr on (ug.ug2 = gr.gr1)
               inner join std on (gr.gr1 = std.std3)
               inner join st on (std.std2 =st.st1)
               inner join ucx on (uo.uo19 = ucx.ucx1)
               inner join d on (uo.uo3 = d.d1)
               inner join sem on (us.us3 = sem.sem1)
            where std2=:st1_ and std7 is null and std11<>1 and ucx5<2 and ((d8 in (6) and us4=0))
            group by sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':st1', $st1);
        $command->bindValue(':st1_', $st1);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * @param $st1
     * @return array
     * @throws CException
     */
    public  function getTable1Data2($st1){
        $sql=/** @lang text */<<<SQL
            select sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1,iif(d8=6,'отчет по практике',
                   iif(d8=2,'выпускная квалификационная работа',
                   iif(us4=8,'курсовая',
                   iif(us4=7 and (select w8 from w where w1=us.us6)=2,'реферат','контрольная' )))) as vid,
                   (select first 1 stusvst6 from stusv,stusvst where stusv0=stusvst1 and stusv1=us.us1 and stusvst3=st.st1 order by stusv11 DESC) as ocenka,
                   (select first 1 zrst1 from zrst where zrst6=0 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as rabota,
                   (select first 1 zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as recenziya
            from uo
               inner join us on (uo.uo1 = us.us2)
               inner join nr on (us.us1 = nr.nr2)
               inner join ug on (nr.nr1 = ug.ug1)
               inner join gr on (ug.ug2 = gr.gr1)
               inner join std on (gr.gr1 = std.std3)
               inner join st on (std.std2 =st.st1)
               inner join ucx on (uo.uo19 = ucx.ucx1)
               inner join d on (uo.uo3 = d.d1)
               inner join sem on (us.us3 = sem.sem1)
            where std2=:st1_ and std7 is null and std11<>1 and ucx5<2 and ((d8 in (2) and us4=0))
            group by sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':st1', $st1);
        $command->bindValue(':st1_', $st1);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * @param $p1
     * @param $us1
     * @return array
     * @throws CException
     */
    public  function getTable1DataTeacher($p1, $us1){
        $sql=/** @lang text */<<<SQL
        select pe2,pe3,pe4,std3,st1,us1,sem4,gr19,gr20,gr21,gr22,gr23,gr24,gr28,gr3,
               (select first 1 zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as recenziya
        from uo
           inner join us on (uo.uo1 = us.us2)
           inner join nr on (us.us1 = nr.nr2)
           inner join pd on (nr.nr6 = pd.pd1)
           inner join ug on (nr.nr1 = ug.ug1)
           inner join gr on (ug.ug2 = gr.gr1)
           inner join std on (gr.gr1 = std.std3)
           inner join st on (std.std2 =st.st1)
           inner join pe on (st200 = pe1)
           inner join ucx on (uo.uo19 = ucx.ucx1)
           inner join d on (uo.uo3 = d.d1)
           inner join sem on (us.us3 = sem.sem1)
        where us1=:us1_ and pd2=:p1_ and std7 is null and std24=0 and std11<>1 and ucx5<2 and (us4 in (7,8) or (d8 in (2,6) and us4=0))
        group by pe2,pe3,pe4,std3,st1,us1,sem4,gr19,gr20,gr21,gr22,gr23,gr24,gr28,gr3
        UNION
        select pe2,pe3,pe4,std3,st1,us1,sem4,gr19,gr20,gr21,gr22,gr23,gr24,gr28,gr3,
               (select first 1 zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1 order by zrst1 desc) as recenziya
        from ucgn
           inner join ucxg on (ucgn.ucgn1 = ucxg.ucxg2)
           inner join ucx on (ucxg.ucxg1 = ucx.ucx1)
           inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
           inner join ucsn on (ucgns.ucgns1 = ucsn.ucsn1)
           inner join st on (ucsn.ucsn2 =st.st1)
           inner join pe on (st200 = pe1)
           inner join std on (st.st1 = std.std2)
           inner join gr on (std.std3 = gr.gr1)
           inner join uo on (ucx.ucx1 = uo.uo19)
           inner join us on (uo.uo1 = us.us2)
           inner join nr on (us.us1 = nr.nr2)
           inner join pd on (nr.nr6 = pd.pd1)
           inner join d on (uo.uo3 = d.d1)
           inner join sem on (us.us3 = sem.sem1)
        where us1=:us1 and pd2=:p1 and std7 is null and std24=0 and std11<>1 and ucx5>1 and (us4 in (7,8))
        group by pe2,pe3,pe4,std3,st1,us1,sem4,gr19,gr20,gr21,gr22,gr23,gr24,gr28,gr3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':p1', $p1);
        $command->bindValue(':p1_', $p1);
        $command->bindValue(':us1', $us1);
        $command->bindValue(':us1_', $us1);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * @param $st1
     * @param $zrst4
     * @return static[]
     */
    public  function getTableData($st1, $zrst4){
        return self::findAllByAttributes(array(
            'zrst2' => $st1,
            'zrst4' => $zrst4,
            'zrst6' => 0
        ),
        array(
            'order' => 'zrst5 asc'
        ));
    }

    /**
     * @param $p1
     * @return array
     * @throws CException
     */
    public function getSemesterData($p1){
        if(empty($p1))
            return array();
        $sql = /** @lang text */<<<SQL
          select sem3,sem5
                from uo
                   inner join us on (uo.uo1 = us.us2)
                   inner join nr on (us.us1 = nr.nr2)
                   inner join pd on (nr.nr6 = pd.pd1)
                   inner join ucx on (uo.uo19 = ucx.ucx1)
                   inner join d on (uo.uo3 = d.d1)
                   inner join sem on (us.us3 = sem.sem1)
                where pd2=:p1_ and (us4 in (7,8) or (d8 in (2,6) and us4=0))
                group by sem3,sem5
                UNION
                select sem3,sem5
                from ucx
                   inner join uo on (ucx.ucx1 = uo.uo19)
                   inner join us on (uo.uo1 = us.us2)
                   inner join nr on (us.us1 = nr.nr2)
                   inner join pd on (nr.nr6 = pd.pd1)
                   inner join d on (uo.uo3 = d.d1)
                   inner join sem on (us.us3 = sem.sem1)
                where pd2=:p1 and ucx5>1 and (us4 in (7,8))
                group by sem3,sem5
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':p1', $p1);
        $command->bindValue(':p1_', $p1);
        $res = $command->queryAll();

        $semesters = array();
        foreach($res as $key => $semester) {
            if($semester['sem3'] == 0)
                continue;
            $semesters[$semester['sem3'].'/'.$semester['sem5']] = $semester['sem3'] . '/' . ($semester['sem3']+1) . ' ' . SH::convertSem5($semester['sem5']);
        }
        return $semesters;
    }

    /**
     * @param $p1
     * @param $semData
     * @return array
     * @throws CException
     */
    public function getDisciplinesData($p1, $semData){
        if(empty($p1))
            return array();
        if(empty($semData))
            return array();
        list($year, $sem) = explode('/', $semData);

        $sql = /** @lang text */<<<SQL
        select * from (
        select d2,us1,iif(d8=6,'отчет по практике',
                   iif(d8=2,'выпускная квалификационная работа',
                   iif(us4=8,'курсовая',
                   iif(us4=7 and (select w8 from w where w1=us.us6)=2,'реферат','контрольная' )))) as vid
                from uo
                   inner join us on (uo.uo1 = us.us2)
                   inner join nr on (us.us1 = nr.nr2)
                   inner join pd on (nr.nr6 = pd.pd1)
                   inner join ucx on (uo.uo19 = ucx.ucx1)
                   inner join d on (uo.uo3 = d.d1)
                   inner join sem on (us.us3 = sem.sem1)
                where pd2=:p1_ and (us4 in (7,8) or (d8 in (2,6) and us4=0)) and sem3=:year_ and sem5=:sem_
                UNION
                select d2,us1,iif(d8=6,'отчет по практике',
       iif(d8=2,'выпускная квалификационная работа',
       iif(us4=8,'курсовая',
       iif(us4=7 and (select w8 from w where w1=us.us6)=2,'реферат','контрольная' )))) as vid
                from ucx
                   inner join uo on (ucx.ucx1 = uo.uo19)
                   inner join us on (uo.uo1 = us.us2)
                   inner join nr on (us.us1 = nr.nr2)
                   inner join pd on (nr.nr6 = pd.pd1)
                   inner join d on (uo.uo3 = d.d1)
                   inner join sem on (us.us3 = sem.sem1)
                where pd2=:p1 and ucx5>1 and (us4 in (7,8)) and sem3=:year and sem5=:sem
        )
                group by d2, us1, vid
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':p1', $p1);
        $command->bindValue(':p1_', $p1);
        $command->bindValue(':year', $year);
        $command->bindValue(':sem', $sem);
        $command->bindValue(':year_', $year);
        $command->bindValue(':sem_', $sem);
        $res = $command->queryAll();

        $disciplines = array();
        foreach($res as $key => $discipline) {
            $disciplines[$discipline['us1']] = $discipline['d2']. ' ('.$discipline['vid'].')';
        }
        return $disciplines;
    }

    /**
     * Проверка на редактирование
     * @param $p1
     * @return bool
     * @throws CException
     */
    public function checkAccessForTeacher($p1){
        $sql = /** @lang text */<<<SQL
        Select count(*) from (
              select us1
                from uo
                   inner join us on (uo.uo1 = us.us2)
                   inner join nr on (us.us1 = nr.nr2)
                   inner join pd on (nr.nr6 = pd.pd1)
                   inner join ucx on (uo.uo19 = ucx.ucx1)
                   inner join d on (uo.uo3 = d.d1)
                   inner join sem on (us.us3 = sem.sem1)
                where pd2=:p1_ and (us4 in (7,8) or (d8 in (2,6) and us4=0)) and us1=:us1_
                group by us1
                UNION
                select us1
                from ucx
                   inner join uo on (ucx.ucx1 = uo.uo19)
                   inner join us on (uo.uo1 = us.us2)
                   inner join nr on (us.us1 = nr.nr2)
                   inner join pd on (nr.nr6 = pd.pd1)
                   inner join d on (uo.uo3 = d.d1)
                   inner join sem on (us.us3 = sem.sem1)
                where pd2=:p1 and ucx5>1 and (us4 in (7,8)) and us1=:us1
                group by us1
          )
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':p1', $p1);
        $command->bindValue(':p1_', $p1);
        $command->bindValue(':us1', $this->zrst3);
        $command->bindValue(':us1_', $this->zrst3);
        return ((int)$command->queryScalar()) > 0;
    }

    /**
     * @return array
     * @throws CException
     */
    public function getListFilesForStatistic(){
        $sql = /** @lang text */
            <<<SQL
            select 
                zrst.*,
                pe2, pe3, pe4, std20, f3, gr3
            from sg
               inner join sp on (sg.sg2 = sp.sp1)
               inner join f on (sp.sp5 = f.f1)
               inner join gr on (sg.sg1 = gr.gr2)
               inner join std on (gr.gr1 = std.std3)
               inner join st on (std.std2 = st.st1)
               inner join pe on (st.st200 = pe.pe1)
               inner join zrst on (st.st1 = zrst.zrst2)
            where std7 is null and std11 <> 1 and zrst6=0 and zrst4 in (1,4)
            ORDER BY f2, gr3, pe2
SQL;
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
}
