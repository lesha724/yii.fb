<?php

/**
 * This is the model class for table "elgdst".
 *
 * The followings are the available columns in table 'elgdst':
 * @property integer $elgdst0
 * @property integer $elgdst1
 * @property integer $elgdst2
 * @property double $elgdst3
 *
 * The followings are the available model relations:
 * @property St $elgdst10
 * @property Elgd $elgdst20
 */
class Elgdst extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elgdst';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elgdst0', 'required'),
			array('elgdst1, elgdst2', 'numerical', 'integerOnly'=>true),
			array('elgdst3', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('elgdst0, elgdst1, elgdst2, elgdst3', 'safe', 'on'=>'search'),
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
			'elgdst10' => array(self::BELONGS_TO, 'St', 'elgdst1'),
			'elgdst20' => array(self::BELONGS_TO, 'Elgd', 'elgdst2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'elgdst0' => 'Elgdst0',
			'elgdst1' => 'Elgdst1',
			'elgdst2' => 'Elgdst2',
			'elgdst3' => 'Elgdst3',
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

		$criteria->compare('elgdst0',$this->elgdst0);
		$criteria->compare('elgdst1',$this->elgdst1);
		$criteria->compare('elgdst2',$this->elgdst2);
		$criteria->compare('elgdst3',$this->elgdst3);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elgdst the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getMarksForStudent($st1,$elg1)
    {
        if(empty($st1)||empty($elg1))
            return array();

        $sql=<<<SQL
                SELECT elgdst3,elgd2
                FROM elgdst
                    INNER JOIN elgd on (elgdst.elgdst2 = elgd.elgd0)
                WHERE elgd1=:ELG1 AND elgdst1=:ST1
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ELG1', $elg1);
        $command->bindValue(':ST1', $st1);
        $rows = $command->queryAll();

        $res= array();

        foreach($rows as $row)
        {
            $res[$row['elgd2']]=$row['elgdst3'];
        }

        return $res;
    }
}
