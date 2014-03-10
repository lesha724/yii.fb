<?php

/**
 * This is the model class for table "d".
 *
 * The followings are the available columns in table 'd':
 * @property integer $d1
 * @property string $d2
 * @property string $d3
 * @property string $d4
 * @property integer $d5
 * @property integer $d6
 * @property string $d7
 * @property string $d8
 * @property string $d9
 * @property integer $d10
 * @property string $d11
 * @property string $d12
 * @property integer $d13
 * @property integer $d14
 * @property integer $d15
 * @property integer $d16
 * @property integer $d17
 * @property integer $d18
 * @property integer $d19
 * @property integer $d20
 * @property integer $d21
 * @property integer $d22
 * @property integer $d23
 * @property integer $d24
 * @property integer $d25
 * @property string $d26
 * @property string $d27
 * @property string $d28
 * @property string $d29
 * @property integer $d30
 * @property integer $d31
 * @property string $d32
 * @property string $d33
 * @property string $d34
 * @property string $d35
 * @property string $d36
 * @property string $d37
 */
class D extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('d1, d5, d6, d10, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d30, d31', 'numerical', 'integerOnly'=>true),
			array('d2, d27, d32, d34, d36', 'length', 'max'=>1000),
			array('d3, d37', 'length', 'max'=>60),
			array('d4, d29', 'length', 'max'=>400),
			array('d7, d8, d9, d26', 'length', 'max'=>4),
			array('d11, d12', 'length', 'max'=>8),
			array('d28, d33, d35', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37', 'safe', 'on'=>'search'),
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
			'd1' => 'D1',
			'd2' => 'D2',
			'd3' => 'D3',
			'd4' => 'D4',
			'd5' => 'D5',
			'd6' => 'D6',
			'd7' => 'D7',
			'd8' => 'D8',
			'd9' => 'D9',
			'd10' => 'D10',
			'd11' => 'D11',
			'd12' => 'D12',
			'd13' => 'D13',
			'd14' => 'D14',
			'd15' => 'D15',
			'd16' => 'D16',
			'd17' => 'D17',
			'd18' => 'D18',
			'd19' => 'D19',
			'd20' => 'D20',
			'd21' => 'D21',
			'd22' => 'D22',
			'd23' => 'D23',
			'd24' => 'D24',
			'd25' => 'D25',
			'd26' => 'D26',
			'd27' => 'D27',
			'd28' => 'D28',
			'd29' => 'D29',
			'd30' => 'D30',
			'd31' => 'D31',
			'd32' => 'D32',
			'd33' => 'D33',
			'd34' => 'D34',
			'd35' => 'D35',
			'd36' => 'D36',
			'd37' => 'D37',
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

		$criteria->compare('d1',$this->d1);
		$criteria->compare('d2',$this->d2,true);
		$criteria->compare('d3',$this->d3,true);
		$criteria->compare('d4',$this->d4,true);
		$criteria->compare('d5',$this->d5);
		$criteria->compare('d6',$this->d6);
		$criteria->compare('d7',$this->d7,true);
		$criteria->compare('d8',$this->d8,true);
		$criteria->compare('d9',$this->d9,true);
		$criteria->compare('d10',$this->d10);
		$criteria->compare('d11',$this->d11,true);
		$criteria->compare('d12',$this->d12,true);
		$criteria->compare('d13',$this->d13);
		$criteria->compare('d14',$this->d14);
		$criteria->compare('d15',$this->d15);
		$criteria->compare('d16',$this->d16);
		$criteria->compare('d17',$this->d17);
		$criteria->compare('d18',$this->d18);
		$criteria->compare('d19',$this->d19);
		$criteria->compare('d20',$this->d20);
		$criteria->compare('d21',$this->d21);
		$criteria->compare('d22',$this->d22);
		$criteria->compare('d23',$this->d23);
		$criteria->compare('d24',$this->d24);
		$criteria->compare('d25',$this->d25);
		$criteria->compare('d26',$this->d26,true);
		$criteria->compare('d27',$this->d27,true);
		$criteria->compare('d28',$this->d28,true);
		$criteria->compare('d29',$this->d29,true);
		$criteria->compare('d30',$this->d30);
		$criteria->compare('d31',$this->d31);
		$criteria->compare('d32',$this->d32,true);
		$criteria->compare('d33',$this->d33,true);
		$criteria->compare('d34',$this->d34,true);
		$criteria->compare('d35',$this->d35,true);
		$criteria->compare('d36',$this->d36,true);
		$criteria->compare('d37',$this->d37,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return D the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getDisciplines($type = null)
    {
        $sql = <<<SQL
            select d1,d2
            from u
               inner join uo on (u.u1 = uo.uo22)
               inner join d on (uo.uo3 = d.d1)
               inner join us on (uo.uo1 = us.us2)
               inner join
                (select nr1,nr2
                          from pd
                             inner join nr on (pd1 = nr6) or (pd1 = nr7) or (pd1 = nr8) or (pd1 = nr9)
                             inner join us on (nr2 = us1)
                          where pd1>0 and pd2=:P1
                          group by nr1,nr2)
                on (us1 = nr2)
               inner join sem on (us.us12 = sem.sem1)
               inner join sg on (u.u2 = sg.sg1)
            where sg4=0 and sem3=:YEAR and sem5=:SEM
            group by d1,d2;
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $disciplines = $command->queryAll();

        return $disciplines;
    }
}
