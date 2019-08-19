<?php

/**
 * This is the model class for table "mp".
 *
 * The followings are the available columns in table 'mp':
 * @property integer $mp1
 * @property string $mp5
 */
class Mp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mp1', 'numerical', 'integerOnly'=>true),
            array('mp5', 'string')
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @return array
     */
	public static function getSettinsBy2602(){
        $mpModel = self::model()->findByPk(2602);

        if(empty($mpModel))
            return array();

        return CJSON::decode($mpModel->mp5, true);
    }
}
