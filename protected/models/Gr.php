<?php

/**
 * This is the model class for table "gr".
 *
 * The followings are the available columns in table 'gr':
 * @property integer $gr1
 * @property integer $gr2
 * @property string $gr3
 * @property string $gr4
 * @property string $gr6
 * @property integer $gr7
 * @property integer $gr8
 * @property string $gr13
 * @property integer $gr14
 * @property integer $gr15
 * @property string $gr16
 * @property string $gr17
 * @property string $gr19
 * @property string $gr20
 * @property string $gr21
 * @property string $gr22
 * @property string $gr23
 * @property string $gr24
 * @property string $gr25
 * @property integer $gr26
 * @property string $gr27
 * @property string $gr28
 * @property integer $gr10
 */
class Gr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gr1, gr2, gr7, gr8, gr14, gr15, gr26, gr10', 'numerical', 'integerOnly'=>true),
			array('gr3, gr19, gr20, gr21, gr22, gr23, gr24, gr28', 'length', 'max'=>180),
			array('gr4', 'length', 'max'=>100),
			array('gr6, gr25', 'length', 'max'=>8),
			array('gr13, gr16', 'length', 'max'=>4),
			array('gr17', 'length', 'max'=>28),
			array('gr27', 'length', 'max'=>140),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('gr1, gr2, gr3, gr4, gr6, gr7, gr8, gr13, gr14, gr15, gr16, gr17, gr19, gr20, gr21, gr22, gr23, gr24, gr25, gr26, gr27, gr28, gr10', 'safe', 'on'=>'search'),
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
			'gr1' => 'Gr1',
			'gr2' => 'Gr2',
			'gr3' => 'Gr3',
			'gr4' => 'Gr4',
			'gr6' => 'Gr6',
			'gr7' => 'Gr7',
			'gr8' => 'Gr8',
			'gr13' => 'Gr13',
			'gr14' => 'Gr14',
			'gr15' => 'Gr15',
			'gr16' => 'Gr16',
			'gr17' => 'Gr17',
			'gr19' => 'Gr19',
			'gr20' => 'Gr20',
			'gr21' => 'Gr21',
			'gr22' => 'Gr22',
			'gr23' => 'Gr23',
			'gr24' => 'Gr24',
			'gr25' => 'Gr25',
			'gr26' => 'Gr26',
			'gr27' => 'Gr27',
			'gr28' => 'Gr28',
			'gr10' => 'Gr10',
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

		$criteria->compare('gr1',$this->gr1);
		$criteria->compare('gr2',$this->gr2);
		$criteria->compare('gr3',$this->gr3,true);
		$criteria->compare('gr4',$this->gr4,true);
		$criteria->compare('gr6',$this->gr6,true);
		$criteria->compare('gr7',$this->gr7);
		$criteria->compare('gr8',$this->gr8);
		$criteria->compare('gr13',$this->gr13,true);
		$criteria->compare('gr14',$this->gr14);
		$criteria->compare('gr15',$this->gr15);
		$criteria->compare('gr16',$this->gr16,true);
		$criteria->compare('gr17',$this->gr17,true);
		$criteria->compare('gr19',$this->gr19,true);
		$criteria->compare('gr20',$this->gr20,true);
		$criteria->compare('gr21',$this->gr21,true);
		$criteria->compare('gr22',$this->gr22,true);
		$criteria->compare('gr23',$this->gr23,true);
		$criteria->compare('gr24',$this->gr24,true);
		$criteria->compare('gr25',$this->gr25,true);
		$criteria->compare('gr26',$this->gr26);
		$criteria->compare('gr27',$this->gr27,true);
		$criteria->compare('gr28',$this->gr28,true);
		$criteria->compare('gr10',$this->gr10);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getGroupsFor($discipline, $type = null)
    {
        if (empty($discipline))
            return array();
        $sql = <<<SQL
            select gr1,gr3,  sem4,gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26,gr28,gr7
            from sem
               inner join us on (sem1 = us12)
               inner join uo on (us2 = uo1)
               inner join u on (uo22 = u1)
               inner join sg on (u2 = sg1)
               inner join
                          (select nr1,nr2
                          from pd
                             inner join nr on (pd1 = nr6) or (pd1 = nr7) or (pd1 = nr8) or (pd1 = nr9)
                             inner join us on (nr2 = us1)
                          where pd1>0 and pd2=:P1
                          group by nr1,nr2)
                on (us1 = nr2)
               inner join ug on (ug3 = nr1)
               inner join r on (nr1 = r1)
               inner join gr on (ug2 = gr1)
            where sg4=0 and sem3=:YEAR and sem5=:SEM and uo3=:D1 and us4 in (2,3,4)
            group by sem4,gr3,gr7,gr1,gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26,gr28
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
        $command->bindValue(':D1', $discipline);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $groups = $command->queryAll();

        foreach($groups as $key => $group) {
            $groups[$key]['name'] = $this->getGroupName($group['sem4'], $group);
        }

        return $groups;
    }

    public function getGroupName($cr, $data)
    {
        switch($cr) {
            case 1:
                $name = !empty($data['gr19']) ? $data['gr19'] : $data['gr3']; break;
            case 2:
                $name = !empty($data['gr21']) ? $data['gr21'] : $data['gr3']; break;
            case 3:
                $name = !empty($data['gr22']) ? $data['gr22'] : $data['gr3']; break;
            case 4:
                $name = !empty($data['gr23']) ? $data['gr23'] : $data['gr3']; break;
            case 5:
                $name = !empty($data['gr24']) ? $data['gr24'] : $data['gr3']; break;
            case 6:
                $name = !empty($data['gr25']) ? $data['gr25'] : $data['gr3']; break;
            case 7:
                $name = !empty($data['gr26']) ? $data['gr26'] : $data['gr3']; break;
            default:
                $name = $data['gr3'];
        }

        return $name;
    }

    public function getGroupsForTimeTable($faculty, $course)
    {
        if (empty($faculty) || empty($course))
            return array();

        $sql=<<<SQL
            SELECT sg4, sem4, gr7,gr3,gr1, gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26
            FROM SP
            INNER JOIN SG ON (SP1 = SG2)
            INNER JOIN SEM ON (SG1 = SEM2)
            INNER JOIN GR ON (SG1 = GR2)
            INNER JOIN GRK ON (GR1 = GRK1)
            WHERE gr13=0 and sp5=:FACULTY and gr6 is null and sem3=:YEAR1 and sem5=:SEM1 and grk2=:YEAR2 and grk3=:SEM2
            and (grk4 > 0 or grk5 > 0 or grk6 > 0 or grk7 > 0) and sem4=:COURSE
            GROUP BY sg4, sem4, gr7,gr3,gr1, gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26
            ORDER BY gr7,gr3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':FACULTY', $faculty);
        $command->bindValue(':COURSE', $course);
        $command->bindValue(':YEAR1', date('Y'));
        $command->bindValue(':YEAR2', date('Y'));
        $command->bindValue(':SEM1', date('n')>=8 ? 0 : 1);
        $command->bindValue(':SEM2', date('n')>=8 ? 0 : 1);
        $groups = $command->queryAll();

        foreach($groups as $key => $group) {
            $groups[$key]['name'] = $this->getGroupName($course, $group);
        }

        return $groups;
    }

    public static function getTimeTable($gr1, $date1, $date2)
    {
        $sql = <<<SQL
        SELECT *
        FROM RAGR(:LANG, :GR1, :DATE_1, :DATE_2)
        ORDER BY r2,r3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':LANG', 1);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':DATE_1', $date1);
        $command->bindValue(':DATE_2', $date2);
        $timeTable = $command->queryAll();

        if (empty($timeTable))
            return array();

        return $timeTable;
    }
}
