<?php

/**
 * This is the model class for table "users_email".
 *
 * The followings are the available columns in table 'users_email':
 * @property string $ue1
 * @property integer $ue2
 * @property string $ue3
 *
 * The followings are the available model relations:
 * @property Users $ue20
 */
class UsersEmail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ue2', 'numerical', 'integerOnly'=>true),
			array('ue1', 'length', 'max'=>400),
			array('ue3', 'length', 'max'=>180),
            array('ue3','unique', 'className' => 'UsersEmail'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ue1, ue2, ue3', 'safe', 'on'=>'search'),
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
			'ue20' => array(self::BELONGS_TO, 'Users', 'ue2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ue1' => 'Ue1',
			'ue2' => 'Ue2',
			'ue3' => 'Ue3',
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

		$criteria->compare('ue1',$this->ue1,true);
		$criteria->compare('ue2',$this->ue2);
		$criteria->compare('ue3',$this->ue3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersEmail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * UsersEmail constructor.
     * @param Users $user
     * @param string $scenario
     */
	/*public function __construct($user, $scenario = 'insert')
    {
        parent::__construct($scenario);

        $this->ue1 = $user['u4'];
        $this->ue2 = $user['u1'];

        $this->generateToken();
    }*/

    /**
     * Сгенерировать токен
     */
    public function generateToken(){
        $token = openssl_random_pseudo_bytes(12);
        $hex   = bin2hex($token);
        $this->ue3 = $hex. '_' . time();
    }

    /**
     * Проверка токена
     * @param $token
     * @return bool
     */
    public function validateToken($token){
        if(!static::isTokenValid($token))
            return false;

        return $this->ue3 === $token;
    }

    /**
     * Проверка валидный ли токен
     * @param $token string
     * @return bool
     */
    private static function isTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = 3600;
        return $timestamp + $expire >= time();
    }
}
