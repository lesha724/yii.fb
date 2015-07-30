<?php

/**
 * This is the model class for table "pm".
 *
 * The followings are the available columns in table 'pm':
 * @property integer $pm1
 * @property string $pm2
 * @property string $pm3
 * @property string $pm4
 * @property string $pm5
 * @property string $pm6
 * @property integer $pm7
 * @property integer $pm8
 * @property integer $pm9
 * @property string $pm10
 */
class Pm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pm2, pm3, pm4, pm5, pm6, pm7, pm8, pm9,pm10', 'required'),
			array('pm7, pm8, pm9', 'numerical', 'integerOnly'=>true),
			array('pm2, pm3, pm4, pm5', 'length', 'max'=>400),
			array('pm6', 'length', 'max'=>1020),
                        array('pm6', 'url'),
			array('pm10', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pm2, pm3, pm4, pm5, pm6, pm7, pm8, pm9,pm10', 'safe', 'on'=>'search'),
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
			'pm1' => 'Pm1',
			'pm2' => tt('Заголовок укр.'),
			'pm3' => tt('Заголовок рус.'),
			'pm4' => tt('Заголовок анг.'),
			'pm5' => tt('Заголовок др.'),
			'pm6' => 'url',
			'pm7' => tt('Видимость'),
			'pm8' => tt('Открывать в новой вкладке'),
                    	'pm9' => tt('Приоритет'),
                        'pm10' => tt('Группа'),
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

		$criteria->compare('pm1',$this->pm1);
		$criteria->compare('pm2',$this->pm2,true);
		$criteria->compare('pm3',$this->pm3,true);
		$criteria->compare('pm4',$this->pm4,true);
		$criteria->compare('pm5',$this->pm5,true);
                $criteria->compare('pm6',$this->pm6,true);
		$criteria->compare('pm7',$this->pm7);
		$criteria->compare('pm8',$this->pm8);
		$criteria->compare('pm9',$this->pm9);
		$criteria->compare('pm10',$this->pm10,true);

		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=> Yii::app()->user->getState('pageSize',10),
                    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getPm10Array()
        {
           return array(
               'timeTable'=>tt('Расписание'),
               'workPlan'=>tt('Рабочий план'),
               'list'=>tt('Список'),
               'progress'=>tt('Успеваемость'),
               'entrance'=>tt('Абитуриент'),
               'workLoad'=>tt('Нагрузка'),
               'payment'=>tt('Оплата'),
               'other'=>tt('Другое'),
           );
        }

        public function getPm10()
        {
            $arr = self::getPm10Array();
            if(isset($arr[$this->pm10]))
                return $arr[$this->pm10];
            else
                return '-';
        }
        
        public static function getPm8Array()
        {
           return array(
               0=>tt('Открывать в текущей вкладке'),
               1=>tt('Открывать в новой вкладке'),
           );
        }

        public function getPm8()
        {
            switch ($this->pm8) {
                case 0:
                    return tt('Открывать в текущей вкладке');
                    break;
                case 1:
                    return tt('Открывать в новой вкладке');
                    break;
                default:
                    return '-';
            }
        }
        
        public static function getPm7Array()
        {
           return array(
               0=>tt('Неопубликовано'),
               1=>tt('Опубликовано'),
           );
        }

        public function getPm7()
        {
            switch ($this->pm7) {
                case 0:
                    return tt('Неопубликовано');
                    break;
                case 1:
                    return tt('Опубликовано');
                    break;
                default:
                    return '-';
            }
        }
}
