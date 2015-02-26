<?php

/**
 * This is the model class for table "spabk".
 *
 * The followings are the available columns in table 'spabk':
 * @property integer $spabk1
 * @property integer $spabk2
 * @property integer $spabk3
 */
class Spabk extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spabk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spabk1, spabk2, spabk3', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('spabk1, spabk2, spabk3', 'safe', 'on'=>'search'),
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
			'spabk1' => 'Spabk1',
			'spabk2' => 'Spabk2',
			'spabk3' => 'Spabk3',
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

		$criteria->compare('spabk1',$this->spabk1);
		$criteria->compare('spabk2',$this->spabk2);
		$criteria->compare('spabk3',$this->spabk3);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Spabk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function checkIfCNExists($spab1)
    {
        $sql = <<<SQL
                SELECT SUM(spabk3)
                FROM spabk
				WHERE spabk1 = :SEL_6
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SEL_6', $spab1);

        $sum = $command->queryScalar();

        return (bool)$sum;
    }

    public function getValueOf($field, $speciality, $cn1)
    {
        $sql = <<<SQL
                SELECT {$field}
				FROM spabk
				WHERE spabk1 = :SEL_6 and SPABK2 = :CN1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SEL_6', $speciality);
        $command->bindValue(':CN1', $cn1);

        $amount = $command->queryScalar();

        return $amount;
    }
}
