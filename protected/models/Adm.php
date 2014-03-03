<?php

/**
 * This is the model class for table "adm".
 *
 * The followings are the available columns in table 'adm':
 * @property integer $adm1
 * @property string $adm2
 * @property string $adm3
 * @property integer $adm4
 * @property integer $adm5
 * @property string $adm6
 * @property string $adm7
 * @property integer $adm8
 * @property integer $adm9
 * @property string $adm10
 * @property integer $adm11
 * @property integer $adm12
 * @property integer $adm13
 * @property integer $adm14
 * @property integer $adm15
 * @property integer $adm16
 * @property integer $adm17
 * @property integer $adm18
 * @property integer $adm19
 * @property integer $adm20
 * @property integer $adm21
 * @property string $adm23
 * @property string $adm24
 * @property string $adm25
 * @property string $adm26
 * @property integer $adm27
 * @property integer $adm28
 * @property integer $adm29
 * @property string $adm22
 * @property string $adm30
 * @property string $adm31
 * @property string $adm32
 * @property integer $adm33
 * @property integer $adm34
 */
class Adm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adm1', 'required'),
			array('adm1, adm4, adm5, adm8, adm9, adm11, adm12, adm13, adm14, adm15, adm16, adm17, adm18, adm19, adm20, adm21, adm27, adm28, adm29, adm33, adm34', 'numerical', 'integerOnly'=>true),
			array('adm2, adm31, adm32', 'length', 'max'=>60),
			array('adm3', 'length', 'max'=>140),
			array('adm6, adm7', 'length', 'max'=>80),
			array('adm10', 'length', 'max'=>200),
			array('adm23, adm24, adm25, adm26', 'length', 'max'=>1200),
			array('adm22, adm30', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('adm1, adm2, adm3, adm4, adm5, adm6, adm7, adm8, adm9, adm10, adm11, adm12, adm13, adm14, adm15, adm16, adm17, adm18, adm19, adm20, adm21, adm23, adm24, adm25, adm26, adm27, adm28, adm29, adm22, adm30, adm31, adm32, adm33, adm34', 'safe', 'on'=>'search'),
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
			'adm1' => 'Adm1',
			'adm2' => 'Adm2',
			'adm3' => 'Adm3',
			'adm4' => 'Adm4',
			'adm5' => 'Adm5',
			'adm6' => 'Adm6',
			'adm7' => 'Adm7',
			'adm8' => 'Adm8',
			'adm9' => 'Adm9',
			'adm10' => 'Adm10',
			'adm11' => 'Adm11',
			'adm12' => 'Adm12',
			'adm13' => 'Adm13',
			'adm14' => 'Adm14',
			'adm15' => 'Adm15',
			'adm16' => 'Adm16',
			'adm17' => 'Adm17',
			'adm18' => 'Adm18',
			'adm19' => 'Adm19',
			'adm20' => 'Adm20',
			'adm21' => 'Adm21',
			'adm23' => 'Adm23',
			'adm24' => 'Adm24',
			'adm25' => 'Adm25',
			'adm26' => 'Adm26',
			'adm27' => 'Adm27',
			'adm28' => 'Adm28',
			'adm29' => 'Adm29',
			'adm22' => 'Adm22',
			'adm30' => 'Adm30',
			'adm31' => 'Adm31',
			'adm32' => 'Adm32',
			'adm33' => 'Adm33',
			'adm34' => 'Adm34',
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

		$criteria->compare('adm1',$this->adm1);
		$criteria->compare('adm2',$this->adm2,true);
		$criteria->compare('adm3',$this->adm3,true);
		$criteria->compare('adm4',$this->adm4);
		$criteria->compare('adm5',$this->adm5);
		$criteria->compare('adm6',$this->adm6,true);
		$criteria->compare('adm7',$this->adm7,true);
		$criteria->compare('adm8',$this->adm8);
		$criteria->compare('adm9',$this->adm9);
		$criteria->compare('adm10',$this->adm10,true);
		$criteria->compare('adm11',$this->adm11);
		$criteria->compare('adm12',$this->adm12);
		$criteria->compare('adm13',$this->adm13);
		$criteria->compare('adm14',$this->adm14);
		$criteria->compare('adm15',$this->adm15);
		$criteria->compare('adm16',$this->adm16);
		$criteria->compare('adm17',$this->adm17);
		$criteria->compare('adm18',$this->adm18);
		$criteria->compare('adm19',$this->adm19);
		$criteria->compare('adm20',$this->adm20);
		$criteria->compare('adm21',$this->adm21);
		$criteria->compare('adm23',$this->adm23,true);
		$criteria->compare('adm24',$this->adm24,true);
		$criteria->compare('adm25',$this->adm25,true);
		$criteria->compare('adm26',$this->adm26,true);
		$criteria->compare('adm27',$this->adm27);
		$criteria->compare('adm28',$this->adm28);
		$criteria->compare('adm29',$this->adm29);
		$criteria->compare('adm22',$this->adm22,true);
		$criteria->compare('adm30',$this->adm30,true);
		$criteria->compare('adm31',$this->adm31,true);
		$criteria->compare('adm32',$this->adm32,true);
		$criteria->compare('adm33',$this->adm33);
		$criteria->compare('adm34',$this->adm34);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Adm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
