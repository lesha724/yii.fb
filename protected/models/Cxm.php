<?php

/**
 * This is the model class for table "cxm".
 *
 * The followings are the available columns in table 'cxm':
 * @property integer $cxm0
 * @property string $cxm1
 * @property string $cxm2
 * @property string $cxm3
 * @property string $cxm4
 * @property string $cxm5
 * @property string $cxm6
 * @property string $cxm7
 * @property string $cxm20
 * @property integer $cxm21
 * @property integer $cxm22
 * @property integer $cxm23
 * @property integer $cxm24
 *
 * The followings are the available model relations:
 * @property Cxmb[] $cxmbs
 * @property Us[] $uses
 * @property Usup[] $usups
 */
class Cxm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cxm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cxm0, cxm21, cxm22, cxm23, cxm24', 'numerical', 'integerOnly'=>true),
			array('cxm1, cxm2, cxm3, cxm4, cxm5, cxm6, cxm7', 'length', 'max'=>100),
			array('cxm20', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cxm0, cxm1, cxm2, cxm3, cxm4, cxm5, cxm6, cxm7, cxm20, cxm21, cxm22, cxm23, cxm24', 'safe', 'on'=>'search'),
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
			'cxmbs' => array(self::HAS_MANY, 'Cxmb', 'cxmb0'),
			'uses' => array(self::HAS_MANY, 'Us', 'us13'),
			'usups' => array(self::HAS_MANY, 'Usup', 'usup13'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cxm0' => 'Cxm0',
			'cxm1' => 'Cxm1',
			'cxm2' => 'Cxm2',
			'cxm3' => 'Cxm3',
			'cxm4' => 'Cxm4',
			'cxm5' => 'Cxm5',
			'cxm6' => 'Cxm6',
			'cxm7' => 'Cxm7',
			'cxm20' => 'Cxm20',
			'cxm21' => 'Cxm21',
			'cxm22' => 'Cxm22',
			'cxm23' => 'Cxm23',
			'cxm24' => 'Cxm24',
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

		$criteria->compare('cxm0',$this->cxm0);
		$criteria->compare('cxm1',$this->cxm1,true);
		$criteria->compare('cxm2',$this->cxm2,true);
		$criteria->compare('cxm3',$this->cxm3,true);
		$criteria->compare('cxm4',$this->cxm4,true);
		$criteria->compare('cxm5',$this->cxm5,true);
		$criteria->compare('cxm6',$this->cxm6,true);
		$criteria->compare('cxm7',$this->cxm7,true);
		$criteria->compare('cxm20',$this->cxm20,true);
		$criteria->compare('cxm21',$this->cxm21);
		$criteria->compare('cxm22',$this->cxm22);
		$criteria->compare('cxm23',$this->cxm23);
		$criteria->compare('cxm24',$this->cxm24);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cxm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
