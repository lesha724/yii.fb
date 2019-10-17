<?php

/**
 * This is the model class for table "elgr".
 *
 * The followings are the available columns in table 'elgr':
 * @property integer $elgr1
 * @property integer $elgr2
 * @property string $elgr3
 * @property string $elgr4
 * @property string $elgr5
 * @property integer $elgr6
 */
class Elgr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'elgr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elgr1, elgr2, elgr6', 'numerical', 'integerOnly'=>true),
			array('elgr3, elgr5', 'length', 'max'=>8),
			array('elgr4', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('elgr1, elgr2, elgr3, elgr4, elgr5, elgr6', 'safe', 'on'=>'search'),
		);
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'elgr1' => 'Elgr1',
			'elgr2' => 'Elgr2',
			'elgr3' => 'Elgr3',
			'elgr4' => 'Elgr4',
			'elgr5' => 'Elgr5',
			'elgr6' => 'Elgr6',
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

		$criteria->compare('elgr1',$this->elgr1);
		$criteria->compare('elgr2',$this->elgr2);
		$criteria->compare('elgr3',$this->elgr3,true);
		$criteria->compare('elgr4',$this->elgr4,true);
		$criteria->compare('elgr5',$this->elgr5,true);
		$criteria->compare('elgr6',$this->elgr6);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elgr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getList($gr1,$elgz1)
    {

        $res = Yii::app()->db->createCommand()
            ->select('elgr2,elgr3')
            ->from('elgr')
            ->where(array('in', 'elgr2', $elgz1))
            ->andWhere('elgr1 = :GR1', array(':GR1' => $gr1))
            ->queryAll();

        if(!empty($res))
        {
            $arr = array();
            foreach($res as $val)
            {
                $arr[$val['elgr2']]=$val['elgr3'];
            }
            return $arr;
        }else
            return array();
    }
}
