<?php

/**
 * This is the model class for table "k".
 *
 * The followings are the available columns in table 'k':
 * @property integer $k1
 * @property string $k2
 * @property string $k3
 * @property string $k4
 * @property string $k5
 * @property string $k6
 * @property integer $k7
 * @property integer $k8
 * @property string $k9
 * @property integer $k10
 * @property string $k11
 * @property integer $k12
 * @property string $k13
 * @property integer $k14
 * @property string $k15
 * @property string $k16
 * @property string $k17
 * @property string $k18
 */
class K extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'k';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k1', 'required'),
			array('k1, k7, k8, k10, k12, k14', 'numerical', 'integerOnly'=>true),
			array('k2', 'length', 'max'=>200),
			array('k3, k4, k5, k15, k16, k17, k18', 'length', 'max'=>600),
			array('k6, k11', 'length', 'max'=>4),
			array('k9, k13', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('k1, k2, k3, k4, k5, k6, k7, k8, k9, k10, k11, k12, k13, k14, k15, k16, k17, k18', 'safe', 'on'=>'search'),
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
			'k1' => 'K1',
			'k2' => 'K2',
			'k3' => 'K3',
			'k4' => 'K4',
			'k5' => 'K5',
			'k6' => 'K6',
			'k7' => 'K7',
			'k8' => 'K8',
			'k9' => 'K9',
			'k10' => 'K10',
			'k11' => 'K11',
			'k12' => 'K12',
			'k13' => 'K13',
			'k14' => 'K14',
			'k15' => 'K15',
			'k16' => 'K16',
			'k17' => 'K17',
			'k18' => 'K18',
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

		$criteria->compare('k1',$this->k1);
		$criteria->compare('k2',$this->k2,true);
		$criteria->compare('k3',$this->k3,true);
		$criteria->compare('k4',$this->k4,true);
		$criteria->compare('k5',$this->k5,true);
		$criteria->compare('k6',$this->k6,true);
		$criteria->compare('k7',$this->k7);
		$criteria->compare('k8',$this->k8);
		$criteria->compare('k9',$this->k9,true);
		$criteria->compare('k10',$this->k10);
		$criteria->compare('k11',$this->k11,true);
		$criteria->compare('k12',$this->k12);
		$criteria->compare('k13',$this->k13,true);
		$criteria->compare('k14',$this->k14);
		$criteria->compare('k15',$this->k15,true);
		$criteria->compare('k16',$this->k16,true);
		$criteria->compare('k17',$this->k17,true);
		$criteria->compare('k18',$this->k18,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return K the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAllChairs()
    {
        $today = date('Y-m-d');
        $sql = <<<SQL
            SELECT k1,k2,k3
            FROM f
              INNER JOIN k on (f.f1 = k.k7)
            WHERE f1>0 and f12<>0 and f17<>2 and (f19 is null or f19>'{$today}') and
                  k11<>0 and k1>0 and (k9 is null or k9>'{$today}')
            ORDER BY k8,f15,f3,k3
SQL;
        $chairs = Yii::app()->db->createCommand($sql)->queryAll();

        return $chairs;
    }

    public function getOnlyChairsFor($filial)
    {
        $sql=<<<SQL
            SELECT K1,K2,K3,K15,K16,K17,K6,K10, K18
				FROM F
				inner join k on (f.f1 = k.k7)
			WHERE f12='1' and f17='0' and k11='1' and k10=:FILIAL and (k9 is null) and K1>0
			ORDER BY K3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':FILIAL', $filial);
        $chairs = $command->queryAll();

        return $chairs;
    }

    public function getChairByUo1($uo1)
    {
        $sql=<<<SQL
            SELECT uo4
				FROM uo
			WHERE uo1=:UO1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':UO1', $uo1);
        $chair = $command->queryScalar();

        return $chair;
    }

    public function getChairByPd1($pd1)
    {
        $sql=<<<SQL
            SELECT pd4
				FROM pd
			WHERE pd1=:PD1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':PD1', $pd1);
        $chair = $command->queryScalar();

        return $chair;
    }
}
