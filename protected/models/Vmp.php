<?php

/**
 * This is the model class for table "vmp".
 *
 * The followings are the available columns in table 'vmp':
 * @property integer $vmp1
 * @property integer $vmp2
 * @property integer $vmp3
 * @property integer $vmp4
 * @property integer $vmp5
 * @property integer $vmp6
 * @property integer $vmp7
 */
class Vmp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vmp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vmp1, vmp2, vmp3, vmp4, vmp5, vmp6, vmp7', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('vmp1, vmp2, vmp3, vmp4, vmp5, vmp6, vmp7', 'safe', 'on'=>'search'),
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
			'vmp1' => 'Vmp1',
			'vmp2' => 'Vmp2',
			'vmp3' => 'Vmp3',
			'vmp4' => 'Vmp4',
			'vmp5' => 'Vmp5',
			'vmp6' => 'Vmp6',
			'vmp7' => 'Vmp7',
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

		$criteria->compare('vmp1',$this->vmp1);
		$criteria->compare('vmp2',$this->vmp2);
		$criteria->compare('vmp3',$this->vmp3);
		$criteria->compare('vmp4',$this->vmp4);
		$criteria->compare('vmp5',$this->vmp5);
		$criteria->compare('vmp6',$this->vmp6);
		$criteria->compare('vmp7',$this->vmp7);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vmp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function recalculateModulesFor($vvmp1, $nr1)
    {
        $vvmp = Vvmp::model()->findByPk($vvmp1);

        if (empty($vvmp))
            throw new Exception('Can\'t find vvmp with id = '.$vvmp1);

        $gr1  = $vvmp->vvmp2;
        $d1   = $vvmp->vvmp3;
        $sem7 = $vvmp->vvmp4;

        // даты модулей
        $moduleDates = Mej::model()->findAllByAttributes(array('mej3' => $nr1));

        // студенты
        $students = St::model()->getStudentsOfGroup($gr1);

        // получаем все коды nr1 для конкретной дисциплины
        $sql = <<<SQL
                select nr1
				from ug
				   inner join nr on (ug.ug3 = nr.nr1)
				   inner join us on (nr.nr2 = us.us1)
				   inner join uo on (us.us2 = uo.uo1)
				   inner join sem on (us.us3 = sem.sem1)
				where ug2={$gr1} and sem7={$sem7} and uo3={$d1}
				group by nr1
SQL;
        $arrayNr1 = Yii::app()->db->createCommand($sql)->queryColumn();

        $canRecalculate = count($moduleDates) > 0 &&
                          count($students) > 0 &&
                          count($arrayNr1) > 0;

        if ($canRecalculate) {

            // set to 0 all rows
            $condition = 'vmp1 = '.$vvmp->vvmp1.' AND vmp3 >=1';
            Vmp::model()->updateAll(array(
                'vmp4' => 0,
                'vmp5' => 0,
                'vmp6' => 0,
                'vmp7' => 0,
            ), $condition);

            foreach ($moduleDates as $key => $module) {
                foreach($students as $st) {

                    $st1 = $st['st1'];
                    $min = $module->mej4;
                    $max = $module->mej5;
                    $nr1 = implode(',',$arrayNr1);

                    $sql = <<<SQL
                            select sum (case when steg9 <> 0 then steg9 else steg5 end)
                            from steg
                            where steg1 = {$st1} and steg2 in ({$nr1})
                            and steg3>='{$min}' and steg3<='{$max}';

SQL;
                    $data = Yii::app()->db->createCommand($sql)->queryRow();

                    if (! empty($data['sum'])) {
                        $vmp4 = round($data['sum'], 1);
                        $vmp1 = $vvmp->vvmp1;
                        $num  = $key + 1;

                        $sql = <<<SQL
                            update vmp set vmp4 = {$vmp4}
                            where vmp1={$vmp1} and vmp2 = {$st1} and vmp3 = {$num}
SQL;
                        $res = Yii::app()->db->createCommand($sql)->execute();
                        if (! $res)
                            throw new Exception('Can\'t update the module for vvmp1 = '.$vmp1);
                    }
                }
            }

        }
    }

    public function getMarksForStudent($st1, $vvmp1)
    {
        $rows = Yii::app()->db->createCommand()
                ->select('*')
                ->from('vmp')
                ->where('vmp1 = :VVMP1 and vmp2 = :ST1', array(
                    ':VVMP1' => $vvmp1,
                    ':ST1' => $st1,
                ))
                ->queryAll();

        $res = array();
        foreach($rows as $row) {
            $key = $row['vmp3'];
            $res[$key] = $row;
        }

        return $res;
    }

    public function getExtraMarks($st1, $vvmp1)
    {
        $marks = array();

        $marks['0'] = Yii::app()->db->createCommand()
                    ->select('vmp4')
                    ->from('vmp')
                    ->where('vmp1 = :VVMP1 and vmp2 = :ST1 and vmp3=0', array(
                        ':VVMP1' => $vvmp1,
                        ':ST1' => $st1,
                    ))
                    ->queryScalar();

        $vvmp = Vvmp::model()->findByPk($vvmp1);

        $marks['stus3'] = Yii::app()->db->createCommand()
                            ->select('stus3')
                            ->from('stus')
                            ->where('stus1=:ST1 and stus18=:D1 and stus19=8 and stus20=:SEM7 and stus21=:K1', array(
                                ':ST1'  => $st1,
                                ':D1'   => $vvmp->vvmp3,
                                ':SEM7' => $vvmp->vvmp4,
                                ':K1'   => $vvmp->vvmp5,
                            ))
                            ->queryScalar();

        $marks['-1'] = Yii::app()->db->createCommand()
                    ->select('vmp4')
                    ->from('vmp')
                    ->where('vmp1 = :VVMP1 and vmp2 = :ST1 and vmp3=-1', array(
                        ':VVMP1' => $vvmp1,
                        ':ST1' => $st1,
                    ))
                    ->queryScalar();

        return $marks;

    }

    public function recalculateVmp4()
    {
        $array = array(
            $this->vmp5,
            $this->vmp6,
            $this->vmp7
        );

        $this->saveAttributes(array(
            'vmp4' => array_sum($array)
        ));
    }

    public function isModuleExtended($vvmp1, $module)
    {
        $isExtended = Yii::app()->db->createCommand()
                        ->select('count(*)')
                        ->from('vmp')
                        ->where('vmp1 = :VVMP1 AND vmp3 = :MODULE_NUM and (vmp5 <> 0 OR vmp6 <> 0 OR vmp7 <> 0)', array(
                            ':VVMP1' => $vvmp1,
                            ':MODULE_NUM' => $module,
                        ))
                        ->queryScalar();

        return (bool)$isExtended;
    }
}
