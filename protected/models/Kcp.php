<?php

/**
 * This is the model class for table "kcp".
 *
 * The followings are the available columns in table 'kcp':
 * @property integer $kcp1
 * @property integer $kcp2
 *
 * The followings are the available model relations:
 * @property K $kcp20
 */
class Kcp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kcp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kcp2', 'required'),
			array('kcp1, kcp2', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kcp1, kcp2', 'safe', 'on'=>'search'),
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
			'kcp20' => array(self::BELONGS_TO, 'K', 'kcp2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'kcp1' => 'Kcp1',
			'kcp2' => tt('Кафедра'),
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

		$criteria->compare('kcp1',$this->kcp1);
		$criteria->compare('kcp2',$this->kcp2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kcp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getMax()
	{
		$sql=<<<SQL
            SELECT MAX(kcp1) as max_kcp1 FROM kcp
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$max = $command->queryRow();

		return (int) $max['max_kcp1'];
	}
}
