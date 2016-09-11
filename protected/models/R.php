<?php

/**
 * This is the model class for table "r".
 *
 * The followings are the available columns in table 'r':
 * @property integer $r1
 * @property string $r2
 * @property integer $r3
 * @property integer $r5
 * @property integer $r6
 * @property integer $r7
 * @property integer $r9
 * @property string $r11
 * @property integer $r10
 */
class R extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'r';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('r1, r3, r5, r6, r7, r9, r10', 'numerical', 'integerOnly'=>true),
			array('r2, r11', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('r1, r2, r3, r5, r6, r7, r9, r11, r10', 'safe', 'on'=>'search'),
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
			'r1' => 'R1',
			'r2' => 'R2',
			'r3' => 'R3',
			'r5' => 'R5',
			'r6' => 'R6',
			'r7' => 'R7',
			'r9' => 'R9',
			'r11' => 'R11',
			'r10' => 'R10',
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

		$criteria->compare('r1',$this->r1);
		$criteria->compare('r2',$this->r2,true);
		$criteria->compare('r3',$this->r3);
		$criteria->compare('r5',$this->r5);
		$criteria->compare('r6',$this->r6);
		$criteria->compare('r7',$this->r7);
		$criteria->compare('r9',$this->r9);
		$criteria->compare('r11',$this->r11,true);
		$criteria->compare('r10',$this->r10);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return R the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getDatesForJournal($uo1, $gr1,$type_lesson, $sem1)
    {
		/*$sem1 = Sem::model()->getSem1ByUo1($uo1);
		if(empty($sem1))
			return array();*/

		$sql = <<<SQL
			select elgz3,r2,r1,ustem5,us4,ustem7,ustem6,elgz4,elgz1,elgz5,elgz6,nr30,k2,k3,rz9,rz10
			from elgz
			inner join elg on (elgz.elgz2 = elg.elg1 and elg2=:UO1 and elg4=:TYPE_LESSON and elg3={$sem1})
			inner join ustem on (elgz.elgz7 = ustem.ustem1)
			inner join EL_GURNAL_ZAN({$uo1},:GR1,:SEM1, {$type_lesson}) on (elgz.elgz3 = EL_GURNAL_ZAN.nom)
			inner join rz on (EL_GURNAL_ZAN.r4 = rz1)
			inner join nr on (r1 = nr1)
			inner join k on (nr30 = k1)
			order by elgz3
SQL;
		/*select elgz3,r2,r1,ustem5,us4,ustem7,ustem6,elgz4,elgz1,elgz5,elgz6
from elgz
   inner join elg on (elgz.elgz2 = elg.elg1 and elg2=:UO1 and elg4=:TYPE_LESSON)
   inner join ustem on (elgz.elgz7 = ustem.ustem1)
   inner join EL_GURNAL_ZAN({$uo1},:GR1,:SEM1, {$type_lesson}) on (elgz.elgz3 = EL_GURNAL_ZAN.nom)
order by elgz3*/
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':UO1', $uo1);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':TYPE_LESSON', $type_lesson);
        $command->bindValue(':SEM1', $sem1);
        $dates = $command->queryAll();

		$ps59 = PortalSettings::model()->findByPk(59)->ps2;

        foreach($dates as $key => $date) {
            $dates[$key]['formatted_date'] = ShortCodes::formatDate('Y-m-d H:i:s', 'd.m.Y', $date['r2']);
			$us4=SH::convertUS4(1);
			if($type_lesson!=0)
				$us4=SH::convertUS4($dates[$key]['us4']);
			$dates[$key]['text'] = '№'.$dates[$key]['elgz3'].' '.$dates[$key]['formatted_date'].' '.$us4;
			if($ps59==1)
				$dates[$key]['text'].= ' '.$dates[$key]['k2'];
        }

        return $dates;
    }

	public function getDatesForJournalByChangeTheme($uo1, $gr1,$type_lesson, $sem1, $nom)
	{
		$sql = <<<SQL
			select elgz3,r2,ustem5,us4,ustem7,ustem6,ustem1,elgz4,elgz1,nr30,k2,k3
			from elgz
			inner join elg on (elgz.elgz2 = elg.elg1 and elg2=:UO1 and elg4=:TYPE_LESSON and elg3={$sem1})
			inner join ustem on (elgz.elgz7 = ustem.ustem1)
			inner join EL_GURNAL_ZAN({$uo1},:GR1,:SEM1, {$type_lesson}) on (elgz.elgz3 = EL_GURNAL_ZAN.nom)
			inner join rz on (EL_GURNAL_ZAN.r4 = rz1)
			inner join nr on (r1 = nr1)
			inner join k on (nr30 = k1)
			WHERE elgz3>:NOM
			order by elgz3
SQL;

		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':UO1', $uo1);
		$command->bindValue(':GR1', $gr1);
		$command->bindValue(':TYPE_LESSON', $type_lesson);
		$command->bindValue(':SEM1', $sem1);
		$command->bindValue(':NOM', $nom);
		$dates = $command->queryAll();

		return $dates;
	}
}
