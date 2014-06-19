<?php

/**
 * This is the model class for table "ustem".
 *
 * The followings are the available columns in table 'ustem':
 * @property integer $ustem1
 * @property integer $ustem2
 * @property integer $ustem3
 * @property integer $ustem4
 * @property string $ustem5
 * @property integer $ustem6
 */
class Ustem extends CActiveRecord
{
    public $nr18;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ustem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ustem1', 'required'),
			array('ustem2, ustem3, ustem4, ustem6', 'numerical', 'integerOnly'=>true),
			array('ustem5', 'length', 'max'=>1000),
            array('nr18', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ustem1, ustem2, ustem3, ustem4, ustem5, ustem6', 'safe', 'on'=>'search'),
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
			'ustem1' => 'Ustem1',
			'ustem2' => 'Ustem2',
            'ustem3' => tt('№ темы'),
            'ustem4' => tt('№ занятия'),
            'ustem5' => tt('Тема'),
            'ustem6' => tt('Тип'),
            'groups' => tt('Группы'),
            'nr18'   => tt('Длительность')
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

		$criteria->compare('ustem1',$this->ustem1);
		$criteria->compare('ustem2',$this->ustem2);
		$criteria->compare('ustem3',$this->ustem3);
		$criteria->compare('ustem4',$this->ustem4);
		$criteria->compare('ustem5',$this->ustem5,true);
		$criteria->compare('ustem6',$this->ustem6);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ustem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getThemesBy(FilterForm $model)
    {
        $sql=<<<SQL
            SELECT * FROM TEM_PLAN(:US1, :CODE, :DURATION, :PD1);
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':US1', $model->semester);
        $command->bindValue(':CODE', 1);
        $command->bindValue(':DURATION', $model->duration > 0 ? $model->duration : 1);
        $command->bindValue(':PD1', $model->teacher);
        $themes = $command->queryAll();

        return $themes;
    }

    public function deleteThematicPlan($model)
    {
        $sql=<<<SQL
            SELECT * FROM TEM_PLAN(:US1, :CODE, :DURATION, :PD1);
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':US1', $model->semester);
        $command->bindValue(':CODE', 2);
        $command->bindValue(':DURATION', 0);
        $command->bindValue(':PD1', 0);
        $command->queryAll();
    }

}
