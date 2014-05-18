<?php

/**
 * This is the model class for table "innf".
 *
 * The followings are the available columns in table 'innf':
 * @property integer $innf1
 * @property string $innf2
 * @property string $innf3
 * @property string $innf4
 */
class Innf extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'innf';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('innf1', 'numerical', 'integerOnly'=>true),
			array('innf2, innf4', 'length', 'max'=>20),
			array('innf3', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('innf1, innf2, innf3, innf4', 'safe', 'on'=>'search'),
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
			'innf1' => 'Innf1',
			'innf2' => 'Innf2',
			'innf3' => 'Innf3',
			'innf4' => 'Innf4',
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

		$criteria->compare('innf1',$this->innf1);
		$criteria->compare('innf2',$this->innf2,true);
		$criteria->compare('innf3',$this->innf3,true);
		$criteria->compare('innf4',$this->innf4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Innf the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getIndexesByArray()
    {
        $sql = <<<SQL
        SELECT *
        FROM innf
        WHERE innf4=:INNF4
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':INNF4', date('Y'));
        $indexes = $command->queryAll();

        foreach ($indexes as $key => $index) {
            $indexes[$key]['id']   = $index['innf1'];
            $indexes[$key]['name'] = $index['innf2'].' '.$index['innf3'];
        }

        return $indexes;
    }
}
