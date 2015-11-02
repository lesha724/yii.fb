<?php

/**
 * This is the model class for table "elgotr".
 *
 * The followings are the available columns in table 'elgotr':
 * @property integer $elgotr0
 * @property integer $elgotr1
 * @property double $elgotr2
 * @property string $elgotr3
 * @property integer $elgotr4
 * @property string $elgotr5
 *
 * The followings are the available model relations:
 * @property Elgzst $elgotr10
 * @property P $elgotr40
 */
class Elgotr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elgotr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elgotr0', 'required'),
			array('elgotr1, elgotr4', 'numerical', 'integerOnly'=>true),
			array('elgotr2', 'numerical'),
			array('elgotr3, elgotr5', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('elgotr0, elgotr1, elgotr2, elgotr3, elgotr4, elgotr5', 'safe', 'on'=>'search'),
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
			'elgotr10' => array(self::BELONGS_TO, 'Elgzst', 'elgotr1'),
			'elgotr40' => array(self::BELONGS_TO, 'P', 'elgotr4'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'elgotr0' => 'Elgotr0',
			'elgotr1' => 'Elgotr1',
            'elgotr2' => tt('Оценка'),
            'elgotr3' => tt('Дата'),
            'elgotr4' => tt('Преподаватель'),
			'elgotr5' => 'Elgotr5',
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

		$criteria->compare('elgotr0',$this->elgotr0);
		$criteria->compare('elgotr1',$this->elgotr1);
		$criteria->compare('elgotr2',$this->elgotr2);
		$criteria->compare('elgotr3',$this->elgotr3,true);
		$criteria->compare('elgotr4',$this->elgotr4);
		$criteria->compare('elgotr5',$this->elgotr5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elgotr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getElgotr2ArrByLk()
    {
        return array('0'=>tt('Не отработано'),'-1'=>tt('Отработано'));
    }

    public function getElgotr2ByLk()
    {
        switch ($this->stego2) {
            case 0:
                return tt('Не отработано');
                break;
            case -1:
                return tt('Отработано');
                break;
            default:
                return '-';
        }
    }
}
