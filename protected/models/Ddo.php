<?php

/**
 * This is the model class for table "ddo".
 *
 * The followings are the available columns in table 'ddo':
 * @property integer $ddo1
 * @property string $ddo2
 * @property integer $ddo3
 * @property integer $ddo4
 * @property integer $ddo5
 * @property integer $ddo6
 * @property integer $ddo7
 * @property integer $ddo8
 * @property integer $ddo9
 * @property integer $ddo10
 * @property integer $ddo11
 * @property integer $ddo12
 * @property integer $ddo13
 * @property integer $ddo14
 * @property integer $ddo15
 *
 * The followings are the available model relations:
 * @property Ddoi[] $ddois
 * @property Ddon[] $ddons
 * @property Tddo[] $tddos
 */
class Ddo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ddo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ddo1, ddo3, ddo4, ddo5, ddo6, ddo7, ddo8, ddo9, ddo10, ddo11, ddo12, ddo13, ddo14, ddo15', 'numerical', 'integerOnly'=>true),
			array('ddo2', 'length', 'max'=>180),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ddo1, ddo2, ddo3, ddo4, ddo5, ddo6, ddo7, ddo8, ddo9, ddo10, ddo11, ddo12, ddo13, ddo14, ddo15', 'safe', 'on'=>'search'),
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
			'ddois' => array(self::HAS_MANY, 'Ddoi', 'ddoi2'),
			'ddons' => array(self::HAS_MANY, 'Ddon', 'ddon2'),
			'tddos' => array(self::HAS_MANY, 'Tddo', 'tddo2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ddo1' => 'Ddo1',
			'ddo2' => 'Ddo2',
			'ddo3' => 'Ddo3',
			'ddo4' => 'Ddo4',
			'ddo5' => 'Ddo5',
			'ddo6' => 'Ddo6',
			'ddo7' => 'Ddo7',
			'ddo8' => 'Ddo8',
			'ddo9' => 'Ddo9',
			'ddo10' => 'Ddo10',
			'ddo11' => 'Ddo11',
			'ddo12' => 'Ddo12',
			'ddo13' => 'Ddo13',
			'ddo14' => 'Ddo14',
			'ddo15' => 'Ddo15',
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

		$criteria->compare('ddo1',$this->ddo1);
		$criteria->compare('ddo2',$this->ddo2,true);
		$criteria->compare('ddo3',$this->ddo3);
		$criteria->compare('ddo4',$this->ddo4);
		$criteria->compare('ddo5',$this->ddo5);
		$criteria->compare('ddo6',$this->ddo6);
		$criteria->compare('ddo7',$this->ddo7);
		$criteria->compare('ddo8',$this->ddo8);
		$criteria->compare('ddo9',$this->ddo9);
		$criteria->compare('ddo10',$this->ddo10);
		$criteria->compare('ddo11',$this->ddo11);
		$criteria->compare('ddo12',$this->ddo12);
		$criteria->compare('ddo13',$this->ddo13);
		$criteria->compare('ddo14',$this->ddo14);
		$criteria->compare('ddo15',$this->ddo15);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ddo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/*
	 * Отношение полей tddo к полям ddo
	 *
	 */
	public function getTddoFiledByDdo($ddoField){
		$field = '';
		switch($ddoField){
			case 'ddo3':
				$field = 'tddo7';
				break;
			case 'ddo4':
				$field = 'tddo4';
				break;
			case 'ddo5':
				$field = 'tddo8';
				break;
			case 'ddo6':
				$field = 'tddo9';
				break;
			case 'ddo7':
				$field = 'tddo18';
				break;
			case 'ddo8':
				$field = 'tddo6';
				break;
			case 'ddo9':
				$field = '';
				break;
			case 'ddo10':
				$field = 'tddo19';
				break;
			case 'ddo11':
				$field = 'tddo11';
				break;
			case 'ddo12':
				$field = 'tddo10';
				break;
			case 'ddo13':
				$field = 'tddo17';
				break;
			case 'ddo14':
				$field = 'tddo16';
				break;
			case 'ddo15':
				$field = 'tddo20';
				break;
			default:
				$field = '';

		}
		return $field;
	}
	/*Колонки для грида для типа докумнта*/
	public function generateColumnsGrid(){
		$docTypeIndexModel = Ddoi::model()->findByAttributes(array('ddoi2'=>$this->ddo1));
		if(empty($docTypeIndexModel))
			$docTypeIndexModel = new Ddoi();
		$docTypeNameModel = Ddon::model()->findByAttributes(array('ddon2'=>$this->ddo1));
		if(empty($docTypeNameModel))
			$docTypeNameModel = new Ddon();

		for($i=3;$i<=15; $i++){

			$nameAttr = 'ddon'.$i;
			$indexAttr = 'ddoi'.$i;
			$ddoAttr = 'ddo'.$i;

			$tddoFiled = Ddo::model()->getTddoFiledByDdo($ddoAttr);

			if($tddoFiled=='')
				continue;

			$items[$docTypeIndexModel->$indexAttr] = array(
					'name' => $tddoFiled,
					'header'=>$docTypeNameModel->$nameAttr,
					'value' => '$data->'.$tddoFiled,
					'visible'=>$this->$ddoAttr==1
			);

			switch ($tddoFiled){
				case 'tddo9':
					$items[$docTypeIndexModel->$indexAttr]['value'] = function($data) {
						if(empty($data['tddo9']))
							return '';
						return date_format(date_create_from_format('Y-m-d H:i:s', $data['tddo9']), 'd-m-Y');
					};
				break;
				case 'tddo4':
					$items[$docTypeIndexModel->$indexAttr]['value'] = function($data) {
						if(empty($data['tddo4']))
							return '';
						return date_format(date_create_from_format('Y-m-d H:i:s', $data['tddo4']), 'd-m-Y');
					};
				break;
				case 'tddo18':
					$items[$docTypeIndexModel->$indexAttr]['value'] = function($data) {
						if($data->tddo18==0)
							return '';

						$org = $data->tddo180;

						return sprintf('%s / %s / %s',$org->org2,$org->org3,$org->org4);
					};
					$items[$docTypeIndexModel->$indexAttr]['filter'] = Org::getAll();
				break;
				case 'tddo20':
					$items[$docTypeIndexModel->$indexAttr]['value'] = function($data) {
						if($data->tddo20==0)
							return '';
						$tdo = $data->tddo200;

						return $tdo->tdo2;
					};
					$items[$docTypeIndexModel->$indexAttr]['filter'] = Org::getAll();
				break;
				case 'tddo17':
					$items[$docTypeIndexModel->$indexAttr]['value'] ='$data->getTddo17Type()';
					$items[$docTypeIndexModel->$indexAttr]['filter'] = Tddo::model()->getTddo17Types();
					break;
				case 'tddo10':
					$items[$docTypeIndexModel->$indexAttr]['value'] ='$data->getTddo10Type()';
					$items[$docTypeIndexModel->$indexAttr]['filter'] = Tddo::model()->getTddo10Types();
					break;
				case 'tddo11':
					$items[$docTypeIndexModel->$indexAttr]['value'] ='$data->getTddo11Type()';
					$items[$docTypeIndexModel->$indexAttr]['filter'] = Tddo::model()->getTddo11Types();
					break;
			}
		}

		ksort($items);

		return $items;
	}
}
