<?php

/**
 * This is the model class for table "mej".
 *
 * The followings are the available columns in table 'mej':
 * @property integer $mej1
 * @property integer $mej2
 * @property integer $mej3
 * @property string $mej4
 * @property string $mej5
 */
class Mej extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mej';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mej1', 'required'),
			array('mej2, mej3', 'numerical', 'integerOnly'=>true),
			array('mej4, mej5', 'date', 'format'=>'yyyy-mm-dd', 'allowEmpty' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mej1, mej2, mej3, mej4, mej5', 'safe', 'on'=>'search'),
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
			'mej1' => 'Mej1',
			'mej2' => '№',
			'mej3' => tt('Дата начала'),
			'mej4' => tt('Дата окончания'),
			'mej5' => 'Mej5',
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

		$criteria->compare('mej1',$this->mej1);
		$criteria->compare('mej2',$this->mej2);
		$criteria->compare('mej3',$this->mej3);
		$criteria->compare('mej4',$this->mej4,true);
		$criteria->compare('mej5',$this->mej5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mej the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getModulesFor($nr1)
    {
        $criteria=new CDbCriteria;

        $criteria->compare('mej3', $nr1);
        $criteria->limit = 100;

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 't.mej3 ASC',
            ),
        ));
    }
}
