<?php

/**
 * This is the model class for table "spkr".
 *
 * The followings are the available columns in table 'spkr':
 * @property integer $spkr1
 * @property string $spkr2
 * @property string $spkr3
 * @property integer $spkr4
 * @property integer $spkr5
 * @property integer $spkr6
 */
class Spkr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spkr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spkr1', 'required'),
			array(' spkr4, spkr5, spkr6', 'numerical', 'integerOnly'=>true),
			array('spkr2, spkr3', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('spkr1, spkr2, spkr3, spkr4, spkr5, spkr6', 'safe', 'on'=>'search'),
		);
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'spkr1' => 'Spkr1',
			'spkr2' => tt('Оригинальное название'),
			'spkr3' => tt('Название на английском'),
			'spkr4' => 'Spkr4',
			'spkr5' => 'Spkr5',
			'spkr6' => 'Spkr6',
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

		$criteria->compare('spkr1',$this->spkr1);
		$criteria->compare('spkr2',$this->spkr2,true);
		$criteria->compare('spkr3',$this->spkr3,true);
		$criteria->compare('spkr4',$this->spkr4);
		$criteria->compare('spkr5',$this->spkr5);
		$criteria->compare('spkr6',$this->spkr6);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Spkr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function findAllInArray()
    {
        $rows = Yii::app()->db->createCommand()
                ->select('*')
                ->from($this->tableName())
                ->queryAll();

        $rus = array();
        foreach ($rows as $row) {
            $rus[$row['spkr1']] = $row['spkr2'];
            $eng[$row['spkr1']] = $row['spkr3'];
        }
        return array($rus, $eng);
    }

}
