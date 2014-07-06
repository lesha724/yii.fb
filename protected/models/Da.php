<?php

/**
 * This is the model class for table "da".
 *
 * The followings are the available columns in table 'da':
 * @property integer $da1
 * @property string $da2
 * @property string $da3
 * @property string $da9
 * @property integer $da10
 * @property integer $da12
 * @property integer $da13
 * @property integer $da14
 * @property integer $da15
 * @property string $da16
 * @property string $da17
 */
class Da extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'da';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('da1', 'required'),
			array('da1, da10, da12, da13, da14, da15', 'numerical', 'integerOnly'=>true),
			array('da2, da16', 'length', 'max'=>40),
			array('da3', 'length', 'max'=>120),
			array('da9', 'length', 'max'=>8),
			array('da17', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('da1, da2, da3, da9, da10, da12, da13, da14, da15, da16, da17', 'safe', 'on'=>'search'),
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
			'da1' => 'Da1',
			'da2' => 'Da2',
			'da3' => 'Da3',
			'da9' => 'Da9',
			'da10' => 'Da10',
			'da12' => 'Da12',
			'da13' => 'Da13',
			'da14' => 'Da14',
			'da15' => 'Da15',
			'da16' => 'Da16',
			'da17' => 'Da17',
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

		$criteria->compare('da1',$this->da1);
		$criteria->compare('da2',$this->da2,true);
		$criteria->compare('da3',$this->da3,true);
		$criteria->compare('da9',$this->da9,true);
		$criteria->compare('da10',$this->da10);
		$criteria->compare('da12',$this->da12);
		$criteria->compare('da13',$this->da13);
		$criteria->compare('da14',$this->da14);
		$criteria->compare('da15',$this->da15);
		$criteria->compare('da16',$this->da16,true);
		$criteria->compare('da17',$this->da17,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Da the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAllCitiesFor($country, $region)
    {
        if (empty($country) || empty($region))
            return array();

        $sql=<<<SQL
           SELECT da1,da3,dar3,da2
           FROM da
           INNER JOIN dar on (da.da14 = dar.dar1)
           WHERE (da12=:COUNTRY and da13 = :REGION) or da13 = 0
           ORDER BY da13,da3
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':COUNTRY', $country);
        $command->bindValue(':REGION', $region);
        $cities = $command->queryAll();

        foreach ($cities as $key => $city) {
            $parts = array();
            $parts[] = $city['da2'];
            $parts[] = $city['da3'];

            if (! empty($city['dar3']))
                $parts[] = '('.$city['dar3'].' '.tt('район').')';

            $cities[$key]['name'] = implode(' ', $parts);
        }

        return $cities;
    }
}
