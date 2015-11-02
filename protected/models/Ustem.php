<?php

/**
 * This is the model class for table "ustem".
 *
 * The followings are the available columns in table 'ustem':
 * @property integer $ustem1
 * @property integer $ustem2
 * @property integer $ustem3
 * @property integer $ustem4
 * @property string $ustem5
 * @property integer $ustem6
 */
class Ustem extends CActiveRecord
{
    public $nr18;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ustem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ustem1', 'required'),
            array('ustem7', 'numerical'),
			array('ustem2, ustem3, ustem4, ustem6', 'numerical', 'integerOnly'=>true),
			array('ustem5', 'length', 'max'=>1000),
            array('nr18', 'safe'),
            array('ustem4', 'unsafe','on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ustem1, ustem2, ustem3, ustem4, ustem5, ustem6', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ustem1' => 'Ustem1',
			'ustem2' => 'Ustem2',
            'ustem3' => tt('№ темы'),
            'ustem4' => tt('№ занятия'),
            'ustem5' => tt('Тема'),
            'ustem6' => tt('Тип'),
            'ustem7' => tt('Длительность занятия'),
            'groups' => tt('Группы'),
            'nr18'   => tt('Длительность')
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

		$criteria->compare('ustem1',$this->ustem1);
		$criteria->compare('ustem2',$this->ustem2);
		$criteria->compare('ustem3',$this->ustem3);
		$criteria->compare('ustem4',$this->ustem4);
		$criteria->compare('ustem5',$this->ustem5,true);
		$criteria->compare('ustem6',$this->ustem6);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ustem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTheme($us1)
    {
        $sql=<<<SQL
            select * from ustem where ustem2=:us1 order by ustem4
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':us1', $us1);
        $themes = $command->queryAll();
        return $themes;
    }
	
    public function deleteThematicPlan($model)
    {
        if(!empty($model->group))
        {
            list($us1,$us6)=explode('/',$model->group);
            $sql=<<<SQL
                SELECT * FROM ustem WHERE ustem2=:us1;
SQL;
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':us1', $us1);
            $res=$command->queryAll();

            $name=P::model()->getTeacherNameBy(Yii::app()->user->dbModel->p1,false);
            foreach($res as $val)
            {
                $ustem1=$val['ustem1'];
                $ustem2=$val['ustem2'];
                $ustem3=$val['ustem3'];
                $ustem4=$val['ustem4'];
                $ustem5=$val['ustem5'];
                $ustem6=$val['ustem6'];

                $text=$name.' Ustem1-'.$ustem1.' Ustem2-'.$ustem2.' Ustem3-'.$ustem3.' Ustem4-'.$ustem4.' Ustem5-'.$ustem5.' Ustem6-'.$ustem6;
                $sql = <<<SQL
              INSERT into adz (adz1,adz2,adz3,adz4,adz5,adz6) VALUES (:adz1,:adz2,:adz3,:adz4,:adz5,:adz6);
SQL;
                $command=Yii::app()->db->createCommand($sql);
                $command->bindValue(':adz1', 0);
                $command->bindValue(':adz2', 999);
                $command->bindValue(':adz3', 1);
                $command->bindValue(':adz4', date('Y-m-d H:i:s'));
                $command->bindValue(':adz5', 0);
                $command->bindValue(':adz6', $text);
                $command->execute();
            }

            $sql=<<<SQL
                DELETE  FROM ustem WHERE ustem2=:us1;
SQL;
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':us1', $us1);
            $command->queryAll();
            $this->noAcceptThematicPlan($us1);
        }
    }

    public function selectAcceptThematicPlan($us1)
    {
        if(empty($us1))
        return false;

        $sql=<<<SQL
            SELECT * FROM ustemp WHERE ustemp1=:us1;
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':us1', $us1);
        $res=$command->queryRow();

        if(empty($res))
            return false;
        else
            return true;

    }

    public function noAcceptThematicPlan($us1)
    {
        if(!empty($us1))
        {
            $sql=<<<SQL
                DELETE FROM ustemp WHERE ustemp1=:us1;
SQL;
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':us1', $us1);
            $command->execute();
        }
    }

    public function acceptThematicPlan($model)
    {
        if(!empty($model->group))
        {
            list($us1,$us6)=explode('/',$model->group);
            $this->noAcceptThematicPlan($us1);
            $sql=<<<SQL
                INSERT INTO ustemp(ustemp1) VALUES (:us1);
SQL;
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':us1', $us1);
            $res=$command->execute();
        }
    }
    
    public function recalculation($us1)
    {
        $themes=Ustem::model()->findAllByAttributes(array('ustem2'=>$us1),array('order'=>'ustem4 ASC,ustem1 ASC'));
        foreach($themes as $key => $theme) {
            if($theme->ustem4!=((int)$key+1))
            {
                $theme->ustem4=(int)$key+1;
                $theme->save();
            }
        }
    }

    public function getUstem6Arr()
    {
        return array(
            '0'=>tt('Занятие'),
            '1'=>tt('Субмодуль'),
            '2'=>tt('ПМК'),
        );
    }

    public function getUstem7Arr()
    {
        $sql = <<<SQL
              select rz8 from rz group by rz8
SQL;
        $command=Yii::app()->db->createCommand($sql);
        $res = $command->queryAll();
        foreach($res as $key => $val)
        {
            $res[$key]['rz8_']=round($val['rz8'], 2);
        }
        return $res;
    }

    public function getUstem6($type)
    {
        $arr=$this->getUstem6Arr();
        if(isset($arr[$type]))
            return $arr[$type];
        else
            return '-';
    }

    //фактичесое количетво часов по тем плану
    public function getHours($us1,$ustem1)
    {
        $res = Ustem::model()->findAllByAttributes(
            array('ustem2'=>$us1),
            array(
                'select'=>'ustem7',
                'condition'=>'ustem1 != :ustem1',
                'params'=>array(':ustem1'=>$ustem1)
            ));

        $hours=0;
        foreach($res as $val)
        {
            $hours+=$val['ustem7'];
        }
        return $hours;
    }

    public function getLessonByRasp()
    {
        $sql = <<<SQL
             select r2,rz8 as dlitelnost
            from rz
               inner join r on (rz.rz1 = r.r4)
               inner join nr on (r.r1 = nr.nr1)
               inner join us on (nr.nr2 = us.us1)
               inner join ug on (nr.nr1 = ug.ug3)
            where us1=:us1 and ug2=:gr1
            order by r2,rz2
SQL;

    }

}
