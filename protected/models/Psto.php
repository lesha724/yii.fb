<?php

/**
 * This is the model class for table "psto".
 *
 * The followings are the available columns in table 'psto':
 * @property integer $psto1
 * @property integer $psto2
 * @property string $psto3
 * @property string $psto4
 */
class Psto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'psto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('psto1, psto2', 'numerical', 'integerOnly'=>true),
			array('psto3', 'length', 'max'=>6000),
            array('psto3', 'purifyText'),
			array('psto4', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('psto1, psto2, psto3, psto4', 'safe', 'on'=>'search'),
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
			'psto1' => 'Psto1',
			'psto2' => 'Psto2',
			'psto3' => 'Psto3',
			'psto4' => 'Psto4',
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

		$criteria->compare('psto1',$this->psto1);
		$criteria->compare('psto2',$this->psto2);
		$criteria->compare('psto3',$this->psto3,true);
		$criteria->compare('psto4',$this->psto4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Psto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function purifyText($attribute, $params)
    {
        $text = $this->$attribute;

        $p = new CHtmlPurifier();

        $text = $p->purify($text);
        $text = strip_tags($p->purify($text));
        $text = trim($text);

        $this->$attribute = $text;
    }
}
