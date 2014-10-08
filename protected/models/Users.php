<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $u1
 * @property string $u2
 * @property string $u3
 * @property string $u4
 * @property integer $u5
 * @property integer $u6
 * @property integer $u7
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('u1', 'required'),
			array('u1, u5, u6, u7', 'numerical', 'integerOnly'=>true),
			array('u2, u3', 'length', 'max'=>200),
			array('u4', 'length', 'max'=>400),

            array('u2, u4', 'checkIfUnique'),
            array('u4', 'email'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('u1, u2, u3, u4, u5, u6, u7', 'safe', 'on'=>'search'),
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
			'u1' => 'U1',
			'u2' => 'Login',
			'u3' => 'Password',
			'u4' => 'Email',
			'u5' => 'U5',
			'u6' => 'U6',
			'u7' => 'U7',
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

		$criteria->compare('u1',$this->u1);
		$criteria->compare('u2',$this->u2,true);
		$criteria->compare('u3',$this->u3,true);
		$criteria->compare('u4',$this->u4,true);
		$criteria->compare('u5',$this->u5);
		$criteria->compare('u6',$this->u6);
		$criteria->compare('u7',$this->u7);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Returns true if this user is admin.
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->u7 == 1;
    }

    /**
     * Returns true if this user is teacher.
     * @return boolean
     */
    public function getIsTeacher()
    {
        return $this->u5 == 1;
    }

    /**
     * Returns true if this user is student.
     * @return boolean
     */
    public function getIsStudent()
    {
        return $this->u5 == 0;
    }

    public function getName()
    {
        $id = $this->u6;

        if ($this->u5 === 0 || $this->u5 === 2) { // student or parent
            $model = St::model()->findByPk($id);
            $name  = $model->getShortName();
        } elseif ($this->u5 == 1) {             // teacher
            $model = P::model()->findByPk($id);
            $name  = $model->getShortName();
        } elseif (empty($this->u5) && empty($this->u6))
            $name = 'mkp';
        else
            $name = '';

        return $name;
    }

    public function checkIfUnique($attribute, $params)
    {
        if (empty($this->$attribute))
            return;

        $criteria = new CDbCriteria;
        $criteria->addCondition('u1 != '.$this->u1);
        $criteria->addInCondition($attribute, array($this->$attribute));

        $amount = Users::model()->count($criteria);

        if ($amount > 0) {
            $labels = $this->attributeLabels();
            $errorMessage = $labels[$attribute].' '.tt('значение должно быть уникально!');
            $this->addError($attribute, $errorMessage);
        }
    }
}
