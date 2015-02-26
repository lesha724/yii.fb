<?php

/**
 * This is the model class for table "fpdd".
 *
 * The followings are the available columns in table 'fpdd':
 * @property integer $fpdd1
 * @property string $fpdd2
 * @property integer $fpdd3
 * @property string $fpdd4
 * @property string $fpdd5
 */
class Fpdd extends CActiveRecord
{
    public $doc_file;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fpdd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fpdd1, fpdd3', 'numerical', 'integerOnly'=>true),
			array('fpdd2', 'length', 'max'=>400),
			array('fpdd4, fpdd5', 'length', 'max'=>1000),
            array('doc_file', 'file', 'allowEmpty'=>true, 'maxSize'=>1024 * 1024 * 10, 'tooLarge'=>'File has to be smaller than 10MB'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fpdd1, fpdd2, fpdd3, fpdd4, fpdd5', 'safe', 'on'=>'search'),
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
			'fpdd1' => 'Fpdd1',
			'fpdd2' => 'Fpdd2',
			'fpdd3' => 'Fpdd3',
			'fpdd4' => 'Fpdd4',
			'fpdd5' => 'Fpdd5',
            'doc_file' => tt('Прикрепить файл')
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

		$criteria->compare('fpdd1',$this->fpdd1);
		$criteria->compare('fpdd2',$this->fpdd2,true);
		$criteria->compare('fpdd3',$this->fpdd3);
		$criteria->compare('fpdd4',$this->fpdd4,true);
		$criteria->compare('fpdd5',$this->fpdd5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fpdd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
