<?php

/**
 * This is the model class for table "fpdd".
 *
 * The followings are the available columns in table 'fpdd':
 * @property integer $fpdd1
 * @property integer $fpdd2
 * @property string $fpdd3
 * @property string $fpdd4
 */
class Fpdd extends CGraficActiveRecord
{
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
			array('fpdd1, fpdd2, fpdd3, fpdd4', 'required'),
			array('fpdd1, fpdd2', 'numerical', 'integerOnly'=>true),
			//array('fpdd3', 'length', 'max'=>8),
			array('fpdd4', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fpdd1, fpdd2, fpdd3, fpdd4', 'safe', 'on'=>'search'),
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
		$criteria->compare('fpdd2',$this->fpdd2);
		$criteria->compare('fpdd3',$this->fpdd3,true);
		$criteria->compare('fpdd4',$this->fpdd4,true);

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

    /**
     * Являеться ли пикрепленый файл изображением
     * @return bool
     */
    public function isImage(){
        $ext=$this->getExtension();

        switch($ext){
            case 'doc':
            case 'docx':
            case 'xls':
            case 'xlsx':
            case 'pdf':
                $result = false;
                break;
            default:
                $result = true;
                break;
        }
        return $result;
    }

    /**
     * расширение прикрепленого файла по имени
     * @param $fileName
     * @return mixed
     */
    public function getExtension(){
        $ext = explode(".",$this->fpdd4);
        return strtolower(end($ext));
    }
}
