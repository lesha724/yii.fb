<?php

/**
 * This is the model class for table "nrst".
 *
 * The followings are the available columns in table 'nrst':
 * @property integer $nrst1
 * @property integer $nrst2
 * @property integer $nrst3
 */
class Nrst extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nrst';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nrst1, nrst2, nrst3', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nrst1, nrst2, nrst3', 'safe', 'on'=>'search'),
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
			'nrst1' => 'Nrst1',
			'nrst2' => 'Nrst2',
			'nrst3' => 'Nrst3',
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

		$criteria->compare('nrst1',$this->nrst1);
		$criteria->compare('nrst2',$this->nrst2);
		$criteria->compare('nrst3',$this->nrst3);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Nrst the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getGostemsForStudent()
    {
        $sql = <<<SQL
        SELECT nrst.nrst1, nrst.nrst3, gostem.gostem4, k.k3
        from k
        INNER JOIN gostem on (k.k1 = gostem.gostem2)
        INNER JOIN nrst on (gostem.gostem1 = nrst.nrst3)
        INNER JOIN nr on (nrst.nrst1 = nr.nr1)
        INNER JOIN us on (nr.nr2 = us.us1)
        INNER JOIN sem on (us.us3 = sem.sem1)
        WHERE sem3 = :YEAR and nrst2 = :ST1
SQL;

        list($year, ) = SH::getCurrentYearAndSem();
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':ST1', Yii::app()->user->dbModel->st1);

        $gostems = $command->queryAll();

        return $gostems;
    }

    public function studentIsAlreadySubscribed($d1, $k1)
    {
        $sql = <<<SQL
        SELECT nr1
        FROM us
        INNER JOIN nr on (us.us1 = nr.nr2)
        INNER JOIN nrst on (nr.nr1 = nrst.nrst1)
        INNER JOIN uo on (us.us2 = uo.uo1)
        WHERE uo3=:D1 and uo4=:K1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':D1', $d1);
        $command->bindValue(':K1', $k1);
        $nr1 = $command->queryScalar();

        $criteria = new CDbCriteria();
        $criteria->compare('nrst1', $nr1);
        $criteria->compare('nrst2', Yii::app()->user->dbModel->st1);

        return Nrst::model()->exists($criteria);
    }
}
