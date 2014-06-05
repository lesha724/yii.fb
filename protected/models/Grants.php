<?php

/**
 * This is the model class for table "grants".
 *
 * The followings are the available columns in table 'grants':
 * @property integer $grants1
 * @property integer $grants2
 * @property integer $grants3
 * @property integer $grants4
 * @property integer $grants5
 *
 * The followings are the available model relations:
 * @property P $p
 */
class Grants extends CActiveRecord
{
    const EL_JOURNAL = 'grant3';
    const MODULES = 'grant4';
    const DOCS = 'grant5';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grants';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grants1, grants2, grants3, grants4, grants5', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('grants1, grants2, grants3', 'safe', 'on'=>'search'),
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
			'p' => array(self::BELONGS_TO, 'P', 'grants2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'grants1' => 'Grants1',
			'grants2' => 'Grants2',
			'grants3' => tt('Эл. журнал'),
			'grants4' => tt('Ведомости'),
			'grants5' => tt('Документооборот'),
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

		$criteria->compare('grants1',$this->grants1);
		$criteria->compare('grants2',$this->grants2);
		$criteria->compare('grants3',$this->grants3);
		$criteria->compare('grants4',$this->grants4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grants the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getGrantsFor($service)
    {
        switch($service){
            case self::EL_JOURNAL:
                $grants = $this->grants3;
                break;
            case self::MODULES:
                $grants = $this->grants4;
                break;
            case self::DOCS:
                $grants = $this->grants5;
                break;
            default:
                $grants = null;
        }

        return $grants;
    }
}
