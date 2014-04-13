<?php

/**
 * This is the model class for table "vvmp".
 *
 * The followings are the available columns in table 'vvmp':
 * @property integer $vvmp1
 * @property integer $vvmp2
 * @property integer $vvmp3
 * @property integer $vvmp4
 * @property integer $vvmp5
 * @property integer $vvmp6
 * @property string $vvmp7
 * @property integer $vvmp8
 * @property integer $vvmp10
 * @property integer $vvmp11
 * @property integer $vvmp12
 * @property integer $vvmp13
 * @property integer $vvmp14
 * @property integer $vvmp15
 * @property integer $vvmp16
 * @property integer $vvmp17
 * @property integer $vvmp18
 * @property integer $vvmp19
 * @property integer $vvmp20
 * @property integer $vvmp21
 */
class Vvmp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vvmp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('vvmp1', 'safe'),
			array('vvmp2, vvmp3, vvmp4, vvmp5, vvmp6, vvmp8, vvmp10, vvmp11, vvmp12, vvmp13, vvmp14, vvmp15, vvmp16, vvmp17, vvmp18, vvmp19, vvmp20, vvmp21', 'numerical', 'integerOnly'=>true),
			array('vvmp7', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('vvmp1, vvmp2, vvmp3, vvmp4, vvmp5, vvmp6, vvmp7, vvmp8, vvmp10, vvmp11, vvmp12, vvmp13, vvmp14, vvmp15, vvmp16, vvmp17, vvmp18, vvmp19, vvmp20, vvmp21', 'safe', 'on'=>'search'),
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
			'vvmp1' => 'Vvmp1',
			'vvmp2' => 'Vvmp2',
			'vvmp3' => 'Vvmp3',
			'vvmp4' => 'Vvmp4',
			'vvmp5' => 'Vvmp5',
			'vvmp6' => 'Vvmp6',
			'vvmp7' => 'Vvmp7',
			'vvmp8' => 'Vvmp8',
			'vvmp10' => 'Vvmp10',
			'vvmp11' => 'Vvmp11',
			'vvmp12' => 'Vvmp12',
			'vvmp13' => 'Vvmp13',
			'vvmp14' => 'Vvmp14',
			'vvmp15' => 'Vvmp15',
			'vvmp16' => 'Vvmp16',
			'vvmp17' => 'Vvmp17',
			'vvmp18' => 'Vvmp18',
			'vvmp19' => 'Vvmp19',
			'vvmp20' => 'Vvmp20',
			'vvmp21' => 'Vvmp21',
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

		$criteria->compare('vvmp1',$this->vvmp1);
		$criteria->compare('vvmp2',$this->vvmp2);
		$criteria->compare('vvmp3',$this->vvmp3);
		$criteria->compare('vvmp4',$this->vvmp4);
		$criteria->compare('vvmp5',$this->vvmp5);
		$criteria->compare('vvmp6',$this->vvmp6);
		$criteria->compare('vvmp7',$this->vvmp7,true);
		$criteria->compare('vvmp8',$this->vvmp8);
		$criteria->compare('vvmp10',$this->vvmp10);
		$criteria->compare('vvmp11',$this->vvmp11);
		$criteria->compare('vvmp12',$this->vvmp12);
		$criteria->compare('vvmp13',$this->vvmp13);
		$criteria->compare('vvmp14',$this->vvmp14);
		$criteria->compare('vvmp15',$this->vvmp15);
		$criteria->compare('vvmp16',$this->vvmp16);
		$criteria->compare('vvmp17',$this->vvmp17);
		$criteria->compare('vvmp18',$this->vvmp18);
		$criteria->compare('vvmp19',$this->vvmp19);
		$criteria->compare('vvmp20',$this->vvmp20);
		$criteria->compare('vvmp21',$this->vvmp21);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vvmp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function loadBillBy($nr1, $students)
    {
        $sql=<<<SQL
                select uo.uo3, uo.uo4, sem.sem7,ug.ug2
                from ug
                   inner join nr on (ug.ug3 = nr.nr1)
                   inner join us on (nr.nr2 = us.us1)
                   inner join uo on (us.us2 = uo.uo1)
                   inner join sem on (us.us3 = sem.sem1)
                where ug3=:NR1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':NR1', $nr1);
        $data = $command->queryRow();

        if (empty($data))
            return false;

        $gr1  = $data['ug2'];
        $d1   = $data['uo3'];
        $k1   = $data['uo4'];
        $sem7 = $data['sem7'];

        $params = array(
            'vvmp2'=>$gr1,
            'vvmp3'=>$d1,
            'vvmp4'=>$sem7,
            'vvmp5'=>$k1,
        );
        $vvmp = $this->findByAttributes($params);

        if (! empty($vvmp))
            return $vvmp;

        $newModules = 5;

        $vvmp = new Vvmp;
        $vvmp->attributes = $params + array(
            'vvmp1' => new CDbExpression('GEN_ID(GEN_VVMP, 1)'),
            'vvmp6' => $newModules
        );
        $vvmp->save();
        $vvmp = $this->findByAttributes($params);

        // fill table vmp
        foreach($students as $st) {
            for($i=-1;$i<=$newModules;$i++) {
                $vmp = new Vmp();
                $vmp->attributes = array(
                    'vmp1' => $vvmp->vvmp1,
                    'vmp2' => $st['st1'],
                    'vmp3' => $i,
                );
               $vmp->save(false);
            }
        }

        return $vvmp;
    }

    public function fillDataForGroup($gr1, $d1, $year, $sem)
    {
        $sql = <<<SQL
        SELECT * FROM PROC_MODULI(:GR1, :D1, :YEAR, :SEM);
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':D1', $d1);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $res = $command->queryRow();
        return $res;
    }

}
