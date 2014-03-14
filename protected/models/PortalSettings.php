<?php

/**
 * This is the model class for table "portal_settings".
 *
 * The followings are the available columns in table 'portal_settings':
 * @property integer $ps1
 * @property string $ps2
 */
class PortalSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'portal_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ps1', 'required'),
			array('ps1', 'numerical', 'integerOnly'=>true),
			array('ps2', 'length', 'max'=>4000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ps1, ps2', 'safe', 'on'=>'search'),
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
			'ps1' => 'Ps1',
			'ps2' => 'Ps2',
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

		$criteria->compare('ps1',$this->ps1);
		$criteria->compare('ps2',$this->ps2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PortalSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
