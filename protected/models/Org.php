<?php

/**
 * This is the model class for table "org".
 *
 * The followings are the available columns in table 'org':
 * @property integer $org1
 * @property string $org2
 * @property string $org3
 * @property string $org4
 * @property integer $org5
 *
 * The followings are the available model relations:
 * @property Tddo[] $tddos
 */
class Org extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'org';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('org1, org5', 'numerical', 'integerOnly'=>true),
			array('org2, org4', 'length', 'max'=>1000),
			array('org3', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('org1, org2, org3, org4, org5', 'safe', 'on'=>'search'),
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
			'tddos' => array(self::HAS_MANY, 'Tddo', 'tddo18'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'org1' => 'Org1',
			'org2' => 'Org2',
			'org3' => 'Org3',
			'org4' => 'Org4',
			'org5' => 'Org5',
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

		$criteria->compare('org1',$this->org1);
		$criteria->compare('org2',$this->org2,true);
		$criteria->compare('org3',$this->org3,true);
		$criteria->compare('org4',$this->org4,true);
		$criteria->compare('org5',$this->org5);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Org the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAll()
	{
		$res = CHtml::listData(
				self::model()->findAll(array("select"=>"org1, org2, org3, org4", "order"=>"org2 ASC")),
				// поле модели $myOptionsModel, из которого будет взято value для <option>
				'org1',
				// поле модели $myOptionsModel, из которого будет взята подпись для <option>
				function($data){
					return sprintf('%s / %s / %s',$data->org2,$data->org3,$data->org4);
				}
		);
		return $res;
	}
}
