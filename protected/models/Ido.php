<?php

/**
 * This is the model class for table "ido".
 *
 * The followings are the available columns in table 'ido':
 * @property integer $ido0
 * @property integer $ido1
 * @property integer $ido2
 * @property integer $ido4
 * @property integer $ido5
 * @property string $ido6
 * @property string $ido7
 * @property integer $ido8
 * @property integer $ido9
 * @property integer $ido11
 *
 * The followings are the available model relations:
 * @property Ido $ido80
 * @property Ido[] $idos
 * @property Tddo $ido10
 * @property Pd $ido20
 * @property Innf $ido40
 * @property P $ido90
 */
class Ido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ido0, ido1, ido2, ido4, ido5, ido8, ido9, ido11', 'numerical', 'integerOnly'=>true),
			array('ido6', 'length', 'max'=>8),
			array('ido7', 'length', 'max'=>400),
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
			'ido80' => array(self::BELONGS_TO, 'Ido', 'ido8'),
			'idos' => array(self::HAS_MANY, 'Ido', 'ido8'),
			'ido10' => array(self::BELONGS_TO, 'Tddo', 'ido1'),
			'ido20' => array(self::BELONGS_TO, 'Pd', 'ido2'),
			'ido40' => array(self::BELONGS_TO, 'Innf', 'ido4'),
			'ido90' => array(self::BELONGS_TO, 'P', 'ido9'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getChildren(){
		$childs = array();

		$idos = $this->idos;
		foreach($idos as $ido){
			/**
			 * @var $ido Ido
			 */
			$childs[$ido->ido0] = array(
					'id'   => $ido->ido0,
					'text' => $ido->getFullText(),
					'children' => $ido->getChildren()

			);
		}
		return $childs;
	}

	public function getFullText(){
		$text = '';

		if ($this->ido4 > 0)
		{
			$innf = $this->ido40;
			$text = sprintf("%s (%s)", $innf->innf3, $innf->innf2);
		}
		else
		{
			//$innf = $this->ido20;
			$info = Pd::model()->getTeacherAndChairByPd1($this->ido2);
			if(!empty($info))
				$text = sprintf("%s (%s)", SH::getShortName($info['p3'],$info['p4'],$info['p5']), $info['k3']);
		}

		$text= tt("Исполнитель: ") . $text . ";";
		if ($this->ido9 > 0)
		{
			$info = Pd::model()->getTeacherAndChairByP1($this->ido9);
			if(!empty($info))
				$text .=' '. tt(" Контролер: ") . sprintf("%s (%s);", SH::getShortName($info['p3'],$info['p4'],$info['p5']), $info['k3']);
		}

		return $text;
	}
}
