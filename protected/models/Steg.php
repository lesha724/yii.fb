<?php

/**
 * This is the model class for table "steg".
 *
 * The followings are the available columns in table 'steg':
 * @property integer $steg1
 * @property integer $steg2
 * @property string $steg3
 * @property integer $steg4
 * @property double $steg5
 * @property integer $steg6
 * @property string $steg7
 * @property integer $steg8
 * @property double $steg9
 */
class Steg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'steg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('steg1, steg2, steg4, steg6, steg8', 'numerical', 'integerOnly'=>true),
			array('steg5, steg9', 'numerical'),
			array('steg3, steg7', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('steg1, steg2, steg3, steg4, steg5, steg6, steg7, steg8, steg9', 'safe', 'on'=>'search'),
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
			'steg1' => 'Steg1',
			'steg2' => 'Steg2',
			'steg3' => 'Steg3',
			'steg4' => 'Steg4',
			'steg5' => 'Steg5',
			'steg6' => 'Steg6',
			'steg7' => 'Steg7',
			'steg8' => 'Steg8',
			'steg9' => 'Steg9',
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

		$criteria->compare('steg1',$this->steg1);
		$criteria->compare('steg2',$this->steg2);
		$criteria->compare('steg3',$this->steg3,true);
		$criteria->compare('steg4',$this->steg4);
		$criteria->compare('steg5',$this->steg5);
		$criteria->compare('steg6',$this->steg6);
		$criteria->compare('steg7',$this->steg7,true);
		$criteria->compare('steg8',$this->steg8);
		$criteria->compare('steg9',$this->steg9);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Steg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function fillDataForGroup($gr1, $p1, $d1, $date, $year, $sem)
    {
        $sql = <<<SQL
        EXECUTE PROCEDURE PROC_EL_JURNAL(:GR1, :P1, :D1, :DATE, :YEAR, :SEM, 0);
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':P1', $p1);
        $command->bindValue(':D1', $d1);
        $command->bindValue(':DATE', $date);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $command->execute();
    }

    public function getMarksForStudent($st1, $nr1)
    {
        $raws = Yii::app()->db->createCommand()
            ->select('*')
            ->from('steg')
            ->where(array('in', 'steg2', $nr1))
            ->andWhere('steg1 = :ST1', array(':ST1' => $st1))
            ->queryAll();

        $res = array();
        foreach($raws as $raw) {
            $key = $raw['steg2'].'/'.$raw['steg3'].'/'.$raw['steg4'];
            $res[$key] = $raw;
        }

        return $res;
    }

    public function getAttendanceStatisticFor($st1, $start, $end, $monthStatistic)
    {
        if (empty($st1) || empty($start) || empty($end))
            return array();

        $sql=<<<SQL
            SELECT *
            FROM steg
            WHERE steg1=:STEG1 and steg3 >= :DATE1 and steg3 <= :DATE2
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':STEG1', $st1);
        $command->bindValue(':DATE1', $start);
        $command->bindValue(':DATE2', $end);
        $rows = $command->queryAll();

        $statistic = array();

        $statistic['summary'] = array(
            'td1' => 0,
            'td2' => 0,
            'td3' => 0,
        );

        $start = strtotime($start);
        $end   = strtotime($end);

        while($start <= $end) {

            $td1 = $td2 = $td3 = 0;
            foreach ($rows as $row) {

                $steg3 = $row['steg3'];
                $steg6 = $row['steg6'];

                $condition = $monthStatistic
                                ? date('Y-m-d', $start) == date('Y-m-d', strtotime($steg3))
                                : date('Y-m', $start) == date('Y-m', strtotime($steg3));

                if ($condition) {
                    $td1++;                  // whole
                    if ($steg6 == 1) $td2++; // with reason
                    if ($steg6 == 2) $td3++; // without reason
                }
            }

            $statistic[$start] = array(
                'td1' => $td1,
                'td2' => $td2,
                'td3' => $td3,
            );

            $statistic['summary']['td1'] += $td1;
            $statistic['summary']['td2'] += $td2;
            $statistic['summary']['td3'] += $td3;

            $condition = $monthStatistic
                            ? 'next day'
                            : 'first day of next month';
            $start = strtotime($condition, $start);
        }

        return $statistic;
    }
}
