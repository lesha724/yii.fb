<?php

/**
 * This is the model class for table "dob".
 *
 * The followings are the available columns in table 'dob':
 * @property integer $dob1
 * @property string $dob2
 * @property string $dob3
 * @property integer $dob4
 */
class Dob extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dob';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dob1', 'required'),
			array('dob1, dob4', 'numerical', 'integerOnly'=>true),
			array('dob2', 'length', 'max'=>300),
			array('dob3', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dob1, dob2, dob3, dob4', 'safe', 'on'=>'search'),
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
			'dob1' => 'Dob1',
			'dob2' => 'Dob2',
			'dob3' => 'Dob3',
			'dob4' => 'Dob4',
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

		$criteria->compare('dob1',$this->dob1);
		$criteria->compare('dob2',$this->dob2,true);
		$criteria->compare('dob3',$this->dob3,true);
		$criteria->compare('dob4',$this->dob4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dob the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAllDocuments()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('dob1 > 0');

        $documents = $this->findAll($criteria);

        return $documents;
    }

}
