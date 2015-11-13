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
