<?php

/**
 * This is the model class for table "sdp".
 *
 * The followings are the available columns in table 'sdp':
 * @property integer $sdp1
 * @property string $sdp4
 * @property string $sdp5
 * @property integer $sdp6
 * @property string $sdp7
 * @property string $sdp8
 * @property string $sdp10
 * @property string $sdp13
 * @property integer $sdp14
 * @property integer $sdp15
 * @property string $sdp16
 * @property string $sdp17
 * @property string $sdp18
 * @property string $sdp19
 * @property string $sdp20
 * @property string $sdp21
 * @property string $sdp22
 * @property string $sdp23
 * @property string $sdp24
 * @property string $sdp25
 * @property string $sdp26
 * @property string $sdp27
 * @property string $sdp28
 * @property string $sdp30
 * @property string $sdp31
 * @property integer $sdp32
 * @property integer $sdp33
 * @property string $sdp34
 * @property string $sdp35
 * @property string $sdp36
 * @property string $sdp37
 * @property string $sdp38
 * @property double $sdp39
 * @property double $sdp40
 * @property integer $sdp41
 * @property integer $sdp42
 * @property integer $sdp43
 * @property string $sdp44
 * @property integer $sdp45
 * @property string $sdp46
 * @property integer $sdp47
 */
class Sdp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sdp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('sdp1', 'required'),
            array('sdp31', 'email'),
			array('sdp1, sdp6, sdp14, sdp15, sdp32, sdp33, sdp41, sdp42, sdp43, sdp45, sdp47', 'numerical', 'integerOnly'=>true),
			array('sdp39, sdp40, sdp8', 'safe'),
			array('sdp4', 'length', 'max'=>6000),
			array('sdp5', 'length', 'max'=>100),
			array('sdp7, sdp24, sdp25, sdp36, sdp38', 'length', 'max'=>60),
			array('sdp10, sdp16, sdp37, sdp46', 'safe'),
            array('sdp13', 'safe'),
			array('sdp17, sdp18, sdp19, sdp20, sdp21', 'length', 'max'=>600),
			array('sdp22', 'length', 'max'=>200),
			array('sdp23, sdp35', 'length', 'max'=>40),
			array('sdp26, sdp27, sdp28', 'length', 'max'=>1400),
			array('sdp30', 'length', 'max'=>180),
			array('sdp31', 'length', 'max'=>300),
			array('sdp34', 'length', 'max'=>4000),
			array('sdp44', 'length', 'max'=>1000),
        );
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sdp1' => 'Sdp1',
			'sdp4' => tt('Тема диплома').':',
			'sdp5' => 'Sdp5',
			'sdp6' => 'Sdp6',
			'sdp7' => 'Sdp7',
			'sdp8' => 'Sdp8',
			'sdp10' => 'Sdp10',
			'sdp13' => 'Sdp13',
			'sdp14' => 'Sdp14',
			'sdp15' => 'Sdp15',
			'sdp16' => 'Sdp16',
			'sdp17' => 'Sdp17',
			'sdp18' => 'Sdp18',
			'sdp19' => 'Sdp19',
			'sdp20' => 'Sdp20',
			'sdp21' => 'Sdp21',
			'sdp22' => 'Sdp22',
			'sdp23' => 'Sdp23',
			'sdp24' => 'Sdp24',
			'sdp25' => 'Sdp25',
			'sdp26' => tt('Опыт работы').':',
			'sdp27' => tt('Интересы').':',
			'sdp28' => tt('Место работы').':',
			'sdp30' => tt('Телефон').':',
			'sdp31' => tt('Email').':',
			'sdp32' => tt('Отображать статистику успеваемости').':',
			'sdp33' => tt('Отображать комментарии преподавателей').':',
			'sdp34' => 'Sdp34',
			'sdp35' => 'Sdp35',
			'sdp36' => 'Sdp36',
			'sdp37' => 'Sdp37',
			'sdp38' => 'Sdp38',
			'sdp39' => 'Sdp39',
			'sdp40' => 'Sdp40',
			'sdp41' => 'Sdp41',
			'sdp42' => 'Sdp42',
			'sdp43' => 'Sdp43',
			'sdp44' => 'Sdp44',
			'sdp45' => 'Sdp45',
			'sdp46' => 'Sdp46',
			'sdp47' => 'Sdp47',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sdp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function loadModel($st1)
    {
        $model = Sdp::model()->findByPk($st1);

        if (empty($model)) {
            $model = new Sdp();
            $model->unsetAttributes();

            $model->sdp1 = $st1;
            $model->sdp4 = '';
            $model->sdp5 = '';
            $model->sdp6 = 0;
            $model->sdp7 = '';
            $model->sdp8 = '';
            $model->sdp10 = '';
            $model->sdp14 = 0;
            $model->sdp15 = 0;
            $model->sdp16 = '';
            $model->sdp17 = '';
            $model->sdp18 = '';
            $model->sdp19 = '';
            $model->sdp20 = '';
            $model->sdp21 = '';
            $model->sdp22 = '';
            $model->sdp23 = '';
            $model->sdp24 = '';
            $model->sdp25 = '';
            $model->sdp26 = '';
            $model->sdp27 = '';
            $model->sdp28 = '';
            $model->sdp30 = '';
            $model->sdp31 = '';
            $model->sdp32 = 0;
            $model->sdp33 = 0;
            $model->sdp34 = '';
            $model->sdp35 = '';
            $model->sdp36 = '';
            $model->sdp37 = '';
            $model->sdp38 = '';
            $model->sdp39 = 0;
            $model->sdp40 = 0;
            $model->sdp41 = 0;
            $model->sdp42 = 0;
            $model->sdp43 = 0;
            $model->sdp44 = '';
            $model->sdp45 = 0;
            $model->sdp46 = '';
            $model->sdp47 = 0;
            $model->save(false);
        }

        return $model;
    }
}
