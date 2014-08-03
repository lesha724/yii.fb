<?php

/**
 * This is the model class for table "sekap".
 *
 * The followings are the available columns in table 'sekap':
 * @property integer $sekap1
 * @property integer $sekap2
 * @property integer $sekap3
 * @property integer $sekap4
 */
class Sekap extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sekap';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sekap1, sekap2, sekap3, sekap4', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sekap1, sekap2, sekap3, sekap4', 'safe', 'on'=>'search'),
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
			'sekap1' => 'Sekap1',
			'sekap2' => 'Sekap2',
			'sekap3' => 'Sekap3',
			'sekap4' => 'Sekap4',
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

		$criteria->compare('sekap1',$this->sekap1);
		$criteria->compare('sekap2',$this->sekap2);
		$criteria->compare('sekap3',$this->sekap3);
		$criteria->compare('sekap4',$this->sekap4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sekap the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function checkIfProfileSubjectExistsFor($spab1)
    {
        $sql = <<<SQL
           SELECT first 1 seka2
           FROM sekap
           INNER JOIN seka ON (seka1=sekap1 AND seka3=sekap2)
           WHERE sekap1=:SPAB1 AND sekap3=1
SQL;
        list($year, ) = SH::getCurrentYearAndSem();
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SPAB1', $spab1);
        $exist = $command->queryScalar();

        return $exist;
    }

}
