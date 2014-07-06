<?php

/**
 * This is the model class for table "dao".
 *
 * The followings are the available columns in table 'dao':
 * @property integer $dao1
 * @property integer $dao2
 * @property string $dao3
 * @property string $dao4
 * @property integer $dao5
 * @property string $dao6
 */
class Dao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dao1', 'required'),
			array('dao1, dao2, dao5', 'numerical', 'integerOnly'=>true),
			array('dao3', 'length', 'max'=>200),
			array('dao4', 'length', 'max'=>40),
			array('dao6', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dao1, dao2, dao3, dao4, dao5, dao6', 'safe', 'on'=>'search'),
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
			'dao1' => 'Dao1',
			'dao2' => 'Dao2',
			'dao3' => 'Dao3',
			'dao4' => 'Dao4',
			'dao5' => 'Dao5',
			'dao6' => 'Dao6',
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

		$criteria->compare('dao1',$this->dao1);
		$criteria->compare('dao2',$this->dao2);
		$criteria->compare('dao3',$this->dao3,true);
		$criteria->compare('dao4',$this->dao4,true);
		$criteria->compare('dao5',$this->dao5);
		$criteria->compare('dao6',$this->dao6,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAllRegionsFor($country)
    {
        if (empty($country))
            return array();

        $sql=<<<SQL
           SELECT dao1,dao3
           FROM dao
           WHERE dao2=:COUNTRY
           ORDER BY dao3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':COUNTRY', $country);
        $regions = $command->queryAll();

        return $regions;
    }
}
