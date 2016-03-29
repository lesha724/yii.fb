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
			array('elg1, elg2, elg3, elg4', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('elg1, elg2, elg3, elg4', 'safe', 'on'=>'search'),
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'elg1' => 'Elg1',
			'elg2' => 'Elg2',
			'elg3' => 'Elg3',
			'elg4' => 'Elg4',
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

		$criteria->compare('elg1',$this->elg1);
		$criteria->compare('elg2',$this->elg2);
		$criteria->compare('elg3',$this->elg3);
		$criteria->compare('elg4',$this->elg4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
                SELECT elgzst3,elgzst4,elgzst5,elgz3
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
        //$command->bindValue(':YEAR', Yii::app()->session['year']);
        //$command->bindValue(':SEM', Yii::app()->session['sem']);
        $res = $command->queryRow();

        if(!empty($res))
            return  $res['elg1'];
        else
            return -1;
    }

	public function getDispBySt($st1){
		$sql=<<<SQL
              /*SELECT elg.*,d2,d3,k2,k3 FROM elg
                INNER JOIN sem on (elg3 = sem1)
                inner join uo on (elg.elg2 = uo.uo1)
                inner join d on (uo.uo3 = d.d1)
                inner join elgz on (elg1 = elgz2)
                inner join elgzst on (elgz1 = elgzst2)
                inner JOIN k on (uo4 = k1)
              WHERE elgzst1=:ST1 AND sem3=:YEAR AND sem5=:SEM*/
SQL;
		$sql=<<<SQL
              SELECT d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1,sem1
                    from ucxg
                       inner join ucgn on (ucxg.ucxg2 = ucgn.ucgn1)
                       inner join ucx on (ucxg.ucxg1 = ucx.ucx1)
                       inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
                       inner join ucsn on (ucgns.ucgns1 = ucsn.ucsn1)
                       inner join uo on (ucx.ucx1 = uo.uo19)
                       inner join us on (uo.uo1 = us.us2)
                       inner join u on (uo.uo22 = u.u1)
                       inner join d on (uo.uo3 = d.d1)
                       inner join k on (uo.uo4 = k.k1)
                       inner join sem on (us.us3 = sem.sem1)
                    WHERE ucxg3=0 and ucsn2=:ST1 and sem3=:YEAR and sem5=:SEM and us6<>0 and us4 in (1,2,3,4)
                    group by d2,us4,us6,k2,uo3,u16,u1,d1,d27,d32,d34,d36,uo1,sem1
                    ORDER BY d2,us4,uo3
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':YEAR', Yii::app()->session['year']);
		$command->bindValue(':SEM', Yii::app()->session['sem']);
		$res = $command->queryAll();
		return $res;
	}

	public function getRetakeInfo($uo1,$sem1,$elg4,$st1)
	{
		$sql = <<<SQL
			SELECT COUNT(*) FROM elgzst
				INNER JOIN elgz on (elgzst2 = elgz1)
				INNER JOIN elg on (elgz2 = elg1)
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elgzst1=:ST1 AND elgzst3=2
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
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elgzst1=:ST1 AND elgzst3=1
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
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elgzst1=:ST1 AND elgzst4>0 AND elgzst4<=:MIN
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
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elgzst1=:ST1 AND elgzst3>0 AND (elgzst5>=:MIN OR elgzst5=-1)
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
			WHERE elg2=:UO1 AND elg3=:SEM1 AND elg4=:ELG4 AND elgzst1=:ST1 AND elgzst4>0 AND elgzst4<=:MIN1 AND (elgzst5>=:MIN2  OR elgzst5=-1)
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
