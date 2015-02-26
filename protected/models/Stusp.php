<?php

/**
 * This is the model class for table "stusp".
 *
 * The followings are the available columns in table 'stusp':
 * @property integer $stusp0
 * @property integer $stusp5
 * @property integer $stusp3
 * @property string $stusp11
 * @property integer $stusp8
 * @property string $stusp6
 * @property string $stusp7
 * @property string $stusp12
 * @property integer $stusp2
 */
class Stusp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stusp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stusp0, stusp5, stusp3, stusp8, stusp2', 'numerical', 'integerOnly'=>true),
			array('stusp11, stusp6', 'length', 'max'=>8),
			array('stusp7', 'length', 'max'=>60),
			array('stusp12', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stusp0, stusp5, stusp3, stusp11, stusp8, stusp6, stusp7, stusp12, stusp2', 'safe', 'on'=>'search'),
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
			'stusp0' => 'Stusp0',
			'stusp5' => 'Stusp5',
			'stusp3' => 'Stusp3',
			'stusp11' => 'Stusp11',
			'stusp8' => 'Stusp8',
			'stusp6' => 'Stusp6',
			'stusp7' => 'Stusp7',
			'stusp12' => 'Stusp12',
			'stusp2' => 'Stusp2',
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

		$criteria->compare('stusp0',$this->stusp0);
		$criteria->compare('stusp5',$this->stusp5);
		$criteria->compare('stusp3',$this->stusp3);
		$criteria->compare('stusp11',$this->stusp11,true);
		$criteria->compare('stusp8',$this->stusp8);
		$criteria->compare('stusp6',$this->stusp6,true);
		$criteria->compare('stusp7',$this->stusp7,true);
		$criteria->compare('stusp12',$this->stusp12,true);
		$criteria->compare('stusp2',$this->stusp2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stusp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAllStusP($allSt1)
    {
        if (empty($allSt1))
            return array();

        $stus1 = implode(',', $allSt1);
        $sql = <<<SQL
           SELECT stusp.*, stus1, stus19,stus0
           from stusp
           inner join stus on (stusp.stusp0 = stus.stus0)
           WHERE stus1 in ({$stus1})
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $marks = $command->queryAll();

        $res = array();
        foreach ($marks as $mark) {

            $st1    = $mark['stus1'];
            $stus0  = $mark['stus0'];
            $stusp5 = $mark['stusp5']; // номер пересдачи

            $res[$st1][$stus0][$stusp5] = $mark;
        }

        return $res;
    }

    public function customSave($attrs)
    {
        /*$field  = key($attr);
        $value  = $attr[$field];

        if ($field == 'stusp3')
            $value = empty($value) ? 0 : $value;*/

        $sets = $params = array();
        foreach ($attrs as $key => $val) {
            $paramName = ':'.mb_strtoupper($key);
            $sets[] = $key.'='.$paramName;
            $params[$paramName] = $val;
        }
        $sets = implode(', ', $sets);

        $stusp0 = $this->stusp0;
        $stusp5 = $this->stusp5;

        $sql = <<<SQL
          update stusp set {$sets}
          where stusp0={$stusp0} and stusp5={$stusp5}
SQL;

        return Yii::app()->db->createCommand($sql)->execute($params);
    }

}
