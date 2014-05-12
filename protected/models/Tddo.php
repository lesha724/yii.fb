<?php

/**
 * This is the model class for table "tddo".
 *
 * The followings are the available columns in table 'tddo':
 * @property integer $tddo1
 * @property integer $tddo2
 * @property integer $tddo3
 * @property string $tddo4
 * @property string $tddo5
 * @property string $tddo6
 * @property integer $tddo7
 * @property string $tddo8
 * @property string $tddo9
 * @property integer $tddo10
 * @property integer $tddo11
 * @property string $tddo12
 * @property string $tddo13
 * @property string $tddo14
 * @property integer $tddo15
 */
class Tddo extends CActiveRecord
{
    public $executor;

    public $executorType = 0;

    const ONLY_TEACHERS = 1;
    const ONLY_INDEXES  = 2;
    const ONLY_CHAIRS   = 3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tddo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tddo1, tddo2, tddo3, tddo7, tddo10, tddo11, tddo15', 'numerical', 'integerOnly'=>true),
			array('tddo4, tddo9, tddo13', 'length', 'max'=>8),
			array('tddo5', 'length', 'max'=>400),
			array('tddo6', 'length', 'max'=>4000),
			array('tddo8, tddo12', 'length', 'max'=>180),
			array('tddo14', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tddo1, tddo2, tddo3, tddo4, tddo5, tddo6, tddo7, tddo8, tddo9, tddo10, tddo11, tddo12, tddo13, tddo14, tddo15', 'safe', 'on'=>'search'),
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
			'tddo1' => 'Tddo1',
			'tddo2' => 'Tddo2',
			'tddo3' => '№',
			'tddo4' => tt('Дата'),
			'tddo5' => 'Tddo5',
			'tddo6' => tt('Краткое содержание'),
			'tddo7' => tt('Входящий номер регистрации'),
			'tddo8' => tt('Исходящий номер регистрации'),
			'tddo9' => tt('Дата'),
			'tddo10' => tt('Сдан оригинал в канц.'),
			'tddo11' => 'Tddo11',
			'tddo12' => 'Tddo12',
			'tddo13' => 'Tddo13',
			'tddo14' => 'Tddo14',
			'tddo15' => 'Tddo15',
            'executor' => tt('Исполнитель'),
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

		$criteria->compare('tddo1',$this->tddo1);
		$criteria->compare('tddo2',$this->tddo2);
		$criteria->compare('tddo3',$this->tddo3);
		$criteria->compare('tddo4',$this->tddo4,true);
		$criteria->compare('tddo5',$this->tddo5,true);
		$criteria->compare('tddo6',$this->tddo6,true);
		$criteria->compare('tddo7',$this->tddo7);
		$criteria->compare('tddo8',$this->tddo8,true);
		$criteria->compare('tddo9',$this->tddo9,true);
		$criteria->compare('tddo10',$this->tddo10);
		$criteria->compare('tddo11',$this->tddo11);
		$criteria->compare('tddo12',$this->tddo12,true);
		$criteria->compare('tddo13',$this->tddo13,true);
		$criteria->compare('tddo14',$this->tddo14,true);
		$criteria->compare('tddo15',$this->tddo15);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tddo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getDocsFor($docType)
    {
        $criteria=new CDbCriteria;

        $criteria->compare('tddo2', $docType);

        $provider = new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 20
            )
        ));

        $items = $provider->getData();
        foreach ($items as $key => $item) {
            $items[$key]->executor = $item->executorNames;
        }
        $provider->setData($items);

        return $provider;
    }

    public static function getTddo5Header($docType)
    {
        if ($docType == 1)
            $header = tt('Город и название организации отправителя');
        elseif ($docType == 2)
            $header = tt('Город и название организации получателя');
        else
            $header = tt('От кого');

        return $header;
    }

    public function getExecutorNames()
    {
        $executors = array();

        $sql = <<<SQL
            SELECT ido2, ido3, ido4, ido5, p3, p4, p5, innf2, innf3
            FROM IDO
            LEFT JOIN PD on (pd1 = ido2)
            LEFT JOIN P on (p1 = pd2)
            LEFT JOIN INNF on (innf1 = ido4)
            WHERE ido1 = :IDO1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':IDO1', $this->tddo1);
        $result = $command->queryAll();

        foreach ($result as $executor) {

            if (empty($executor['ido2'])) // teacher
                continue;

            if ($executor['ido5'] == 1) {
                $symbol = '<i class="icon-ok green"></i>';
            } else {
                $symbol = '<i class="icon-remove red"></i>';
            }

            $executors[] = $symbol.' '.SH::getShortName($executor['p3'], $executor['p4'], $executor['p5']);

            $this->executorType = Tddo::ONLY_TEACHERS;
        }

        if (empty($executors)) {
            foreach ($result as $executor) {

                if (empty($executor['ido4'])) // indexes
                    continue;

                $executors[] = $executor['innf2'].' '.$executor['innf3'];
                $this->executorType = Tddo::ONLY_INDEXES;
            }
        }

        // chairs
        if (empty($executors)) {
            $sql = <<<SQL
                SELECT idok2, idok3, idok4, k3
                FROM idok
                LEFT JOIN K on (k1 = idok2)
                WHERE idok1 = :IDOK1
SQL;
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':IDOK1', $this->tddo1);
            $chairs = $command->queryAll();

            foreach ($chairs as $chair) {

                if ($chair['idok4'] == 1) {
                    $symbol = '<i class="icon-ok green"></i>';
                } else {
                    $symbol = '<i class="icon-remove red"></i>';
                }

                $executors[] = $symbol.' '.$chair['k3'];
                $this->executorType = Tddo::ONLY_CHAIRS;
            }

        }

        return implode('<br>', $executors);
    }

    public static function getNextNumberFor($docType, $date = null)
    {
        if (empty($date))
            $date = date('d.m.Y H:i');

        $year = DateTime::createFromFormat('d.m.Y H:i', $date)->format('Y');

        $sql = <<<SQL
          SELECT max(tddo3)
          FROM tddo
          WHERE tddo2 = :DOC_TYPE and EXTRACT (year FROM tddo4) = :YEAR
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':DOC_TYPE', $docType);
        $command->bindValue(':YEAR', $year);
        $count = $command->queryScalar();

        return $count + 1;
    }

}
