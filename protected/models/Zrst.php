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
			array('zrst1, zrst2, zrst3, zrst4, zrst5, zrst6', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('zrst1, zrst2, zrst3, zrst4, zrst5, zrst6', 'safe', 'on'=>'search'),
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
			'zrst2' => 'Студент',
			'zrst3' => 'Us1',
			'zrst4' => 'Тип1',
			'zrst5' => 'Сортировка',
			'zrst6' => 'Тип',
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

		$criteria->compare('zrst1',$this->zrst1);
		$criteria->compare('zrst2',$this->zrst2);
		$criteria->compare('zrst3',$this->zrst3);
		$criteria->compare('zrst4',$this->zrst4);
		$criteria->compare('zrst5',$this->zrst5);
		$criteria->compare('zrst6',$this->zrst6);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
        $sql=<<<SQL
            select sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1,iif(d8=6,'отчет по практике',
                   iif(d8=2,'выпускная квалификационная работа',
                   iif(us4=8,'курсовая',
                   iif(us4=7 and (select w8 from w where w1=us.us6)=2,'реферат','контрольная' )))) as vid,
                   (select first 1 stusvst6 from stusv,stusvst where stusv0=stusvst1 and stusv1=us.us1 and stusvst3=st.st1 order by stusv11 DESC) as ocenka,
                   (select zrst1 from zrst where zrst6=0 and zrst2=st.st1 and zrst3=us.us1) as rabota,
                   (select zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1) as recenziya
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
            where std2=:st1_ and std7 is null and std11<>1 and ucx5<2 and (us4 in (7,8) or (d8 in (2,6) and us4=0))
            group by sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1
            UNION
            select sem4,sem3,sem5,d2,us1,us4,us6,d8,ucx5,st1,iif(d8=6,'отчет по практике',
                   iif(d8=2,'выпускная квалификационная работа',
                   iif(us4=8,'курсовая',
                   iif(us4=7 and (select w8 from w where w1=us.us6)=2,'реферат','контрольная' )))) as vid,
                   (select first 1 stusvst6 from stusv,stusvst where stusv0=stusvst1 and stusv1=us.us1 and stusvst3=st.st1 order by stusv11 DESC) as ocenka,
                   (select zrst1 from zrst where zrst6=0 and zrst2=st.st1 and zrst3=us.us1) as rabota,
                   (select zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1) as recenziya
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
     * @param $p1
     * @return array
     * @throws CException
     */
    public  function getTable1DataTeacher($p1){
        $sql=<<<SQL
        select st2,st3,st4,std3,st1,us1,
               (select zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1) as recenziya
        from uo
           inner join us on (uo.uo1 = us.us2)
           inner join nr on (us.us1 = nr.nr2)
           inner join pd on (nr.nr6 = pd.pd1)
           inner join ug on (nr.nr1 = ug.ug1)
           inner join gr on (ug.ug2 = gr.gr1)
           inner join std on (gr.gr1 = std.std3)
           inner join st on (std.std2 =st.st1)
           inner join ucx on (uo.uo19 = ucx.ucx1)
           inner join d on (uo.uo3 = d.d1)
           inner join sem on (us.us3 = sem.sem1)
        where us1=:us1 and pd2=:p1 and std7 is null and std11<>1 and ucx5<2 and (us4 in (7,8) or (d8 in (2,6) and us4=0))
        group by st2,st3,st4,std3,st1,us1
        UNION
        select st2,st3,st4,std3,st1,us1,
               (select zrst1 from zrst where zrst6=1 and zrst2=st.st1 and zrst3=us.us1) as recenziya
        from ucgn
           inner join ucxg on (ucgn.ucgn1 = ucxg.ucxg2)
           inner join ucx on (ucxg.ucxg1 = ucx.ucx1)
           inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
           inner join ucsn on (ucgns.ucgns1 = ucsn.ucsn1)
           inner join st on (ucsn.ucsn2 =st.st1)
           inner join std on (st.st1 = std.std2)
           inner join uo on (ucx.ucx1 = uo.uo19)
           inner join us on (uo.uo1 = us.us2)
           inner join nr on (us.us1 = nr.nr2)
           inner join pd on (nr.nr6 = pd.pd1)
           inner join d on (uo.uo3 = d.d1)
           inner join sem on (us.us3 = sem.sem1)
        where us1=:us1 and pd2=:p1 and std7 is null and std11<>1 and ucx5>1 and (us4 in (7,8))
        group by st2,st3,st4,std3,st1,us1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':p1', $p1);
        $command->bindValue(':p1_', $p1);
        $students = $command->queryAll();

        return $students;
    }

    /**
     * @param $st1
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


    public  function getTable3Data($st1){

    }
}
