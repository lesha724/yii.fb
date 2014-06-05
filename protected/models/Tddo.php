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

    //public $executorType = 0;
    public $executionDates;

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
            array('tddo1,tddo13', 'safe'),
			array('tddo2, tddo3, tddo7, tddo10, tddo11, tddo15', 'numerical', 'integerOnly'=>true),
			array('tddo4, tddo9', 'length', 'max'=>10),
			array('tddo5', 'length', 'max'=>400),
			array('tddo6', 'length', 'max'=>4000),
			array('tddo8, tddo12', 'length', 'max'=>180),
			array('tddo14', 'length', 'max'=>1000),
            array('executorType' , 'safe'),
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
            'ido' => array(self::HAS_MANY, 'Ido', 'ido1'),
            'idok' => array(self::HAS_MANY, 'Idok', 'idok1')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        $tddo5Header = Tddo::getTddo5Header($this->tddo2);
		return array(
			'tddo1' => 'Tddo1',
			'tddo2' => 'Tddo2',
			'tddo3' => '№',
			'tddo4' => tt('Дата'),
			'tddo5' => $tddo5Header,
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
            'executorType' => tt('Исполнитель'),
            'executionDates' => tt('Даты контроля исполнений'),

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

        $criteria->compare('tddo3', $this->tddo3);
        $criteria->compare('tddo7', $this->tddo7);
        $criteria->compare('tddo4', $this->tddo4);
        $criteria->addSearchCondition('tddo8', $this->tddo8);
        $criteria->compare('tddo9', $this->tddo9);
        $criteria->addSearchCondition('tddo5', $this->tddo5);
        $criteria->addSearchCondition('tddo6', $this->tddo6);

        $id = Yii::app()->request->getParam('executor', null);
        if (! empty($id)) {
            if ($this->executorType == Tddo::ONLY_TEACHERS) {
                $criteria->with = array(
                    'ido' => array(
                        'select' => false
                    )
                );
                $criteria->compare('ido2', $id);

            } else if ($this->executorType == Tddo::ONLY_INDEXES) {
                $criteria->with = array(
                    'ido' => array(
                        'select' => false
                    )
                );
                $criteria->compare('ido4', $id);

            } else if ($this->executorType == Tddo::ONLY_CHAIRS) {
                $criteria->with = array(
                    'idok' => array(
                        'select' => false
                    )
                );
                $criteria->compare('idok2', $id);
            }

            $criteria->together = true;
        }

        $isPrintMode = stristr(Yii::app()->controller->action->id, 'print');

        $provider = new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => $isPrintMode ? 100 : 10,
            ),
            'sort' => array(
                'defaultOrder' => 'EXTRACT (year FROM tddo4) DESC, tddo3 DESC'
            ),
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

            $symbol = SH::showIcon($executor['ido5']);

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
                $symbol = SH::showIcon($chair['idok4']);
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

    public static function showExecutorFor($docType)
    {
        return (Yii::app()->params['code'] == U_FARM && in_array($docType, array(1,2,3,4))) ||
               (Yii::app()->params['code'] == U_NULAU && $docType != 2);
    }

    public static function getLastInsertId()
    {
        $sql = <<<'SQL'
          SELECT gen_ID(GEN_TDDO, 0)
          FROM RDB$DATABASE
SQL;
        $tddo1 = Yii::app()->db->createCommand($sql)->queryScalar();

        return $tddo1;
    }

    public function getTddo4Formatted()
    {
        return SH::formatDate('Y-m-d H:i:s', 'd.m.Y', $this->tddo4);
    }

    public function getTddo9Formatted()
    {
        return SH::formatDate('Y-m-d H:i:s', 'd.m.Y', $this->tddo9);
    }

    public function getExecutorType()
    {
        if ($this->isNewRecord) {
            $type = $this->tddo2 == 2 ? Tddo::ONLY_INDEXES : Tddo::ONLY_TEACHERS;
        } else {
            if ($this->tddo2 == 2)
                $type = Tddo::ONLY_INDEXES;
            else {
                $tddo1 = $this->tddo1;
                if (Idok::model()->exists('idok1='.$tddo1))
                    $type = Tddo::ONLY_CHAIRS;
                elseif (Ido::model()->exists('ido1='.$tddo1))
                    $type = Tddo::ONLY_TEACHERS;
                else
                    $type = null;
            }
        }

        $emptyTypeOnEdit = $this->scenario == 'edit' &&
                           is_null($type);
        if ($emptyTypeOnEdit)
            $type = Tddo::ONLY_TEACHERS;


        $filterScenario = $this->scenario == 'filter' &&
                          isset($_REQUEST['executorType']);
        if ($filterScenario)
            $type = $_REQUEST['executorType'];


        return $type;
    }

    public function setExecutorType($value)
    {
        $this->executorType = $value;
    }

    public function hasAttachedFiles()
    {
        return Fpdd::model()->exists('fpdd1 = '.$this->tddo1);
    }

    public function isOnControl()
    {
        return Dkid::model()->exists('dkid1 = '.$this->tddo1);
    }

}
