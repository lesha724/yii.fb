<?php

/**
 * This is the model class for table "steg".
 *
 * The followings are the available columns in table 'steg':
 * @property integer $steg1
 * @property integer $steg2
 * @property string $steg3
 * @property integer $steg4
 * @property double $steg5
 * @property integer $steg6
 * @property string $steg7
 * @property integer $steg8
 * @property double $steg9
 */
class Steg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'steg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('steg1, steg2, steg4, steg6, steg8', 'numerical', 'integerOnly'=>true),
			array('steg5, steg9', 'numerical'),
			array('steg3, steg7', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('steg1, steg2, steg3, steg4, steg5, steg6, steg7, steg8, steg9', 'safe', 'on'=>'search'),
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
			'steg1' => 'Steg1',
			'steg2' => 'Steg2',
			'steg3' => 'Steg3',
			'steg4' => 'Steg4',
			'steg5' => 'Steg5',
			'steg6' => 'Steg6',
			'steg7' => 'Steg7',
			'steg8' => 'Steg8',
			'steg9' => 'Steg9',
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

		$criteria->compare('steg1',$this->steg1);
		$criteria->compare('steg2',$this->steg2);
		$criteria->compare('steg3',$this->steg3,true);
		$criteria->compare('steg4',$this->steg4);
		$criteria->compare('steg5',$this->steg5);
		$criteria->compare('steg6',$this->steg6);
		$criteria->compare('steg7',$this->steg7,true);
		$criteria->compare('steg8',$this->steg8);
		$criteria->compare('steg9',$this->steg9);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Steg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function fillDataForGroup($gr1, $p1, $d1, $date, $year, $sem)
    {
        $sql = <<<SQL
        EXECUTE PROCEDURE PROC_EL_JURNAL(:GR1, :P1, :D1, :DATE, :YEAR, :SEM, 0);
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':GR1', $gr1);
        $command->bindValue(':P1', $p1);
        $command->bindValue(':D1', $d1);
        $command->bindValue(':DATE', $date);
        $command->bindValue(':YEAR', $year);
        $command->bindValue(':SEM', $sem);
        $command->execute();
    }

    public function getMarksForStudent($st1, $nr1)
    {
        $raws = Yii::app()->db->createCommand()
            ->select('*')
            ->from('steg')
            ->where(array('in', 'steg2', $nr1))
            ->andWhere('steg1 = :ST1', array(':ST1' => $st1))
            ->queryAll();

        $res = array();
        foreach($raws as $raw) {
            $key = $raw['steg2'].'/'.$raw['steg3'].'/'.$raw['steg4'];
            $res[$key] = $raw;
        }

        return $res;
    }

}
