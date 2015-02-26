<?php

/**
 * This is the model class for table "cn".
 *
 * The followings are the available columns in table 'cn':
 * @property integer $cn1
 * @property string $cn2
 * @property integer $cn3
 * @property string $cn4
 */
class Cn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cn1', 'required'),
			array('cn1, cn3', 'numerical', 'integerOnly'=>true),
			array('cn2', 'length', 'max'=>200),
			array('cn4', 'length', 'max'=>400),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cn1, cn2, cn3, cn4', 'safe', 'on'=>'search'),
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
			'cn1' => 'Cn1',
			'cn2' => 'Cn2',
			'cn3' => 'Cn3',
			'cn4' => 'Cn4',
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

		$criteria->compare('cn1',$this->cn1);
		$criteria->compare('cn2',$this->cn2,true);
		$criteria->compare('cn3',$this->cn3);
		$criteria->compare('cn4',$this->cn4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAllCn()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('cn1 > 0');

        $cns = $this->findAll($criteria);

        return $cns;
    }
}
