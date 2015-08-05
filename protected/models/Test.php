<?php

/**
 * This is the model class for table "test".
 *
 * The followings are the available columns in table 'test':
 * @property integer $test1
 * @property integer $test2
 * @property integer $test3
 * @property integer $test4
 * @property integer $test5
 * @property integer $test7
 * @property integer $test8
 * @property integer $test9
 * @property string $test10
 * @property integer $test11
 *
 * The followings are the available model relations:
 * @property Uo $test20
 * @property Gr $test30
 * @property St $test40
 * @property I $test110
 */
class Test extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('test1', 'required'),
			array('test1, test2, test3, test4, test5, test7, test8, test9, test11', 'numerical', 'integerOnly'=>true),
			array('test10', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('test1, test2, test3, test4, test5, test7, test8, test9, test10, test11', 'safe', 'on'=>'search'),
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
			'test20' => array(self::BELONGS_TO, 'Uo', 'test2'),
			'test30' => array(self::BELONGS_TO, 'Gr', 'test3'),
			'test40' => array(self::BELONGS_TO, 'St', 'test4'),
			'test110' => array(self::BELONGS_TO, 'I', 'test11'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'test1' => 'Test1',
			'test2' => 'Test2',
			'test3' => 'Test3',
			'test4' => 'Test4',
			'test5' => 'Test5',
			'test7' => 'Test7',
			'test8' => 'Test8',
			'test9' => 'Test9',
			'test10' => 'Test10',
			'test11' => 'Test11',
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

		$criteria->compare('test1',$this->test1);
		$criteria->compare('test2',$this->test2);
		$criteria->compare('test3',$this->test3);
		$criteria->compare('test4',$this->test4);
		$criteria->compare('test5',$this->test5);
		$criteria->compare('test7',$this->test7);
		$criteria->compare('test8',$this->test8);
		$criteria->compare('test9',$this->test9);
		$criteria->compare('test10',$this->test10,true);
		$criteria->compare('test11',$this->test11);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Test the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getDispArray()
        {
            if (!Yii::app()->user->IsStd)
                return array();
		$sql = <<<SQL
			select TEST2,d2
			from TEST
			   inner join uo on (TEST.TEST2 = uo.uo1)
			   inner join d on (uo.uo3 = d.d1)
			where TEST4=:st1
			group by TEST2,d2
			order by d2 collate UNICODE
SQL;
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':st1',Yii::app()->user->DbModel->st1);
                $disciplines = $command->queryAll();
                return $disciplines;
        }
        
        public function getValueByDisp($uo1)
        {
            if (!Yii::app()->user->IsStd||empty($uo1))
                return array();
            $res=  Test::model()->find('test4='.Yii::app()->user->DbModel->st1.' AND test2='.$uo1.' AND test5<=0');
            $res=$this->changeValKod($res);
            return $res;
        }
        
        public function changeValKod($res)
        {
            $arr=array(
                -1=>tt('неув.'),
                -2=>tt('уваж.'),
                -3=>tt(''),
            );
            if($res!=null)
            {
                if($res->test6<0&&isset($arr[$res->test6]))
                {
                   $res->test6=$arr[$res->test6]; 
                }
                if($res->test7<0&&isset($arr[$res->test7]))
                {
                   $res->test7=$arr[$res->test7]; 
                }
                if($res->test8<0&&isset($arr[$res->test8]))
                {
                   $res->test8=$arr[$res->test8]; 
                }
                if($res->test9<0&&isset($arr[$res->test9]))
                {
                   $res->test9=$arr[$res->test9]; 
                }
            }
            return $res;
        }
        
        public function getValueByDispNumber($uo1,$number)
        {
            if (!Yii::app()->user->IsStd||empty($uo1))
                return array();
            $res=  Test::model()->find('test4='.Yii::app()->user->DbModel->st1.' AND test2='.$uo1.' AND test5='.$number);
            $res=$this->changeValKod($res);
            return $res;
        }
        
        public function getMaxTest()
        {
            if (!Yii::app()->user->IsStd)
                return 0;
            
                $sql = <<<SQL
			select MAX(test5)
                        FROM test
			where TEST4=:st1
SQL;
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':st1',Yii::app()->user->DbModel->st1);
                $max = $command->queryRow();
                if(!empty($max))
                    return $max['max'];
                else {
                    return 0;
                }
        }
}
