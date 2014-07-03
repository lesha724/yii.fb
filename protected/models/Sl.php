<?php

/**
 * This is the model class for table "sl".
 *
 * The followings are the available columns in table 'sl':
 * @property integer $sl1
 * @property string $sl2
 * @property integer $sl3
 * @property string $sl4
 * @property string $sl5
 * @property integer $sl6
 * @property integer $sl7
 * @property integer $sl8
 * @property integer $sl9
 */
class Sl extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sl1', 'required'),
			array('sl1, sl3, sl6, sl7, sl8, sl9', 'numerical', 'integerOnly'=>true),
			array('sl2', 'length', 'max'=>1000),
			array('sl4, sl5', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sl1, sl2, sl3, sl4, sl5, sl6, sl7, sl8, sl9', 'safe', 'on'=>'search'),
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
			'sl1' => 'Sl1',
			'sl2' => 'Sl2',
			'sl3' => 'Sl3',
			'sl4' => 'Sl4',
			'sl5' => 'Sl5',
			'sl6' => 'Sl6',
			'sl7' => 'Sl7',
			'sl8' => 'Sl8',
			'sl9' => 'Sl9',
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

		$criteria->compare('sl1',$this->sl1);
		$criteria->compare('sl2',$this->sl2,true);
		$criteria->compare('sl3',$this->sl3);
		$criteria->compare('sl4',$this->sl4,true);
		$criteria->compare('sl5',$this->sl5,true);
		$criteria->compare('sl6',$this->sl6);
		$criteria->compare('sl7',$this->sl7);
		$criteria->compare('sl8',$this->sl8);
		$criteria->compare('sl9',$this->sl9);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getSlFor($abd1)
    {
        $sql = <<<SQL
                SELECT sl2
				FROM sl
				   INNER JOIN stal ON (sl.sl1 = stal.stal3)
				WHERE sl6=2 and stal2=:ABD1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ABD1', $abd1);
        $sl = $command->queryScalar();
        return $sl;
    }
    public function getAllSl()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('sl1 > 0');
        $criteria->addInCondition('sl6', array(2,3));

        $sls = $this->findAll($criteria);

        return $sls;
    }
}
