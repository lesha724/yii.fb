<?php

/**
 * This is the model class for table "mmbj".
 *
 * The followings are the available columns in table 'mmbj':
 * @property integer $mmbj1
 * @property integer $mmbj2
 * @property integer $mmbj3
 * @property double $mmbj4
 * @property double $mmbj5
 */
class Mmbj extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mmbj';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mmbj1, mmbj2, mmbj3', 'numerical', 'integerOnly'=>true),
			array('mmbj4, mmbj5', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mmbj1, mmbj2, mmbj3, mmbj4, mmbj5', 'safe', 'on'=>'search'),
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
			'mmbj1' => 'Mmbj1',
			'mmbj2' => 'Mmbj2',
			'mmbj3' => 'Mmbj3',
			'mmbj4' => 'Mmbj4',
			'mmbj5' => 'Mmbj5',
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

		$criteria->compare('mmbj1',$this->mmbj1);
		$criteria->compare('mmbj2',$this->mmbj2);
		$criteria->compare('mmbj3',$this->mmbj3);
		$criteria->compare('mmbj4',$this->mmbj4);
		$criteria->compare('mmbj5',$this->mmbj5);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mmbj the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getDataFor($nr1)
    {
        $raws = Yii::app()->db->createCommand()
                ->select('*')
                ->from('mmbj')
                ->where(array('in', 'mmbj2', $nr1))
                ->queryAll();

        $res = array();
        foreach ($raws as $raw) {
            $res[ $raw['mmbj3'] ] = $raw;
        };

        return $res;
    }

    public function getTotalFor($nr1)
    {
        $data = Yii::app()->db->createCommand()
                    ->select('sum(mmbj4) as minValue, sum(mmbj5) as maxValue')
                    ->from('mmbj')
                    ->where(array('in', 'mmbj2', $nr1))
                    ->queryRow();

        $res['min'] = round($data['minvalue'], 1);
        $res['max'] = round($data['maxvalue'], 1);

        return $res;
    }


}
