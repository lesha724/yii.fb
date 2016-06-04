<?php

/**
 * This is the model class for table "elgd".
 *
 * The followings are the available columns in table 'elgd':
 * @property integer $elgd1
 * @property integer $elgd0
 * @property integer $elgd2
 */
class Elgd extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elgd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elgd1, elgd2', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('elgd1, elgd2', 'safe', 'on'=>'search'),
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
			'elgd1' => 'Elgd1',
			'elgd2' => 'Elgd2',
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

		$criteria->compare('elgd1',$this->elgd1);
		$criteria->compare('elgd2',$this->elgd2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elgd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getDop($elg1)
    {
        if(empty($elg1))
            return array();

        $sql=<<<SQL
                SELECT elgd.*,elgsd.*
                FROM elgd
                    INNER JOIN elgsd on (elgd.elgd2 = elgsd.elgsd1)
                WHERE elgd1=:ELG1
                ORDER BY elgsd4, elgd0
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':ELG1', $elg1);
        $rows = $command->queryAll();

        return $rows;
    }

	public static function checkEmptyElgd($elg1)
	{
		if(empty($elg1))
			return;
		$sql=<<<SQL
                SELECT elgsd.*
                FROM elgsd
                    LEFT JOIN elgd on (elgsd.elgsd1 = elgd.elgd2 AND elgd1 = :ELG1)
                WHERE elgd0 is NULL AND elgsd3=0
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ELG1', $elg1);
		$rows = $command->queryAll();
		foreach($rows as $row)
		{
			$elgd = new Elgd();
			$elgd->elgd0=new CDbExpression('GEN_ID(GEN_ELGD, 1)');
			$elgd->elgd1=$elg1;
			$elgd->elgd2=$row['elgsd1'];
			$elgd->save();
		}
		//return $rows;
	}
}
