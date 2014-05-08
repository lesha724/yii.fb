<?php

/**
 * This is the model class for table "tsg".
 *
 * The followings are the available columns in table 'tsg':
 * @property integer $tsg1
 * @property string $tsg2
 * @property integer $tsg3
 */
class Tsg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tsg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tsg1', 'required'),
			array('tsg1, tsg3', 'numerical', 'integerOnly'=>true),
			array('tsg2', 'length', 'max'=>600),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tsg1, tsg2, tsg3', 'safe', 'on'=>'search'),
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
			'tsg1' => 'Tsg1',
			'tsg2' => 'Tsg2',
			'tsg3' => 'Tsg3',
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

		$criteria->compare('tsg1',$this->tsg1);
		$criteria->compare('tsg2',$this->tsg2,true);
		$criteria->compare('tsg3',$this->tsg3);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tsg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
