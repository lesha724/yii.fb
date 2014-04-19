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

    public function getDatesForJournal($p1, $d1, $year, $sem, $gr1, $type = null)
    {
        /*$sql = <<<SQL
        select r2,nr1,us4,uo1
        from sem
           inner join us on (sem1 = us12)
           inner join
                     (select uo1,uo22
                      from pd
                         inner join nr on (pd1 = nr6) or (pd1 = nr7) or (pd1 = nr8) or (pd1 = nr9)
                         inner join us on (nr2 = us1)
                         inner join uo on (us2 = uo1)
                      where pd1>0 and pd2=:P1 and uo3=:D1
                      group by uo1,uo22)
             on (us2 = uo1)
           inner join nr on (us1 = nr2)
           inner join ug on (ug3 = nr1)
           inner join r on (nr1 = r1)
           inner join u on (uo22 = u1)
           inner join sg on (u2 = sg1)
        where sg4=0 and sem3=:YEAR and sem5=:SEM and ug2=:GR1 and us4 in (2,3,4)
        group by r2,nr1,us4,uo1
SQL;*/
        $sql = <<<SQL
        select * from LIST_DATA_EL_JURNAL(:P1, :D1, :YEAR, :SEM, :GR1);
SQL;


        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $p1);
        $command->bindValue(':D1', $d1);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $command->bindValue(':GR1', $gr1);
        $dates = $command->queryAll();

        foreach($dates as $key => $date) {
            $dates[$key]['formatted_date'] = ShortCodes::formatDate('Y-m-d H:i:s', 'd.m.Y', $date['r2']);
        }

        return $dates;
    }
}
