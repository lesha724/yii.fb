<?php

/**
 * This is the model class for table "sdp".
 *
 * The followings are the available columns in table 'sdp':
 * @property integer $sdp1
 * @property string $sdp4
 * @property string $sdp5
 * @property integer $sdp6
 * @property string $sdp7
 * @property string $sdp8
 * @property string $sdp10
 * @property string $sdp13
 * @property integer $sdp14
 * @property integer $sdp15
 * @property string $sdp16
 * @property string $sdp17
 * @property string $sdp18
 * @property string $sdp19
 * @property string $sdp20
 * @property string $sdp21
 * @property string $sdp22
 * @property string $sdp23
 * @property string $sdp24
 * @property string $sdp25
 * @property string $sdp26
 * @property string $sdp27
 * @property string $sdp28
 * @property string $sdp30
 * @property string $sdp31
 * @property integer $sdp32
 * @property integer $sdp33
 * @property string $sdp34
 * @property string $sdp35
 * @property string $sdp36
 * @property string $sdp37
 * @property string $sdp38
 * @property double $sdp39
 * @property double $sdp40
 * @property integer $sdp41
 * @property integer $sdp42
 * @property integer $sdp43
 * @property string $sdp44
 * @property integer $sdp45
 * @property string $sdp46
 * @property integer $sdp47
 */
class Sdp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sdp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sdp1', 'required'),
            array('sdp31', 'email'),
			array('sdp1, sdp6, sdp14, sdp15, sdp32, sdp33, sdp41, sdp42, sdp43, sdp45, sdp47', 'numerical', 'integerOnly'=>true),
			array('sdp39, sdp40', 'numerical'),
			array('sdp4', 'length', 'max'=>6000),
			array('sdp5', 'length', 'max'=>100),
			array('sdp7, sdp24, sdp25, sdp36, sdp38', 'length', 'max'=>60),
			array('sdp8, sdp10, sdp16, sdp37, sdp46', 'length', 'max'=>8),
            array('sdp13', 'safe'),
			array('sdp17, sdp18, sdp19, sdp20, sdp21', 'length', 'max'=>600),
			array('sdp22', 'length', 'max'=>200),
			array('sdp23, sdp35', 'length', 'max'=>40),
			array('sdp26, sdp27, sdp28', 'length', 'max'=>1400),
			array('sdp30', 'length', 'max'=>180),
			array('sdp31', 'length', 'max'=>300),
			array('sdp34', 'length', 'max'=>4000),
			array('sdp44', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sdp1, sdp4, sdp5, sdp6, sdp7, sdp8, sdp10, sdp13, sdp14, sdp15, sdp16, sdp17, sdp18, sdp19, sdp20, sdp21, sdp22, sdp23, sdp24, sdp25, sdp26, sdp27, sdp28, sdp30, sdp31, sdp32, sdp33, sdp34, sdp35, sdp36, sdp37, sdp38, sdp39, sdp40, sdp41, sdp42, sdp43, sdp44, sdp45, sdp46, sdp47', 'safe', 'on'=>'search'),
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
			'sdp1' => 'Sdp1',
			'sdp4' => tt('Тема диплома').':',
			'sdp5' => 'Sdp5',
			'sdp6' => 'Sdp6',
			'sdp7' => 'Sdp7',
			'sdp8' => 'Sdp8',
			'sdp10' => 'Sdp10',
			'sdp13' => 'Sdp13',
			'sdp14' => 'Sdp14',
			'sdp15' => 'Sdp15',
			'sdp16' => 'Sdp16',
			'sdp17' => 'Sdp17',
			'sdp18' => 'Sdp18',
			'sdp19' => 'Sdp19',
			'sdp20' => 'Sdp20',
			'sdp21' => 'Sdp21',
			'sdp22' => 'Sdp22',
			'sdp23' => 'Sdp23',
			'sdp24' => 'Sdp24',
			'sdp25' => 'Sdp25',
			'sdp26' => tt('Опыт работы').':',
			'sdp27' => tt('Интересы').':',
			'sdp28' => tt('Место работы').':',
			'sdp30' => tt('Телефон').':',
			'sdp31' => tt('Email').':',
			'sdp32' => tt('Отображать статистику успеваемости').':',
			'sdp33' => tt('Отображать комментарии преподавателей').':',
			'sdp34' => 'Sdp34',
			'sdp35' => 'Sdp35',
			'sdp36' => 'Sdp36',
			'sdp37' => 'Sdp37',
			'sdp38' => 'Sdp38',
			'sdp39' => 'Sdp39',
			'sdp40' => 'Sdp40',
			'sdp41' => 'Sdp41',
			'sdp42' => 'Sdp42',
			'sdp43' => 'Sdp43',
			'sdp44' => 'Sdp44',
			'sdp45' => 'Sdp45',
			'sdp46' => 'Sdp46',
			'sdp47' => 'Sdp47',
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

		$criteria->compare('sdp1',$this->sdp1);
		$criteria->compare('sdp4',$this->sdp4,true);
		$criteria->compare('sdp5',$this->sdp5,true);
		$criteria->compare('sdp6',$this->sdp6);
		$criteria->compare('sdp7',$this->sdp7,true);
		$criteria->compare('sdp8',$this->sdp8,true);
		$criteria->compare('sdp10',$this->sdp10,true);
		$criteria->compare('sdp13',$this->sdp13,true);
		$criteria->compare('sdp14',$this->sdp14);
		$criteria->compare('sdp15',$this->sdp15);
		$criteria->compare('sdp16',$this->sdp16,true);
		$criteria->compare('sdp17',$this->sdp17,true);
		$criteria->compare('sdp18',$this->sdp18,true);
		$criteria->compare('sdp19',$this->sdp19,true);
		$criteria->compare('sdp20',$this->sdp20,true);
		$criteria->compare('sdp21',$this->sdp21,true);
		$criteria->compare('sdp22',$this->sdp22,true);
		$criteria->compare('sdp23',$this->sdp23,true);
		$criteria->compare('sdp24',$this->sdp24,true);
		$criteria->compare('sdp25',$this->sdp25,true);
		$criteria->compare('sdp26',$this->sdp26,true);
		$criteria->compare('sdp27',$this->sdp27,true);
		$criteria->compare('sdp28',$this->sdp28,true);
		$criteria->compare('sdp30',$this->sdp30,true);
		$criteria->compare('sdp31',$this->sdp31,true);
		$criteria->compare('sdp32',$this->sdp32);
		$criteria->compare('sdp33',$this->sdp33);
		$criteria->compare('sdp34',$this->sdp34,true);
		$criteria->compare('sdp35',$this->sdp35,true);
		$criteria->compare('sdp36',$this->sdp36,true);
		$criteria->compare('sdp37',$this->sdp37,true);
		$criteria->compare('sdp38',$this->sdp38,true);
		$criteria->compare('sdp39',$this->sdp39);
		$criteria->compare('sdp40',$this->sdp40);
		$criteria->compare('sdp41',$this->sdp41);
		$criteria->compare('sdp42',$this->sdp42);
		$criteria->compare('sdp43',$this->sdp43);
		$criteria->compare('sdp44',$this->sdp44,true);
		$criteria->compare('sdp45',$this->sdp45);
		$criteria->compare('sdp46',$this->sdp46,true);
		$criteria->compare('sdp47',$this->sdp47);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sdp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function loadModel($st1)
    {
        $model = Sdp::model()->findByPk($st1);

        if (empty($model)) {
            $model = new Sdp();
            $model->sdp1 = $st1;
        }

        return $model;
    }
}
