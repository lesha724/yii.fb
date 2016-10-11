<?php

/**
 * This is the model class for table "jpv".
 *
 * The followings are the available columns in table 'jpv':
 * @property integer $jpv1
 * @property integer $jpv2
 * @property integer $jpv3
 * @property integer $jpv4
 * @property integer $jpv5
 *
 * The followings are the available model relations:
 * @property Jpvd[] $jpvds
 * @property Gr $jpv50
 */
class Jpv extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jpv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jpv1', 'required'),
			array('jpv1, jpv2, jpv3, jpv4, jpv5', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('jpv1, jpv2, jpv3, jpv4, jpv5', 'safe', 'on'=>'search'),
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
			'jpvds' => array(self::HAS_MANY, 'Jpvd', 'jpvd1'),
			'jpv50' => array(self::BELONGS_TO, 'Gr', 'jpv5'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'jpv1' => 'Jpv1',
			'jpv2' => 'Jpv2',
			'jpv3' => 'Jpv3',
			'jpv4' => 'Jpv4',
			'jpv5' => 'Jpv5',
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

		$criteria->compare('jpv1',$this->jpv1);
		$criteria->compare('jpv2',$this->jpv2);
		$criteria->compare('jpv3',$this->jpv3);
		$criteria->compare('jpv4',$this->jpv4);
		$criteria->compare('jpv5',$this->jpv5);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jpv the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /*добавляет или удаляет лишний права на дисциплины*/
    public function fillPermition($uo1, $gr1)
    {
        $sql=<<<SQL
           select cxm21,cxm1,cxm2,cxm3,cxm4,cxm5,cxm6,cxm7
           from cxm
           where cxm0=(
              select us13
              from us
              inner join sem on (us3 = sem1)
              where us4=0 and us2=:UO1 AND sem3=:YEAR AND sem5=:SEM
           )
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $command->bindValue(':UO1', $uo1);
        $cxm = $command->queryRow();

        if(empty($cxm))
            return;

        $cxm21 = $cxm['cxm21'];

        $sql=<<<SQL
          select ucgn2
          from uo
          inner join ucx on (uo.uo19 = ucx.ucx1)
          inner join ucxg on (ucx.ucx1 = ucxg.ucxg1)
          inner join ucgn on (ucxg.ucxg2 = ucgn.ucgn1)
          inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
          where uo1=:UO1 and ucxg3=0 and (ucgns3>0 or ucgns4>0) and ucgns5=:YEAR and ucgns6=:SEM
          group by ucgn2
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $command->bindValue(':UO1', $uo1);
        $res = $command->queryRow();

        foreach ($res as $value){
            for($i=1; $i<=$cxm21; $i++)
            {
                $sql=<<<SQL
                      select jpv1
                      from jpv
                      INNER JOIN sem on (jpv2 = sem1)
                      where sem3=:YEAR AND sem5=:SEM AND and jpv3=:UO1 and jpv4=:NOM and jpv5=:UCGN2
SQL;
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':YEAR', Yii::app()->session['year']);
                $command->bindValue(':SEM', Yii::app()->session['sem']);
                $command->bindValue(':UO1', $uo1);
                $command->bindValue(':NOM', $i);
                $command->bindValue(':UCGN2', $value['ucgn2']);
                $jpv1 = $command->queryScalar();

                if(empty($jpv1)||$jpv1==0){
                    $jpv = new Jpv();
                    $jpv->jpv1=new CDbExpression('GEN_ID(GEN_JPV, 1)');
                    $jpv->jpv3 = $uo1;
                    $jpv->jpv4 = $i;
                    $jpv->jpv5 = $value['ucgn2'];
                    if($jpv->save())
                        $jpv1 = $jpv->jpv1;
                }

                if($jpv1>0){
                    $sql=<<<SQL
                      select first 1 us4,pd2
                        from uo
                        inner join us on (uo1 = us2)
                        inner join nr on (us1 = nr2)
                        inner join ug on (nr1 = ug3)
                        inner join pd on (nr6 = pd1)
                        INNER JOIN sem on (us3 = sem1)
                        where nr6>0 and us4>=1 and uo1=:UO1 and sem3=:YEAR AND sem5=:SEM and ug2=:UCGN2
                        group by us4,pd2
SQL;
                    $command = Yii::app()->db->createCommand($sql);
                    $command->bindValue(':YEAR', Yii::app()->session['year']);
                    $command->bindValue(':SEM', Yii::app()->session['sem']);
                    $command->bindValue(':UO1', $uo1);
                    $command->bindValue(':UCGN2', $value['ucgn2']);
                    $row = $command->queryRow();

                    if(!empty($row)){
                        $sql = <<<SQL
                          UPDATE OR INSERT INTO jpvp (jpvp1,jpvp2) VALUES (:JPV1,:PD2) MATCHING (jpvp1,jpvp2)
SQL;
                        $command = Yii::app()->db->createCommand($sql);
                        $command->bindValue(':JPV1', $jpv1);
                        $command->bindValue(':PD2', $row['pd2']);
                        $command->execute();
                    }
                }
            }


            /*
             * // ѕровер¤ю, нет ли лишних модулей
              D_M.QSel1.Sql.Clear;
              D_M.QSel1.Sql.Add('select jpv1 from jpv where jpv2='+sem1+' and jpv3='+uo1+' and jpv4>'+IntToStr(kol)+' and jpv5='+D_M.QSel.FieldByName('ucgn2').AsString);
              D_M.QSel1.Close; D_M.QSel1.Open;
              if D_M.QSel1.FieldByName('jpv1').AsInteger > 0 then begin
                D_M.QInsert.Sql.Clear;
                D_M.QInsert.Sql.Add('DELETE FROM jpv WHERE jpv2='+sem1+' and jpv3='+uo1+' and jpv4>'+IntToStr(kol)+' and jpv5='+D_M.QSel.FieldByName('ucgn2').AsString);
                D_M.QInsert.Close; D_M.TQInsert.Active:=True; D_M.QInsert.ExecSQL; D_M.TQInsert.Commit;
              end;
            */
        }
    }

    public function getModules($res)
    {
        if(empty($res))
            return array();

        list($uo1,$gr1) = explode("/", $res);

        if(empty($uo1)||empty($gr1))
            return array();

        $sql=<<<SQL
            select jpv4,jpv1,jpvp2 from jpv
              INNER JOIN sem on (jpv2 = sem1)
              LEFT JOIN jpvp on (jpv1 = jpvp1 and jpvp2=:P1)
            WHERE jpv3=:JPV3 AND sem3=:YEAR AND sem5=:SEM AND JPV5=:JPV5 AND jpv4>0
            GROUP BY jpv4,jpv1,jpvp2
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':JPV3', $uo1);
        $command->bindValue(':JPV5', $gr1);
        $modules = $command->queryAll();

        /*foreach ($modules as $key=>$module)
        {
            $modules[$key]['name']=tt('Модуль №').$module['jpv4'];
            if(empty($module['jpvp2']))
                $modules[$key]['name'].='('.tt('Просмотр').')';
        }*/
        return $modules;
    }

    public function getStudents($uo1,$gr1)
    {
        if (empty($uo1)||empty($gr1))
            return array();
        $sql=<<<SQL
          select st1,st2,st3,st4
            from st
               inner join ucsn on (st.st1 = ucsn.ucsn2)
               inner join ucgns on (ucsn.ucsn1 = ucgns.ucgns1)
               inner join ucgn on (ucgns.ucgns2 = ucgn.ucgn1)
               inner join ug on (ucgn.ucgn1 = ug.ug4)
               inner join nr on (ug.ug3 = nr.nr1)
               inner join us on (nr.nr2 = us.us1)
               inner join std on (st1=std2)
           where st1>0 AND std11 in (0,5,6,8) and std7 is null AND UCGNS5=:YEAR and UCGNS6=:SEM and us2=:UO1 and ug2=:GR1
           GROUP BY st1,st2,st3,st4
           ORDER BY st2 collate UNICODE
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':UO1', $uo1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $statements = $command->queryAll();
        return $statements;
    }

    public function getModuleFromStudentCard($gr1)
    {
        $sql=<<<SQL
            select jpv1,jpv3,jpv4,d1,d2 from jpv
              INNER JOIN sem on (jpv2 = sem1)
              INNER JOIN uo on (jpv.jpv3 = uo.uo1)
              INNER JOIN d on (uo.uo3 = d.d1)
            WHERE sem3=:YEAR AND sem5=:SEM AND jpv5=:JPV5 ORDER BY d2 collate UNICODE
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $command->bindValue(':JPV5', $gr1);
        $res = $command->queryAll();
        $modules = array();
        $maxCount=$count=$d1=$exam=$ind=0;
        foreach ($res as $val)
        {
            if($d1!=$val['d1']) {
                if ($count > $maxCount)
                    $maxCount = $count;
                $count = 0;
                $d1=$val['d1'];
            }
            $modules[$val['d1']]['name']=$val['d2'];
            $modules[$val['d1']]['uo1']=$val['jpv3'];
            $modules[$val['d1']][$val['jpv4']]=$val['jpv1'];
            if($val['jpv4']<0)
            {
                switch($val['jpv4'])
                {
                    case -1:
                        $ind=1;
                        break;
                    case -2:
                        $exam=1;
                        break;
                }
            }else
                $count++;
        }

        if($count>$maxCount)
            $maxCount=$count;

        return array($modules,array($maxCount,$exam,$ind));
    }

    public function getMarksFromStudent($uo1,$gr1,$st1)
    {
        if (empty($uo1)||empty($gr1)||empty($st1))
            return array();

        $sql=<<<SQL
            select jpv4,jpvd3 from jpvd
              LEFT JOIN jpv on (jpvd1 = jpv1)
              INNER JOIN sem on (jpv2 = sem1)
            WHERE jpv3=:JPV3 AND sem3=:YEAR AND sem5=:SEM AND JPV5=:JPV5 AND jpv4>0 AND jpvd2=:ST1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $command->bindValue(':ST1',$st1);
        $command->bindValue(':JPV3', $uo1);
        $command->bindValue(':JPV5', $gr1);
        $res = $command->queryAll();

        $marks= array();
        foreach ($res as $val)
        {
            $key = $val['jpv4'];
            $marks[$key] = $val;
        }
        return $marks;
    }

    public function getMarksFromStudentDop($uo1,$gr1,$st1)
    {
        if (empty($uo1)||empty($gr1)||empty($st1))
            return array();

        $sql=<<<SQL
            select jpv4,jpvd3 from jpvd
              LEFT JOIN jpv on (jpvd1 = jpv1)
              INNER JOIN sem on (jpv2 = sem1)
            WHERE jpv3=:JPV3 AND sem3=:YEAR AND sem5=:SEM AND JPV5=:JPV5 AND jpv4<0 AND jpvd2=:ST1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $command->bindValue(':ST1',$st1);
        $command->bindValue(':JPV3', $uo1);
        $command->bindValue(':JPV5', $gr1);
        $res = $command->queryAll();

        $marks= array();
        foreach ($res as $val)
        {
            $key = $val['jpv4'];
            $marks[$key] = $val;
        }
        return $marks;
    }

    public function getModule($uo1,$gr1,$key)
    {
        if(empty($uo1)||empty($gr1))
            return array();

        $sql=<<<SQL
            select jpv4,jpv1,jpvp2 from jpv
              INNER JOIN sem on (jpv2 = sem1)
              LEFT JOIN jpvp on (jpv1 = jpvp1 and jpvp2=:P1)
            WHERE jpv3=:JPV3 AND sem3=:YEAR AND sem5=:SEM AND JPV5=:JPV5 AND jpv4=:KEY
            GROUP BY jpv4,jpv1,jpvp2
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':JPV3', $uo1);
        $command->bindValue(':KEY', $key);
        $command->bindValue(':JPV5', $gr1);
        $module = $command->queryRow();

        return $module;
    }
}
