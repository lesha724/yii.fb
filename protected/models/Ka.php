<?php

/**
 * This is the model class for table "ka".
 *
 * The followings are the available columns in table 'ka':
 * @property integer $ka1
 * @property string $ka2
 * @property integer $ka3
 * @property integer $ka4
 */
class Ka extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ka';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ka1, ka3, ka4', 'numerical', 'integerOnly'=>true),
			array('ka2', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ka1, ka2, ka3, ka4', 'safe', 'on'=>'search'),
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
			'ka1' => 'Ka1',
			'ka2' => 'Ka2',
			'ka3' => 'Ka3',
			'ka4' => 'Ka4',
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

		$criteria->compare('ka1',$this->ka1);
		$criteria->compare('ka2',$this->ka2,true);
		$criteria->compare('ka3',$this->ka3);
		$criteria->compare('ka4',$this->ka4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ka the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getHousingFor($filial)
    {
        $sql=<<<SQL
            SELECT KA1,KA2
            FROM KA
            WHERE KA3=:FILIAL and KA1>0
            ORDER BY KA2
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':FILIAL', $filial);
        $housing = $command->queryAll();

        return $housing;
    }
}
